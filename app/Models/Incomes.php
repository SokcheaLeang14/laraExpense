<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomes extends Model
{
    use HasFactory;

    public function income_category()
    {
        return $this->belongsTo(IncomeCategory::class,'category_id');
    }

    public function wallet()
    {
        return $this->belongsTo(Wallets::class, 'wallet_id');
    }

    public static function AddIncomeToWallet($income_amount, $wallet_id)
    {
        if(isset($income_amount)){
            return \DB::table('wallets')->where('id', $wallet_id)->increment('amount', $income_amount);
        }
    }
    
    public static function RemoveIncomeFromWallet($income_amount, $wallet_id)
    {
        if(isset($income_amount)){
            return \DB::table('wallets')->where('id', $wallet_id)->decrement('amount', $income_amount);
        }
    }
}
