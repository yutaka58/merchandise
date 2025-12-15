<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function scopeCategorySearch($query, $keyword)
    {
        if (!empty($keyword)) {
        $query->where('keyword', $keyword);
    }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
        $query->where('name', 'like', '%' . $keyword . '%');
    }
        return $query;
    }

    protected $fillable = ['name', 'price', 'image_path', 'season_id', 'description'];
    
    /**
     * この商品が属する季節を取得する
     */
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

}
