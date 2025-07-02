<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenMazip - Aplikasi Konversi & Kompresi Data</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;700&display=swap" rel="stylesheet"> <!-- Font modern untuk logo -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Oxanium', 'Arial', sans-serif;
            /* overflow-x: hidden; Removed to diagnose header stacking issue */
            background-color: black; /* Changed to solid black */
            color: white;
            /* display: flex; Make body a flex container */
            /* flex-direction: column; Stack children vertically */
            /* min-height: 100vh; Ensure body takes full viewport height */
        }

        .logo-gradient {
            font-family: 'Oxanium', sans-serif;
            background: linear-gradient(90deg, #00FFC0 0%, #00BFFF 100%); /* Hijau ke Biru */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }

        .hero-title-gradient-futuristic {
            background: linear-gradient(90deg, #00FFC0 0%, #00BFFF 100%); /* Blue to Green gradient - consistent with logo */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
            text-shadow: 0 0 15px rgba(0, 255, 192, 0.4), 0 0 30px rgba(0, 191, 255, 0.3); /* Enhanced glow effect */
            font-family: 'Oxanium', sans-serif;
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
            animation: pulse-button 2s infinite cubic-bezier(0.4, 0, 0.6, 1);
        }

        .button-style:hover {
            transform: scale(1.05);
            background-color: #4A2FB8;
            box-shadow: 0 0 20px rgba(93, 63, 211, 0.6), 0 0 30px rgba(93, 63, 211, 0.4);
            animation: none; /* Stop pulse on hover */
        }

        @keyframes pulse-button {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            }
            50% {
                transform: scale(1.02);
                box-shadow: 0 0 20px rgba(93, 63, 211, 0.4), 0 0 30px rgba(93, 63, 211, 0.2);
            }
        }

        /* Custom CSS for Floating Cards */
        .floating-card {
            background-color: rgba(0, 0, 0, 0.7); /* Darker, less transparent */
            /* backdrop-filter: blur(5px); Reduced blur - Removed for testing stacking context */
            border: 1px solid rgba(255, 255, 255, 0.05); /* Subtle border */
            border-radius: 1.5rem;
            padding: 2rem;
            text-align: center;
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1; /* Ensure floating cards don't overlap fixed header */
        }
        .floating-card:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 0 20px 30px -8px rgba(0, 0, 0, 0.6), 0 8px 15px -8px rgba(0, 0, 0, 0.5);
            border-color: rgba(0, 255, 192, 0.5);
        }
        .floating-card svg {
            width: 70px;
            height: 70px;
            margin-bottom: 1.5rem;
            color: #00FFC0;
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .floating-card:hover svg {
            transform: scale(1.1) rotate(5deg);
        }
        .floating-card p {
            color: #D0D0D0; /* Slightly darker for readability on black */
            max-width: 300px; /* Limit width for readability */
            margin-left: auto;
            margin-right: auto;
        }

        /* Futuristic Background Animation */
        /* @keyframes background-pan {
            from {
                background-position: 0% 0%;
            }
            to {
                background-position: -200% 0%;
            }
        }

        .futuristic-bg {
            background: linear-gradient(90deg, #000000 0%, #1a0d4b 25%, #000000 50%, #1a0d4b 75%, #000000 100%);
            background-size: 200% 100%;
            animation: background-pan 30s linear infinite;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        } */

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: black; /* Set a default background */
            z-index: -2; /* Ensure it's behind content */
            pointer-events: none; /* Prevent clicks on background */
        }

        /* Dynamic Background Overlay for Hero Section */
        .hero-background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 80% 20%, rgba(0, 255, 192, 0.2) 0%, transparent 50%),
                        radial-gradient(circle at 20% 80%, rgba(93, 63, 211, 0.2) 0%, transparent 50%);
            background-size: 200% 200%;
            animation: gradient-move 20s ease-in-out infinite alternate;
            opacity: 0.7;
            z-index: -1; /* Placed above particles */
            pointer-events: none; /* Prevent clicks on background */
        }

        @keyframes gradient-move {
            0% { background-position: 0% 0%; }
            100% { background-position: 100% 100%; }
        }

        .format-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 0.5rem auto;
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), filter 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            /* filter: grayscale(100%); */ /* Removed for clearer text */
        }

        .format-icon:hover {
            transform: translateY(-5px) scale(1.1);
            /* filter: grayscale(0%) brightness(1); */ /* Removed for clearer text */
        }

        .format-text-icon {
            font-size: 4rem;
            font-weight: bold;
            color: #00FFC0;
            display: block;
            margin: 0 auto 0.5rem auto;
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            overflow-wrap: break-word; /* Ensure long words break */
            word-break: break-word; /* Force words to break if necessary */
        }
        .format-text-icon:hover {
            transform: translateY(-5px) scale(1.1);
        }

        /* Statistik Section Styling */
        .stats-card {
            background-color: rgba(0, 0, 0, 0.7); /* Darker, less transparent */
            backdrop-filter: blur(5px); /* Reduced blur */
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1.5rem; /* Unified border-radius */
            padding: 2rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
        }

        .stats-card h3 {
            font-family: 'Oxanium', sans-serif;
            font-size: 3.5rem;
        }

        .stats-card p {
            font-size: 1.5rem;
            color: #B0B0B0;
            max-width: 350px; /* Limit width for readability */
            margin-left: auto;
            margin-right: auto;
        }

        /* Responsive Navigation Styles */
        @media (max-width: 768px) {
            .navbar-menu-mobile {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: rgba(0, 0, 0, 0.9);
                position: fixed; /* Changed from absolute to fixed */
                top: 80px; /* Adjusted to match header height (h-20) */
                left: 0;
                height: calc(100vh - 80px); /* Fill remaining viewport height */
                overflow-y: auto; /* Enable scrolling for long menu content */
                padding: 1rem 0;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.3s ease-in-out;
                z-index: 50; /* Ensure mobile menu is above other content */
            }
            .navbar-menu-mobile.active {
                display: flex !important;
            }
            .navbar-link-desktop {
                display: none; /* Hide desktop links on mobile */
            }
        }
        @media (min-width: 769px) {
            .navbar-link-desktop {
                display: flex; /* Show desktop links on desktop */
            }
            .navbar-menu-mobile {
                display: none; /* Hide mobile menu on desktop */
            }
        }

        /* Star Animation */
        @keyframes falling-star {
            0% {
                transform: translateY(-100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) translateX(50vw);
                opacity: 0;
            }
        }

        .star {
            position: absolute;
            background-color: white;
            border-radius: 50%;
            opacity: 0;
            animation: falling-star linear infinite;
            pointer-events: none; /* Ensure stars don't block interaction */
            mix-blend-mode: screen; /* For glowing effect */
        }

        /* Decorative Element (Bottom Right) */
        .decorative-element {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(0, 255, 192, 0.3) 0%, rgba(93, 63, 211, 0.3) 50%, transparent 70%);
            border-radius: 50%;
            animation: pulse-glow 5s infinite alternate ease-in-out;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes pulse-glow {
            0% {
                transform: scale(0.8);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }
        }

        /* New Modern Styles */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 80px; /* Account for fixed header */
            padding-bottom: 80px; /* Ensure space at bottom */
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem; /* Unified border-radius */
            padding: 2rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Added initial shadow */
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border-color: rgba(0, 255, 192, 0.5); /* Highlight border on hover */
        }

        .gradient-text {
            background: linear-gradient(90deg, #00FFC0, #00BFFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-family: 'Oxanium', sans-serif; /* Apply Oxanium here */
        }

        .animated-border {
            position: relative;
        }

        .animated-border::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #00FFC0, #00BFFF);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .animated-border:hover::after {
            transform: scaleX(1);
        }

        .stats-number {
            font-size: 3.5rem;
            font-weight: bold;
            background: linear-gradient(90deg, #00FFC0, #00BFFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* New style for How It Works cards */
        .feature-card.how-it-works:hover {
            border-color: rgba(93, 63, 211, 0.5);
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4); /* Add shadow to match other cards */
        }

    </style>
</head>
<body class="bg-black text-white">
    <!-- <div class="futuristic-bg"></div> -->
    <div id="particles-js"></div> <!-- Particle.js container -->
    <div class="hero-background-overlay"></div> <!-- Dynamic Background Overlay for Hero Section -->

    <header class="fixed w-full z-50 bg-black bg-opacity-80 backdrop-blur-lg top-0">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('halaman-utama') }}" class="text-3xl font-bold logo-gradient">ZenMazip</a>
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('halaman-utama') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Home</a>
                    <a href="{{ route('halaman-utama') }}#features" class="text-gray-300 hover:text-white transition-colors duration-300">Fitur</a>
                    <a href="{{ route('halaman-utama') }}#about" class="text-gray-300 hover:text-white transition-colors duration-300">Tentang Kami</a>
                    <a href="{{ route('halaman-utama') }}#contact" class="text-gray-300 hover:text-white transition-colors duration-300">Kontak</a>
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

    <!-- Mobile Navigation (hidden by default) -->
    <div id="navbar-links-mobile" class="navbar-menu-mobile z-40">
        <a href="{{ route('halaman-utama') }}" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Home</a>
        <a href="{{ route('halaman-utama') }}#features" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Fitur</a>
        <a href="{{ route('halaman-utama') }}#about" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Tentang Kami</a>
        <a href="{{ route('halaman-utama') }}#contact" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Kontak</a>
    </div>

    <main class="container mx-auto flex-grow relative z-[5]">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container mx-auto px-6 py-20">
                <div class="flex flex-col items-center text-center" data-aos="fade-up">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 hero-title-gradient-futuristic">
                        ZenMazip: Solusi File Anda yang Cerdas
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-3xl">
                        Konversi dan kompresi berbagai jenis file dengan mudah, cepat, dan aman. 
                        Hemat ruang, tingkatkan kualitas, semuanya dalam satu platform intuitif.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-8">
                        <a href="#features" class="button-style smooth-scroll">
                            <i class="fas fa-lightbulb mr-2"></i>Pelajari Fitur
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-16 gradient-text" data-aos="fade-up">
                    Fitur Unggulan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <!-- Konversi Section -->
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-4xl mb-4">🔄</div>
                        <h3 class="text-2xl font-bold mb-4 font-oxanium">Konversi File</h3>
                        <p class="text-gray-300 mb-4">Konversi berbagai jenis file dengan mudah dan cepat:</p>
                        <ul class="text-gray-300 space-y-2">
                            <li>• Gambar (JPG, PNG, WEBP, dll)</li>
                            <li>• Dokumen (PDF, DOC, DOCX)</li>
                            <li>• Video (MP4, AVI, MOV)</li>
                            <li>• Audio (MP3, WAV, FLAC)</li>
                        </ul>
                        <a href="{{ route('konversi-file') }}" class="mt-4 inline-block text-primary hover:text-primary-dark transition-colors duration-300">
                            Mulai Konversi →
                        </a>
                    </div>
                    <!-- Kompresi Section -->
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-4xl mb-4">📦</div>
                        <h3 class="text-2xl font-bold mb-4 font-oxanium">Kompresi File</h3>
                        <p class="text-gray-300 mb-4">Kompresi file tanpa mengurangi kualitas:</p>
                        <ul class="text-gray-300 space-y-2">
                            <li>• Kompresi Gambar</li>
                            <li>• Kompresi Video</li>
                            <li>• Kompresi PDF</li>
                            <li>• Kompresi Audio</li>
                        </ul>
                        <a href="{{ route('kompresi-file') }}" class="mt-4 inline-block text-primary hover:text-primary-dark transition-colors duration-300">
                            Mulai Kompresi →
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center mb-16 gradient-text" data-aos="fade-up">
                    Bagaimana ZenMazip Bekerja?
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="feature-card how-it-works" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-4xl mb-4 text-primary">1. Unggah File</div>
                        <h3 class="text-2xl font-bold mb-4 font-oxanium">Pilih File Anda</h3>
                        <p class="text-gray-300">Pilih file dari perangkat Anda untuk diunggah ke ZenMazip.</p>
                    </div>
                    <div class="feature-card how-it-works" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-4xl mb-4 text-success">2. Pilih Aksi</div>
                        <h3 class="text-2xl font-bold mb-4 font-oxanium">Konversi atau Kompresi</h3>
                        <p class="text-gray-300">Pilih apakah Anda ingin mengkonversi atau mengkompresi file Anda, dan atur preferensi.</p>
                    </div>
                    <div class="feature-card how-it-works" data-aos="fade-up" data-aos-delay="300">
                        <div class="text-4xl mb-4 text-warning">3. Dapatkan Hasil</div>
                        <h3 class="text-2xl font-bold mb-4 font-oxanium">Unduh File Hasil</h3>
                        <p class="text-gray-300">Download file yang sudah dikonversi atau dikompresi dengan kualitas optimal.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us and Contact Section (Side by Side) -->
        <section class="py-20 bg-gradient-to-b from-black to-gray-900">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- About Us Section -->
                    <div id="about" class="feature-card" data-aos="fade-up">
                        <h2 class="text-3xl font-bold mb-8 gradient-text">Tentang Kami</h2>
                        <p class="text-xl text-gray-300 mb-8">
                            ZenMazip adalah platform konversi dan kompresi file yang dirancang untuk memberikan solusi cepat, aman, dan mudah digunakan. 
                            Kami berkomitmen untuk membantu pengguna mengelola file mereka dengan lebih efisien.
                        </p>
                        <div class="grid grid-cols-1 gap-6 mt-8">
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl">🎯</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2">Visi</h3>
                                    <p class="text-gray-300">Menjadi platform terdepan dalam solusi manajemen file digital.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl">💫</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2">Misi</h3>
                                    <p class="text-gray-300">Memberikan layanan terbaik dengan teknologi terkini.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl">🤝</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2">Nilai</h3>
                                    <p class="text-gray-300">Inovasi, Keamanan, dan Kepuasan Pengguna.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div id="contact" class="feature-card" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="text-3xl font-bold mb-8 gradient-text">Hubungi Kami</h2>
                        <form class="space-y-6">
                            <div>
                                <label class="block text-gray-300 mb-2">Nama</label>
                                <input type="text" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-gray-300 mb-2">Email</label>
                                <input type="email" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-gray-300 mb-2">Pesan</label>
                                <textarea rows="4" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-primary"></textarea>
                            </div>
                            <button type="submit" class="button-style w-full">
                                Kirim Pesan
                            </button>
                        </form>
                        <div class="mt-8 space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl">📍</div>
                                <div>
                                    <h4 class="font-bold mb-1">Alamat</h4>
                                    <p class="text-gray-300">Jl. Contoh No. 123, Jakarta, Indonesia</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl">📧</div>
                                <div>
                                    <h4 class="font-bold mb-1">Email</h4>
                                    <p class="text-gray-300">info@zenmazip.com</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl">📱</div>
                                <div>
                                    <h4 class="font-bold mb-1">Telepon</h4>
                                    <p class="text-gray-300">+62 123 4567 890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 py-12 mt-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-row md:flex-row justify-between items-start md:items-center">
                <div class="mb-8 md:mb-0">
                    <h2 class="text-2xl font-bold logo-gradient">ZenMazip</h2>
                    <p class="text-gray-400 mt-2">Solusi Konversi & Kompresi File Terbaik</p>
                </div>
                <div class="flex flex-col space-y-4 md:space-y-0 md:space-x-8 items-end md:items-center">
                    <a href="{{ route('halaman-utama') }}#about" class="text-gray-400 hover:text-white transition-colors duration-300">Tentang Kami</a>
                    <a href="{{ route('halaman-utama') }}#contact" class="text-gray-400 hover:text-white transition-colors duration-300">Kontak</a>
                    <a href="{{ route('halaman-utama') }}#features" class="text-gray-400 hover:text-white transition-colors duration-300">Fitur</a>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-left md:text-center text-gray-400">
                <p>&copy; {{ date('Y') }} ZenMazip. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Decorative Element (Bottom Right) -->
    <div class="decorative-element"></div>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // Smooth Scroll for anchor links
        document.querySelectorAll('a.smooth-scroll').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#00FFC0'
                },
                shape: {
                    type: 'circle'
                },
                opacity: {
                    value: 0.5,
                    random: false
                },
                size: {
                    value: 3,
                    random: true
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00FFC0',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'grab'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                }
            },
            retina_detect: true
        });

        document.addEventListener('DOMContentLoaded', function() {
            console.log('Script loaded and DOM fully parsed.');

            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const navbarLinksMobile = document.getElementById('navbar-links-mobile');

            // Added for deeper debugging
            console.log('DEBUG: mobileMenuButton element:', mobileMenuButton);
            console.log('DEBUG: navbarLinksMobile element:', navbarLinksMobile);

            if (mobileMenuButton && navbarLinksMobile) {
                console.log('Elements found: mobileMenuButton and navbarLinksMobile');

                function toggleMobileMenu() {
                    console.log('Mobile menu button clicked!');
                    navbarLinksMobile.classList.toggle('active');
                }

                try {
                    mobileMenuButton.addEventListener('click', toggleMobileMenu);
                    console.log('Event listener added to mobileMenuButton');
                } catch (e) {
                    console.error('Error adding event listener:', e);
                }

                // Close mobile menu when a link is clicked
                navbarLinksMobile.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        navbarLinksMobile.classList.remove('active');
                    });
                });

                // Handle window resize to ensure correct navbar is shown/hidden
                function handleResize() {
                    if (window.innerWidth >= 768) {
                        // On desktop, ensure mobile menu is hidden
                        navbarLinksMobile.classList.remove('active');
                    }
                }

                window.addEventListener('resize', handleResize);

                // Initial check on load for correct navbar visibility
                window.addEventListener('load', handleResize);
            } else {
                console.error('Mobile menu elements not found!', { mobileMenuButton, navbarLinksMobile });
            }
        });
    </script>
</body>
</html> 