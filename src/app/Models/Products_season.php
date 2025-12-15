<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_season extends Model
{
    use HasFactory;

    // 💡 中間テーブルの名前を明示的に指定
    protected $table = 'products_season';

    // 💡 中間テーブルに created_at/updated_at カラムがない場合は false に設定
    public $timestamps = false;
}