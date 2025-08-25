<?php


namespace App\Http\Controllers\settings;

use App\Http\Controllers\controller;

use App\Models\Settings; // ✅ Singular Model name (Laravel convention)
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {

        return view('settings.index');
    }

}
