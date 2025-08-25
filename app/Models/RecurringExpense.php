<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecurringExpense extends Model
{
     protected $fillable = [
        'status',
         'client_id', 
        'number',
        'vendor',
        'client',
        'project',
        'category',
        'user',
        'amount',
        'date',
        'frequency',
        'start_date',
        'next_send_date',
        'remaining_cycle',
        'state',
        'publicnotes',
        'privatenotes',
        'should_be_invoiced',
        'mark_paid',
        'convert_currency',
        'add_documents'
    ];
        public function client()
    {
        return $this->belongsTo(Client::class);
    }


}

