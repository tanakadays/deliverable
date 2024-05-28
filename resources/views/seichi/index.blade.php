<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>聖地巡礼マップ</title>
        <style>
            #map {
                height: 50vh;
                width: 50%;
            }
        </style>
    </head>
    <body>
        <h1>聖地巡礼マップ</h1>
        
       
        
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='place_name'>
                        <a href="/posts/{{ $post->id }}">{{ $post->place_name }}</a>
                    </h2>
                    <p class='genre'>{{ $post->genre }}</p>
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
        <a href='/posts/create'>聖地追加</a>
        
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
                'use strict'
                
                if(confirm('削除すると戻せません。\n本当に削除しますか')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
       
        
       
    </body>

</html>