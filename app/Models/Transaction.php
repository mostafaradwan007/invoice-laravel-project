<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'status',
        'deposit',
        'withdrawal',
        'date',
        'description',
       'amount',
       'bank_account'
    ];

}
