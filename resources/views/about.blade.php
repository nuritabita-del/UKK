@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="space-y-12 max-w-5xl mx-auto">

    <!-- Hero Banner -->
    <section class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#24201D] via-[#322D29] to-[#3D3732] text-white p-8 sm:p-14 shadow-2xl border border-[#4E4640] text-center">
        <!-- Ambient Decorative Glow -->
        <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-[#E2C599]/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-[#72383D]/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-2xl mx-auto space-y-4">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-[#72383D]/30 text-[#E2C599] border border-[#72383D]/50">
                <svg class="w-3.5 h-3.5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                Sensasi Kelezatan Autentik
            </span>
            <h1 class="text-3xl sm:text-5xl leading-tight">
    <span class="font-classic font-light tracking-wider text-white block">Cerita di Balik</span>
    <span class="font-brand font-normal text-[#E2C599] text-4xl sm:text-6xl tracking-wider block mt-2">Karen's Bakery</span>
</h1>   
            <p class="text-[#E8D5B7] text-sm sm:text-base leading-relaxed">
                Dari kehangatan oven dapur kami hingga ke hati Anda. Kami percaya setiap gigitan kue harus menghadirkan kebahagiaan sejati.
            </p>
        </div>
    </section>

    <!-- Our Story Section (2 Columns) -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        
        <!-- Image Card (5 Cols on LG) -->
        <div class="lg:col-span-5 relative group">
            <div class="absolute -inset-2 bg-gradient-to-r from-[#E2C599] to-[#72383D] rounded-3xl blur-lg opacity-25 group-hover:opacity-40 transition duration-300"></div>
            <div class="relative rounded-2xl overflow-hidden shadow-xl border border-[#4E4640] aspect-4/3 sm:aspect-square">
                <img src="{{ asset('images/about-bakery.png') }}" 
                     onerror="this.src='https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=1000&auto=format&fit=crop'" 
                     alt="Dapur Karen's Bakery" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
        </div>

        <!-- Narrative Content (7 Cols on LG) -->
        <div class="lg:col-span-7 space-y-5">
            <div class="space-y-2">
                <span class="text-xs font-bold uppercase tracking-widest text-[#E2C599]">Sejak 2021</span>
                <h2 class="text-2xl sm:text-4xl font-classic font-light text-white tracking-wider leading-snug">
                    Dedikasi Resep Warisan & Bahan Berkualitas Tinggi
                </h2>
            </div>
            
            <p class="text-[#E8D5B7] text-sm sm:text-base leading-relaxed">
                Karen's Bakery bermula dari passion mendalam terhadap seni pembuatan kue beraroma khas. Kami hanya menggunakan cokelat mentega impor pilihan, cokelat Belgia murni, serta tepung berkualitas tanpa pengawet buatan.
            </p>
            
            <p class="text-[#BBAE9F] text-sm leading-relaxed">
                Setiap varian dipanggang fresh setiap pagi (*baked fresh daily*) untuk memastikan tekstur renyah di luar dan lembut lumer di dalam saat sampai di tangan pelanggan setia kami.
            </p>

            <!-- Stats Bar -->
            <div class="grid grid-cols-3 gap-4 pt-4 border-t border-[#4E4640] text-center">
                <div class="bg-[#3D3732] p-3.5 rounded-2xl shadow-sm border border-[#4E4640]">
                    <span class="text-xl sm:text-2xl font-extrabold text-white block">100%</span>
                    <span class="text-[11px] text-[#BBAE9F] font-semibold">Bahan Alami</span>
                </div>
                <div class="bg-[#3D3732] p-3.5 rounded-2xl shadow-sm border border-[#4E4640]">
                    <span class="text-xl sm:text-2xl font-extrabold text-white block">15+</span>
                    <span class="text-[11px] text-[#BBAE9F] font-semibold">Varian Rasa</span>
                </div>
                <div class="bg-[#3D3732] p-3.5 rounded-2xl shadow-sm border border-[#4E4640]">
                    <span class="text-xl sm:text-2xl font-extrabold text-white block">200+</span>
                    <span class="text-[11px] text-[#BBAE9F] font-semibold">Pelanggan Puas</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Grid -->
    <section class="space-y-6">
        <div class="text-center max-w-xl mx-auto space-y-2">
            <h2 class="text-2xl font-extrabold text-white">Mengapa Memilih Karen's Bakery?</h2>
            <p class="text-xs sm:text-sm text-[#BBAE9F]">Komitmen kami dalam menyajikan kue terbaik untuk momen spesial Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Card 1 -->
            <div class="bg-[#3D3732] rounded-2xl p-6 shadow-xl border border-[#4E4640] space-y-3 hover:-translate-y-1 hover:border-[#72383D] transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-[#24201D] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                    <svg class="w-6 h-6 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                </div>
                <h3 class="font-extrabold text-white text-base">Fresh From Oven</h3>
                <p class="text-xs text-[#BBAE9F] leading-relaxed">Dipanggang setiap hari secara berkala agar pesanan selalu dalam kondisi terbaik.</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-[#3D3732] rounded-2xl p-6 shadow-xl border border-[#4E4640] space-y-3 hover:-translate-y-1 hover:border-[#72383D] transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-[#24201D] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                    <svg class="w-6 h-6 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.701 2.701 0 01-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M3 21h18M3 10h18M3 7l9-4 9 4v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"></path></svg>
                </div>
                <h3 class="font-extrabold text-white text-base">Cokelat Pilihan</h3>
                <p class="text-xs text-[#BBAE9F] leading-relaxed">Menggunakan lelehan cokelat berkualitas untuk rasa manis gurih yang seimbang.</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-[#3D3732] rounded-2xl p-6 shadow-xl border border-[#4E4640] space-y-3 hover:-translate-y-1 hover:border-[#72383D] transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-emerald-950/60 text-emerald-300 flex items-center justify-center border border-emerald-800/60">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="font-extrabold text-white text-base">Higienis & Tersegel</h3>
                <p class="text-xs text-[#BBAE9F] leading-relaxed">Kemasan tertutup rapat untuk menjaga kerenyahan dan higienitas produk.</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-[#3D3732] rounded-2xl p-6 shadow-xl border border-[#4E4640] space-y-3 hover:-translate-y-1 hover:border-[#72383D] transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-blue-950/60 text-blue-300 flex items-center justify-center border border-blue-800/60">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="font-extrabold text-white text-base">Pickup & Delivery</h3>
                <p class="text-xs text-[#BBAE9F] leading-relaxed">Bisa langsung diambil di toko kami atau dikirim cepat ke tempat Anda.</p>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Callout -->
    <section class="bg-gradient-to-r from-[#24201D] via-[#322D29] to-[#24201D] rounded-3xl p-8 sm:p-10 text-white text-center space-y-4 shadow-xl border border-[#4E4640]">
        <h3 class="text-2xl font-extrabold tracking-tight text-white">Siap Memanjakan Lidah Anda Hari Ini?</h3>
        <p class="text-xs sm:text-sm text-[#E8D5B7] max-w-md mx-auto">Jelajahi seluruh varian cookies, cake, dan pastry favorit kami sekarang.</p>
        <div>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#72383D] hover:bg-[#8C464C] text-white font-bold text-sm shadow-md transition transform active:scale-95 border border-[#8C464C]">
                <span>Lihat Katalog Produk</span>
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>

</div>
@endsection

