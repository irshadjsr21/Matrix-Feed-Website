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
        @yield('head')
    </head>
    <body>
        @include('../components/header')
    
        @include('../components/topbar')

          <div
          class="w-100 py-4 row align-items-center justify-content-center" style="min-height: 60vh;"
          >
            <div class="col py-4 text-center">
              <h1 class="display-4">@yield('title')</h1>
              <h5 style="opacity: 0.8" class="mt-2 mb-4">@yield('message')</h5>
              <a href="/" class="mt-4 btn btn-primary btn-lg">Go Back</a>
            </div>
          </div>

        @include('../components/copyright')

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/share.js') }}"></script>
    </body>
</html>
