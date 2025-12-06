<?php

namespace Database\Factories;

use App\Models\Shelter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'type' => fake()->randomElement(['cat','dog','rabit','bird']),
            'gender' => fake()->randomElement(['Male','Female']),
            'age' => fake()->numberBetween(1,15),
            'description' =>fake()->sentence(),
            'is_adopted' =>fake()->boolean(20),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'shelter_id' => Shelter::inRandomOrder()->first()->id ?? Shelter::factory(),


        ];
    }

    public function avilable()
    {
        return $this->state(function(array $attributes){
            return [
                'is_adopted'=> false,
            ];
        });
    }

    public function adopted()
    {
        return $this->state(function(array $attributes){
            return [
                'is_adopted'=> true,
            ];
        });
    }
}
