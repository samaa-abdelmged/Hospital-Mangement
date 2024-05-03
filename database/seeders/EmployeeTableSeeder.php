<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeTableSeeder extends Seeder
{

    public function run()
    {
        $ray_employee = new Employee();
        $ray_employee->name = 'mohamed mohamed';
        $ray_employee->email = 'mohamed@gmail.com';
        $ray_employee->password = Hash::make('12345678');
        $ray_employee->section = 1;
        $ray_employee->ray_employee_id = 1;
        $ray_employee->save();

        ///////////////////////////////////////

        $LaboratorieEmployee = new Employee();
        $LaboratorieEmployee->name = 'nada yaser';
        $LaboratorieEmployee->email = 'nada@gmail.com';
        $LaboratorieEmployee->password = Hash::make('12345678');
        $LaboratorieEmployee->section = 2;
        $LaboratorieEmployee->laboratorie_employee_id = 1;
        $LaboratorieEmployee->save();

    }
}