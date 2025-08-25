<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'Expense_settings';

    protected $fillable = [

        'should_be_invoiced',

        'mark_paid',

      
        'convert_currency',

        'inclusive_taxes'

    ];
}
