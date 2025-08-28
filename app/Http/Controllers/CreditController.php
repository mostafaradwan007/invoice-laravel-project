<?php
namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Client;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    // Show all creditss
    public function index(Request $request)
    {
        $query = Credit::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('number', 'like', "%{$search}%")
                  ->orWhereHas('client', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $credits = $query->orderBy('date', 'desc')->paginate(10); // <-- use 'date' column

        return view('credits.index', compact('credits'));
    }

    // Show create form
    public function create()
    {
        $clients = Client::orderBy('name')->get(); 
        return view('credits.create', compact('clients'));
    }

    // Store a new credit
public function store(Request $request)
{
    // Validation
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'credit_date' => 'required|date',
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

    // Create the credit
    $credit = Credit::create([
        'client_id' => $request->client_id,
        'date' => $request->credit_date,
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

    return redirect()->route('credits.index')->with('success', 'credit created successfully!');
}




}
