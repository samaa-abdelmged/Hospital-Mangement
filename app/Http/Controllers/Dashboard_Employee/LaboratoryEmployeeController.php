<?php

namespace App\Http\Controllers\Dashboard_Employee;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard_Employee\LaboratorieEmployee\LaboratorieEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryEmployeeController extends Controller
{
    private $employee;

    public function __construct(LaboratorieEmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }

    public function index()
    {
        return $this->employee->index();
    }

    public function store(Request $request)
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