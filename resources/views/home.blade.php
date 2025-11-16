@section('title', 'Welcome to BNSP Hotel - Luxury Accommodation')

<x-app-layout>
    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Experience Luxury & Comfort</h1>
            <p class="hero-subtitle">Your perfect getaway awaits at BNSP Hotel</p>
            <a href="#rooms" class="btn-hero">Explore Rooms</a>
        </div>
    </section>

    <!-- Featured Rooms Section -->
    <section id="rooms" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="section-title">Our Rooms</h2>
                <p class="section-subtitle">Choose from our selection of luxurious accommodations</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Room Cards -->
                @foreach($jenisKamars as $kamar)
                <div class="room-card group">
                    <div class="relative overflow-hidden rounded-t-xl">
                        <!-- Thumbnail Image -->
                        <img src="{{ $kamar->thumbnailPath }}"
                        alt="{{ $kamar->nama }}"
                        class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110"
                        loading="lazy">

                        <!-- Video Play Button Overlay -->
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button onclick="openVideoModal('{{ $kamar->videoUrl }}', '{{ $kamar->nama }}')"
                                class="bg-amber-600 hover:bg-amber-700 text-white rounded-full p-4 transform hover:scale-110 transition-all duration-300 shadow-lg">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Video Badge -->
                        <div class="absolute top-3 right-3 bg-amber-600 text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            Video Tour
                        </div>
                    </div>

                    <div class="room-content">
                        <h3 class="room-title">{{ $kamar->nama }}</h3>
                        <p class="room-description">{{ $kamar->deskripsi }}</p>
                        <div class="room-footer">
                            <div class="room-price">
                                <span class="price-amount">Rp.{{ number_format($kamar->harga, 0, ",", ".") }}</span>
                                <span class="price-period">/malam</span>
                            </div>
                            <a href="javascript:void(0)" onclick="openBookingModal()" class="btn-book">Book Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div id="video-modal" class="fixed inset-0 bg-black/90 z-[100] items-center justify-center p-4" style="display: none;">
        <div class="relative w-full max-w-5xl">
            <!-- Close Button -->
            <button onclick="closeVideoModal()"
            class="absolute -top-12 right-0 text-white hover:text-amber-500 transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Video Title -->
        <h3 id="video-title" class="text-white text-2xl font-bold mb-4 text-center"></h3>

        <!-- YouTube Iframe Container -->
        <div class="bg-black rounded-lg overflow-hidden shadow-2xl" style="aspect-ratio: 16/9;">
            <iframe id="youtube-iframe"
            class="w-full h-full"
            src=""
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>
</div>
</div>

<!-- Amenities Section -->
<section id="amenities" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="section-title">Hotel Amenities</h2>
            <p class="section-subtitle">Everything you need for a perfect stay</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="amenity-card">
                <div class="amenity-icon">🏊</div>
                <h3 class="amenity-title">Swimming Pool</h3>
                <p class="amenity-description">Outdoor heated pool with stunning views</p>
            </div>

            <div class="amenity-card">
                <div class="amenity-icon">🍽️</div>
                <h3 class="amenity-title">Restaurant</h3>
                <p class="amenity-description">Fine dining with international cuisine</p>
            </div>

            <div class="amenity-card">
                <div class="amenity-icon">💪</div>
                <h3 class="amenity-title">Fitness Center</h3>
                <p class="amenity-description">24/7 access to modern equipment</p>
            </div>

            <div class="amenity-card">
                <div class="amenity-icon">🅿️</div>
                <h3 class="amenity-title">Free Parking</h3>
                <p class="amenity-description">Complimentary parking for all guests</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="section-title text-left">About BNSP Hotel</h2>
                <p class="text-gray-600 mb-6">
                    Welcome to BNSP Hotel, where luxury meets comfort. Since our establishment, we've been dedicated to providing exceptional hospitality and creating unforgettable experiences for our guests.
                </p>
                <p class="text-gray-600 mb-6">
                    Our hotel features state-of-the-art facilities, elegantly designed rooms, and a team of professionals committed to making your stay perfect. Whether you're here for business or leisure, we ensure every moment is memorable.
                </p>
                <div class="grid grid-cols-3 gap-6 mt-8">
                    <div class="stat-card">
                        <div class="stat-number">150+</div>
                        <div class="stat-label">Rooms</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Happy Guests</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Years</div>
                    </div>
                </div>
            </div>
            <div class="about-image"></div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-2xl font-bold text-amber-500 mb-4">BNSP Hotel</h3>
                <p class="text-gray-400">Your home away from home. Experience luxury and comfort.</p>
            </div>

            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#home" class="text-gray-400 hover:text-amber-500">Home</a></li>
                    <li><a href="#rooms" class="text-gray-400 hover:text-amber-500">Rooms</a></li>
                    <li><a href="#amenities" class="text-gray-400 hover:text-amber-500">Amenities</a></li>
                    <li><a href="#about" class="text-gray-400 hover:text-amber-500">About</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-4">Services</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-amber-500">Room Service</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-amber-500">Concierge</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-amber-500">Spa & Wellness</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-amber-500">Events</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-4">Newsletter</h4>
                <p class="text-gray-400 mb-4">Subscribe for exclusive offers</p>
                <form class="flex">
                    <input type="email" placeholder="Your email" class="flex-1 px-4 py-2 rounded-l-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-amber-500">
                    <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 rounded-r-lg">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2025 BNSP Hotel. All rights reserved.</p>
        </div>
    </div>
</footer>
<x-form :jenisKamars="$jenisKamars" />
@push('scripts')
<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                document.getElementById('mobile-menu').classList.add('hidden');
            }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });
    </script>
    @endpush
    @push('scripts')
    <script>
    function openBookingModal() {
        document.getElementById('booking-modal').classList.add('active');
    }
    function closeBookingModal() {
        document.getElementById('booking-modal').classList.remove('active');
    }

    </script>
    @endpush
    @push('scripts')
    <script>
    function getYouTubeEmbedUrl(url) {
        // Extract video ID from various YouTube URL formats
        let videoId = '';

        // Check for different YouTube URL formats
        if (url.includes('youtube.com/watch?v=')) {
            videoId = url.split('v=')[1].split('&')[0];
        } else if (url.includes('youtu.be/')) {
            videoId = url.split('youtu.be/')[1].split('?')[0];
        } else if (url.includes('youtube.com/embed/')) {
            videoId = url.split('embed/')[1].split('?')[0];
        } else if (url.includes('youtube.com/v/')) {
            videoId = url.split('v/')[1].split('?')[0];
        }

        // Return embed URL with autoplay
        return `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
    }

    function openVideoModal(videoUrl, roomName) {
        const modal = document.getElementById('video-modal');
        const iframe = document.getElementById('youtube-iframe');
        const videoTitle = document.getElementById('video-title');

        // Convert to embed URL if needed
        const embedUrl = getYouTubeEmbedUrl(videoUrl);

        iframe.src = embedUrl;
        videoTitle.textContent = roomName + ' - Virtual Tour';
        modal.classList.add('active');

        // Prevent body scroll when modal is open
        document.body.style.overflow = 'hidden';
    }

    function closeVideoModal() {
        const modal = document.getElementById('video-modal');
        const iframe = document.getElementById('youtube-iframe');

        // Stop video by removing src
        iframe.src = '';
        modal.classList.remove('active');

        // Restore body scroll
        document.body.style.overflow = '';
    }

    // Close modal when clicking outside the video
    document.getElementById('video-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeVideoModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeVideoModal();
        }
    });
    </script>
    @endpush
</x-app-layout>
