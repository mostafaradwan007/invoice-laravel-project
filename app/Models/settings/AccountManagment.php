<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountManagment extends Model
{
    protected $table = 'account_managment';
    protected $fillable = [

        'activate_company',

        'enable_markdown',

        'include_drafts',

        //enabled modules
        'invoices',

        'recurring_invoices',
        'quotes',

        'credits',

        'projects',

        'tasks',

        'vendors',

        'expenses',

        'purchase_orders',

        'recurring_expenses',

        'transactions',

    ];
}
