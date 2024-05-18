<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>聖地巡礼マップ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <x-slot name="header">
            ヘッダー名
        </x-slot>
        <body>
            <h1>Blog Name</h1>
            <div class='posts'>
                <div class='post'>
                    <h2 class='title'>Title</h2>
                    <p class='body'>This is a sample body.</p>
                </div>
            </div>
        </body>
    </x-app-layout>
    
</html>