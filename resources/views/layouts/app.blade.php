<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BNSP Hotel')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
  </head>
  <body class="font-sans bg-gray-50 text-gray-900">

    <main role="main" class="transition-all duration-300 relative min-h-screen z-30">
        {{ $slot }}
    </main>

    <!-- Global Scripts -->
    @vite('resources/js/app.js')

    <!-- Scripts dari child -->
    @stack('scripts')
  </body>
</html>
