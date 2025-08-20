<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
     protected $fillable = [
        'invoice_id',
        'item_name',
        'description',
        'unit_cost',
        'quantity',
        'line_total'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
