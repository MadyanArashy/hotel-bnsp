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
    .room-card {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .room-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .room-content {
        padding: 1.5rem;
    }

    .room-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .room-description {
        color: #6b7280;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .room-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
    }

    .room-price {
        display: flex;
        flex-direction: column;
    }

    .price-amount {
        font-size: 1.5rem;
        font-weight: 700;
        color: #d97706;
    }

    .price-period {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .btn-book {
        background: #d97706;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-book:hover {
        background: #b45309;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.3);
    }

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
                        <a href="/" class="text-2xl font-bold text-amber-600">BNSP Hotel</a>
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
                    <a href="#home" class="block py-2 text-gray-700 hover:text-amber-600">Home</a>
                    <a href="#rooms" class="block py-2 text-gray-700 hover:text-amber-600">Rooms</a>
                    <a href="#amenities" class="block py-2 text-gray-700 hover:text-amber-600">Amenities</a>
                    <a href="#about" class="block py-2 text-gray-700 hover:text-amber-600">About</a>
                    <a href="#contact" class="block py-2 text-gray-700 hover:text-amber-600">Contact</a>
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
