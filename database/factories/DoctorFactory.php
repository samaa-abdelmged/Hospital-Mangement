<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [

            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'phone' => $this->faker->phoneNumber,
            'section_id' => Section::all()->random()->id,

            'day_start' => array(
                '1' => '00:00',
                '2' => '00:00',
                '3' => '00:00',
                '4' => '00:00',
                '5' => '00:00',
                '6' => '00:00',
                '7' => '00:00',
            ),

            'day_end' => array(
                '1' => '00:00',
                '2' => '00:00',
                '3' => '00:00',
                '4' => '00:00',
                '5' => '00:00',
                '6' => '00:00',
                '7' => '00:00',
            ),
        ];
    }
}