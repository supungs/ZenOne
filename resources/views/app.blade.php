<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @routes
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite(['resources/sass/app.scss'])

        @vite(['resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="fixed-top-navbar">
        <div class="wrapper">
            <x-layouts.header></x-layouts.header>
            <div class="content-page">
                @inertia
            </div>
        </div>
        <x-layouts.footer></x-layouts.footer>
    </body>
</html>
