<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\Wallets;
use Carbon\Carbon;
use Auth;
class DasboardController extends Controller
{
    public function Index()
    {
        $balance_per_day = 0;
        $balance_per_day_riel = 0;
        $total_expense = 0;
        $total_expense = 0;

        $expenses = \DB::table('expenses')
            ->join('wallets', 'wallets.id' , '=', 'expenses.wallet_id')
            ->selectRaw('expenses.amount')
            ->where('wallets.user_id', Auth::user()->id)
            ->where('expense_date','>', now()->subDays(30)->endOfDay())
            ->get();

       
        foreach($expenses as $expense)
        {
            $total_expense = $total_expense+$expense->amount;
        }

        //Get Logged in User Balance
        $balances = Wallets::select('name','amount','currency_symbol')
                ->where('user_id', Auth::user()->id)
                ->get();

        if(isset($balances)){
            // Get Remain Balance to use everyday
            $today = \Carbon\Carbon::now();
            $finish_time = \Carbon\Carbon::parse(date("Y-m-05", strtotime("+1 month")));
            $dayToSalary = $today->diffInDays($finish_time, false);
            
            foreach($balances as $balance){
                $balance_per_day = $balance->amount/$dayToSalary;
                $balance_per_day_riel = $balance_per_day * 4100;
            }
        }
        
        return view('index',compact('total_expense', 'balances', 'balance_per_day', 'balance_per_day_riel'));
    }
}
