<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Los 3 Osos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: #f3f4f6; /* gris claro */
            color: #18181b; /* negro */
        }
        .bg-oso-orange { background-color: #ff7300; }
        .text-oso-orange { color: #ff7300; }
        .border-oso-orange { border-color: #ff7300; }
        nav.bg-black {
            background: #18181b !important;
        }
        .navbar-link {
            color: #e5e7eb;
            transition: color 0.2s;
        }
        .navbar-link:hover {
            color: #ff7300;
        }
        .navbar-btn {
            background: #ff7300;
            color: #fff;
        }
        .navbar-btn:hover {
            background: #ff8800;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    <div class="min-h-screen bg-white dark:bg-gray-900">
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
        <main class="py-6 px-2 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
