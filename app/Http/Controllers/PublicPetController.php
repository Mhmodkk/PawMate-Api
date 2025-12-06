<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicPetRequest;
use App\Models\Pet;
use App\Models\PublicPet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicPetController extends Controller
{
    public function index()
    {
        $pet = Pet::all();
        return response()->json($pet,200);
    }

    public function show($id)
    {
        $pet=Pet::find($id);
        return response()->json($pet,200);
    }

    public function store(StorePublicPetRequest $request)
    {
        $validatedData=$request->validated();
        $validatedData['shelter_id']=$request->input('shelter_id');

        if($request->hasFile('image'))
        {
            $path=$request->file('image')->store('pet photo','public');
            $validatedData['image']=$path;
        }
        $pet=PublicPet::create($validatedData);
        return response()->json(['message'=>'Pet added Successfully',$pet],201);
    }
}
