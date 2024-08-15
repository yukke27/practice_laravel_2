<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //１対多の関係なのでpostsと複数形にする
    public function posts()
    {
        //hasManyメソッドでリレーションの定義
        return $this->hasMany(Post::class);
    }
    public function getByCategory(int $limit_count = 5)
    {
        //$thisは選択されたCategoryインスタンス
        //posts()で関連するPostインスタンスのクエリビルダを取得する
        //with('category')で関連するCategoryインスタンスをEagerローディングする
        return $this->posts()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    use HasFactory;
}
