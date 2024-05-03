<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'samaa',
            'email' => 'samaaroshdy55@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

    }
}