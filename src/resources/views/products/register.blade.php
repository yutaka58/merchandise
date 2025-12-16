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

            <div id="image-preview-container" class="mb-2" style="display: none; min-height: 10px;">
                <img id="image-preview" src="" alt="プレビュー" style="max-width: 300px; height: 200px; border: 1px solid #ddd; padding: 5px; display: block;">
            </div>

            <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(this)">

            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">季節 <span class="required-tag">必須</span> <span class="optional-tag">複数選択可</span></label>

            <div class="season-checkbox-group"> @foreach($seasons as $season)
                    <label class="checkbox-label">
                        <input type="checkbox"
                            name="season_id[]"
                            value="{{ $season->id }}"
                            {{ is_array(old('season_id')) && in_array($season->id, old('season_id')) ? 'checked' : '' }}>
                        {{ $season->name }}
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

<script>
window.previewImage = function(input) {
    const previewContainer = document.getElementById('image-preview-container');
    const previewImage = document.getElementById('image-preview');

    if (input.files && input.files[0]) {
        if (previewImage.src.startsWith('blob:')) {
            URL.revokeObjectURL(previewImage.src);
        }

        const fileUrl = URL.createObjectURL(input.files[0]);
        previewImage.src = fileUrl;
        
        previewContainer.style.display = 'block';
    } else {
        previewContainer.style.display = 'none';
        previewImage.src = "";
    }
}
</script>

@endsection