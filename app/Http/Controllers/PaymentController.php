<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        // Basic listing (latest first). You can add search/filter later.
        $payments = Payment::orderBy('payment_date', 'desc')->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name'          => 'required|string|max:255',
            'amount'               => 'nullable|numeric',
            'payment_date'         => 'required|date',
            'payment_type'         => 'nullable|string|max:255',
            'transaction_reference'=> 'nullable|string|max:255',
            'private_notes'        => 'nullable|string',
            'send_email'           => 'nullable|boolean',
            'convert_currency'     => 'nullable|boolean',
            'status'               => 'nullable|string|max:50',
            'invoice_number'       => 'nullable|string|max:255',
        ]);

        // Auto-generate payment number 
        $nextId = (Payment::max('id') ?? 0) + 1;
        $data['payment_number'] = 'PMT-'.str_pad($nextId, 6, '0', STR_PAD_LEFT);

        $data['send_email'] = (bool)($request->boolean('send_email'));
        $data['convert_currency'] = (bool)($request->boolean('convert_currency'));
        $data['status'] = $data['status'] ?? 'paid';

        Payment::create($data);

        return redirect()->route('payments.index')->with('success', 'Payment saved.');
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'client_name'          => 'required|string|max:255',
            'amount'               => 'nullable|numeric',
            'payment_date'         => 'required|date',
            'payment_type'         => 'nullable|string|max:255',
            'transaction_reference'=> 'nullable|string|max:255',
            'private_notes'        => 'nullable|string',
            'send_email'           => 'nullable|boolean',
            'convert_currency'     => 'nullable|boolean',
            'status'               => 'nullable|string|max:50',
            'invoice_number'       => 'nullable|string|max:255',
        ]);

        $data['send_email'] = (bool)($request->boolean('send_email'));
        $data['convert_currency'] = (bool)($request->boolean('convert_currency'));

        $payment->update($data);

        return redirect()->route('payments.index')->with('success', 'Payment updated.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return back()->with('success', 'Payment deleted.');
    }

    // ----- Import -----

    public function showImportForm()
    {
        return view('payments.import');
    }

    public function downloadTemplate()
    {
        $headers = [
            'PAYMENT NUMBER','CLIENT','AMOUNT','PAYMENT TYPE','INVOICE NUMBER','TRANSACTION ID','PAYMENT DATE','STATUS'
        ];

        $sample = [
            ['PMT-000001','Ahmed Corp','1500.00','Bank Transfer','INV-1001','TRX-789','2025-01-20','paid'],
            ['PMT-000002','Bee Client','250.00','Cash','INV-1002','TRX-790','2025-01-22','paid'],
        ];

        $fh = fopen('php://temp', 'w');
        fputcsv($fh, $headers);
        foreach ($sample as $row) fputcsv($fh, $row);
        rewind($fh);
        $csv = stream_get_contents($fh);
        fclose($fh);

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="payment-import-template.csv"',
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|file|mimes:csv,txt|max:20480',
        ]);

        $file = $request->file('csvFile');
        $handle = fopen($file->getRealPath(), 'r');

        if (!$handle) {
            return back()->withErrors(['csvFile' => 'Cannot open uploaded file.']);
        }

        $header = fgetcsv($handle);
        if (!$header) {
            return back()->withErrors(['csvFile' => 'CSV file is empty.']);
        }

        // Normalize header keys to map columns
        $map = [];
        foreach ($header as $i => $h) {
            $key = strtolower(trim($h));
            $map[$key] = $i;
        }

        // Required columns (by your guidelines)
        $required = [
            'payment number','client','amount','payment type','invoice number','transaction id','payment date','status'
        ];
        foreach ($required as $col) {
            if (!array_key_exists($col, $map)) {
                return back()->withErrors(['csvFile' => "Missing column: {$col}"]);
            }
        }

        $count = 0;
        while (($row = fgetcsv($handle)) !== false) {
            // Read values by header mapping
            $paymentNumber = $row[$map['payment number']] ?: null;
            $client        = $row[$map['client']] ?: '';
            $amount        = (float) ($row[$map['amount']] ?: 0);
            $paymentType   = $row[$map['payment type']] ?: null;
            $invoiceNumber = $row[$map['invoice number']] ?: null;
            $trx           = $row[$map['transaction id']] ?: null;
            $date          = $row[$map['payment date']] ?: date('Y-m-d');
            $status        = $row[$map['status']] ?: 'paid';

            if (!$client) continue; // skip invalid rows

            // If payment number missing, auto-generate
            if (!$paymentNumber) {
                $nextId = (Payment::max('id') ?? 0) + 1;
                $paymentNumber = 'PMT-'.str_pad($nextId, 6, '0', STR_PAD_LEFT);
            }

            // Upsert by payment_number
            Payment::updateOrCreate(
                ['payment_number' => $paymentNumber],
                [
                    'client_name'          => $client,
                    'amount'               => $amount,
                    'invoice_number'       => $invoiceNumber,
                    'payment_date'         => $date,
                    'payment_type'         => $paymentType,
                    'transaction_reference'=> $trx,
                    'status'               => $status,
                ]
            );

            $count++;
        }
        fclose($handle);

        return redirect()->route('payments.index')->with('success', "Imported {$count} payments.");
    }
}
