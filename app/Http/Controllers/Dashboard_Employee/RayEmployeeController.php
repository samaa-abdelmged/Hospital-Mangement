<?php

namespace App\Http\Controllers\Dashboard_Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\RayRequest;
use App\Interfaces\Dashboard_Employee\RayEmployee\RayEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class RayEmployeeController extends Controller
{
    private $employee;

    public function __construct(RayEmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }

    public function index()
    {
        return $this->employee->index();
    }

    public function store(RayRequest $request)
    {
        return $this->employee->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->employee->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->employee->destroy($id);
    }
}