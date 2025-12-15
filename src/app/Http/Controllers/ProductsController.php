<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ProductsController extends Controller
{
    public function list(Request $request)
    {
        $products = Product::paginate(6);
        $keyword = '';

        return view('products', compact('products', 'keyword'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $priceSort = $request->input('price_sort');
        $query = Product::query();

        $query->CategorySearch($request->input('category_id'))
              ->KeywordSearch($keyword);

        if (in_array($priceSort, ['asc', 'desc'])) {
            $query->orderBy('price', $priceSort);
        }

        $products = $query->paginate(6);
        return view('products', compact('products', 'keyword'));
    }

    public function create()
    {
        $seasons = \App\Models\Season::all(); // データベースから4つの季節データを取得
        return view('products.register', compact('seasons'));
    }
}

