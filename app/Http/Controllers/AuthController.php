<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signUp(SignUpRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'token' => $accessToken]);
    }

    public function logOut(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out!']);
    }

    public function logIn(LoginRequest $request)
    {
        if(!auth()->attempt($request->validated()))
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'token' => $accessToken]);
    }
}
