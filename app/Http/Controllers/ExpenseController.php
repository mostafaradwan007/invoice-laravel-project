<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Vendor;
use App\Models\Client;
use Illuminate\Http\Request;
use Exception;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 1); // default = 1
        $expenses = Expense::with(['vendor', 'client'])->latest()->paginate($perPage);
        return view('expenses.index', compact('expenses'));
    }

    
public function create()
{
    $vendors = Vendor::orderBy('name')->get();
    $clients = Client::orderBy('name')->get();
    $categories = ['Office Supplies', 'Software', 'Travel', 'Meals & Entertainment', 'Utilities'];

    $breadcrumbs = [
        ['title' => 'Expenses', 'url' => route('expenses.index')],
        ['title' => 'Create Expense'] // current page
    ];

    return view('expenses.create', [
        'vendors' => $vendors,
        'clients' => $clients,
        'categories' => $categories,
        'breadcrumbs' => $breadcrumbs,
        'pageTitle' => 'Create Expense',
    ]);
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'category' => 'required|string|max:255',
            'public_notes' => 'nullable|string',
            'vendor_id' => 'nullable|exists:vendors,id',
            'client_id' => 'nullable|exists:clients,id',
        ]);

        Expense::create($validatedData);
        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function edit(Expense $expense)
    {
        $vendors = Vendor::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();
        $expense = Expense::find($expense->id);
        $categories = ['Office Supplies', 'Software', 'Travel', 'Meals & Entertainment', 'Utilities'];
        $breadcrumbs = [
        ['title' => 'Expenses', 'url' => route('expenses.index')],
        ['title' => 'Edit Expense'] // current page
    ];

    return view('expenses.edit', [
        'vendors' => $vendors,
        'clients' => $clients,
        'categories' => $categories,
        'breadcrumbs' => $breadcrumbs,
        'pageTitle' => 'Edit Expense',
        'expense' => $expense,
    ]);
    }

    public function update(Request $request, Expense $expense)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'category' => 'required|string|max:255',
            'public_notes' => 'nullable|string',
            'vendor_id' => 'nullable|exists:vendors,id',
            'client_id' => 'nullable|exists:clients,id',
            'status' => 'nullable|string|max:255',
        ]);

        $expense->update($validatedData);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
    
    public function destroyMultiple(Request $request)
    {
        $request->validate(['expense_ids' => 'required|array']);
        Expense::whereIn('id', $request->expense_ids)->delete();
        return redirect()->route('expenses.index')->with('success', 'Selected expenses deleted successfully.');
    }

    public function showImportForm()
    {
        return view('expenses.import');
    }

    public function handleImport(Request $request)
    {
        $request->validate(['csvFile' => 'required|file|mimes:csv,txt']);
        $path = $request->file('csvFile')->getRealPath();

        try {
            $file = fopen($path, 'r');
            $header = fgetcsv($file);

            while (($row = fgetcsv($file)) !== false) {
                $data = array_combine($header, $row);
                Expense::create([
                    'expense_date' => $data['Expense Date'] ?? null,
                    'amount' => $data['Amount'] ?? 0,
                    'category' => $data['Category'] ?? 'Uncategorized',
                    // You can add logic to find vendor/client by name if needed
                ]);
            }
            fclose($file);
        } catch (Exception $e) {
            return redirect()->route('expenses.import')->with('error', 'Import failed: ' . $e->getMessage());
        }

        return redirect()->route('expenses.index')->with('success', 'Expenses imported successfully.');
    }
}