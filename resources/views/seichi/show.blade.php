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
                padding: 20px;
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
        </style>
    </head>
    <body>
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
            <a href="/unlike/{{  $post->id  }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
          @else
            <a href="/like/{{  $post->id  }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
          @endif
        </div>
        
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
        <div class='edit'><a href="/posts/{{ $post->id }}/edit">edit</a></div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>
