<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface
{
    public function index($search, $perPage, $division_id);
    public function store($request, $imagePath);
    public function update($request, $id, $imagePath);
    public function getById($id);
    public function destroy($id);
}
