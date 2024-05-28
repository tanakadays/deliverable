<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Maps API with Laravel</title>
    <style>
        #map {
            height: 50vh;
            width: 50%;
        }
    </style>
</head>
<body>
    <h1>マップテスト</h1>
    <div id="map"></div>
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
            });
            
            let tokyo = new google.maps.Marker({
                position:{ lat:35.6586, lng:139.7454 },
                map:map,
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
