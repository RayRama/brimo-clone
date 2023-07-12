<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pulsa extends Model
{
    use HasFactory;

    protected $table = 'transaction_pulsas';

    protected $fillable = [
        'transactions_id',
        'phone_number',
        'timestamp',
    ];
}
