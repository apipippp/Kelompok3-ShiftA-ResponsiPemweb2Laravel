<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-cream text-gray-800 selection:bg-sage selection:text-white">
        <div class="min-h-screen bg-cream flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <div class="max-w-7xl mx-auto w-full pt-8 pb-4 px-4 sm:px-6 lg:px-8">
                    <div class="bezel-outer">
                        <div class="bezel-inner px-6 py-5 bg-white">
                            {{ $header }}
                        </div>
                    </div>
                </div>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
