<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringInvoice extends Model
{
    use HasFactory;
     protected $fillable = [
        'client_id',
        'invoice_number',
        'po_number',
        'invoice_date',
        'due_date',
        'partial_deposit',
        'discount',
        'discount_type',
        'public_notes',
        'private_notes',
        'terms',
        'footer',
        'subtotal',
        'total',
        'paid_to_date',
        'balance_due'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
