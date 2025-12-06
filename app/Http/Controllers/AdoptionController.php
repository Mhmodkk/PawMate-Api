<?php

namespace App\Http\Controllers;

use App\Notifications\AdoptionStatusNotification;
use App\Http\Requests\AdoptionRequest;
use App\Http\Requests\UpdateAdoptionRequest;
use App\Models\Adoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    public function getAdoptUser($id)
    {
        $adopt = Adoption::findOrFail($id);
        return response()->json($adopt,200);
    }

    public function show($id)
    {
        $adopt = Adoption::find($id);
        return response()->json($adopt,200);
    }

    public function store(AdoptionRequest $request)
    {
        $user_id=Auth::user()->id;
        $validatedData=$request->validated();
        $validatedData['user_id']=$user_id;
        $validatedData['status']='Pending';
        $adopt = Adoption::create($validatedData);
        $adopt->user->notify(new AdoptionStatusNotification($adopt)); // ارسال الاشعار
        return response()->json($adopt,201);
    }


    public function update(UpdateAdoptionRequest $request,$id)
    {
        $user_id=Auth::user()->id;
        $validatedData['user_id']=$user_id;
        $adopt = Adoption::findOrFail($id);
        if($adopt->user_id!=$user_id)
        return response()->json(['message'=>'Unauthurized'],403);

        $adopt->update($request->validated());
        $adopt->user->notify(new AdoptionStatusNotification($adopt));
        return response()->json($adopt,200);
    }


    public function destroy($id)
    {
        $adopt = Adoption::findOrFail($id);
        $adopt->delete();
        return response()->json(null,204);
    }

}
