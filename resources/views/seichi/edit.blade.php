<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>聖地巡礼マップ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">編集画面</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='place_name'>
                    <h2>場所名</h2>
                    <input type='text' name='post[place_name]' value="{{ $post->place_name }}">
                </div>
                <div class='title_name'>
                    <h2>作品名</h2>
                    <input type='text' name='post[title_name]' value="{{ $post->title_name }}">
                </div>
                <div class='genre'>
                    <h2>ジャンル</h2>
                    <input type='text' name='post[genre]' value="{{ $post->genre }}">
                </div>
                <div class='area'>
                    <h2>エリア</h2>
                    <input type='text' name='post[area]' value="{{ $post->area }}">
                </div>
                <div class='information'>
                    <h2>詳細</h2>
                    <textarea type='text' name='post[information]' >{{ $post->information }}</textarea>
                </div>
                <input type="submit" value="保存">
            </form>
        </div>
    </body>
</html>