<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#6cb2eb">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <meta name="description"
          content="Музыкально-информационный портал Echo.tj. Песни, альбомы, видео, новости, статьи и многое другое в удобном приложении. Слушайте музыку онлайн, скачивайте на устройства, находите тексты песен и аккорды таджикских артистов">

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

{{--    <link rel="icon" href="{{ URL::asset('icons/png/favicon.png') }}" type="image/x-icon"/>--}}

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ URL::asset('icons/favicons/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ URL::asset('icons/favicons/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ URL::asset('icons/favicons/favicon-96x96.png') }}" sizes="96x96">

    <!-- Apple -->
    <link rel="apple-touch-icon" href="{{ URL::asset('icons/favicons/favicon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('icons/favicons/favicon-180x180.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('icons/favicons/favicon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ URL::asset('icons/favicons/favicon-167x167.png') }}">

    <meta name="apple-mobile-web-app-title" content="Echo.tj">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#6cb2eb">

</head>
<body>
<main id="app" class="position-relative h-100 overflow-auto">
    <app @auth :user="{{auth()->user()}}" @endauth ></app>
</main>
</body>
</html>
