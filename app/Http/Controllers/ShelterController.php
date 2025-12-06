<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShelterRequest;
use App\Http\Requests\UpdateShelterRequest;
use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function index()
    {
        $shelter = Shelter::all();
        return response()->json($shelter,200);
    }
    public function show($id)
    {
        $shelter=Shelter::find($id);
        return response()->json($shelter,200);
    }

    public function store(StoreShelterRequest $request)
    {
        $shelter=Shelter::create($request->validated());
        return response()->json($shelter,201);
    }

    public function update(UpdateShelterRequest $request,$id)
    {
        $shelter = Shelter::findOrfail($id);
        $shelter->update($request->validated());
        return response()->json($request,200);
    }

    public function destroy($id)
    {
        $shelter = Shelter::findOrfail($id);
        $shelter->delete();
        return response()->json(null,204);
    }
}
