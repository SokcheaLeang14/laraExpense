<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    
    public function expense_category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id'); //category_id is a foriegn key in table Expense
    }

    public function wallet()
    {
        return $this->belongsTo(Wallets::class, 'wallet_id');
    }

    public static function AddExpenseToWallet($expense_amount, $wallet_id)
    {
        if(isset($expense_amount)){
            return \DB::table('wallets')->where('id', $wallet_id)->decrement('amount', $expense_amount);
        }
    }

    public static function RemoveExpenseFromWallet($expense_amount, $wallet_id)
    {
        if(isset($expense_amount)){
            return \DB::table('wallets')->where('id', $wallet_id)->increment('amount', $expense_amount);
        }
    }
}
