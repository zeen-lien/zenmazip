<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenMazip - Kompresi File</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        body {
            font-family: 'Oxanium', 'Arial', sans-serif;
            background-color: black;
            color: white;
        }
        .logo-gradient {
            font-family: 'Oxanium', sans-serif;
            background: linear-gradient(90deg, #00FFC0 0%, #00BFFF 100%);
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
        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 2rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border-color: rgba(0, 255, 192, 0.5);
        }
        .gradient-text {
            background: linear-gradient(90deg, #00FFC0, #00BFFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-family: 'Oxanium', sans-serif;
        }
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: black;
            z-index: -2;
            pointer-events: none;
        }
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
            z-index: -1;
            pointer-events: none;
        }
        @keyframes gradient-move {
            0% { background-position: 0% 0%; }
            100% { background-position: 100% 100%; }
        }
    </style>
</head>
<body class="bg-black text-white">
    <div id="particles-js"></div>
    <div class="hero-background-overlay"></div>

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
                <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <div id="navbar-links-mobile" class="navbar-menu-mobile z-40 hidden">
        <a href="{{ route('halaman-utama') }}" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Home</a>
        <a href="{{ route('halaman-utama') }}#features" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Fitur</a>
        <a href="{{ route('halaman-utama') }}#about" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Tentang Kami</a>
        <a href="{{ route('halaman-utama') }}#contact" class="block px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300">Kontak</a>
    </div>

    <main class="container mx-auto flex-grow relative z-[5] pt-20">
        <section class="py-12">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-5xl font-bold gradient-text mb-8" data-aos="fade-up">Kompresi File</h1>
                <p class="text-xl text-gray-300 mb-12" data-aos="fade-up" data-aos-delay="100">
                    Kompresi berbagai jenis file Anda dengan mudah dan efisien.
                </p>
                <!-- Pesan error jika ada -->
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-600 text-white rounded font-bold">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="p-8 bg-gray-800 bg-opacity-70 rounded-lg shadow-xl" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-3xl font-bold mb-6">Unggah File Anda</h3>
                    <form action="{{ route('kompresi-zip') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="files[]" id="file-input" multiple required class="block w-full text-sm text-gray-400
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700
                            hover:file:bg-violet-100 mb-6"/>
                        <button type="submit" class="button-style">Mulai Kompresi</button>
                    </form>
                </div>

                <div class="mt-12 text-left">
                    <h2 class="text-4xl font-bold gradient-text mb-8" data-aos="fade-up">Fitur Kompresi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                            <h3 class="text-2xl font-bold mb-4">Kompresi Gambar</h3>
                            <p class="text-gray-300">Mengurangi ukuran file gambar (JPG, PNG, dll) tanpa kehilangan kualitas.</p>
                        </div>
                        <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="text-2xl font-bold mb-4">Kompresi Video</h3>
                            <p class="text-gray-300">Optimalkan ukuran video (MP4, MOV, dll) untuk upload dan streaming lebih cepat.</p>
                        </div>
                        <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="text-2xl font-bold mb-4">Kompresi PDF</h3>
                            <p class="text-gray-300">Perkecil ukuran dokumen PDF untuk email dan penyimpanan yang lebih mudah.</p>
                        </div>
                        <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                            <h3 class="text-2xl font-bold mb-4">Kompresi Audio</h3>
                            <p class="text-gray-300">Kompresi file audio (MP3, WAV, dll) untuk menghemat ruang disk.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-8 md:mb-0">
                    <h2 class="text-2xl font-bold logo-gradient">ZenMazip</h2>
                    <p class="text-gray-400 mt-2">Solusi Konversi & Kompresi File Terbaik</p>
                </div>
                <div class="flex space-x-6">
                    <a href="{{ route('halaman-utama') }}#about" class="text-gray-400 hover:text-white transition-colors duration-300">Tentang Kami</a>
                    <a href="{{ route('halaman-utama') }}#contact" class="text-gray-400 hover:text-white transition-colors duration-300">Kontak</a>
                    <a href="{{ route('halaman-utama') }}#features" class="text-gray-400 hover:text-white transition-colors duration-300">Fitur</a>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} ZenMazip. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

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
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const navbarLinksMobile = document.getElementById('navbar-links-mobile');

            if (mobileMenuButton && navbarLinksMobile) {
                function toggleMobileMenu() {
                    navbarLinksMobile.classList.toggle('hidden'); // Toggle hidden class
                }
                mobileMenuButton.addEventListener('click', toggleMobileMenu);

                navbarLinksMobile.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        navbarLinksMobile.classList.add('hidden'); // Hide after click
                    });
                });

                function handleResize() {
                    if (window.innerWidth >= 768) {
                        navbarLinksMobile.classList.add('hidden'); // Hide mobile menu on desktop
                    }
                }
                window.addEventListener('resize', handleResize);
                window.addEventListener('load', handleResize);
            } else {
                console.error('Mobile menu elements not found!', { mobileMenuButton, navbarLinksMobile });
            }
        });
    </script>
</body>
</html> 