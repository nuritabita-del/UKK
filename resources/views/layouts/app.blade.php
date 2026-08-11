<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "Karen's Bakery") - Fresh From Oven</title>
    <!-- Google Fonts: Ballet, Cinzel, Bodoni Moda, Cormorant Garamond, Italiana, Parisienne, Pinyon Script -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ballet&family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,500;1,6..96,400&family=Cinzel:wght@300;400;500&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Italiana&family=Parisienne&family=Pinyon+Script&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Cormorant Garamond"', '"Italiana"', 'Georgia', 'serif'],
                        classic: ['"Cinzel"', '"Bodoni Moda"', 'serif'],
                        brand: ['"Ballet"', '"Parisienne"', '"Pinyon Script"', 'cursive'],
                    },
                    colors: {
                        luxury: {
                            bg: '#322D29',
                            dark: '#24201D',
                            card: '#3D3732',
                            hover: '#49423C',
                            border: '#4E4640',
                            accent: '#72383D',
                            'accent-hover': '#8C464C',
                            'accent-dark': '#562A2E',
                            gold: '#E2C599',
                            'gold-light': '#F2E3CD',
                            cream: '#F5EFEA',
                            taupe: '#BBAE9F'
                        },
                        cocoa: {
                            50: '#24201D',
                            100: '#F5EFEA',
                            200: '#E8D5B7',
                            300: '#BBAE9F',
                            400: '#D3A2A7',
                            500: '#8C464C',
                            600: '#72383D',
                            700: '#562A2E',
                            800: '#401F22',
                            900: '#322D29',
                            950: '#24201D'
                        },
                        brown: {
                            50: '#3D3732',
                            100: '#49423C',
                            600: '#72383D',
                            700: '#562A2E',
                            800: '#401F22'
                        }
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-[#322D29] text-[#F5EFEA] font-sans min-h-screen flex flex-col antialiased">

    <!-- Animated Page Preloader -->
    <div id="page-preloader" class="fixed inset-0 z-[100] bg-[#24201D] flex flex-col items-center justify-center text-white transition-opacity duration-500 ease-out">
        <div class="relative flex items-center justify-center mb-6">
            <!-- Outer Rotating Glowing Ring -->
            <div class="w-20 h-20 rounded-full border-4 border-[#4E4640] border-t-[#72383D] animate-spin"></div>
            <!-- Inner Icon -->
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-9 h-9 animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-4-4 4 4 0 0 1-4-4 4 4 0 0 1-2-2z" fill="#72383D" stroke="#E2C599" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="8.5" cy="8.5" r="1.2" fill="#E2C599" stroke="#E2C599"/>
                    <circle cx="7.5" cy="14.5" r="1.3" fill="#E2C599" stroke="#E2C599"/>
                    <circle cx="13.5" cy="13.5" r="1.4" fill="#E2C599" stroke="#E2C599"/>
                    <circle cx="15.5" cy="9.5" r="1.1" fill="#E2C599" stroke="#E2C599"/>
                    <circle cx="11.5" cy="17.5" r="1.2" fill="#E2C599" stroke="#E2C599"/>
                </svg>
            </div>
        </div>
        <!-- Brand Title -->
        <h2 class="font-brand text-4xl text-[#E2C599] font-normal tracking-wider mb-2 animate-pulse">Karen's Bakery</h2>
        <p class="text-xs font-semibold text-[#BBAE9F] tracking-widest uppercase">Sedang Menyiapkan Kelezatan...</p>
    </div>

    <!-- Header Navigation (Fixed at top - Luxury Dark Charcoal Surface) -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-[#24201D]/95 backdrop-blur-md text-[#F5EFEA] shadow-2xl border-b border-[#4E4640]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="group">
                <div>
                    <span class="text-2.5xl sm:text-4xl font-brand font-normal text-[#E2C599] tracking-wider block leading-none pt-1">Karen's Bakery</span>
                    <span class="text-[9px] sm:text-[10px] text-[#BBAE9F] font-medium block">Fresh From Oven</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-2 sm:gap-4 text-sm font-semibold">
                <a href="{{ route('home') }}" 
                   class="px-3 py-1.5 rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-[#72383D] text-white font-bold border border-[#8C464C]' : 'text-[#E8D5B7] hover:text-white hover:bg-[#3D3732]' }}">
                    Beranda
                </a>
                <a href="{{ route('products.index') }}" 
                   class="px-3 py-1.5 rounded-lg transition-colors {{ request()->routeIs('products.*') ? 'bg-[#72383D] text-white font-bold border border-[#8C464C]' : 'text-[#E8D5B7] hover:text-white hover:bg-[#3D3732]' }}">
                    Produk
                </a>
                <a href="{{ route('about') }}" 
                   class="px-3 py-1.5 rounded-lg transition-colors {{ request()->routeIs('about') ? 'bg-[#72383D] text-white font-bold border border-[#8C464C]' : 'text-[#E8D5B7] hover:text-white hover:bg-[#3D3732]' }}">
                    Tentang Kami
                </a>

                @auth
                    <a href="{{ route('cart.index') }}" class="px-3 py-1.5 rounded-lg text-[#E8D5B7] hover:text-white hover:bg-[#3D3732] transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Keranjang
                    </a>
                    <a href="{{ route('orders.index') }}" class="px-3 py-1.5 rounded-lg text-[#E8D5B7] hover:text-white hover:bg-[#3D3732] transition-colors">
                        Pesanan Saya
                    </a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="bg-[#72383D] hover:bg-[#8C464C] text-white font-bold px-3 py-1.5 rounded-lg text-xs transition border border-[#8C464C]">
                            Admin
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-rose-300 hover:text-rose-100 hover:bg-rose-950/50 transition">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-3.5 py-1.5 rounded-lg text-[#E8D5B7] hover:text-white hover:bg-[#3D3732] transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-[#72383D] hover:bg-[#8C464C] text-white px-4 py-1.5 rounded-lg font-bold shadow-sm transition border border-[#8C464C]">
                        Daftar
                    </a>
                @endauth
            </nav>

            <!-- Mobile Hamburger Button -->
            <button type="button" 
                    onclick="toggleMobileMenu()" 
                    aria-label="Menu Navigasi" 
                    class="md:hidden text-[#E8D5B7] hover:text-white p-2 rounded-xl border border-[#4E4640] bg-[#3D3732] hover:bg-[#49423C] focus:outline-none transition">
                <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Overlay Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-[#4E4640] bg-[#24201D]/98 backdrop-blur-lg px-4 pt-3 pb-6 space-y-2">
            <a href="{{ route('home') }}" 
               class="block px-4 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('home') ? 'bg-[#72383D] text-white font-bold border border-[#8C464C]' : 'text-[#E8D5B7] hover:bg-[#3D3732]' }}">
                Beranda
            </a>
            <a href="{{ route('products.index') }}" 
               class="block px-4 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('products.*') ? 'bg-[#72383D] text-white font-bold border border-[#8C464C]' : 'text-[#E8D5B7] hover:bg-[#3D3732]' }}">
                Produk
            </a>
            <a href="{{ route('about') }}" 
               class="block px-4 py-2.5 rounded-xl text-sm font-semibold transition {{ request()->routeIs('about') ? 'bg-[#72383D] text-white font-bold border border-[#8C464C]' : 'text-[#E8D5B7] hover:bg-[#3D3732]' }}">
                Tentang Kami
            </a>

            @auth
                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-[#E8D5B7] hover:bg-[#3D3732] transition">
                    <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Keranjang
                </a>
                <a href="{{ route('orders.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-[#E8D5B7] hover:bg-[#3D3732] transition">
                    Pesanan Saya
                </a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-xl text-xs font-bold bg-[#72383D] text-white transition border border-[#8C464C]">
                        Panel Admin
                    </a>
                @endif
                <div class="pt-2 border-t border-[#4E4640]">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2.5 rounded-xl text-xs font-bold text-rose-300 hover:bg-rose-950/50 transition">
                            Keluar
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-2 border-t border-[#4E4640] grid grid-cols-2 gap-2">
                    <a href="{{ route('login') }}" class="text-center px-4 py-2.5 rounded-xl text-xs font-bold text-[#E8D5B7] bg-[#3D3732] border border-[#4E4640]">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="text-center px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-[#72383D]">
                        Daftar
                    </a>
                </div>
            @endauth
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 pt-20 pb-8 sm:pt-28 sm:pb-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            @if(session("success"))
                <div class="mb-6 bg-emerald-950/60 text-emerald-200 border border-emerald-800/80 px-4 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-medium">{{ session("success") }}</span>
                </div>
            @endif
            @if(session("error"))
                <div class="mb-6 bg-rose-950/60 text-rose-200 border border-rose-800/80 px-4 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-medium">{{ session("error") }}</span>
                </div>
            @endif

            @yield("content")
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#24201D] text-[#BBAE9F] text-center py-8 border-t border-[#4E4640] mt-auto text-xs font-medium space-y-2">
        <div class="flex items-center justify-center gap-2 text-white">
            <span class="font-sans font-bold text-[#E2C599] text-base tracking-tight">Karen's Bakery</span>
        </div>
        <p>&copy; {{ date("Y") }} <span class="font-sans font-bold text-[#E8D5B7]">Karen's Bakery</span>. From Oven To Your Heart.</p>
    </footer>

    <!-- Mobile Menu Toggle Script & Preloader Script -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');

            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        }

        window.addEventListener('load', function() {
            const preloader = document.getElementById('page-preloader');
            if (preloader) {
                preloader.classList.add('opacity-0', 'pointer-events-none');
                setTimeout(() => {
                    preloader.remove();
                }, 500);
            }
        });
    </script>
</body>
</html>