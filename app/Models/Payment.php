<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_number',
        'client_name',
        'amount',
        'invoice_number',
        'payment_date',
        'payment_type',
        'transaction_reference',
        'status',
        'private_notes',
        'send_email',
        'convert_currency',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'send_email'   => 'boolean',
        'convert_currency' => 'boolean',
    ];
}
