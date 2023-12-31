<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/notification.css') }}" rel="stylesheet" defer>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" defer>
    <link href="{{asset('css/userModal.css')}}" rel="stylesheet" defer />
</head>
<body>
    <div id="app">
        @include("includes.navbar")
        @include("includes.notification")
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
