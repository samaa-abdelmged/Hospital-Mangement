<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\PatientTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientTableSeeder extends Seeder
{

    public function run()
    {
        $Patients = new Patient();
        $Patients->email = 'patient550@gmail.com';
        $Patients->password = Hash::make('12345678');
        $Patients->Date_Birth = '2001-01-01';
        $Patients->Phone = '123456789';
        $Patients->Gender = 1;
        $Patients->Blood_Group = 'o+';
        $Patients->save();

        //insert trans
        $PatientTranslation = new PatientTranslation();
        $PatientTranslation->name = 'ptient';
        $PatientTranslation->Address = 'cairo';
        $PatientTranslation->patient_id = 1;
        $PatientTranslation->locale = 'ar';
        $PatientTranslation->save();
    }
}