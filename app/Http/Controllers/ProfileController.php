<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\Profile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show($id)
    {
        $profile = Profile::where('user_id',$id)->firstOrFail();
        return response()->json($profile,200);
    }

    public function store(StoreProfileRequest $request)
    {
        {

        $user_id=Auth::user()->id;
        $validatedData=$request->validated();
        $validatedData['user_id']=$user_id;
        if($request->hasFile('image'))
        {
            $path=$request->file('image')->store('my photo','public');
            $validatedData['image'] = $path;
        }
        $profile=Profile::create($validatedData);
        return response()->json(['message'=>'Profile Created Successfully',$profile],201);

        }
    }

    public function update(UpdateProfileRequest $request,$id)
    {
        $user_id=Auth::user()->id;
        $profile=Profile::findOrFail($id);
        if ($profile->user_id!=$user_id)
        return response()->json(['message'=>'Unauthurized'],403);

        $profile->update($request->validated());
        return response()->json($profile,200);
    }
}
