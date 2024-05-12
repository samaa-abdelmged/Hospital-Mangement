<?php

namespace App\Repository\Dashboard_Employee\RayEmployee;

use App\Interfaces\Dashboard_Employee\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\Employee;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{

    public function index()
    {
        $ray_employees = RayEmployee::all();
        return view('Dashboard.employee_dashboard.ray_employee.index', compact('ray_employees'));
    }

    public function store($request)
    {


        $ray_employee = new RayEmployee();
        $ray_employee->name = $request->name;
        $ray_employee->email = $request->email;
        $ray_employee->password = Hash::make($request->password);
        $ray_employee->save();

        $RayEmployee = new Employee();
        $RayEmployee->name = $request->name;
        $RayEmployee->email = $request->email;
        $RayEmployee->password = Hash::make($request->password);
        $RayEmployee->section = 1;
        $RayEmployee->ray_employee_id = RayEmployee::latest()->first()->id;
        $RayEmployee->save();

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

        $ray_employee = RayEmployee::find($id);
        $ray_employee->update($input);

        $employee = Employee::where('ray_employee_id', $id)->first();
        $employee->update($input);

        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            RayEmployee::destroy($id);
            Employee::where('ray_employee_id', $id)->delete();

            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}