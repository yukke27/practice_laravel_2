<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf=8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <!-- name属性はサーバー側で扱うキーとなる -->
                <!-- post[]とすることで配列として扱うことができる -->
                <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
                <!-- $errorsからメッセージを取り出す -->
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も１日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body_error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="fotter">
            <a href="/">戻る</a>
        </div>
    </body>
</html>