<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\EmployeeResource;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{

    private EmployeeRepositoryInterface $employeeRepositoryInterface;
    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface)
    {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function index(Request $request)
    {
        try {
            $search = $request->input('name');
            $perPage = $request->input('per_page', 10);
            $division_id = $request->input('division');

            $employees = $this->employeeRepositoryInterface->index($search, $perPage, $division_id);

            $pagination = [
                'current_page' => $employees->currentPage(),
                'per_page' => $employees->perPage(),
                'total' => $employees->total(),
                'last_page' => $employees->lastPage(),
                'next_page_url' => $employees->nextPageUrl(),
                'prev_page_url' => $employees->previousPageUrl(),
            ];

            if ($employees->isEmpty()) {
                return ApiResponseClass::sendResponse('error', [], 'Data employees not found.', 404);
            }

            return ApiResponseClass::sendPaginatedResponse('success', EmployeeResource::collection($employees), $pagination, 'employees', 'Data employees fetched successfully.');
        } catch (\Exception $e) {
            return ApiResponseClass::handleException($e);
        }
    }

    public function store(CreateEmployeeRequest $request)
    {
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('employees/images', 'public');
            }

            log::debug('imagePath: ' . $imagePath);

            $this->employeeRepositoryInterface->store($request, $imagePath);

            return ApiResponseClass::sendResponse('success', [], 'Employee successfully created.', 201, 'employee');
        } catch (\Exception $e) {
            return ApiResponseClass::handleException($e);
        }
    }


    public function update(UpdateEmployeeRequest $request)
    {
        try {
            $id = $request->route('id');

            Log::debug('Request Data: ', $request->all());

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('employees/images', 'public');
            }

            log::debug('imagePath: ' . $imagePath);

            $this->employeeRepositoryInterface->update($request, $id, $imagePath);
            return ApiResponseClass::sendResponse('success', [], 'Employee successfully updated.', 200, 'employee');
        } catch (\Exception $e) {
            return ApiResponseClass::handleException($e);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->route('id');
            $employee = $this->employeeRepositoryInterface->getById($id);

            if (!$employee) {
                return ApiResponseClass::sendResponse('error', [], 'Employee not found.', 404);
            }

            $this->employeeRepositoryInterface->destroy($id);
            return ApiResponseClass::sendResponse('success', [], 'Employee successfully deleted.', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::handleException($e);
        }
    }
}
