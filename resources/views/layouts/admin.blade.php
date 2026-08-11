<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Karen's Bakery</title>
    <!-- Google Fonts: Parisienne & Pinyon Script -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&family=Pinyon+Script&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        brand: ['"Parisienne"', '"Pinyon Script"', 'cursive'],
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
<body class="bg-[#322D29] text-[#F5EFEA] font-sans min-h-screen flex flex-col md:flex-row antialiased">

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
        <p class="text-xs font-semibold text-[#BBAE9F] tracking-widest uppercase">Sedang Memuat Admin Panel...</p>
    </div>

    <!-- Mobile Header Bar -->
    <header class="md:hidden bg-[#24201D] text-white p-4 flex items-center justify-between sticky top-0 z-40 shadow-lg border-b border-[#4E4640]">
        <a href="{{ route('home') }}">
            <span class="text-2xl font-brand font-normal text-[#E2C599] tracking-wider">Karen's Bakery Admin</span>
        </a>
        <button type="button" 
                onclick="toggleAdminMobileMenu()" 
                class="text-[#E8D5B7] hover:text-white p-2 rounded-xl border border-[#4E4640] bg-[#3D3732] focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </header>

    <!-- Desktop Sidebar -->
    <aside id="admin-sidebar" 
           class="hidden md:flex w-full md:w-64 bg-[#24201D] text-[#F5EFEA] md:min-h-screen p-6 flex-col justify-between shadow-2xl z-30 shrink-0 border-r border-[#4E4640]">
        <div>
            <!-- Brand Header -->
            <a href="{{ route('home') }}" class="hidden md:block mb-8 group">
                <div>
                    <span class="text-3xl font-brand font-normal text-[#E2C599] tracking-wider block leading-none pt-1">Karen's Bakery</span>
                    <span class="text-xs text-[#BBAE9F] font-medium">Admin Control Panel</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-[#72383D] text-white shadow-sm border border-[#8C464C]' : 'text-[#E8D5B7] hover:bg-[#3D3732] hover:text-white' }}">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.categories.*') ? 'bg-[#72383D] text-white shadow-sm border border-[#8C464C]' : 'text-[#E8D5B7] hover:bg-[#3D3732] hover:text-white' }}">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Kategori
                </a>

                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.products.*') ? 'bg-[#72383D] text-white shadow-sm border border-[#8C464C]' : 'text-[#E8D5B7] hover:bg-[#3D3732] hover:text-white' }}">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Produk
                </a>

                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.orders.*') ? 'bg-[#72383D] text-white shadow-sm border border-[#8C464C]' : 'text-[#E8D5B7] hover:bg-[#3D3732] hover:text-white' }}">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Pesanan
                </a>

                <a href="{{ route('admin.settings.edit') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 {{ request()->routeIs('admin.settings.*') ? 'bg-[#72383D] text-white shadow-sm border border-[#8C464C]' : 'text-[#E8D5B7] hover:bg-[#3D3732] hover:text-white' }}">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m0 14v1m9-10h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Pengaturan Pembayaran
                </a>
            </nav>
        </div>

        <!-- Footer actions in sidebar -->
        <div class="space-y-2 pt-6 border-t border-[#4E4640] mt-6 md:mt-0">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-[#BBAE9F] hover:text-white hover:bg-[#3D3732] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Toko
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-rose-300 hover:text-rose-100 hover:bg-rose-950/50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-4 sm:p-8 lg:p-10 max-w-7xl overflow-y-auto">
        @if(session('success'))
            <div class="mb-6 bg-emerald-950/60 text-emerald-200 border border-emerald-800/80 px-4 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-rose-950/60 text-rose-200 border border-rose-800/80 px-4 py-3.5 rounded-2xl flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Preloader & Admin Mobile Menu Script -->
    <script>
        function toggleAdminMobileMenu() {
            const sidebar = document.getElementById('admin-sidebar');
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
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

