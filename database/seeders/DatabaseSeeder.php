<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserTableSeeder::class,
            AdminTableSeeder::class,
            SectionTableSeeder::class,
            DoctorTableSeeder::class,
            ImageTableSeeder::class,
            PatientTableSeeder::class,
            RayEmployeeTableSeeder::class,
            ServiceTableSeeder::class,
            LaboratoryEmployeeTableSeeder::class,
            EmployeeTableSeeder::class,

        ]);

    }
}