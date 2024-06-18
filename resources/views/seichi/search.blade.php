<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>聖地巡礼マップ</title>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            h1 {
                font-size: 24px;
                color: #333;
                margin: 20px 0;
            }
            form {
                width: 80%;
                max-width: 800px;
                margin: 20px 0;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            form input[type="text"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 16px;
            }
            form input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            form input[type="submit"]:hover {
                background-color: #45a049;
            }
            .posts {
                width: 80%;
                max-width: 800px;
                margin: 20px 0;
            }
            .post {
                background-color: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 20px;
                margin: 10px 0;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .post h2 {
                margin: 0 0 10px;
            }
            .post p {
                margin: 5px 0;
            }
            .post a {
                color: #1E90FF;
                text-decoration: none;
            }
            .post a:hover {
                text-decoration: underline;
            }
            button {
                background-color: #ff4c4c;
                color: white;
                padding: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button:hover {
                background-color: #ff0000;
            }
            .paginate {
                margin: 20px 0;
                text-align: center;
            }
            .paginate a {
                margin: 0 5px;
                text-decoration: none;
                color: #1E90FF;
            }
            #map {
                height: 50vh;
                width: 80%;
                max-width: 800px;
                margin: 20px 0;
                border: 1px solid #ddd;
                border-radius: 8px;
            }
        </style>
    </head>
    <body>
        <h1>あいうえお</h1>
        
        <div>
          <form action="/search" method="GET">
            <input type="text" name="keyword" placeholder="キーワードを入力">
            <input type="submit" value="検索">
          </form>
        </div>
        
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='place_name'>
                        <a href="/posts/{{ $post->id }}">{{ $post->place_name }}</a>
                    </h2>
                    <p><a href="/category_genres/{{ $post->category_genre->id }}">{{ $post->category_genre->name }}</a></p>
                    <p><a href="/category_titles/{{ $post->category_title->id }}">{{ $post->category_title->name }}</a></p>
                    <p><a href="/category_areas/{{ $post->category_area->id }}">{{ $post->category_area->name }}</a></p>
                    <p class='information'>{{ $post->information }}</p>
                </div>
                <form action='/posts/{{ $post->id }}' id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                </form>
            @endforeach
        </div>
        <a href='/posts/create' style="margin: 20px; text-decoration: none; color: #4CAF50;">聖地追加</a>
        
        <div class='paginate'>
            {{ $posts->appends(request()->query())->links() }} 
        </div>
        
        <div id="map"></div>
        
        <script>
            function deletePost(id) {
                'use strict';
                
                if (confirm('削除すると戻せません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
