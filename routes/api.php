<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPetController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\UserController;
use App\Models\PublicPet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('publicpets',PublicPetController::class)->middleware('CheckUser');

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function()
{

Route::apiResource('adoption_requests',AdoptionController::class);


Route::prefix('profile')->group(function()
{
Route::post('',[ProfileController::class,'store']);
Route::get('/{id}',[ProfileController::class,'show']);
});

Route::get('user',[UserController::class,'GetUser']);
Route::get('user/{id}/profile',[UserController::class,'getProfile']);
Route::get('user/{id}/pets',[UserController::class,'getUserPets']);


Route::post('pet/{id}/favorite',[PetController::class,'addToFavorites']);
Route::delete('pet/{id}/favorite',[PetController::class,'removeFromFavorites']);
Route::get('pet/{id}/favorites',[PetController::class,'getFavoritesPets']);


Route::get('pet/all',[PetController::class,'getAllPets'])->middleware('CheckUser');
Route::apiResource('pets',PetController::class);
Route::get('pet/{id}/user',[PetController::class,'getPetUser']);
Route::get('pet',[PetController::class,'GetPet']);

Route::apiResource('shelters',ShelterController::class)->middleware('CheckUser');

Route::apiResource('appointments',AppointmentController::class);

});
