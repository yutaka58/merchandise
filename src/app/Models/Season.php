<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * 季節に属する商品（複数の商品）を取得します。
     * リレーション: 多対多 (Many-to-Many)
     */
    public function products()
    {
        // 💡 中間テーブル名 'product_season' を指定
        return $this->belongsToMany(Product::class, 'product_season');
    }
}