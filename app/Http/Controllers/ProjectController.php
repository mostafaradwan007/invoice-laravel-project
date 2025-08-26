<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Client;

class ProjectController extends Controller
{
public function index()
{
    return view('products.index');
}

public function create()
{
    return view('products.create');
}

public function import()
{
    return view('products.import');
}

}

