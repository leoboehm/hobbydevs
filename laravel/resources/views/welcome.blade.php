<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>HobbyDevs</title>

        @vite(['resources/js/app.js'])
        @csrf

    </head>
    <body>
        <div id="app"></div>
    </body>
</html>
