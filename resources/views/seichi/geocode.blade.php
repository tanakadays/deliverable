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
        let markers = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 35.6895, lng: 139.6917 }, // 東京の中心
                zoom: 8,
            });

            map.addListener("click", (e) => {
                placeMarkerAndPanTo(e.latLng, map);
            });
        }

        function placeMarkerAndPanTo(latLng, map) {
            const marker = new google.maps.Marker({
                position: latLng,
                map: map,
            });
            markers.push(marker);
            map.panTo(latLng);
        }
    </script>
</body>
</html>
