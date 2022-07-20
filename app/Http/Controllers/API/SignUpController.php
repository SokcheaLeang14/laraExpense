<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function Register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password'=> 'required|confirmed|min:6'
        ]);

        $register = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => 1,
            'created_at' => date('Y-m-d h:m:s'),
        ];

        $user = User::create($register);

        $token = $user->createToken('appToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }
}
