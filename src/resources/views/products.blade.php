@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')

<!-- 登録画面へ遷移 -->
<form class="register-form form" action="/register" method="post">
    @csrf
    <div class="register-form__group">
        <div class="register-form__inner">
            <h2 class="register-form__title">商品一覧</h2>
            <input class="register-form__btn btn" type="submit" value="+ 商品を追加">
        </div>
    </div>
    </form>

<div class="main-content-wrapper">

    <!-- 検索機能 -->
    <form class="products-form form" action="/search" method="post">
        @csrf
        <div class="products-form__inner">
            <input class="products-form__search" name="search" type="text" placeholder="商品名で検索">
        </div>
        <div class="products-form__inner">
            <button class="products-btn">検索</button>
        </div>
        <div class="products-form__inner">
            <p class="products-form__label">価格順で表示</p>
        </div>
        <div class="products-form__inner">
            <select class="products-form__item" name="price" value="価格で並べ替え"></select>
        </div>
    </form>

    <div class="product-list-container">
        @foreach ($products as $product)
            <div class="product-item">
                <div class="product-image-wrapper">
                    <img src="{{ asset('images/fruits-img/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
                <div class="product-info-row">
                    <p class="product-name">{{ $product->name }}</p>
                    <p class="product-price">¥{{ number_format($product->price) }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="pagination-container">
    {{ $products->links() }}
</div>



@endsection

</body>

</html>