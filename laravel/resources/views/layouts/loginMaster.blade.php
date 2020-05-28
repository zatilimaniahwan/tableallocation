<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-pjax-version" content="{{ mix('/css/app.css') . mix('/css/template.css'). mix('/js/app.js').mix('/js/template.js') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> 
     @if (isset($title))
     {{ config('app.name') }}|{{ $title }} 
        @else
        {{ config('app.name') }}
        @endif</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/template.js') }}" defer></script>
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">
 
</head>
<body class="text-left">
    <div id="app">
    <main id="pjax-container">
@yield('content')

</main>

</div>

</body>
</html>