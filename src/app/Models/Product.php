<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'image', 'description'];
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }

    public function scopeCategorySearch($query, $seasonId)
    {
        if (!empty($seasonId)) {
            return $query->whereHas('seasons', function ($q) use ($seasonId) {
                $q->where('seasons.id', $seasonId);
            });
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            return $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
    }
}