<?php

namespace App\Http\Controllers;

use App\Models\Transaction; // ✅ Singular Model name (Laravel convention)
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::paginate(10); // ✅ Use correct model name
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    public function import()
    {
        return view('transactions.import');
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'type' => 'required|in:Deposit,Withdrawal',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'bank_account' => 'nullable|string|max:255',
        ]);

         $deposit = null;
        $withdrawal = null;

        if ($validated['type'] === 'Deposit') {
            $deposit = $validated['amount'];
        } else {
            $withdrawal = $validated['amount'];
        }

        Transaction::create([
            'status' => 'PENDING',
            'deposit' => $deposit,
            'withdrawal' => $withdrawal,
            'date' => $validated['date'],
            'description' => $validated['description'] ?? null ,
            'amount' => $validated['amount'],
         'bank_account' => $validated['bank_account'] ?? null,

        ]);

        return to_route('transactions.index')->with('success', 'Transaction created!');
    }

    //destroy
    public function destroy($id)
{
    $transaction = Transaction::findOrFail($id); // لو مش لاقي يرمي 404
    $transaction->delete();

    return redirect()->route('transactions.index')->with('success', 'transaction deleted successfully.');
}


// editt

public function edit($id)
{
    $transaction = Transaction::findOrFail($id);
    return view('transactions.edit', compact('transaction'));
}
public function update(Request $request, $id)
{
    $transaction = Transaction::findOrFail($id);

    $validated = $request->validate([
        'type' => 'required|in:Deposit,Withdrawal',
        'amount' => 'required|numeric',
        'date' => 'required|date',
        'description' => 'nullable|string',
        'bank_account' => 'nullable|string|max:255',
    ]);

    $deposit = $validated['type'] === 'Deposit' ? $validated['amount'] : null;
    $withdrawal = $validated['type'] === 'Withdrawal' ? $validated['amount'] : null;

    $transaction->update([
        'deposit' => $deposit,
        'withdrawal' => $withdrawal,
        'date' => $validated['date'],
         'amount' => $validated['amount'],
         'bank_account' => $validated['bank_account'] ?? null,
        'description' => $validated['description'] ?? null,

    ]);

    return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully!');
}



}
