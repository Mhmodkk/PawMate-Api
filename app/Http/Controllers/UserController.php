<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function register(Request $request)
    {
       $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users|email',
            'password'=>'required|string|min:8'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        //Mail::to($user->email)->send(new WelcomeMail());
        return response()->json([
            'message'=>'User Registered  Successfuly',
            'User'=>$user,

        ],201);

    }


    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);
        if(!Auth::attempt($request->only('email','password')))
        return response()->json(['message'=>'invalid email or password'],401);
        $user=User::where('email',$request->email)->FirstorFail();
        $token=$user->createToken('auth_Token')->plainTextToken;
        return response()->json([
            'message'=>'Login Successfully',
            'User'=>$user,
            'Token'=>$token]
            ,201);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'logout Successfully']);
    }


    public function getProfile($id)
    {
       $profile = User::find($id)->profile;
       return response()->json($profile,200);
    }

    public function getUserPets($id)
    {
       $pets = User::findOrFail($id)->pets;
       return response()->json($pets,200);
    }

    public function GetUser()
    {
        $user_id = Auth::user()->id;
        $userData = User::with('profile')->findOrFail($user_id);
        return new UserResource($userData);
    }


    public function notifications()
    {
        return auth()->user()->notification;
    }


    public function unReadNotifications()
    {
        return auth()->user()->unReadNotifications;
    }


    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['message' => 'Readed']);
    }
}
