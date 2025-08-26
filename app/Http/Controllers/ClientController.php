<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all(); // ممكن نستخدم pagination بعدين
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function import()
    {
        return view('clients.client-import');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            // باقي الـ validation rules ممكن تضيفها حسب الحاجة
        ]);

        Client::create([
            'name' => $request->input('name'),
            'number' => $request->input('number'),
            'group' => $request->input('group'),
            'user' => $request->input('user'),
            'id_number' => $request->input('id_number'),
            'vat_number' => $request->input('vat_number'),
            'website' => $request->input('website'),
            'phone' => $request->input('phone'),
            'routing_id' => $request->input('routing_id'),
            'valid_vat' => $request->has('valid_vat'),
            'tax_exempt' => $request->has('tax_exempt'),
            'classification' => $request->input('classification'),

            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'contact_phone' => $request->input('contact_phone'),
            'add_to_invoices' => $request->has('add_to_invoices'),

            'billing_street' => $request->input('billing_street'),
            'apt_suite' => $request->input('apt_suite'),
            'city' => $request->input('city'),
            'state_province' => $request->input('state_province'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country'),

            'shipping_street' => $request->input('shipping_street'),
            'shipping_apt_suite' => $request->input('shipping_apt_suite'),
            'shipping_city' => $request->input('shipping_city'),
            'shipping_state_province' => $request->input('shipping_state_province'),
            'shipping_postal_code' => $request->input('shipping_postal_code'),
            'shipping_country' => $request->input('shipping_country'),
        ]);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            // باقي الـ validation زي ما تحب
        ]);

        $client->update([
            'name' => $request->input('name'),
            'number' => $request->input('number'),
            'group' => $request->input('group'),
            'user' => $request->input('user'),
            'id_number' => $request->input('id_number'),
            'vat_number' => $request->input('vat_number'),
            'website' => $request->input('website'),
            'phone' => $request->input('phone'),
            'routing_id' => $request->input('routing_id'),
            'valid_vat' => $request->has('valid_vat'),
            'tax_exempt' => $request->has('tax_exempt'),
            'classification' => $request->input('classification'),

            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'contact_phone' => $request->input('contact_phone'),
            'add_to_invoices' => $request->has('add_to_invoices'),

            'billing_street' => $request->input('billing_street'),
            'apt_suite' => $request->input('apt_suite'),
            'city' => $request->input('city'),
            'state_province' => $request->input('state_province'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country'),

            'shipping_street' => $request->input('shipping_street'),
            'shipping_apt_suite' => $request->input('shipping_apt_suite'),
            'shipping_city' => $request->input('shipping_city'),
            'shipping_state_province' => $request->input('shipping_state_province'),
            'shipping_postal_code' => $request->input('shipping_postal_code'),
            'shipping_country' => $request->input('shipping_country'),
        ]);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id); // لو مش لاقي يرمي 404
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    public function import_csv(Request $request)
    {
        try {
            $request->validate([
                'csvFile' => 'required|file|mimes:csv,txt,csv',
            ]);

            $file = $request->file('csvFile');

            if (!$file->isValid()) {
                return redirect()->back()->with('error', 'Invalid file upload.');
            }

            $path = $file->getRealPath();

            if (($handle = fopen($path, 'r')) !== false) {
                $header = fgetcsv($handle);

                while (($row = fgetcsv($handle)) !== false) {
                    if (count($row) < 2) {
                        continue;
                    }

                    Client::create([
                        'name' => $row[0],
                        'email' => $row[1],
                        'phone' => $row[2] ?? null,
                        'company' => $row[3] ?? null,
                        'address' => $row[4] ?? null,
                    ]);
                }

                fclose($handle);
            } else {
                return redirect()->back()->with('error', 'Could not open the file.');
            }

            return redirect()->route('clients.index')->with('success', 'Clients imported successfully.');

        } catch (\Exception $e) {
            // هنا رح نرجع الخطأ عشان تعرف شو المشكلة
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
