<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    // 商品一覧
    public function list(Request $request)
    {
        $products = Product::paginate(6);
        $keyword = '';
        return view('products', compact('products', 'keyword'));
    }

    // 検索機能
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

    // 登録画面表示
    public function create()
    {
        $seasons = Season::all();
        return view('products.register', compact('seasons'));
    }

    // 新規登録処理
    public function store(RegisterRequest $request)
    {
        // 1. 画像の保存
        $imagePath = $request->file('image')->store('public/fruits-img');
        $imagePath = str_replace('public/', '', $imagePath);

        // 2. 商品作成
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        // 3. 季節の紐付け
        $product->seasons()->attach($request->season_id);

        return redirect()->route('products.list')->with('success', '商品を登録しました。');
    }

    // 詳細・編集画面表示
    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();
        return view('products.detail', compact('product', 'seasons'));
    }

    // 更新処理
    public function update(ProductsRequest $request, $productId)
    {
        $product = \App\Models\Product::findOrFail($productId);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // 画像を保存
            $path = $request->file('image')->store('public/fruits-img');
            // パスから 'public/' を取り除く
            $imagePath = str_replace('public/', '', $path);
        }

        // 商品情報の更新
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        // 季節の同期
        $product->seasons()->sync($request->season_id);

        return redirect()->route('products.list')->with('success', '商品を更新しました');
    }

    // 削除処理
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        return redirect()->route('products.list')->with('success', '商品を削除しました');
    }
}