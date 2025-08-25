<?php

namespace App\Models\settings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
       protected $table = 'tax_rates';
    protected $fillable = ['name', 'tax_percentage'];
}


