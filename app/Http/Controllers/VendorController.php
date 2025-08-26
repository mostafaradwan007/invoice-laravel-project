<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Exception;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $perPage = $request->get('per_page', 1); // default = 10
    $vendors = Vendor::orderBy('id_number')->paginate($perPage);

    return view('vendors.index', compact('vendors'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            ['title' => 'Vendors', 'url' => route('vendors.index')],
            ['title' => 'Create Vendor']  // current page, no URL
        ];

        return view('vendors.create', [
            'breadcrumbs' => $breadcrumbs,
            'pageTitle' => 'Create Vendor',
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'phone' => 'required|digits:11|unique:vendors,phone',
            'id_number' => 'required|string|max:255|unique:vendors,id_number',
            'vat_number' => 'nullable|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255|unique:vendors,contact_email',

            // Address fields
            'street' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state_province' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);


        Vendor::create($validatedData);

        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        // Example in your controller
        return view('vendors.edit', [
            'breadcrumbs' => [
                ['title' => 'Vendors', 'url' => route('vendors.index')],
                ['title' => 'Edit Vendor'] // No URL means this is the current page
            ],
            'pageTitle' => 'Edit Vendor'
        ],compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'nullable|string|max:255|unique:vendors,number,' . $vendor->id,
            // (Add the same validation rules as the store method)
        ]);

        $vendor->update($validatedData);

        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function showImportForm()
    {
        return view('vendors.import');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
    }

    public function handleImport(Request $request)
    {
        // 1. Validate that a file was uploaded and it's a CSV.
        $request->validate([
            'csvFile' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csvFile')->getRealPath();

        try {
            // 2. Open the file for reading.
            $file = fopen($path, 'r');

            // 3. Read the header row to skip it.
            $header = fgetcsv($file);

            // 4. Loop through the rest of the rows in the file.
            while (($row = fgetcsv($file)) !== false) {
                // Combine the header with the row data to create an associative array.
                $data = array_combine($header, $row);

                // 5. Create a new Vendor using the data from the CSV row.
                // It's important that your CSV column headers match your database columns.
                // e.g., 'Name', 'Contact Name', 'Contact Email', 'Phone', 'Website'
                Vendor::create([
                    'name' => $data['Name'] ?? null,
                    'id_number' => $data['ID Number'] ?? null,
                    'contact_name' => $data['Contact Name'] ?? null,
                    'contact_email' => $data['Contact Email'] ?? null,
                    'phone' => $data['Phone'] ?? null,
                    'city' => $data['City'] ?? null,

                    // Add other fields from your CSV here
                ]);
            }

            fclose($file);

        } catch (Exception $e) {
            // If anything goes wrong, redirect back with an error message.
            return redirect()->route('vendors.import')->with('error', 'An error occurred during import: ' . $e->getMessage());
        }

        // 6. If the import is successful, redirect back with a success message.
        return redirect()->route('vendors.index')->with('success', 'Vendors imported successfully.');
    }


    public function destroyMultiple(Request $request)
    {
        // Get the array of IDs from the form submission
        $vendorIds = $request->input('vendor_ids');

        // Check if any IDs were actually selected
        if (empty($vendorIds)) {
            return redirect()->route('vendors.index')->with('error', 'No vendors were selected for deletion.');
        }

        // Delete the vendors with the selected IDs
        Vendor::whereIn('id', $vendorIds)->delete();

        // Redirect back with a success message
        return redirect()->route('vendors.index')->with('success', 'Selected vendors have been deleted successfully.');
    }

}
