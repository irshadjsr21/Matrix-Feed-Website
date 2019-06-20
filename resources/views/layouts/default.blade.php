<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Matrix Feed</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
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

        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ asset('js/share.js') }}"></script>
    </body>
</html>
