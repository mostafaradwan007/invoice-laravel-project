<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Client;
class ProductController extends Controller
{
  public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
{
    $clients = Client::all(); // جيب كل الكلاينت
    return view('products.create', compact('clients'));
}

public function import()
{
    return view('products.import');
}

public function store(Request $request)
{

    Product::create([
        'name' => $request->name,
        'client_id' => $request->client_id,
        'due_date' => $request->due_date,
        'budgeted_hours' => $request->budgeted_hours,
        'task_rate' => $request->task_rate,
        'public_notes' => $request->public_notes,
        'private_notes' => $request->private_notes,
    ]);

    return redirect()->route('products.index');
}

public function destroy($id)
{
    $product = Product::findOrFail($id); // لو مش لاقي يرمي 404
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}


public function edit($id)
{
    $product = Product::findOrFail($id);
    $clients = Client::all();

    return view('products.edit', compact('product', 'clients'));
}
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $product->update($request->all());

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

}
