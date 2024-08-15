<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
	public function index(Post $post)
	{
		//Postクラスのインスタンスが生成され、引数として渡される
		//クラス型の引数を定義すると、自動的にそのクラスのインスタンスを生成しメソッドに渡す（依存性注入）
		//この時点で$postはPostクラスの空のインスタンス
		return view('posts.index') ->with(['posts' => $post->getPaginateByLimit()]);
		//withメソッドでビューと一緒に渡すデータを定義
		//withメソッドの中身に連想配列を定義することで、ビュー内でキーで値を呼び出せるようになる
		//$postというPostクラスのインスタンスからgetPaginateByLimit()という関数を呼び出している
	}
	public function show(Post $post)
	{
		//ルートパラメータの文字列と引数の変数名を一致させる
		//URLパラメータのpostIDと一致するPostモデルのインスタンスが生成される（暗黙の結合）
		return view('posts.show')->with(['post' => $post]);
	}
	public function create(Category $category)
	{
		//依存注入でCategoryインスタンスが生成される
		//Categoryインスタンスに対してgetメソッドを呼び出すと
		//categoriesテーブルからすべてのレコード（Categoryインスタンス）が取得される
		//結果として、すべてのCategoryインスタンスの集合（コレクション）がビューに渡される
		return view('posts.create')->with(['categories' => $category->get()]);
	}
	public function store(PostRequest $request, Post $post)
	{
		//インスタンス化するタイミングでバリデーションが検証される
		//この時点でバリデーションエラーがある場合は処理が中断
		$input = $request['post'];
		//リクエストからpostをキーに持つデータを取得し、$inputに代入
		//ここではtitleとbodyを要素に持つ配列形式
		//つまり$inputは['title' => 'タイトル', 'body' => '本文']となる
		$post->fill($input)->save();
		//空だったインスタンスのプロパティを、受け取ったキーごとに上書きする
		//save()でMysqlへのINSERT文が実行されDBへデータが追加される
		//モデルクラスのfill関数やsave関数を実行することで、SQLのソースを書かなくても済む
		return redirect('/posts/' . $post->id);
		//DBへの追加の時点で自動的にIDが採番されている
		//文字列結合している
	}
	public function edit(Post $post)
	{
		return view('posts/edit') ->with(['post' => $post ]);
	}
	public function update(PostRequest $request, Post $post)
	{
		$input = $request['post'];
		$post->fill($input)->save();
		return redirect('/posts/' . $post->id);
	}
	public function delete(Post $post)
	{
		$post->delete();
		return redirect('/');
	}
}
