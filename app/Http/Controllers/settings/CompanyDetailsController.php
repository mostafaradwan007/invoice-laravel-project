<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\controller;

use App\Models\settings\CompanyDetails; // ✅ Singular Model name (Laravel convention)
use Illuminate\Http\Request;

class CompanyDetailsController extends Controller
{
    public function index()
    {
        $company = CompanyDetails::first(); // get first record (if exists)

        return view('settings.companydetails.index', compact('company'));
    }



  
public function updateDetails(Request $request)
{
    $validated = $request->validate([
        'companyname'    => 'string|max:255',
        'email'          => 'email',
        'industry'       => 'nullable|in:Accounting & Legal,Advertising,AeroSpace,Agriculture,Automotive,Banking & Finance,Biotechnology,BroadCasting,Business Services,Commodities & Chemicals,Communications,Computers & Hightech,Construction,Defense,Energy,Entertainment,Government,HealthCare & Life Sciences,Insurance,Manufacturing,Marketing,Media,Non-Profit & Higher ED,Other,Pharmaceuticals,Photography,Professional Services & Consulting,Real State,Restaurant & Catering,Retail & Wholesale,Sports,Transportation,Travel & Luxury',
        'classification' => 'nullable|in:Individual,Business,Company,PartnerShip,Trust,Charity,Government,Other',
        'IDnumber'       => 'nullable|numeric',
        'VATnumber'      => 'nullable|numeric',
        'companyPhone'   => 'nullable|numeric',
        'website'        => 'nullable|url',
    ]);

    $company = CompanyDetails::first();

    if ($company) {
        $company->update($validated);
    } else {
        CompanyDetails::create($validated); // create if not exists
    }

         return redirect()->route('settings.index')->with('success', 'Company details updated.');
}
public function updateAddress(Request $request)
{
    $validated = $request->validate([
        'street_address' => 'nullable|string|max:255',
        'apt_suite'      => 'nullable|string|max:255',
        'city'           => 'nullable|string|max:255',
        'state_province' => 'nullable|string|max:255',
        'postal_code'    => 'nullable|string|max:20',
    ]);

    $company = CompanyDetails::first();

    if ($company) {
        $company->update($validated);
    } else {
        CompanyDetails::create($validated); // create if not exists
    }

       return redirect()->route('settings.index')->with('success', 'Address details updated.');

}

}
