<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Interfaces\DivisionRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\DivisionResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    private DivisionRepositoryInterface $divisionRepositoryInterface;

    public function __construct(DivisionRepositoryInterface $divisionRepositoryInterface)
    {
        $this->divisionRepositoryInterface = $divisionRepositoryInterface;
    }

    public function index(Request $request)
    {
        try {
            $search = $request->input('name');
            $perPage = $request->input('per_page', 10);

            $divisions = $this->divisionRepositoryInterface->index($search, $perPage);

            $pagination = [
                'current_page' => $divisions->currentPage(),
                'per_page' => $divisions->perPage(),
                'total' => $divisions->total(),
                'last_page' => $divisions->lastPage(),
                'next_page_url' => $divisions->nextPageUrl(),
                'prev_page_url' => $divisions->previousPageUrl(),
            ];

            if ($divisions->isEmpty()) {
                return ApiResponseClass::sendResponse('error', [], 'Data divisions not found.', 404);
            }

            return ApiResponseClass::sendPaginatedResponse('success', DivisionResource::collection($divisions), $pagination, 'divisions', 'Data divisions fetched successfully.');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e);
        }
    }
}
