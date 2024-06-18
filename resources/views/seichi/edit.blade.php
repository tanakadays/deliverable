<!DOCTYPE HTML>
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
            .title {
                font-size: 24px;
                color: #333;
                margin: 20px 0;
            }
            #map {
                height: 50vh;
                width: 80%;
                max-width: 800px;
                margin: 20px 0;
                border: 1px solid #ddd;
                border-radius: 8px;
            }
            .content {
                width: 80%;
                max-width: 800px;
                background-color: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                margin-bottom: 20px;
            }
            .content h2 {
                color: #333;
            }
            .content input[type="text"],
            .content textarea {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 16px;
            }
            .content input[type="file"] {
                margin: 10px 0;
            }
            .content input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            .content input[type="submit"]:hover {
                background-color: #45a049;
            }
            .image img {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
                margin-bottom: 20px;
            }
            .footer {
                margin: 20px 0;
            }
            .footer a {
                color: #1E90FF;
                text-decoration: none;
            }
            .footer a:hover {
                text-decoration: underline;
            }
            
            #other_genre,
            #other_title,
            #other_area {
                display: none;
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
                    <p>変更前:{{ $post->category_title->name }}</p>
                    <select id="options_title" name="post[category_title_id]">
                    @foreach($category_titles as $category_title)
                        <option value="{{ $category_title->id }}">{{ $category_title->name }}</option>
                    @endforeach
                    </select>
                <input id="other_title" type="text" name="post[title_name]" placeholder="作品名"/>
                </div>
                
                <div class='genre'>
                    <h2>ジャンル</h2>
                    <p>変更前:{{ $post->category_genre->name }}</p>
                    <select id="options_genre" name="post[category_genre_id]">
                    @foreach($category_genres as $category_genre)
                        <option value="{{ $category_genre->id }}">{{ $category_genre->name }}</option>
                    @endforeach
                    </select>
                    <input id="other_genre" type=text name="post[genre]" placeholder="ジャンル名">
                </div>
                
                <div class='area'>
                    <h2>エリア</h2>
                    <p>変更前:{{ $post->category_area->name }}</p>
                    <select id="options_area" name="post[category_area_id]">
                    @foreach($category_areas as $category_area)
                        <option value="{{ $category_area->id }}">{{ $category_area->name }}</option>
                    @endforeach
                    </select>
                    <input id="other_area" type="text" name="post[area]" placeholder="エリア"/>
                    
                </div>
                <div class='information'>
                    <h2>詳細</h2>
                    <textarea name='post[information]'>{{ $post->information }}</textarea>
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
                    center: position,
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
                if (marker != null) {
                    marker.setMap(null);
                }
    
                marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                });
    
                map.panTo(latLng);
            }
            
            const genreselectElement = document.getElementById('options_genre');
            const genreotherInputDiv = document.getElementById('other_genre');
            
            const titleselectElement = document.getElementById('options_title');
            const titleotherInputDiv = document.getElementById('other_title');
            
            const areaselectElement = document.getElementById('options_area');
            const areaotherInputDiv = document.getElementById('other_area');
            
            genreselectElement.addEventListener('change', function() {
              if (genreselectElement.value == '5') {
                genreotherInputDiv.style.display = 'block';
              } else {
                genreotherInputDiv.style.display = 'none';
              }
            });
            
            titleselectElement.addEventListener('change', function() {
              if (titleselectElement.value == '4') {
                titleotherInputDiv.style.display = 'block';
              } else {
                titleotherInputDiv.style.display = 'none';
              }
            });
            
            areaselectElement.addEventListener('change', function() {
              if (areaselectElement.value == '48') {
                areaotherInputDiv.style.display = 'block';
              } else {
                areaotherInputDiv.style.display = 'none';
              }
            });
            
        </script>
    </body>
</html>
