<?php
namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Client;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    // Show all quotes
    public function index(Request $request)
    {
        $query = Quote::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('number', 'like', "%{$search}%")
                  ->orWhereHas('client', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $quotes = $query->orderBy('date', 'desc')->paginate(10); // <-- use 'date' column

        return view('quotes.index', compact('quotes'));
    }

    // Show create form
    public function create()
    {
        $clients = Client::orderBy('name')->get(); 
        return view('quotes.create', compact('clients'));
    }

    // Store a new quote
public function store(Request $request)
{
    // Validation
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'quote_date' => 'required|date',
        'due_date' => 'nullable|date',
        'partial_deposit' => 'nullable|numeric|min:0',
        'po_number' => 'nullable|string|max:255',
        'discount' => 'nullable|numeric|min:0',
        'discount_type' => 'nullable|in:amount,percent',
        'public_notes' => 'nullable|string',
        'private_notes' => 'nullable|string',
        'terms' => 'nullable|string',
        'footer' => 'nullable|string',
        'products_name.*' => 'required_with:products_unit_cost,products_quantity|string',
        'products_unit_cost.*' => 'required_with:products_name,products_quantity|numeric|min:0',
        'products_quantity.*' => 'required_with:products_name,products_unit_cost|numeric|min:0',
        'tasks.name.*' => 'required_with:tasks.rate,tasks.hours|string',
        'tasks.rate.*' => 'required_with:tasks.name,tasks.hours|numeric|min:0',
        'tasks.hours.*' => 'required_with:tasks.name,tasks.rate|numeric|min:0',
    ]);

    // Prepare items array
    $items = [];

    if ($request->products_name) {
        foreach ($request->products_name as $index => $name) {
            $items[] = [
                'type' => 'product',
                'name' => $name,
                'description' => $request->products_description[$index] ?? '',
                'unit_cost' => (float)($request->products_unit_cost[$index] ?? 0),
                'quantity' => (float)($request->products_quantity[$index] ?? 0),
            ];
        }
    }

    if ($request->tasks['name'] ?? false) {
        foreach ($request->tasks['name'] as $index => $name) {
            $items[] = [
                'type' => 'task',
                'name' => $name,
                'description' => $request->tasks['description'][$index] ?? '',
                'rate' => (float)($request->tasks['rate'][$index] ?? 0),
                'hours' => (float)($request->tasks['hours'][$index] ?? 0),
            ];
        }
    }

    // Calculate subtotal (amount)
    $amount = 0;
    foreach ($items as $item) {
        if ($item['type'] === 'product') {
            $amount += $item['unit_cost'] * $item['quantity'];
        } elseif ($item['type'] === 'task') {
            $amount += $item['rate'] * $item['hours'];
        }
    }

    // Apply discount
    $discountVal = $request->discount ?? 0;
    $discountType = $request->discount_type ?? 'amount';
    $total_amount = $amount;

    if ($discountType === 'percent') {
        $total_amount -= $amount * $discountVal / 100;
    } else {
        $total_amount -= $discountVal;
    }

    // Create the quote
    $quote = Quote::create([
        'client_id' => $request->client_id,
        'date' => $request->quote_date,
        'valid_until' => $request->due_date,
        'partial_deposit' => $request->partial_deposit ?? 0,
        'po_number' => $request->po_number,
        'discount' => $discountVal,
        'discount_type' => $discountType,
        'public_notes' => $request->public_notes,
        'private_notes' => $request->private_notes,
        'terms' => $request->terms,
        'footer' => $request->footer,
        'items' => $items,
        'amount' => $amount,
        'total_amount' => $total_amount,
    ]);

    return redirect()->route('quotes.index')->with('success', 'Quote created successfully!');
}

  


    // Import CSV
    public function import(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csvFile');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));

        // Remove header
        $header = array_shift($data);

        foreach ($data as $row) {
            Quote::create([
                'status' => $row[0] ?? 'Pending',
                'number' => $row[1] ?? '',
                'client_id' => $row[2] ?? null,
                'total_amount' => $row[3] ?? 0,
                'amount' => $row[3] ?? 0,
                'date' => $row[4] ?? now(),
                'valid_until' => $row[5] ?? now(),
                'items' => '[]',
            ]);
        }

        return redirect()->route('quotes.index')->with('success', 'Quotes imported successfully.');
    }
    public function showImportForm()
{
    return view('quotes.import');
}
public function downloadTemplate()
{
    $headers = [
        'Content-Type' => 'text/csv',
    ];

    $filename = 'quotes_template.csv';

    $columns = ['Status', 'Number', 'Client ID', 'Total Amount', 'Amount', 'Date', 'Valid Until', 'Items'];

    $callback = function() use ($columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
        fclose($file);
    };

    return response()->stream($callback, 200, $headers)->withHeaders([
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ]);
}

}
