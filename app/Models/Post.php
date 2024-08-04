<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //PostモデルならDBのpostsテーブルを自動的に参照する
    protected $fillable = [
        'title',
        'body'
    ];
    //$fillableを使用することで特定の属性のみがfill可能に
    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    use HasFactory;
}
