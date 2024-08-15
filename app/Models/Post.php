<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //PostモデルならDBのpostsテーブルを自動的に参照する
    protected $fillable = [
        'title',
        'body',
        'category_id'
    ];
    //$fillableを使用することで特定の属性のみがfill可能に
    //Postモデルではpostsテーブルに自動的に対応する
    public function getPaginateByLimit(int $limit_count = 5)
    {
        //Eagerローディング
        //categoryリレーションを事前にロードすることで軽くする
        //ページネーションの結果に含まれる各投稿に対してそれに関連するcategoryのデータが一緒にロードされる
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    use HasFactory;
}
