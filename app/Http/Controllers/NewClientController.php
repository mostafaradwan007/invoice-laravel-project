<?php

namespace App\Http\Controllers;

use App\Models\NewClient; // changed from Client to NewClient
use Illuminate\Http\Request;

class NewClientController extends Controller
{
    // Show form to create client
    public function create()
    {
        return view('newclients.create'); // changed folder from clients → newclients
    }

    // Store new client
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
        ]);

        NewClient::create($request->all()); // use NewClient model

        return redirect()->route('newclients.create'); // changed route
    }
}
