<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - {{ config('app.name', 'Mini Diary') }}</title>

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/slick/slick-theme.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dynamic.css') }}" rel="stylesheet">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap-datepicker.min.css">
        <script src="/vendor/bootstrap/js/bootstrap-datepicker.js"></script>
        <script src="/vendor/bootstrap/js/locales/bootstrap-datepicker.ja.js"></script>

    </head>
    <body class="bg-dark">
        <div class="container-fluid">
            <div id="header">
                    @include('layouts.nav')
            </div>
            <div id="content">
                @yield('content')
            </div>
            <div id="page-top"><a href="#wrap">PAGE TOP</a></div>
            <div id="footer" class="m-3 p-3 mb-2 bg-light text-dark text-center font-weight-light font-italic border border-dark rounded">
                &copy; Copyright 2020 by H.Kataoka.
            </div>
        </div>
        <script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    </body>
</html>
