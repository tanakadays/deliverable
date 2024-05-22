<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>聖地巡礼マップ</title>
    </head>
    <body>
        <h1>聖地追加</h1>
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
                <input name="post[genre]" placeholder="ジャンル名">
                <p class='genre_error' style="color:red">{{ $errors->first('post.genre') }}</p>
            </div>
            <div class="title_name">
                <h2>作品名</h2>
                <input type="text" name="post[title_name]" placeholder="作品名"/>
                <p class='title_name_error' style="color:red">{{ $errors->first('post.title_name') }}</p>
            </div>
            <div class="area">
                <h2>場所名</h2>
                <input type="text" name="post[area]" placeholder="エリア"/>
                <p class='area_error' style="color:red">{{ $errors->first('post.area') }}</p>
            </div>
            <div class="information">
                <h2>詳細</h2>
                <textarea type="text" name="post[information]" placeholder="説明"/></textarea>
                <p class='information_error' style="color:red">{{ $errors->first('post.information') }}</p>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>