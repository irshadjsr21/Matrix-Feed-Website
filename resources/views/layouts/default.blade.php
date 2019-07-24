<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-7754593401653923",
            enable_page_level_ads: true
        });
        </script>        
        @include('../components/seo')
        @yield('head')
    </head>
    <body>
        @include('../components/header')
    
        @include('../components/topbar')

        <div id="app" class="container">
            @yield('content')
        </div>

        @include('../components/copyright')

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/share.js') }}"></script>
    </body>
</html>
