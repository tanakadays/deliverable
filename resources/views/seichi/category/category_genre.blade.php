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
        <h1>ジャンルごとの一覧</h1>
        
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='place_name'>
                        <a href="/posts/{{ $post->id }}">{{ $post->place_name }}</a>
                    </h2>
                    <p class='genre'>{{ $post->genre }}</p>
                    <a href="">{{ $post->category_genre->name }}</a>
                    <p class='title_name'>{{ $post->title_name }}</p>
                    <p class='area'>{{ $post->area }}</p>
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
            {{ $posts->links() }}
        </div>
        
        <div id="map"></div>
        
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap" async defer></script>
        <script>
            let map;
            let marker = null; 
            
            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: 35.6895, lng: 139.6917 }, // 東京の中心
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
                        scaledSize: new google.maps.Size(25, 25), // 画像のサイズを調整
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(25, 25)
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
