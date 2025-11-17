{{-- layouts/app.blade.php --}}
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
  <style>
    #video-modal.active {
        display: flex !important;
    }
    </style>
  <body class="font-sans bg-gray-50 text-gray-900">

      <main role="main" class="transition-all duration-300 relative min-h-screen z-30">
        <!-- Navigation -->
        <nav class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-sm shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center">
                        <a href="/" class="text-2xl font-bold text-green-600">BNSP Hotel</a>
                    </div>

                    <div class="hidden md:flex items-center space-x-8 {{ request()->routeIs('pesanan.index') ? 'absolute left-7/15' : '' }}">
                        @if (request()->routeIs('home'))
                        <a href="#home" class="nav-link">Home</a>
                        <a href="#rooms" class="nav-link">Rooms</a>
                        <a href="#amenities" class="nav-link">Amenities</a>
                        <a href="#about" class="nav-link">About</a>
                        @else
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                        @endif
                        <a href="{{ route('pesanan.index') }}" class="nav-link {{ request()->routeIs('pesanan.index') ? 'special-nav-link' : '' }}">Orders</a>
                    </div>

                    @if (request()->routeIs('home'))
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="javascript:void(0)" onclick="openBookingModal()" class="btn-book">Book Now</a>
                    </div>
                    @endif

                    <!-- Mobile menu button -->
                    <button class="md:hidden p-2 rounded-lg hover:bg-gray-100" id="mobile-menu-btn">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="hidden md:hidden bg-white border-t" id="mobile-menu">
                <div class="px-4 py-4 space-y-3">
                    <a href="#home" class="block py-2 text-gray-700 hover:text-green-600">Home</a>
                    <a href="#rooms" class="block py-2 text-gray-700 hover:text-green-600">Rooms</a>
                    <a href="#amenities" class="block py-2 text-gray-700 hover:text-green-600">Amenities</a>
                    <a href="#about" class="block py-2 text-gray-700 hover:text-green-600">About</a>
                    <a href="#contact" class="block py-2 text-gray-700 hover:text-green-600">Contact</a>
                    <div class="pt-3 space-y-2">
                        <a href="javascript:void(0)" onclick="openBookingModal()" class="btn-book">Book Now</a>
                    </div>
                </div>
            </div>
        </nav>
        {{ $slot }}
    </main>

    <!-- Global Scripts -->
    @vite('resources/js/app.js')

    <!-- Scripts dari child -->
    @stack('scripts')
  </body>
</html>
