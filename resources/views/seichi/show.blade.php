<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>聖地巡礼マップ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
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
                padding: 60px;
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
            
            .image img {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
                margin-bottom: 20px;
            }
            .place_name {
                font-size: 24px;
                color: #333;
                margin: 20px 0;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                margin: 10px 0;
                font-size: 16px;
                text-align: center;
                border-radius: 4px;
                text-decoration: none;
            }
            .btn-success {
                background-color: #4CAF50;
                color: white;
            }
            .btn-secondary {
                background-color: #6c757d;
                color: white;
            }
            .btn:hover {
                opacity: 0.8;
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
            .content h3 {
                margin-top: 0;
                color: #333;
            }
            .content p {
                margin: 5px 0 20px;
                color: #666;
            }
            .edit, .footer {
                margin: 20px 0;
            }
            .edit a, .footer a {
                color: #1E90FF;
                text-decoration: none;
            }
            .edit a:hover, .footer a:hover {
                text-decoration: underline;
            }
            
            .route {
                background-color: blue;
                color: white;
                border: none;
                border-radius: 50%;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                margin:20px;
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
        
        
        @if($post->image_url)
        <div class="image">
            <img src="{{ $post->image_url }}" alt="画像を読み込めません。">
        </div>
        @endif
        
        <h1 class="place_name">
            {{ $post->place_name }}
        </h1>
        
        <div>
          @if($post->is_liked_by_auth_user())
            <a href="/unlike/{{  $post->id  }}" class="btn btn-success btn-sm">いきたい<span class="badge">{{ $post->likes->count() }}</span></a>
          @else
            <a href="/like/{{  $post->id  }}" class="btn btn-secondary btn-sm">いきたい<span class="badge">{{ $post->likes->count() }}</span></a>
          @endif
        </div>
        
        <button class=route onclick="openGoogleMaps()">ルート案内</button>
        
        <div class="content">
            <div class="title_name">
                <h3>作品名</h3>
                <p>{{ $post->category_title->name }}</p>    
            </div>
            <div class="genre">
                <h3>ジャンル</h3>
                <p>{{ $post->category_genre->name }}</p>    
            </div>
            <div class="area">
                <h3>エリア</h3>
                <p>{{ $post->category_area->name }}</p>    
            </div>
            <div class="information">
                <h3>詳細</h3>
                <p>{{ $post->information }}</p>
            </div>
        </div>
        
        
        
        <div class='edit'><a href="/posts/{{ $post->id }}/edit">編集</a></div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    
    
    <script>
        function openGoogleMaps() {
            var latitude = parseFloat("{{ $post->latitude }}");
            var longitude = parseFloat("{{ $post->longitude }}");

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var origin = position.coords.latitude + ',' + position.coords.longitude;
                    var destination = latitude + ',' + longitude;
                    var url = `https://www.google.com/maps/dir/?api=1&origin=${origin}&destination=${destination}&travelmode=driving`;

                    window.open(url, '_blank');
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>
</html>
