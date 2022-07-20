<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\Wallets;
use Carbon\Carbon;
use Auth;
class DashboardController extends Controller
{
    public function Index()
    {
        $balance_per_day = 0;
        $balance_per_day_riel = 0;
        
        //Get Logged in User Balance
        $balances = Wallets::select('id','name','amount','currency_symbol')
                ->with('expenses')
                ->where('user_id', Auth::user()->id)
                ->get();

        if(isset($balances)){
            // Get Remain Balance to use everyday
            $today = \Carbon\Carbon::now();
            $finish_time = \Carbon\Carbon::parse(date("Y-m-05", strtotime("+1 month")));
            $dayToSalary = $today->diffInDays($finish_time, false);

        }
        
        return view('index',compact('dayToSalary', 'balances', 'balance_per_day', 'balance_per_day_riel'));
    }
}
