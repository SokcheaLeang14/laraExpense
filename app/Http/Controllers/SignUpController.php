<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Wallets;
class SignUpController extends Controller
{
    public function Index()
    {
        $page = 'register';
        return view('login.form', compact('page'));
    }

    public function Register(Request $request)
    {
        try{
            \DB::beginTransaction();
            
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
            
            $user_id = User::insertGetId($register);
    
            if($user_id != 0){
                $data = [
                    'user_id' => $user_id,
                    'name' => 'My Wallet',
                    'currency_symbol' => '$',
                    'description' => 'My wallet...',
                    'created_at' => date('Y-m-d h:m:s'),
                ];
                Wallets::insert($data);
            }
    
            \DB::commit();
            return redirect()->back()->with('status', 'Account Registered');
        }
        catch(Exception $e)
        {
            \DB::rollback();
            throw $e->message;
        }
       
    }
}
