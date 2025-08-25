<?php
namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\settings\TaxRate;
use App\Models\settings\TaxSetting;

class TaxController extends Controller
{
    // Show settings page
    public function index()
    {
        $taxes = TaxRate::all();        // all tax rates
        $settings = TaxSetting::first(); // only 1 row of settings

        return view('settings.taxsettings.index', compact('taxes', 'settings'));
    }

    // Store a new tax rate row
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'tax_percentage' => 'required|numeric|min:0|max:100',
        ]);

        TaxRate::create($validated);

         return redirect()->route('settings.index')->with('success', 'New tax rate added.');

    }

    // Update global settings (toggles / selects)
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'inclusive_taxes'   => 'nullable|in:Yes,No',
            'expensetaxrates'   => 'nullable|in:Disabled,1 tax rate,2 tax rates,3 tax rates',
            'lineitemtaxrate'   => 'nullable|in:Disabled,1 tax rate,2 tax rates,3 tax rates',
            'invoicetaxrates'   => 'nullable|in:Disabled,1 tax rate,2 tax rates,3 tax rates',
        ]);

        $settings = TaxSetting::first();
        if ($settings) {
            $settings->update($validated);
        } else {
            TaxSetting::create($validated);
        }
  return redirect()->route('settings.index')->with('success', 'Tax settings updated.');

    }

    // Delete a tax rate
    public function destroy($id)
    {
        TaxRate::findOrFail($id)->delete();
          return redirect()->route('settings.index')->with('success', 'Tax rate deleted.');

    }
}
