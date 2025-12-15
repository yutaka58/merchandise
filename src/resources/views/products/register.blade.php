@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <div class="mb-3">
            <label for="name" class="form-label">商品名 <span class="required-tag">必須</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"> @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">値段 <span class="required-tag">必須</span></label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" min="0"> @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">商品画像 <span class="required-tag">必須</span></label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*"> @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="season_id" class="form-label">季節 <span class="required-tag">必須</span> <span class="optional-tag">複数選択可</span></label>

            <div class="season-radio-group">
                @foreach($seasons as $season)
                    <label class="radio-label">
                        <input type="radio"
                            name="season_id"
                            value="{{ $season->id }}"
                            {{ old('season_id') == $season->id ? 'checked' : '' }}> {{ $season->name }}
                    </label>
                @endforeach
            </div>

            @error('season_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">商品説明 <span class="required-tag">必須</span></label>
            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea> @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <hr>
        <div class="form-footer">
            <a href="{{ route('products.list') }}" class="btn btn-secondary">
                戻る
            </a>

            <button type="submit" class="btn btn-primary">
                登録
            </button>
        </div>
    </form>
</div>
@endsection