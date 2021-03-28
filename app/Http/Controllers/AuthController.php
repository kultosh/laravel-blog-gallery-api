<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'token' => $accessToken]);
    }
}
