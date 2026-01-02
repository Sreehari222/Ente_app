<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role'=>'user'
        ]);

        return response()->json([
            'token'=>$user->createToken('api')->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json(['error'=>'Invalid'],401);
        }

        return response()->json([
            'token'=>$request->user()->createToken('api')->plainTextToken,
            'role'=>$request->user()->role
        ]);
    }
}
