<?php


namespace App\Http\Controllers\settings;

use App\Http\Controllers\controller;

use App\Models\settings\UserDetails; // ✅ Singular Model name (Laravel convention)
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function index()
    {
        $userr = UserDetails::first(); // get first record (if exists)

        return view('settings.userdetails.index', compact('userr'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            //details
            'email' => 'email',
            'firstname' => 'string',
            'lastname' => 'string',
            'phone' => 'numeric',

            //password
            'password' => 'string',


        ]);

        // 2️⃣ Always fetch the first (and only) record
        $userr = UserDetails::first();

        if ($userr) {
            // If it exists → update it
            $userr->update($validated);
        } else {
            // If not → create the first row
            UserDetails::create($validated);
        }

        return redirect()->route('settings.index');
    }
}
