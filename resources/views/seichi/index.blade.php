<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>聖地巡礼マップ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>聖地巡礼マップ</h1>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='place_name'>
                        <a href="/posts/{{ $post->id }}">{{ $post->place_name }}</a>
                    </h2>
                    <p class='genre'>{{ $post->genre }}</p>
                    <p class='title_name'>{{ $post->title_name }}</p>
                    <p class='area'>{{ $post->area }}</p>
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
            {{ $posts->links() }}
        </div>
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