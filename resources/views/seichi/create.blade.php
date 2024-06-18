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
            h1 {
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
            form {
                width: 80%;
                max-width: 800px;
                background-color: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                margin-bottom: 20px;
            }
            form h2 {
                color: #333;
            }
            form input[type="text"],
            form textarea,
            form select,
            form input[type="file"] {
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
            .error {
                color: red;
            }
            #other_genre,
            #other_title,
            #other_area {
                display: none;
            }
        </style>
    </head>
    <body>
        <h1>聖地追加</h1>
        
        <div id="map"></div>
        
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class='image'>
                <input type="file" name="image">
            </div>
            <div class="place_name">
                <h2>場所名</h2>
                <input type="text" name="post[place_name]" placeholder="場所名"/>
                <p class='error'>{{ $errors->first('post.place_name') }}</p>
            </div>
            
            
            <div class="title_name">
                <h2>作品名</h2>
                <select id="options_title" name="post[category_title_id]">
                    @foreach($category_titles as $category_title)
                        <option value="{{ $category_title->id }}">{{ $category_title->name }}</option>
                    @endforeach
                </select>
                <input id="other_title" type="text" name="post[title_name]" placeholder="作品名"/>
            </div>
            
            <div class="genre">
                <h2>ジャンル</h2>
                <select id="options_genre" name="post[category_genre_id]">
                    @foreach($category_genres as $category_genre)
                        <option value="{{ $category_genre->id }}">{{ $category_genre->name }}</option>
                    @endforeach
                </select>
                <input id="other_genre" type=text name="post[genre]" placeholder="ジャンル名">
            </div>
            
            <div class="area">
                <h2>エリア</h2>
                <select id="options_area" name="post[category_area_id]">
                    @foreach($category_areas as $category_area)
                        <option value="{{ $category_area->id }}">{{ $category_area->name }}</option>
                    @endforeach
                </select>
                <input id="other_area" type="text" name="post[area]" placeholder="エリア"/>
            </div>
            
            <div class="information">
                <h2>詳細</h2>
                <textarea name="post[information]" placeholder="説明"></textarea>
                <p class='error'>{{ $errors->first('post.information') }}</p>
            </div>
            
            <input type="hidden" name="post[latitude]" id="latitude">
            <input type="hidden" name="post[longitude]" id="longitude">
            
            <p class='error'>{{ $errors->first('post.longitude') }}</p>
            
            <input type="submit" value="保存">
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap" async defer></script>
        <script>
            let map;
            let marker = null; 
            
            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: 35.6895, lng: 139.6917 },
                    zoom: 8,
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
