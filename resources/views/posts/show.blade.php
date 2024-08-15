<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <a href='/categories/{{ $post->category->id }}'>{{ $post->category->name }}</a>
        <div class="content">
            <div class="content_post">
                <p>{{ $post->body }}</p>
            </div>
        </div>
        <div class="footer">
            <a href="/posts/{{ $post->id }}/edit">編集</a><br>
            <a href="/">戻る</a>
        </div>
    </body>
</html>
