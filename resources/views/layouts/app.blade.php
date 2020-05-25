<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#a297f7">
    <meta name="theme-color" content="#a297f7">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <meta name="description" content="Echo.tj - Музыкальное наследие Таджикистана. Песни, альбомы, видео, новости,
     статьи и многое другое в удобном приложении. Слушайте музыку онлайн, скачивайте на устройства, находите тексты песен
     и аккорды таджикских артистов">

    <meta name="keywords" content="таджикская музыка, этническая музыка, фолк, Далер Назаров, музыка онлайн, радио,
    новости, альбомы, Парем, Олег Фезов">

    <meta name="author" content="Sultonazar Mamadazizov">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Echo.tj - Музыкальное наследие Таджикистана</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ URL::asset('icons/png/favicon.png') }}" type="image/x-icon"/>
</head>
<body>
<main id="app" class="container-fluid position-relative h-100 overflow-auto">
    <app @auth :user="{{auth()->user()}}" @endauth ></app>
</main>
</body>
</html>
