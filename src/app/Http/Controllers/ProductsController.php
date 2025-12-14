<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function list(Request $request)
    {
        $products = Product::paginate(6);
        $keyword = ''; // listでは初期値として定義済み
        
        return view('products', compact('products', 'keyword'));
    }

    public function search(Request $request)
    {
        // ★★★ 修正箇所: $keyword 変数を定義する ★★★
        $keyword = $request->input('keyword'); 
        
        $query = Product::query();
        
        $products = $query->CategorySearch($request->input('category_id'))
                          ->KeywordSearch($keyword) // 定義された $keyword を使用
                          ->paginate(6);

        // ★★★ $keyword が定義されたので、compactで渡せる ★★★
        return view('products', compact('products', 'keyword'));
    }

    public function register(Request $request)
    {
        return view('register');
    }
}