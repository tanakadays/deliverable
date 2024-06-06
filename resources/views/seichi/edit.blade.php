<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>聖地巡礼マップ</title>
        <style>
            #map {
                height: 50vh;
                width: 50%;
            }
        </style>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">編集画面</h1>
        
        <div id="map"></div>
        
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if($post->image_url)
                    <div class="image">
                        <img src="{{ $post->image_url }}" alt="画像を読み込めません。">
                    </div>
                @endif
                <div class='image'>
                    <input type="file" name="image">
                </div>
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
                
                <input type="hidden" name="post[latitude]" id="latitude" value="{{ $post->latitude }}">
                <input type="hidden" name="post[longitude]" id="longitude" value="{{ $post->longitude }}">
                <input type="submit" value="保存">
            </form>
            
            <div class="footer">
            <a href="/">戻る</a>
            </div>
        </div>
        
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap" async defer></script>
        <script>
            let map;
            let marker = null; 
            
    
            function initMap() {
                
                const lat = parseFloat("{{ $post->latitude }}");
                const lng = parseFloat("{{ $post->longitude }}");
                const position = { lat: lat, lng: lng };
                
                map = new google.maps.Map(document.getElementById("map"), {
                    center: position, // 東京の中心
                    zoom: 8,
                });
                
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                });
            
    
                map.addListener("click", (e) => {
                    placeMarkerAndPanTo(e.latLng, map);
                    document.getElementById('latitude').value = e.latLng.lat();
                    document.getElementById('longitude').value = e.latLng.lng();
                });
                
                
            }
    
            function placeMarkerAndPanTo(latLng, map) {
                // 既存のマーカーがあれば削除
                if (marker　!= null) {
                    marker.setMap(null);
                }
    
                // 新しいマーカーを作成して設置
                marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                });
    
                // 地図の中心を新しいマーカーの位置に移動
                map.panTo(latLng);
            }
        </script>
        
    </body>
</html>