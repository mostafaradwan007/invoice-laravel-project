<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
public function index()
    {
        $invoices = Invoice::with('client')->get();
        return view('invoices.index', compact('invoices'));
    }
public function create()
    {
        $invoices = Invoice::with('client')->get();
        $clients = \App\Models\Client::all();
        return view('invoices.create', compact('clients',));
    }

public function store(Request $request)
    {
        $invoice = Invoice::create($request->only([
            'client_id',
            'invoice_number',
            'po_number',
            'invoice_date',
            'due_date',
            'partial_deposit',
            'discount',
            'discount_type',
            'public_notes',
            'private_notes',
            'terms',
            'footer',
            'subtotal',
            'total',
            'paid_to_date',
            'balance_due'
        ]));

        if ($request->items) {
            foreach ($request->items as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'item_name' => $item['item_name'],
                    'description' => $item['description'],
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $item['quantity'],
                    'line_total' => $item['line_total']
                ]);
            }
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    }



public function import()
{
    return view('invoices.import');
}

public function destroy($id)
{
    $invoice = Invoice::findOrFail($id); // لو مش لاقي يرمي 404
    $invoice->delete();

    return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
}
public function edit($id)
{
    $invoice = Invoice::findOrFail($id);
    $clients = \App\Models\Client::all();
    return view('invoices.edit', compact('invoice', 'clients'));

}

public function update(Request $request, $id)
{
    // البحث عن الفاتورة
    $invoice = Invoice::findOrFail($id);

    // Validation بسيط جداً
    $request->validate([
        'client_id' => 'required',
        'invoice_date' => 'required|date',
    ]);

    try {
        // تحديث البيانات الأساسية فقط
        $invoice->client_id = $request->client_id;
        $invoice->invoice_number = $request->invoice_number;
        $invoice->po_number = $request->po_number;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->partial_deposit = $request->partial_deposit ?? 0;
        $invoice->discount = $request->discount ?? 0;
        $invoice->discount_type = $request->discount_type ?? 'amount';
        $invoice->public_notes = $request->public_notes;
        $invoice->private_notes = $request->private_notes;
        $invoice->terms = $request->terms;
        $invoice->footer = $request->footer;
        $invoice->subtotal = $request->subtotal ?? 0;
        $invoice->total = $request->total ?? 0;
        $invoice->paid_to_date = $request->paid_to_date ?? 0;
        $invoice->balance_due = $request->balance_due ?? 0;

        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');

    } catch (\Exception $e) {
        return redirect()->back()
                         ->with('error', 'Error: ' . $e->getMessage())
                         ->withInput();
    }
}
}
