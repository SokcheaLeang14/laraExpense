<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{
    public function Index()
    {
        $page = 'login';
        //Go to dashboard if logged in
        if(Auth::check()){
            return redirect('dashboard');
        }
        return view('login.form', compact('page'));
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        //Verify User
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1]))
        {
            return redirect('dashboard')->with('status', 'Logged in');
        }
        else{
           return redirect()->back()->withErrors('Username or Password is not correct');
        }
    }

    public function Logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
