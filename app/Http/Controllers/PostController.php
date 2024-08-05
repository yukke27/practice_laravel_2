<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
	public function index(Post $post)
	{
		//Postクラスのインスタンスが生成され、引数として渡される
		//クラス型の引数を定義すると、自動的にそのクラスのインスタンスを生成しメソッドに渡す（依存性注入）
		//この時点で$postはPostクラスの空のインスタンス
		return view('posts.index') ->with(['posts' => $post->getPaginateByLimit()]);
		//'posts'という変数名でビューにデータを渡す
		//$post->getPaginateByLimit() により、ページネーションされた投稿のリストが取得される
		//postsに取得した結果を渡す
	}
	public function show(Post $post)
	{
		//ルートパラメータの文字列と引数の変数名を一致させる
		//URLパラメータのpostIDと一致するPostモデルのインスタンスが生成される（暗黙の結合）
		return view('posts.show')->with(['post' => $post]);
		//postはビュー内で使う変数で中身は暗黙の結合によって生成されたインスタンス
	}
	public function create()
	{
		return view('posts.create');
	}
	public function store(PostRequest $request, Post $post)
	{
		//インスタンス化するタイミングでバリデーションが検証される
		//この時点でバリデーションエラーがある場合は処理が中断
		$input = $request['post'];
		//postをキーに持つリクエストパラメータを取得し、$inputに代入
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
}
