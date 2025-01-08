<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Str;


class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function index($search, $perPage, $division_id)
    {
        $query = Employee::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($division_id) {
            $query->where('division_id', $division_id);
        }

        return $query->paginate($perPage);
    }

    public function store($request, $imagePath = null)
    {
        $employee = new Employee;
        $employee->id = Str::uuid();
        $employee->name = $request['name'];
        $employee->phone = $request['phone'];
        $employee->division_id = $request['division'];
        $employee->position = $request['position'];
        $employee->image = $imagePath;
        $employee->save();

        return $employee;
    }

    public function update($request, $id, $imagePath = null)
    {
        $employee = Employee::find($id);
        $employee->name = $request['name'];
        $employee->phone = $request['phone'];
        $employee->division_id = $request['division'];
        $employee->position = $request['position'];
        $employee->image = $imagePath;
        $employee->save();


        return $employee;
    }

    public function getById($id)
    {
        return Employee::find($id);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
    }
}
