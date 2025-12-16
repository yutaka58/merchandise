@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<div class="container">
    <nav class="product-nav">
        <a href="{{ route('products.list') }}">商品一覧</a> ＞ {{ $product->name }}
    </nav>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="product-grid">
            <div class="product-grid__left">
                <div id="image-preview-container" class="image-box">
                    <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
                <div class="file-input-group">
                    <input type="file" name="image" id="image" onchange="previewImage(this)">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="product-grid__right">
                <div class="form-group">
                    <label>商品名</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>値段</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>季節</label>
                    <div class="checkbox-group">
                        @foreach($seasons as $season)
                            <label>
                                <input type="checkbox" name="season_id[]" value="{{ $season->id }}"
                                    {{-- 💡 現在の商品がこの季節を持っていれば 'checked' にする --}}
                                    @if(in_array($season->id, old('season_id', $product->seasons->pluck('id')->toArray())))
                                        checked
                                    @endif
                                >
                                {{ $season->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('season_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="product-description-section">
            <label>商品説明</label>
            <textarea name="description" rows="4" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-footer">
            <a href="{{ route('products.list') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">変更を保存</button>
    
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:none; border:none; color:red; cursor:pointer; font-size: 20px; margin-left: 20px;">
                    <i class="fas fa-trash"></i> 🗑️
                </button>
            </form>
        </div>
    </form>
</div>
@endsection