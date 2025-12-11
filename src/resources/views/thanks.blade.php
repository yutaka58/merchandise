<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>

<body>
    <div class="thanks-page">
        <div class="thanks-page__inner">
            <p class="thanks-page__message">お問い合わせありがとうございました</p>
            <form class="thanks-page__form" action="/products" method="get">
                @csrf
                <button class="thanks-page__btn btn">HOME</button>
            </form>
        </div>
    </div>
    <div class="thanks-page__bg-inner">
        <span class="thanks-page__bg-text">Thank you</span>
    </div>
</body>
</html>