<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenMazip - Konversi File</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            /* animation: pulse-button 2s infinite cubic-bezier(0.4, 0, 0.6, 1); */ /* Removed pulse animation here if not needed for conversion page button */
        }

        .button-style:hover {
            transform: scale(1.05);
            background-color: #4A2FB8;
            box-shadow: 0 0 20px rgba(93, 63, 211, 0.6), 0 0 30px rgba(93, 63, 211, 0.4);
            /* animation: none; */ /* Stop pulse on hover - uncomment if pulse is enabled */
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

        /* New Styles for Loading Spinner and Notifications */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .spinner {
            border: 8px solid rgba(255, 255, 255, 0.3);
            border-top: 8px solid #00FFC0;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #333;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 1001;
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .notification.active {
            opacity: 1;
            transform: translateY(0);
        }
        .notification.success {
            background-color: #00FFC0;
            color: #1a202c;
        }
        .notification.error {
            background-color: #ef4444;
        }

    </style>
</head>
<body class="bg-black text-white">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="spinner"></div>
    </div>

    <!-- Notification Container -->
    <div id="notification-container" class="notification"></div>

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

    <main class="container mx-auto flex-grow relative z-[5] pt-20">
        <section class="py-12">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-5xl font-bold gradient-text mb-8" data-aos="fade-up">Konversi File</h1>
                <p class="text-xl text-gray-300 mb-12" data-aos="fade-up" data-aos-delay="100">
                    Pilih jenis file yang ingin kamu konversi.
                </p>

                <!-- Konversi dari Link/URL (di atas pilihan tipe file) -->
                <div id="convert-url-section" class="mb-10">
                    <form action="{{ route('konversi-url') }}" method="POST" class="flex flex-col md:flex-row items-center gap-4 justify-center bg-gray-800 p-6 rounded-xl shadow-lg">
                        @csrf
                        <select name="platform" id="platform-select" class="bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary">
                            <option value="">Pilih Platform...</option>
                            <option value="youtube">YouTube</option>
                            <option value="instagram">Instagram</option>
                            <option value="tiktok">TikTok</option>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                        </select>
                        <input type="url" name="media_url" placeholder="Tempel link di sini..." class="bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary w-64" required>
                        <select name="output_format" class="bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary">
                            <option value="">Pilih Format...</option>
                            <optgroup label="Video">
                                <option value="mp4">MP4</option>
                                <option value="avi">AVI</option>
                                <option value="mov">MOV</option>
                            </optgroup>
                            <optgroup label="Audio">
                                <option value="mp3">MP3</option>
                                <option value="wav">WAV</option>
                                <option value="flac">FLAC</option>
                            </optgroup>
                        </select>
                        <button type="submit" class="button-style">Konversi dari Link</button>
                    </form>
                    @if(session('url_result'))
                        <div class="mt-4 text-green-400 font-bold">{{ session('url_result') }}</div>
                    @endif
                    @if(session('url_error'))
                        <div class="mt-4 text-red-400 font-bold">{{ session('url_error') }}</div>
                    @endif
                </div>

                <!-- Pilihan Tipe File -->
                <div id="file-type-selection" class="grid grid-cols-1 md:grid-cols-4 gap-6 justify-center mb-12">
                    <div class="cursor-pointer p-6 bg-transparent border border-blue-400/40 rounded-xl shadow-sm hover:border-blue-400 hover:shadow-lg transition flex flex-col items-center group" style="min-width:180px;" onclick="showConvertSection('image')">
                        <svg class="w-12 h-12 mb-3 text-blue-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16l4-4a3 3 0 014 0l4 4M2 20h20M7 10a4 4 0 118 0 4 4 0 01-8 0z"/></svg>
                        <span class="text-lg font-bold mb-1">Gambar</span>
                        <span class="text-xs text-blue-200">Konversi dan kompresi berbagai format gambar (JPG, PNG, WEBP, GIF, dll) dengan fitur kualitas & resize.</span>
                    </div>
                    <div class="cursor-pointer p-6 bg-transparent border border-red-400/40 rounded-xl shadow-sm hover:border-red-400 hover:shadow-lg transition flex flex-col items-center group" style="min-width:180px;" onclick="showConvertSection('video')">
                        <svg class="w-12 h-12 mb-3 text-red-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z"/></svg>
                        <span class="text-lg font-bold mb-1">Video</span>
                        <span class="text-xs text-red-200">Ubah format, resolusi, dan kompresi video (MP4, AVI, MOV, dll) dengan mudah dan cepat.</span>
                    </div>
                    <div class="cursor-pointer p-6 bg-transparent border border-green-400/40 rounded-xl shadow-sm hover:border-green-400 hover:shadow-lg transition flex flex-col items-center group" style="min-width:180px;" onclick="showConvertSection('document')">
                        <svg class="w-12 h-12 mb-3 text-green-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7V3a1 1 0 011-1h8a1 1 0 011 1v18a1 1 0 01-1 1H8a1 1 0 01-1-1v-4"/><path d="M7 7h8M7 7v10a1 1 0 001 1h8a1 1 0 001-1V7"/></svg>
                        <span class="text-lg font-bold mb-1">Dokumen</span>
                        <span class="text-xs text-green-200">Konversi dokumen (PDF, DOCX, XLSX, PPTX, TXT, dll) ke berbagai format lain, termasuk kompresi PDF.</span>
                    </div>
                    <div class="cursor-pointer p-6 bg-transparent border border-yellow-400/40 rounded-xl shadow-sm hover:border-yellow-400 hover:shadow-lg transition flex flex-col items-center group" style="min-width:180px;" onclick="showConvertSection('audio')">
                        <svg class="w-12 h-12 mb-3 text-yellow-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 19V6a2 2 0 012-2h2a2 2 0 012 2v13"/><path d="M5 19a4 4 0 004 4h6a4 4 0 004-4"/></svg>
                        <span class="text-lg font-bold mb-1">Audio</span>
                        <span class="text-xs text-yellow-200">Konversi file audio (MP3, WAV, FLAC, dll) ke format lain, atur bitrate, dan ekstrak audio dari video.</span>
                    </div>
                </div>

                <!-- Section Konversi Gambar (default: hidden) -->
                <div id="convert-image-section" class="hidden">
                    <button onclick="backToTypeSelection()" class="mb-6 px-4 py-2 rounded bg-gray-700 text-white hover:bg-gray-600 transition">&larr; Kembali</button>
                    <!-- Upload File Section (Images Only) -->
                    <div id="upload-section" class="p-8 bg-gray-800 bg-opacity-70 rounded-lg shadow-xl" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-3xl font-bold mb-6">Unggah Gambar Anda</h3>
                        <form action="{{ route('konversi-images') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="image-convert-form">
                            @csrf
                            <div class="space-y-4">
                                <div id="drop-area" class="border-2 border-dashed border-gray-500 rounded-lg p-6 text-center cursor-pointer bg-gray-900 hover:bg-gray-700 transition">
                                    <input type="file" name="file[]" id="file-input" accept="image/*" multiple class="hidden" />
                                    <p class="text-gray-400">Drag & drop gambar di sini atau klik untuk memilih file (bisa lebih dari satu)</p>
                                    <div id="preview-thumbnails" class="flex flex-wrap gap-4 mt-4 justify-center"></div>
                                    <div id="image-info" class="mt-4 text-sm text-gray-300"></div>
                                </div>
                                <div class="flex flex-col space-y-4">
                                    <label class="text-gray-300">Pilih Format Output:</label>
                                    <select name="output_format" class="bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary">
                                        <option value="jpg">JPG</option>
                                        <option value="png">PNG</option>
                                        <option value="webp">WEBP</option>
                                        <option value="gif">GIF</option>
                                    </select>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <label class="text-gray-300">Kualitas Output: <span id="quality-value">80</span></label>
                                    <input type="range" name="quality" min="1" max="100" value="80" class="w-full" id="quality-slider">
                                </div>
                                <div class="flex flex-col md:flex-row gap-4">
                                    <div class="flex-1">
                                        <label class="text-gray-300">Resize Width (px):</label>
                                        <input type="number" name="resize_width" min="1" max="10000" class="bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white w-full" placeholder="Auto">
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-gray-300">Resize Height (px):</label>
                                        <input type="number" name="resize_height" min="1" max="10000" class="bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white w-full" placeholder="Auto">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="button-style w-full">Mulai Konversi</button>
                            <div id="progress-bar" class="w-full h-2 bg-gray-700 rounded mt-4 hidden">
                                <div class="h-2 bg-primary rounded" style="width: 0%" id="progress-bar-inner"></div>
                            </div>
                        </form>
                        @if(session('download_links'))
                            <div class="mt-6">
                                <h4 class="text-lg font-bold mb-2 text-green-400">Download Hasil Konversi:</h4>
                                <ul class="list-disc list-inside">
                                    @foreach(session('download_links') as $link)
                                        <li><a href="{{ $link }}" class="text-blue-400 underline" target="_blank">Download</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="mt-6 text-red-400 font-bold">{{ session('error') }}</div>
                        @endif
                    </div>
                </div>
                <!-- Section Konversi Video (placeholder) -->
                <div id="convert-video-section" class="hidden">
                    <button onclick="backToTypeSelection()" class="mb-6 px-4 py-2 rounded bg-gray-700 text-white hover:bg-gray-600 transition">&larr; Kembali</button>
                    <div class="p-8 bg-gray-800 bg-opacity-70 rounded-lg shadow-xl">
                        <h3 class="text-3xl font-bold mb-6">Konversi Video (Coming Soon)</h3>
                        <p class="text-gray-400">Fitur konversi video akan segera tersedia.</p>
                    </div>
                </div>
                <!-- Section Konversi Dokumen (modern) -->
                <div id="convert-document-section" class="hidden">
                    <button onclick="backToTypeSelection()" class="mb-6 px-4 py-2 rounded bg-gray-700 text-white hover:bg-gray-600 transition">&larr; Kembali</button>
                    <div class="p-8 bg-gray-800 bg-opacity-70 rounded-lg shadow-xl">
                        <h3 class="text-3xl font-bold mb-6">Konversi Dokumen</h3>
                        <form action="{{ route('konversi-documents') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="document-convert-form">
                            @csrf
                            <div class="space-y-4">
                                <div id="doc-drop-area" class="border-2 border-dashed border-green-400 rounded-lg p-6 text-center cursor-pointer bg-gray-900 hover:bg-gray-700 transition">
                                    <input type="file" name="document[]" id="doc-file-input" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.rtf,.odt,.ods,.odp,.csv" multiple class="hidden" />
                                    <p class="text-gray-400">Drag & drop dokumen di sini atau klik untuk memilih file (bisa lebih dari satu)</p>
                                    <div id="doc-preview-list" class="flex flex-wrap gap-4 mt-4 justify-center"></div>
                                    <div id="doc-info" class="mt-4 text-sm text-gray-300"></div>
                                </div>
                                <div class="flex flex-col space-y-4">
                                    <label class="text-gray-300">Pilih Format Output:</label>
                                    <select name="output_format" id="doc-output-format" class="bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary">
                                        <option value="pdf">PDF</option>
                                        <option value="docx">DOCX</option>
                                        <option value="jpg">JPG (per halaman)</option>
                                        <option value="png">PNG (per halaman)</option>
                                        <option value="txt">TXT</option>
                                        <option value="zip">ZIP (multi-file/halaman)</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="button-style w-full">Mulai Konversi</button>
                            <div id="doc-progress-bar" class="w-full h-2 bg-gray-700 rounded mt-4 hidden">
                                <div class="h-2 bg-green-400 rounded" style="width: 0%" id="doc-progress-bar-inner"></div>
                            </div>
                        </form>
                        @if(session('doc_download_links'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Konversi Berhasil!',
                                        html: `<h4 class='text-lg font-bold mb-2 text-green-400'>Download Hasil Konversi:</h4>` +
                                            `<ul style='list-style: disc; text-align: left; margin-left: 2em;'>` +
                                            @foreach(session('doc_download_links') as $link)
                                                `<li><a href=\'{{ $link }}\' class='text-blue-400 underline' target='_blank'>Download</a></li>` +
                                            @endforeach
                                            `</ul>`,
                                        confirmButtonText: 'OK',
                                        customClass: { popup: 'bg-gray-900 text-white' },
                                        position: 'center',
                                    });
                                });
                            </script>
                        @endif
                        @if(session('doc_error'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan',
                                        text: @json(session('doc_error')),
                                        confirmButtonText: 'OK',
                                        customClass: { popup: 'bg-gray-900 text-white' },
                                        position: 'center',
                                    });
                                });
                            </script>
                        @endif
                    </div>
                </div>
                <!-- Section Konversi Audio (placeholder) -->
                <div id="convert-audio-section" class="hidden">
                    <button onclick="backToTypeSelection()" class="mb-6 px-4 py-2 rounded bg-gray-700 text-white hover:bg-gray-600 transition">&larr; Kembali</button>
                    <div class="p-8 bg-gray-800 bg-opacity-70 rounded-lg shadow-xl">
                        <h3 class="text-3xl font-bold mb-6">Konversi Audio (Coming Soon)</h3>
                        <p class="text-gray-400">Fitur konversi audio akan segera tersedia.</p>
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

            // Section otomatis buka dokumen jika session active_section = document
            @if(session('active_section') === 'document')
                setTimeout(function() {
                    if (typeof showDocumentSection === 'function') {
                        showDocumentSection();
                    } else {
                        // Fallback manual
                        document.getElementById('convert-url-section').classList.add('hidden');
                        document.getElementById('file-type-selection').classList.add('hidden');
                        document.getElementById('convert-image-section').classList.add('hidden');
                        document.getElementById('convert-video-section').classList.add('hidden');
                        document.getElementById('convert-document-section').classList.remove('hidden');
                        document.getElementById('convert-audio-section').classList.add('hidden');
                    }
                }, 300);
            @endif
        });

        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const uploadTab = document.getElementById('upload-tab');
            const urlTab = document.getElementById('url-tab');
            const uploadSection = document.getElementById('upload-section');
            const urlSection = document.getElementById('url-section');

            uploadTab.addEventListener('click', function() {
                uploadTab.classList.add('bg-primary', 'text-white');
                uploadTab.classList.remove('text-gray-400');
                urlTab.classList.remove('bg-primary', 'text-white');
                urlTab.classList.add('text-gray-400');
                uploadSection.classList.remove('hidden');
                urlSection.classList.add('hidden');
            });

            urlTab.addEventListener('click', function() {
                urlTab.classList.add('bg-primary', 'text-white');
                urlTab.classList.remove('text-gray-400');
                uploadTab.classList.remove('bg-primary', 'text-white');
                uploadTab.classList.add('text-gray-400');
                urlSection.classList.remove('hidden');
                uploadSection.classList.add('hidden');
            });

            // Platform-specific format options
            const platformSelect = document.getElementById('platform-select');
            const outputFormatSelect = urlSection.querySelector('select[name="output_format"]');

            platformSelect.addEventListener('change', function() {
                const platform = this.value;
                const options = outputFormatSelect.options;
                
                // Reset options
                for (let i = options.length - 1; i >= 0; i--) {
                    options[i].disabled = false;
                }

                // Disable irrelevant options based on platform
                if (platform === 'instagram' || platform === 'tiktok') {
                    for (let i = 0; i < options.length; i++) {
                        if (options[i].value === 'mp3' || options[i].value === 'wav' || options[i].value === 'flac') {
                            options[i].disabled = true;
                        }
                    }
                }
            });
        });

        // Show loading overlay on form submission
        document.querySelector('#upload-section form').addEventListener('submit', function() {
            document.getElementById('loading-overlay').classList.add('active');
            // Auto-hide after 3 seconds (fallback for download)
            setTimeout(() => {
                document.getElementById('loading-overlay').classList.remove('active');
            }, 3000);
        });

        // Hide loading overlay if window loses focus (user download dialog appears)
        window.addEventListener('blur', function() {
            document.getElementById('loading-overlay').classList.remove('active');
        });

        // Handle notifications
        document.addEventListener('DOMContentLoaded', function() {
            const notificationContainer = document.getElementById('notification-container');
            const successMessage = '{{ session('success') }}';
            const errorMessage = '{{ session('error') }}';

            if (successMessage) {
                notificationContainer.classList.add('active', 'success');
                notificationContainer.textContent = successMessage;
                setTimeout(() => {
                    notificationContainer.classList.remove('active');
                }, 5000);
            } else if (errorMessage) {
                notificationContainer.classList.add('active', 'error');
                notificationContainer.textContent = errorMessage;
                setTimeout(() => {
                    notificationContainer.classList.remove('active');
                }, 7000); // Keep error messages a bit longer
            }
        });

        // Drag & drop + preview
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file-input');
        const previewThumbnails = document.getElementById('preview-thumbnails');
        const qualitySlider = document.getElementById('quality-slider');
        const qualityValue = document.getElementById('quality-value');

        if (dropArea && fileInput && previewThumbnails) {
            dropArea.addEventListener('click', () => fileInput.click());
            dropArea.addEventListener('dragover', e => {
                e.preventDefault();
                dropArea.classList.add('bg-gray-700');
            });
            dropArea.addEventListener('dragleave', e => {
                e.preventDefault();
                dropArea.classList.remove('bg-gray-700');
            });
            dropArea.addEventListener('drop', e => {
                e.preventDefault();
                dropArea.classList.remove('bg-gray-700');
                fileInput.files = e.dataTransfer.files;
                showThumbnails(fileInput.files);
            });
            fileInput.addEventListener('change', () => showThumbnails(fileInput.files));
        }
        function showThumbnails(files) {
            previewThumbnails.innerHTML = '';
            const infoDiv = document.getElementById('image-info');
            infoDiv.innerHTML = '';
            Array.from(files).forEach((file, idx) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-24 h-24 object-cover rounded shadow';
                        previewThumbnails.appendChild(img);
                        if (idx === 0) {
                            // Info file pertama
                            const image = new window.Image();
                            image.onload = function() {
                                infoDiv.innerHTML =
                                    `<b>Nama:</b> ${file.name}<br>` +
                                    `<b>Ukuran:</b> ${(file.size/1024).toFixed(2)} KB<br>` +
                                    `<b>Dimensi:</b> ${this.width} x ${this.height} px<br>` +
                                    `<b>Format:</b> ${file.type}`;
                            };
                            image.src = e.target.result;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
        // Quality slider
        if (qualitySlider && qualityValue) {
            qualitySlider.addEventListener('input', () => {
                qualityValue.textContent = qualitySlider.value;
            });
        }
        // Progress bar (dummy, bisa diintegrasi AJAX jika ingin lebih advance)
        const form = document.getElementById('image-convert-form');
        const progressBar = document.getElementById('progress-bar');
        const progressBarInner = document.getElementById('progress-bar-inner');
        if (form && progressBar && progressBarInner) {
            form.addEventListener('submit', () => {
                progressBar.classList.remove('hidden');
                progressBarInner.style.width = '100%';
            });
        }

        // Section switching logic
        function showConvertSection(type) {
            document.getElementById('convert-url-section').classList.add('hidden');
            document.getElementById('file-type-selection').classList.add('hidden');
            document.getElementById('convert-image-section').classList.add('hidden');
            document.getElementById('convert-video-section').classList.add('hidden');
            document.getElementById('convert-document-section').classList.add('hidden');
            document.getElementById('convert-audio-section').classList.add('hidden');
            if (type === 'image') {
                document.getElementById('convert-image-section').classList.remove('hidden');
            } else if (type === 'video') {
                document.getElementById('convert-video-section').classList.remove('hidden');
            } else if (type === 'document') {
                document.getElementById('convert-document-section').classList.remove('hidden');
            } else if (type === 'audio') {
                document.getElementById('convert-audio-section').classList.remove('hidden');
            }
        }
        function backToTypeSelection() {
            document.getElementById('convert-url-section').classList.remove('hidden');
            document.getElementById('file-type-selection').classList.remove('hidden');
            document.getElementById('convert-image-section').classList.add('hidden');
            document.getElementById('convert-video-section').classList.add('hidden');
            document.getElementById('convert-document-section').classList.add('hidden');
            document.getElementById('convert-audio-section').classList.add('hidden');
        }

        // Drag & drop dokumen + preview info
        const docDropArea = document.getElementById('doc-drop-area');
        const docFileInput = document.getElementById('doc-file-input');
        const docPreviewList = document.getElementById('doc-preview-list');
        const docInfo = document.getElementById('doc-info');
        const docOutputFormat = document.getElementById('doc-output-format');
        if (docDropArea && docFileInput && docPreviewList) {
            docDropArea.addEventListener('click', () => docFileInput.click());
            docDropArea.addEventListener('dragover', e => {
                e.preventDefault();
                docDropArea.classList.add('bg-gray-700');
            });
            docDropArea.addEventListener('dragleave', e => {
                e.preventDefault();
                docDropArea.classList.remove('bg-gray-700');
            });
            docDropArea.addEventListener('drop', e => {
                e.preventDefault();
                docDropArea.classList.remove('bg-gray-700');
                docFileInput.files = e.dataTransfer.files;
                showDocPreview(docFileInput.files);
            });
            docFileInput.addEventListener('change', () => showDocPreview(docFileInput.files));
        }
        function showDocPreview(files) {
            docPreviewList.innerHTML = '';
            docInfo.innerHTML = '';
            Array.from(files).forEach((file, idx) => {
                const ext = file.name.split('.').pop().toLowerCase();
                const icon = ext === 'pdf' ? '📄' : ext === 'doc' || ext === 'docx' ? '📝' : ext === 'xls' || ext === 'xlsx' ? '📊' : ext === 'ppt' || ext === 'pptx' ? '📈' : '📁';
                const div = document.createElement('div');
                div.className = 'flex flex-col items-center';
                div.innerHTML = `<span style="font-size:2rem;">${icon}</span><span class="text-xs mt-1">${file.name}</span>`;
                docPreviewList.appendChild(div);
                if (idx === 0) {
                    docInfo.innerHTML = `<b>Nama:</b> ${file.name}<br><b>Ukuran:</b> ${(file.size/1024).toFixed(2)} KB<br><b>Format:</b> ${file.type || ext}`;
                }
            });
        }
        if (docOutputFormat) {
            docOutputFormat.addEventListener('change', function() {
                if (this.value === 'jpg' || this.value === 'png') {
                    // docPageOptions.style.display = '';
                } else {
                    // docPageOptions.style.display = 'none';
                }
            });
        }
        // Progress bar dummy (bisa diintegrasi AJAX jika ingin advance)
        const docForm = document.getElementById('document-convert-form');
        const docProgressBar = document.getElementById('doc-progress-bar');
        const docProgressBarInner = document.getElementById('doc-progress-bar-inner');
        if (docForm && docProgressBar && docProgressBarInner) {
            docForm.addEventListener('submit', () => {
                docProgressBar.classList.remove('hidden');
                docProgressBarInner.style.width = '100%';
                setTimeout(() => { docProgressBar.classList.add('hidden'); }, 3000);
            });
        }

        // Reset form dan preview setelah download (saat window kembali fokus)
        window.addEventListener('focus', function() {
            // Reset form upload images
            const imageForm = document.getElementById('image-convert-form');
            if (imageForm) imageForm.reset();
            // Hapus preview thumbnail dan info
            const previewThumbnails = document.getElementById('preview-thumbnails');
            if (previewThumbnails) previewThumbnails.innerHTML = '';
            const imageInfo = document.getElementById('image-info');
            if (imageInfo) imageInfo.innerHTML = '';
        });

        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success') && session('refresh'))
            Swal.fire({
                title: 'Berhasil!',
                html: `{!! session('success') !!}`,
                icon: 'success',
                confirmButtonText: 'OK',
                background: '#1a202c',
                color: '#ffffff'
            }).then(() => { window.location.reload(); });
            @endif
            @if(session('doc_error') && session('refresh'))
            Swal.fire({
                title: 'Oops... Terjadi Kesalahan!',
                html: `{!! session('doc_error') !!}`,
                icon: 'error',
                confirmButtonText: 'Coba Lagi',
                background: '#1a202c',
                color: '#ffffff'
            }).then(() => { window.location.reload(); });
            @endif
        });
    </script>
</body>
</html> 