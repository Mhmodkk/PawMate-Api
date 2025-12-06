<?php

namespace Database\Seeders;

use App\Http\Requests\AdoptionRequest;
use App\Models\User;
use App\Notifications\AdoptionStatusNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotifySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $adoptionRequest = AdoptionRequest::first();
        $user->notify(new AdoptionStatusNotification($adoptionRequest,'approved'));
    }
}
