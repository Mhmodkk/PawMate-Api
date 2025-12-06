<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShelterFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->randomElement(['Alhadara','Alforat','Mokambo','Shreaa','Gramana','Althaura']),
            'city' => fake()->randomElement(['Homs','Raqqa','aleppo','Hama','Damascus','Tartus']),
            'phone' => fake()->randomElement(['09','01']).fake()->numerify('#######')
        ];
    }
}
