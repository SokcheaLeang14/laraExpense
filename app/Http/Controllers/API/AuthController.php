<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        //check existing email
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password) || $user->active != 1){
            return response()->json([
                'message' => 'Bad Credential'
            ], 401);
        }
        
        $token = $user->createToken('appToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function Logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged Out'
        ]);
    }
}
