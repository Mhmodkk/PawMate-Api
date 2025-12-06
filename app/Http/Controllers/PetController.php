<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function getAllPets()
    {
        $pets=Pet::all();
        return response()->json($pets,200);
    }

    public function getPetUser($id)
    {
       $user = Pet::findOrFail($id)->user;
       return response()->json($user,200);
    }

    public function index()
    {
        $pets=Auth::user()->pets;
        return response()->json($pets,200);
    }

    public function show($id)
    {
        $pet=Pet::find($id);
        return response()->json($pet,200);
    }

    public function store(StorePetRequest $request)
    {
        $user_id=Auth::user()->id;
        $validatedData=$request->validated();
        $validatedData['user_id']=$user_id;
        if($request->hasFile('image'))
        {
            $path=$request->file('image')->store('pet photo','public');
            $validatedData['image']=$path;
        }
        $pet=Pet::create($validatedData);
        return response()->json(['message'=>'Pet added Successfully',$pet],201);
    }

    public function update(UpdatePetRequest $request,$id)
    {
        $user_id=Auth::user()->id;
        $pet = Pet::findOrfail($id);
        if($pet->user_id!=$user_id)
        return response()->json(['message'=>'Unauthurized'],403);

        $pet->update($request->validated());
        return response()->json($pet,200);
    }

    public function destroy($id)
    {
        try
        {
        $pet = Pet::findOrfail($id);
        $pet->delete();
        return response()->json('Pet Removed Successfully',200);
        }
        catch(ModelNotFoundException $m)
        {
            return response()->json([
                'error'=>'Pet Not Found',
                'details'=>$m->getMessage()
            ],404);
        }
        catch(Exception $e)
        {
            return response()->json([
                'error'=>'somthing went wrong while delete the pet',
                'details'=>$e->getMessage()
            ],404);
        }
    }

    public function addToFavorites($pet_id)
    {
        Pet::findOrFail($pet_id);
        Auth::user()->favoritePets()->syncWithoutDetaching($pet_id);
        return response()->json(['message'=>'Pet added to favorite'],200);
    }

    public function removeFromFavorites($pet_id)
    {
        Pet::findOrFail($pet_id);
        Auth::user()->favoritePets()->detach($pet_id);
        return response()->json(['message'=>'Pet removed from favorite'],200);
    }

    public function getFavoritesPets($user_id)
    {
        $user=User::findOrFail($user_id)->favoritePets;
        return response()->json($user,200);
    }

    public function GetPet()
    {
        $petData = Pet::all();
        return PetResource::collection($petData);
    }
}
