<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\Products_season;
use App\Http\Requests\RegisterRequest;

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

    public function create(Request $request)
    {
        $seasons = \App\Models\Season::all(); // データベースから4つの季節データを取得
        return view('products.register', compact('seasons'));
    }

// app/Http/Controllers/ProductsController.php

    public function store(\App\Http\Requests\RegisterRequest $request)
    {
    // バリデーション失敗時は、このメソッドに入る前に自動的にフォームへ戻ります。

    // 1. 画像の保存
        $imagePath = $request->file('image')->store('public/images');
        $imagePath = str_replace('public/', '', $imagePath);

    // 2. Product モデルの作成 (中間テーブルに関連する season_id は含めない)
        $product = \App\Models\Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath, // 💡 productsテーブルのカラム名 'image' に合わせる
            'description' => $request->description,
        ]);

    // 3. 季節の関連付け（多対多）
    // フォームが season_id (単一IDまたはID配列) を送る場合、中間テーブルに登録
        $product->seasons()->attach($request->season_id);

    // 4. 成功時のリダイレクト
        return redirect()->route('products.list')->with('success', '商品を登録しました。');
    }

        public function show($productId)
    {
        $product = \App\Models\Product::with('seasons')->findOrFail($productId);
    
        // 💡 修正点：'ProductSeason' ではなく 'Season' など、正しいモデル名にする
        // モデルが App/Models/Season.php にある場合は以下のように記述
        $seasons = \App\Models\Season::all();

        return view('products.detail', compact('product', 'seasons'));
    }

    // app/Http/Controllers/ProductsController.php

    public function update(\App\Http\Requests\RegisterRequest $request, $productId)
    {
        $product = \App\Models\Product::findOrFail($productId);

        // 画像が新しくアップロードされた場合の処理
        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath);
        }

        // 商品情報の更新
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        // 季節（多対多）の同期（既存の関連を消して新しい配列で上書き）
        $product->seasons()->sync($request->season_id);

        return redirect()->route('products.list')->with('success', '商品を更新しました');
    }

    // app/Http/Controllers/ProductsController.php

        public function destroy($productId)
    {
        // IDに一致する商品を取得
        $product = \App\Models\Product::findOrFail($productId);

        // 商品を削除（関連する中間テーブルのデータもリレーション設定により削除されます）
        $product->delete();

        // 一覧画面へ戻り、完了メッセージを表示
        return redirect()->route('products.list')->with('success', '商品を削除しました');
    }

}
