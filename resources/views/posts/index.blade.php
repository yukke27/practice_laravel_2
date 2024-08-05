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
                    <p class='body'>{{ $post->body }}</p>
                    <a href="/posts/{{ $post->id }}/edit">投稿を編集</a>
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
