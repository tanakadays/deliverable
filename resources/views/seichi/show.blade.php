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
        @if($post->image_url)
        <div class="image">
            <img src="{{ $post->image_url }}" alt="画像を読み込めません。">
        </div>
        @endif
        
        <h1 class="place_name">
            {{ $post->place_name }}
        </h1>
        <div class="content">
            <div class="title_name">
                <h3>作品名</h3>
                <p>{{ $post->category_title->name }}</p>    
            </div>
            <div class="genre">
                <h3>ジャンル</h3>
                <p>{{ $post->category_genre->name }}</p>    
            </div>
            <div class="area">
                <h3>エリア</h3>
                <p>{{ $post->category_area->name }}</p>    
            </div>
            <div class="information">
                <h3>詳細</h3>
                <p>{{ $post->information }}</p>
            </div>
        </div>
        <div class='edit'><a href="/posts/{{ $post->id }}/edit">edit</a></div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>