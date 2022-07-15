<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class SignUpController extends Controller
{
    public function Index()
    {
        $page = 'register';
        return view('login.form', compact('page'));
    }

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

        User::insert($register);

        return redirect()->back()->with('status', 'Account Registered');

    }
}
