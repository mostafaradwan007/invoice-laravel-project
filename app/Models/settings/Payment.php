<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment_settings';

    protected $fillable = [

        'standard_invoices',

        'recurring_invoices',

        'use_available_credits',

        'use_unapplied_payments',

        'manual_payment_email',

          'online_payment_email',

        'mark_paid_payment_email',

        'payment_email_to_all_contacts',

        'manual_overpayments'  ,

        'allow_overpayment',

        'allow_underpayment',

        'client_initiated_payments',

        'one_page_checkout',

        'unlock_documents',
            'payment_type',
            'quote_valid_until',      
        'auto_bill_on',
        'expense_payment_type',



    ];
}
