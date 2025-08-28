<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    use HasFactory;
   protected $fillable = [
    'name', 'number', 'group', 'user', 'id_number', 'vat_number',
    'website', 'phone', 'routing_id', 'valid_vat', 'tax_exempt', 'classification',
    'first_name', 'last_name', 'email', 'contact_phone', 'add_to_invoices',
    'billing_street', 'apt_suite', 'city', 'state_province', 'postal_code', 'country',
    'shipping_street', 'shipping_apt_suite', 'shipping_city',
    'shipping_state_province', 'shipping_postal_code', 'shipping_country',
];
    protected $casts = [
        'valid_vat' => 'boolean',
        'tax_exempt' => 'boolean',
        'add_to_invoices' => 'boolean',
    ];


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

}
