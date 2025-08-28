<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'id_number',
        'vat_number',
        'phone',
        'website',
        'contact_name',
        'contact_email',
        'street',
        'city',
        'state_province',
        'postal_code',
        'country',
    ];

   public function expense(){
        return $this->hasMany(Expense::class);
   }
}
