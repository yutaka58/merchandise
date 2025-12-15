@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')

<!-- 登録画面へ遷移 -->
<form class="register-form form" action="/products/register" method="get">
    @csrf
    <div class="register-form__group">
        <div class="register-form__inner">
            <h2 class="register-form__title">
                @if (isset($keyword) && $keyword != "")
                    "{{ $keyword }}"の商品一覧
                @else
                    商品一覧
                @endif
            </h2>
            <input class="register-form__btn btn" type="submit" value="+ 商品を追加">
        </div>
    </div>
    </form>

<div class="main-content-wrapper">

    <!-- 検索機能 -->
    <form class="products-form form" action="{{ route('products.search') }}" method="get">
        <div class="products-form__inner">
            <input class="products-form__search" name="keyword" type="text" placeholder="商品名で検索" value="{{ $keyword ?? '' }}">
        </div>
        <div class="products-form__inner">
            <button class="products-btn">検索</button>
        </div>
        <div class="products-form__inner">
            <p class="products-form__label">価格順で表示</p>
            <select class="products-form__item" name="price_sort">
                <option value="">価格で並べ替え</option>
                <option value="asc" @if (request('price_sort') == 'asc') selected @endif>価格が安い順</option>
                <option value="desc" @if (request('price_sort') == 'desc') selected @endif>価格が高い順</option>
            </select>

            @php
                $currentSort = request('price_sort');
                $params = request()->except(['price_sort', 'page']);
                $clearSortUrl = route('products.search', array_merge($params, ['price_sort' => '']));
                $sortLabel = '';
                if ($currentSort == 'asc') {
                $sortLabel = '価格が安い順';
                } elseif ($currentSort == 'desc') {
                $sortLabel = '価格が高い順';
                }
            @endphp

            @if ($currentSort)
                <div class="products-form__inner sort-tag-container">
                    <a href="{{ $clearSortUrl }}" class="sort-tag">
                        {{ $sortLabel }}
                        <span class="clear-icon">×</span>
                    </a>
                </div>
            @endif

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