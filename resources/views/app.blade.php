<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('/') }}"/>

    <title>Pokeking - Antonis Rizopoulos</title>

    <!-- Fonts -->
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
    <div class="content">
        @yield('content')
    </div>
</div>
<script src="{{ URL::asset('js/app.js') }}"></script>
</body>
</html>
