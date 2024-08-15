<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Blog Name</h1>
        <div class='posts'>
            @foreach ($posts as $post)
                 <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        <!-- href属性に指定されたURLをクリックしたときブラウザはGETリクエストを送信する -->
                    </h2>
                    <a href='/categories/{{ $post->category->id }}'>{{ $post->category->name }}</a>
                    <p class='body'>{{ $post->body }}</p>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">削除</button>
                    </form>
                    <script>
                        function deletePost(id) {
                            'use strict'
                            
                            //confirm関数は確認ダイアログを表示する。OKを選択するとtrueが返される
                            //documentは現在のHTML文書を表す
                            //getElementById関数は指定されたIDを持つHTML要素を取得するための関数
                            //バッククォート（`）で囲まれた文字列には変数を埋め込むことができる
                            //受け取った引数idを使ってフォームIDを生成する
                            //生成されたフォームIDを使ってフォーム要素を取得している
                            //取得したフォーム要素のsubmit関数を呼び出している
                            //getElementById関数やsubmit関数はブラウザの組み込み関数
                            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                                document.getElementById(`form_${id}`).submit();
                            }
                        }
                    </script>
                </div>
            @endforeach
        <div class='create'>
            <a class='edit' href='/posts/create'>投稿を作成</a>
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </body>
</html>
