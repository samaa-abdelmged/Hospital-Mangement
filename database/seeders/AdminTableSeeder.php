<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::create([
            'name' => 'samaa',
            'email' => 'samaaabdelmged55@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

    }
}