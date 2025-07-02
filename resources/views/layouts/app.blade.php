<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ZenMazip')</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts Oxanium -->
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Oxanium', 'Arial', sans-serif;
            background-color: #000;
            color: #fff;
            padding-top: 100px; /* Offset for fixed header */
        }
        .logo-gradient {
            font-family: 'Oxanium', sans-serif;
            background: linear-gradient(90deg, #00FFC0 0%, #00BFFF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        .hero-title-gradient-futuristic {
            background: linear-gradient(90deg, #00FFC0 0%, #00BFFF 100%); /* Blue to Green gradient */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        .button-style {
            background-color: #5D3FD3;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .button-style:hover {
            transform: scale(1.05);
            background-color: #4A2FB8;
            box-shadow: 0 0 20px rgba(93, 63, 211, 0.6), 0 0 30px rgba(93, 63, 211, 0.4);
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
        }
        .hero-background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Semi-transparent black overlay */
            z-index: 1; /* Below header, above particles */
            pointer-events: none; /* Allow clicks to pass through */
        }
        .navbar-menu-mobile {
            position: fixed;
            top: 0;
            right: 0;
            width: 80%; /* Adjust as needed */
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.95); /* Darker background for mobile menu */
            z-index: 45; /* Below header, above main content */
            transform: translateX(100%); /* Start off-screen */
            opacity: 0; /* Make it transparent when off-screen */
            visibility: hidden; /* Hide it from screen readers and interaction */
            transition: transform 0.3s ease-out, opacity 0.3s ease-out, visibility 0.3s ease-out; /* Smooth transition */
            padding-top: 100px; /* Space for fixed header */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .navbar-menu-mobile.active {
            transform: translateX(0%); /* Slide in */
            opacity: 1; /* Make it visible */
            visibility: visible; /* Make it interactable */
        }
        /* Tambahkan style lain dari landingpage utama jika perlu */
    </style>
    @stack('styles')
</head>
<body class="bg-black text-white min-h-screen pt-[100px]">
    <div id="particles-js" class="absolute inset-0 z-0 pointer-events-none"></div>
    <div class="hero-background-overlay"></div>
    <header class="fixed w-full z-[999] bg-black bg-opacity-80 backdrop-blur-lg top-0">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('halaman-utama') }}" class="text-3xl font-bold logo-gradient">ZenMazip</a>
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('konversi.landing') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Konversi File</a>
                    <a href="{{ route('kompresi.landing') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Kompresi File</a>
                    <a href="{{ route('tentang-kami') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Tentang Kami</a>
                    <a href="{{ route('kontak') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Kontak</a>
                </div>
                <!-- Hamburger Menu Button for Mobile -->
                <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>
    <!-- Mobile Navigation -->
    <div id="navbar-links-mobile" class="navbar-menu-mobile z-40">
        <a href="{{ route('halaman-utama') }}" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Home</a>
        <a href="{{ route('kompresi.landing') }}" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Kompresi</a>
        <a href="{{ route('konversi.landing') }}" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Konversi</a>
        <a href="{{ route('tentang-kami') }}" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Tentang Kami</a>
        <a href="{{ route('kontak') }}" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Kontak</a>
    </div>
    <main class="container mx-auto flex-grow relative z-10">
        @yield('content')
    </main>
    <footer class="bg-gray-900 py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-8 md:mb-0">
                    <h2 class="text-2xl font-bold logo-gradient">ZenMazip</h2>
                    <p class="text-gray-400 mt-2">Solusi Konversi & Kompresi File Terbaik</p>
                </div>
                <div class="flex space-x-6">
                    <a href="{{ route('tentang-kami') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Tentang Kami</a>
                    <a href="{{ route('kontak') }}" class="text-gray-400 hover:text-white transition-colors duration-300">Kontak</a>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} ZenMazip. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>
    <div class="decorative-element"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#00FFC0' },
                shape: { type: 'circle' },
                opacity: { value: 0.5, random: false },
                size: { value: 3, random: true },
                line_linked: { enable: true, distance: 150, color: '#00FFC0', opacity: 0.4, width: 1 },
                move: { enable: true, speed: 2, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'grab' },
                    onclick: { enable: true, mode: 'push' },
                    resize: true
                }
            },
            retina_detect: true
        });
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const navbarLinksMobile = document.getElementById('navbar-links-mobile');
            if (mobileMenuButton && navbarLinksMobile) {
                function toggleMobileMenu() {
                    navbarLinksMobile.classList.toggle('active');
                }
                mobileMenuButton.addEventListener('click', toggleMobileMenu);
                navbarLinksMobile.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        navbarLinksMobile.classList.remove('active');
                    });
                });
                function handleResize() {
                    if (window.innerWidth >= 768) {
                        navbarLinksMobile.classList.remove('active');
                    }
                }
                window.addEventListener('resize', handleResize);
                window.addEventListener('load', handleResize);
            }
        });
    </script>
    @stack('scripts')
</body>
</html> 