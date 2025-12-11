<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>

<body>
    <div class="header">
        <div class="header-group">
            <h1 class="header-title">mogitate</h1>
        </div>
    </div>
    
    <!-- 登録画面へ遷移 -->
    <form class="register-form form" action="/register" method="post">
        @csrf
        <div class="register-form__group">
            <div class="register-form__inner">
                <h2 class="register-form__title">商品一覧</h2>
                <input class="register-form__btn btn" type="submit" value="+ 商品を追加">
            </div>
        </div>
    

        <!-- 検索機能 -->
        <form class="products-form" action="/search" method="post">
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
                <select class="products-form__item" name="price" placeholder="価格で並べ替え"></select>
            </div>
            <div class="products-form__image">
            </div>
        </form>
    </form>
</body>

</html>