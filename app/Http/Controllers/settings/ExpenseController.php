<?php


namespace App\Http\Controllers\settings;

use App\Http\Controllers\controller;

use App\Models\settings\Expense; // ✅ Singular Model name (Laravel convention)
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
    $expense = Expense::first();

        return view('settings.expensesettings.index', compact('expense'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'should_be_invoiced' => 'nullable|in:Yes,No',

            'mark_paid'  => 'nullable|in:Yes,No',


            'convert_currency'  => 'nullable|in:Yes,No',

            'inclusive_taxes' => 'nullable|in:Yes,No',



        ]);

        // 2️⃣ Always fetch the first (and only) record
        $expense = Expense::first();

        if ($expense) {
            // If it exists → update it
            $expense->update($validated);
        } else {
            // If not → create the first row
            Expense::create($validated);
        }



        return redirect()->route('settings.index');
    }
}
