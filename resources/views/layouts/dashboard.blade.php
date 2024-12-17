<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Hind+Mysuru:wght@300;400;500;600;700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Space+Grotesk:wght@300..700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/scss/main.scss', 'resources/js/app.js'])
</head>

<body>

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

    <footer class="footer">
        <p class="footer__copy">&copy; 2024. All rights reserved.</p>
        <p class="footer__text">Laratasks - The Laravel Tasks Manager</p>
    </footer>

    {{-- <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div> --}}
</body>

</html>
