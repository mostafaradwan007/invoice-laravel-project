<?php


namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\Product;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
    $product = Product::first();

        return view('settings.productsettings.index', compact('product'));
    }

   public function store(Request $request)
    {
        $validated = $request->validate([

              'stock_notifications'  => 'nullable|in:Yes,No',
        'track_inventory'  => 'nullable|in:Yes,No',

       'convert_products' => 'nullable|in:Yes,No',

        'auto_update_products' => 'nullable|in:Yes,No',

        'auto_fill_products' => 'nullable|in:Yes,No',

        'default_quantity' => 'nullable|in:Yes,No',

        'show_products_quantity' => 'nullable|in:Yes,No',

          'show_products_cost' => 'nullable|in:Yes,No',

        'show_products' => 'nullable|in:Yes,No',

        'notification_threshold' =>'nullable|string'

        ]);

        // 2️⃣ Always fetch the first (and only) record
        $product = Product::first();

        if ($product) {
            // If it exists → update it
            $product->update($validated);
        } else {
            // If not → create the first row
            Product::create($validated);
        }



        return redirect()->route('settings.index');
    }


}
