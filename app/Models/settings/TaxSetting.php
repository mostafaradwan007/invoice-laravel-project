<?php

namespace App\Models\settings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxSetting extends Model
{
       protected $table = 'tax_settings';
    protected $fillable = [
        'inclusive_taxes',
        'expensetaxrates',
        'lineitemtaxrate',
        'invoicetaxrates'
    ];
}
