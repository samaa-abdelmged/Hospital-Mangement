<?php

namespace App\Repository\Dashboard_Employee\LaboratorieEmployee;

use App\Interfaces\Dashboard_Employee\LaboratorieEmployee\LaboratorieEmployeeRepositoryInterface;
use App\Models\Employee;
use App\Models\LaboratorieEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class LaboratorieEmployeeRepository implements LaboratorieEmployeeRepositoryInterface
{

    public function index()
    {
        $laboratorie_employees = LaboratorieEmployee::all();
        return view('Dashboard.employee_dashboard.laboratorie_employee.index', compact('laboratorie_employees'));
    }

    public function store($request)
    {

        $laboratorie_employee = new LaboratorieEmployee();
        $laboratorie_employee->name = $request->name;
        $laboratorie_employee->email = $request->email;
        $laboratorie_employee->password = Hash::make($request->password);
        $laboratorie_employee->save();

        $LaboratorieEmployee = new Employee();
        $LaboratorieEmployee->name = $request->name;
        $LaboratorieEmployee->email = $request->email;
        $LaboratorieEmployee->password = Hash::make($request->password);
        $LaboratorieEmployee->section = 2;
        $LaboratorieEmployee->laboratorie_employee_id = LaboratorieEmployee::latest()->first()->id;
        $LaboratorieEmployee->save();

        session()->flash('add');
        return back();

    }

    public function update($request, $id)
    {
        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $ray_employee = LaboratorieEmployee::find($id);
        $ray_employee->update($input);

        $employee = Employee::where('laboratorie_employee_id', $id)->first();
        $employee->update($input);

        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            LaboratorieEmployee::destroy($id);
            Employee::where('laboratorie_employee_id', $id)->delete();
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}