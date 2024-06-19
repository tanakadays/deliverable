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
                padding-top: 60px;
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
                margin-left: 100px;
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
            h1.page-title {
                font-size: 24px;
                color: #333;
                margin: 20px 0;
            }
            .categories {
                width: 80%;
                max-width: 800px;
                margin: 20px auto;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
            .category {
                background-color: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 20px;
                margin: 10px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                width: 200px;
                text-align: center;
            }
            .category a {
                color: #1E90FF;
                text-decoration: none;
                font-size: 18px;
            }
            .category a:hover {
                text-decoration: underline;
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
        
        <h1 class="page-title">作品一覧</h1>
        
        <div class="categories">
            @foreach($category_titles as $category_title)
                <div class="category">
                    <a href="/category_titles/{{ $category_title->id }}">{{ $category_title->name }}</a>
                </div>
            @endforeach
        </div>
        
    </body>
</html>
