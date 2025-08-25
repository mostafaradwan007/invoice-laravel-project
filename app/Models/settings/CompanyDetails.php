<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    protected $table = 'company_details';

    protected $fillable = [
        'companyname',
        'IDnumber',
        'VATnumber',
        'website',
        'email',
        'companyPhone',
        'industry',
        'classification',
        'street_address',
        'apt_suite',
        'city',
        'state_province',
        'postal_code',
    ];
}
