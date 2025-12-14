<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function list(Request $request)
    {
        $products = Product::paginate(6);
        return view('products', compact('products'));
    }

    public function thanks(Request $request)
    {
        return view('thanks');
    }

        public function register(Request $request)
    {
        return view('register');
    }
}

