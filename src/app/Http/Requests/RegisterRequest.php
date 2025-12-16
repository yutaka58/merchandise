<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required|integer|min:0|max:10000',
            'image' => 'required|image|mimes:jpeg,png',
            // 💡 修正: 配列であることを必須とし、中身の各値が seasons テーブルに存在するか確認
            'season_id' => 'required|array',
            'season_id.*' => 'exists:seasons,id',
            'description' => 'required|max:120',
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージを取得する。
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // app/Http/Requests/RegisterRequest.php

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.between' => '0~10000円以内で入力してください',
            'season_id.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
