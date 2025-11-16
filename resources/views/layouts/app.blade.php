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
        {{ $slot }}
    </main>

    <!-- Global Scripts -->
    @vite('resources/js/app.js')

    <!-- Scripts dari child -->
    @stack('scripts')
  </body>
</html>
