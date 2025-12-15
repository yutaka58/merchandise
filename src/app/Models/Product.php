<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image', // DBスキーマに合わせて修正
        'description',
        // 'season_id' は products テーブルから削除されたため、ここから取り除く
    ];

    /**
     * 商品が属する季節（複数の季節）を取得します。
     * リレーション: 多対多 (Many-to-Many)
     */
    public function seasons()
    {
        // 💡 中間テーブル名 'product_season' を指定
        return $this->belongsToMany(Season::class, 'product_season');
    }
}