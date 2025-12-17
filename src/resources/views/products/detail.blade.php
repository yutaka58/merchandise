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

    {{-- ✅ id="update-form" を追加 --}}
    <form id="update-form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="product-grid">
            <div class="product-grid__left">
                <div id="image-preview-container" class="image-box">
                    <img id="image-preview" src="{{ asset('storage/fruits-img/' . $product->image) }}">
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
                                    @if(in_array($season->id, old('season_id', $product->seasons->pluck('id')->toArray())))
                                        checked
                                    @endif
                                >
                                <span></span>
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
    </form>
    
    <div class="form-footer">
        <a href="{{ route('products.list') }}" class="btn-back">戻る</a>
        
        {{-- ✅ form="update-form" を追加 --}}
        <button type="submit" form="update-form" class="btn-submit">変更を保存</button>
    
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:none; border:none; color:red; cursor:pointer; font-size: 20px; margin-left: 20px;">
                <i class="fas fa-trash"></i> 🗑️
            </button>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection