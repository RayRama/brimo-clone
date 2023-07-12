<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $table = 'transaction_withdraws';

    protected $fillable = [
        'transactions_id',
        'code',
        'expired',
        'timestamp',
    ];
}
