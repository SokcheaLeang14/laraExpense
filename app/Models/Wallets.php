<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    use HasFactory;

    protected $table = 'wallets';
    protected $fillable = [
        '*',
    ];

    public function expenses()
    {
        return $this->hasMany(Expenses::class, 'wallet_id');
    }
}
