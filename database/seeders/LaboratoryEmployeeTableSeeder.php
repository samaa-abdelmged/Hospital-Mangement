<?php

namespace Database\Seeders;

use App\Models\LaboratorieEmployee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LaboratoryEmployeeTableSeeder extends Seeder
{

    public function run()
    {
        $LaboratorieEmployee = new LaboratorieEmployee();
        $LaboratorieEmployee->name = 'nada yaser';
        $LaboratorieEmployee->email = 'nada@gmail.com';
        $LaboratorieEmployee->password = Hash::make('12345678');
        $LaboratorieEmployee->save();
    }
}