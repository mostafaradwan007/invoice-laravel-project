<?php

namespace App\Http\Controllers;


use App\Models\RecurringExpense;
use Illuminate\Http\Request;

class RecurringExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $recurring_expense = RecurringExpense::paginate(10); // for pagination
        return view('recurring_expenses.index', compact('recurring_expense'));
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create()
{
    $clients = \App\Models\Client::all(); // get all clients
    return view('recurring_expenses.create', compact('clients'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'vendor' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',

            'project' => 'nullable|string',
            'category' => 'nullable|string',
            'user' => 'nullable|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'frequency' => 'required|in:Daily,Weekly,2 weeks,4 weeks,Monthly,2 Months,3 Months,4 Months,6 Months,Annually,2 Years,3 Years',
            'start_date' => 'required|date',
            'remaining_cycle' => 'required|string',
            'publicnotes' => 'nullable|string',
            'privatenotes' => 'nullable|string',
            'should_be_invoiced' => 'nullable|boolean',
            'mark_paid' => 'nullable|boolean',
            'convert_currency' => 'nullable|boolean',
            'add_documents' => 'nullable|boolean',
        ]);




        // Handle checkboxes manually
        $data['should_be_invoiced'] = $request->has('should_be_invoiced');
        $data['mark_paid'] = $request->has('mark_paid');
        $data['convert_currency'] = $request->has('convert_currency');
        $data['add_documents'] = $request->has('add_documents');

        RecurringExpense::create([
            'status' => 'PENDING',
             'client_id' => $data['client_id'],

            'vendor' => $data['vendor'],
            'project' => $data['project'],
            'category' => $data['category'],
            'user' => $data['user'],

            'date' => $data['date'],
            'frequency' => $data['frequency'],
            'start_date' => $data['start_date'],
            'remaining_cycle' => $data['remaining_cycle'],
            'amount' => $data['amount'],
            'publicnotes' => $data['publicnotes'] ?? null,
            'privatenotes' => $data['privatenotes'] ?? null,
            'should_be_invoice' => $data['should_be_invoiced'],
            'mark_paid' => $data['mark_paid'],
            'convert_currency' => $data['convert_currency'],
            'add_documents' => $data['add_documents'],


        ]);

        return to_route('recurring_expense.index')->with('success', 'Recurring Expense Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(RecurringExpense $recurringExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    // editt

 public function edit($id)
{
    $recurring_expense = RecurringExpense::findOrFail($id);

    return view('recurring_expenses.edit', compact('recurring_expense'));
}

    public function update(Request $request, $id)
    {
        $recurring_expense = RecurringExpense::findOrFail($id);

        $data = $request->validate([
            'vendor' => 'nullable|string',
            'client' => 'nullable|string',
            'project' => 'nullable|string',
            'category' => 'nullable|string',
            'user' => 'nullable|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'frequency' => 'required|in:Daily,Weekly,2 weeks,4 weeks,Monthly,2 Months,3 Months,4 Months,6 Months,Annually,2 Years,3 Years',
            'start_date' => 'required|date',
            'remaining_cycle' => 'required|string',
            'publicnotes' => 'nullable|string',
            'privatenotes' => 'nullable|string',
            'should_be_invoiced' => 'nullable|boolean',
            'mark_paid' => 'nullable|boolean',
            'convert_currency' => 'nullable|boolean',
            'add_documents' => 'nullable|boolean',
        ]);

        // Handle checkboxes manually
        $data['should_be_invoiced'] = $request->has('should_be_invoiced');
        $data['mark_paid'] = $request->has('mark_paid');
        $data['convert_currency'] = $request->has('convert_currency');
        $data['add_documents'] = $request->has('add_documents');

        $recurring_expense->update([
            'status' => 'PENDING',
            'client' => $data['client'],
            'vendor' => $data['vendor'],
            'project' => $data['project'],
            'category' => $data['category'],
            'user' => $data['user'],

            'date' => $data['date'],
            'frequency' => $data['frequency'],
            'start_date' => $data['start_date'],
            'remaining_cycle' => $data['remaining_cycle'],
            'amount' => $data['amount'],
            'publicnotes' => $data['publicnotes'] ?? null,
            'privatenotes' => $data['privatenotes'] ?? null,
            'should_be_invoice' => $data['should_be_invoiced'],
            'mark_paid' => $data['mark_paid'],
            'convert_currency' => $data['convert_currency'],
            'add_documents' => $data['add_documents'],


        ]);

        return redirect()->route('recurring_expense.index')->with('success', 'recurring_expense updated successfully!');
    }

        public function destroy($id)
{
    $recurring_expense = RecurringExpense::findOrFail($id);
    $recurring_expense->delete();

    return redirect()->route(route: 'recurring_expense.index')->with('success', value: 'RecurringExpense deleted successfully.');
}
}
