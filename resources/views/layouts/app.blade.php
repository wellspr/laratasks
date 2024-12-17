<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/sass/main.scss', 'resources/js/app.js'])
</head>

<body x-data="">
    @if (session()->has('success'))
        <x-flash-message-success />
    @endif

    <header class="header primary">
        <x-app-name />

        @if (Route::has('login'))
            <nav class="header__app-navigation">
                @auth
                    @include('tasks.navigation')
                @endauth
            </nav>
        @endif
    </header>

    <main class="main">
        <div class="container">
            <div class="page">
                @yield('page')
            </div>
        </div>
    </main>

    <x-app-footer />
</body>

</html>
