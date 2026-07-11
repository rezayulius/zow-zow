<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Executive Dashboard') | ZOW Vetique Kemang</title>
    <link rel="icon" href="{{ asset('favicon-zow.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/executive.js'])
    @stack('styles')
</head>
<body class="bg-deep-cocoa-brown-900 text-carob-900 antialiased min-h-screen">
    {{ $slot ?? '' }}
    @yield('content')
</body>
</html>
