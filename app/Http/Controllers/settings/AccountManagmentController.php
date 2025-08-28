<?php


namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\settings\AccountManagment; // ✅ Singular Model name (Laravel convention)
use Illuminate\Http\Request;

class AccountManagmentController extends Controller
{
    public function index()
    {
        $accountmanagment = AccountManagment::first();

        return view('settings.accountmanagment.index', compact('accountmanagment'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
//overview
            'activate_company' => 'nullable|in:Yes,No',

            'enable_markdown'  => 'nullable|in:Yes,No',

            'include_drafts' => 'nullable|in:Yes,No',

            //enabled modules
            'invoices'  => 'nullable|in:Yes,No',

            'recurring_invoices' => 'nullable|in:Yes,No',
 'quotes'  => 'nullable|in:Yes,No',

            'credits' => 'nullable|in:Yes,No',

             'projects'  => 'nullable|in:Yes,No',

            'tasks' => 'nullable|in:Yes,No',

             'vendors'  => 'nullable|in:Yes,No',

            'expenses' => 'nullable|in:Yes,No',

    'purchase_orders' => 'nullable|in:Yes,No',

             'recurring_expenses'  => 'nullable|in:Yes,No',

            'transactions' => 'nullable|in:Yes,No',

        ]);

        // 2️⃣ Always fetch the first (and only) record
        $accountmanagment = AccountManagment::first();

        if ($accountmanagment) {
            // If it exists → update it
            $accountmanagment->update($validated);
        } else {
            // If not → create the first row
            AccountManagment::create($validated);
        }



        return redirect()->route('settings.index');
    }


    public function destroy()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0'); // ✅ disable constraints

        $tables = DB::select('SHOW TABLES');
        $db = 'Tables_in_' . env('DB_DATABASE'); // get database name dynamically

        foreach ($tables as $table) {
            $tableName = $table->$db;

            if ($tableName !== 'migrations') {
                DB::table($tableName)->truncate();
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1'); // ✅ enable constraints back

        return redirect('/')->with('success', 'All demo data has been deleted.');
    }
}
