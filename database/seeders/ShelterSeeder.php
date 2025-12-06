<?php

namespace Database\Seeders;

use App\Models\Shelter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShelterSeeder extends Seeder
{
    public function run(): void
    {
        Shelter::factory()->count(10)->create();
    }
}
