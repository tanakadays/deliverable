<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>聖地巡礼マップ</title>
        <style>
          
        </style>
    </head>
    <body>
        <h1>あいうえお</h1>
        
        <div>
          <form action="/search" method="GET">
            <input type="text" name="keyword">
            <input type="submit" value="検索">
          </form>
        </div>
        
       
        
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='place_name'>
                        <a href="/posts/{{ $post->id }}">{{ $post->place_name }}</a>
                    </h2>
                    <p><a href="/category_genres/{{ $post->category_genre->id }}">{{ $post->category_genre->name }}</a></p>
                    <p><a href="/category_titles/{{ $post->category_title->id }}">{{ $post->category_title->name }}</a></p>
                    <p><a href="/category_areas/{{ $post->category_area->id }}">{{ $post->category_area->name }}</a></p>
                    <p class='information'>{{ $post->information }}</p>
                </div>
                <form action='/posts/{{ $post->id }}' id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                </form>
            @endforeach
        </div>
        <a href='/posts/create'>聖地追加</a>
        
        <div class='paginate'>
            {{ $posts->appends(request()->query())->links() }} 
        </div>
        
         <div id="map"></div>
        
        
        <script>
            
            
            function deletePost(id) {
                'use strict'
                
                if(confirm('削除すると戻せません。\n本当に削除しますか')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
       
        
       
    </body>

</html>