<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function list(Request $request)
    {
        return view('products');
    }

    public function thanks(Request $request)
    {
        return view('thanks');
    }
}

