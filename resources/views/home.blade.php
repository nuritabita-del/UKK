@extends("layouts.app")

@section("title", "Beranda")

@section("content")
<div class="space-y-12">

    <!-- Hero Banner Section with Interactive Cursor Trace -->
    <section id="hero-banner" 
             onmousemove="handleHeroMouseMove(event)" 
             onmouseleave="handleHeroMouseLeave()"
             class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-[#24201D] via-[#322D29] to-[#3D3732] text-white p-8 sm:p-14 shadow-2xl border border-[#4E4640] group cursor-default">
        
        <!-- Interactive Cursor Trace Spotlight -->
        <div id="cursor-spotlight" 
             class="absolute w-80 h-80 rounded-full bg-[radial-gradient(circle,rgba(226,197,153,0.3)_0%,rgba(114,56,61,0.25)_45%,transparent_70%)] blur-md pointer-events-none transition-opacity duration-300 opacity-0 -translate-x-1/2 -translate-y-1/2"></div>

        <div class="absolute -right-16 -bottom-16 w-80 h-80 rounded-full bg-[#72383D]/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-2xl space-y-4">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-[#72383D]/30 text-[#E2C599] border border-[#72383D]/50">
                <svg class="w-3.5 h-3.5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                Freshly Baked Every Morning
            </span>
            <h1 class="text-3xl sm:text-5xl font-classic font-light tracking-wider leading-tight text-[#ffd1be]">
                Homemade Cookies & Bakery Made with Love
            </h1>
            <p class="text-[#E8D5B7] text-sm sm:text-base leading-relaxed">
                Aneka varian rasa dan ukuran, dibuat fresh setiap hari. Ambil langsung di tempat atau siap kami antarkan hangat ke rumah Anda.
            </p>
            <div class="pt-2 flex flex-wrap items-center gap-3">
                <a href="{{ route('products.index') }}" 
                   class="px-6 py-3 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-bold text-sm shadow-lg shadow-[#72383D]/30 transition transform active:scale-95 flex items-center gap-2 border border-[#8C464C]">
                    <span>Lihat Semua Produk</span>
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l7-7m7-7H3"></path></svg>
                </a>
                <a href="{{ route('about') }}" 
                   class="px-5 py-3 rounded-xl border border-[#4E4640] hover:bg-[#3D3732] text-[#E8D5B7] hover:text-white font-semibold text-sm transition">
                    Tentang Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Grid Section -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight flex items-center gap-2.5">
                <svg class="w-6 h-6 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kategori Pilihan
            </h2>
            <a href="{{ route('products.index') }}" class="text-xs font-bold text-[#E2C599] hover:text-[#F2E3CD] transition">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                   class="bg-[#3D3732] rounded-2xl shadow-xl border border-[#4E4640] p-5 text-center hover:border-[#72383D] hover:-translate-y-1 transition duration-200 group">
                    <div class="w-12 h-12 rounded-xl bg-[#24201D] text-[#E2C599] flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform border border-[#4E4640]">
                        <svg class="w-6 h-6 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.701 2.701 0 01-3 0 2.704 2.704 0 00-3 0 2.701 2.701 0 01-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M3 21h18M3 10h18M3 7l9-4 9 4v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"></path></svg>
                    </div>
                    <p class="font-extrabold text-white text-sm tracking-tight group-hover:text-[#E2C599] transition-colors">
                        {{ $category->name }}
                    </p>
                    <p class="text-xs font-medium text-[#BBAE9F] mt-1">
                        {{ $category->products_count }} Produk
                    </p>
                </a>
            @endforeach
        </div>
    </section>

    <!-- 16:9 HORIZONTAL PROMOTION BANNER SECTION -->
    <section class="relative rounded-3xl overflow-hidden shadow-2xl border border-[#4E4640] group">
        <div class="relative w-full aspect-[16/9] bg-[#24201D]">
            <img src="{{ asset('image/promo-banner.jpg') }}" 
                 onerror="this.src='https://images.unsplash.com/photo-1499636136210-6f4ee915583e?q=80&w=1600&auto=format&fit=crop'" 
                 alt="Promo Spesial Karen's Bakery" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-75">

            <div class="absolute inset-0 bg-gradient-to-t from-[#24201D]/95 via-[#24201D]/60 to-transparent flex flex-col justify-end p-6 sm:p-12 text-white space-y-3">
                <div class="space-y-2 max-w-xl">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold tracking-wider bg-[#72383D] text-white border border-[#8C464C] shadow-sm">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Special Event
                    </span>
                    <h3 class="text-3xl sm:text-5xl font-classic font-light tracking-wider leading-tight text-[#ffd1be] drop-shadow-md">
                        Ramadhan Tiba!
                    </h3>
                    <p class="text-xs sm:text-sm text-[#E8D5B7] line-clamp-2 leading-relaxed">
                        Hampers special lebaran. Cocok untuk dibagikan kepada keluarga dan kerabat terdekat
                    </p>
                </div>

                <div class="pt-2 flex items-center gap-3">
                    <a href="{{ route('products.index') }}" 
                       class="px-5 py-2.5 rounded-xl bg-[#72383D] hover:bg-[#8C464C] text-white font-bold text-xs sm:text-sm shadow-lg transition active:scale-95 flex items-center gap-2 border border-[#8C464C]">
                        <span>Pesan Promo Sekarang</span>
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l7-7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight flex items-center gap-2.5">
                <svg class="w-6 h-6 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                Produk Unggulan
            </h2>
            <a href="{{ route('products.index') }}" class="text-xs font-bold text-[#E2C599] hover:text-[#F2E3CD] transition">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @foreach($featuredProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

</div>


<!-- Cursor Trace Spotlight Script -->
<script>
    function handleHeroMouseMove(e) {
        const banner = document.getElementById('hero-banner');
        const spotlight = document.getElementById('cursor-spotlight');
        if (!banner || !spotlight) return;

        const rect = banner.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        spotlight.style.left = `${x}px`;
        spotlight.style.top = `${y}px`;
        spotlight.style.opacity = '1';
    }

    function handleHeroMouseLeave() {
        const spotlight = document.getElementById('cursor-spotlight');
        if (spotlight) {
            spotlight.style.opacity = '0';
        }
    }
</script>
@endsection
