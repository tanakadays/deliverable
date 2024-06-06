<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>聖地巡礼マップ</title>
        <style>
            #map {
                height: 50vh;
                width: 50%;
            }
            
            #other_genre {
                display: none;
            }
            
            #other_title {
                display: none;
            }
            
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
                <p class='place_name_error' style="color:red">{{ $errors->first('post.place_name') }}</p>
            </div>
            <div class="genre">
                <h2>ジャンル</h2>
                
                <select id="options_genre" name="post[category_genre_id]">
                    @foreach($category_genres as $category_genre)
                        <option value="{{ $category_genre->id }}">{{ $category_genre->name }}</option>
                    @endforeach
                </select>
                <input id="other_genre" name="post[genre]" placeholder="ジャンル名">
                
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
            
            <div class="area">
                <h2>場所名</h2>
                <select id="options_area" name="post[category_area_id]">
                    @foreach($category_areas as $category_area)
                        <option value="{{ $category_area->id }}">{{ $category_area->name }}</option>
                    @endforeach
                </select>
                <input id="other_area" type="text" name="post[area]" placeholder="エリア"/>
            </div>
            
            <div class="information">
                <h2>詳細</h2>
                <textarea type="text" name="post[information]" placeholder="説明"/></textarea>
                <p class='information_error' style="color:red">{{ $errors->first('post.information') }}</p>
            </div>
            
            <input type="hidden" name="post[latitude]" id="latitude">
            <input type="hidden" name="post[longitude]" id="longitude">
            
             <p class='google_map_error' style="color:red">{{ $errors->first('post.longitude') }}</p>
            
            <input type="submit" value="store"/>
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
                    center: { lat: 35.6895, lng: 139.6917 }, // 東京の中心
                    zoom: 8,
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
              if (titleselectElement.value == '1') {
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