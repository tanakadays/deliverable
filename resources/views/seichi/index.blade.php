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
                padding-top: 60px; 
            }
            header {
                width: 100%;
                background-color: #333;
                color: white;
                position: fixed;
                top: 0;
                left: 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                z-index: 1000;
            }
            header h1 {
                margin: 0;
                font-size: 24px;
            }
            
            header nav {
                display: flex;
                margin-left: 100;
            }
            
            header nav a {
                color: white;
                text-decoration: none;
                margin: 0 20px;
                font-size: 16px;
            }
            header nav a:hover {
                text-decoration: underline;
            }
            
            .dropdown {
                position: relative;
                display: inline-block;
            }
        
            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }
        
            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }
        
            .dropdown-content a:hover {
                background-color: #f1f1f1;
            }
        
            .dropdown:hover .dropdown-content {
                display: block;
            }
            
            h1.page-title {
                font-size: 24px;
                color: #333;
                margin: 20px 0;
            }
            form {
                margin: 20px 0;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            form input[type="text"] {
                padding: 10px;
                font-size: 16px;
                width: 250px;
                border: 1px solid #ccc;
                border-radius: 4px;
                margin-bottom: 10px;
            }
            form input[type="submit"] {
                padding: 10px 20px;
                font-size: 16px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            form input[type="submit"]:hover {
                background-color: #45a049;
            }
            .posts {
                width: 80%;
                max-width: 800px;
                margin: 20px auto;
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
        <header>
            <h1>聖地巡礼マップ</h1>
            <nav>
                <a href="/">ホーム</a>
                <a href="/posts/create">聖地追加</a>
                <a href="/category_titles">作品</a>
                <a href="/category_genres">ジャンル</a>
                <a href="/category_areas">エリア</a>
                
                <div class="dropdown">
                    <a>マイページ</a>
                    <div class="dropdown-content">
                        <a href="/profile">プロフィールの編集</a>
                        <a href="/mypage">行きたいリスト</a>
                    </div>
                </div>
            </nav>
        </header>
        
        <h1 class="page-title">聖地一覧</h1>
        
        <form action="/search" method="GET">
            @csrf
            <input type="text" name="keyword" placeholder="キーワードを入力">
            <input type="submit" value="検索">
        </form>
        
        <div id="map"></div>
        
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
                    <form action='/posts/{{ $post->id }}' id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">削除</button>
                    </form>
                </div>
            @endforeach
        </div>
        
        <a href='/posts/create' style="margin: 20px; text-decoration: none; color: #4CAF50;">聖地追加</a>
        
        <div class='paginate flex-row'>
            {{ $posts->links() }} 
        </div>
        
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap" async defer></script>
        <script>
            let map;
            let marker = null; 
    
            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: 35.6895, lng: 139.6917 }, 
                    zoom: 6,
                });
    
                @foreach ($posts as $post)
                    addMarker({ lat: parseFloat("{{ $post->latitude }}"), lng: parseFloat("{{ $post->longitude }}") }, "/posts/{{ $post->id }}", "{{ $post->image_url }}");
                @endforeach
            }
    
            function addMarker(location, url, imageUrl) {
                const marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    icon: {
                        url: imageUrl,
                        scaledSize: new google.maps.Size(30, 30), 
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(12.5, 12.5),
                        
                    },
                    
                });
                
                marker.addListener('click', function() {
                    window.location.href = url;
                });
            }
            
            function deletePost(id) {
                'use strict';
                
                if (confirm('削除すると戻せません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>
