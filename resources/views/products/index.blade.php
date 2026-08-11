@extends("layouts.app")

@section("title", "Katalog Produk")

@section("content")
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </span>
                Katalog Produk
            </h1>
            <p class="text-xs text-[#BBAE9F] mt-1">Jelajahi seluruh koleksi cookies & pastry buatan hangat Karen's Bakery.</p>
        </div>
    </div>

    <!-- Main 2-Column Layout -->
    <div class="flex flex-col md:flex-row gap-6 items-start">
        
        <!-- Sidebar Filter (Search & Category List) -->
        <aside class="w-full md:w-64 space-y-4 shrink-0">
            
            <!-- Search Card -->
            <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-5 space-y-3">
                <h3 class="font-extrabold text-white text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cari Produk
                </h3>
                <form method="GET" action="{{ route('products.index') }}" class="space-y-3">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="relative">
                        <input type="text" 
                               name="q" 
                               value="{{ request('q') }}" 
                               placeholder="Nama cookies..."
                               class="w-full px-3.5 py-2.5 rounded-xl border border-[#4E4640] text-white placeholder-[#BBAE9F] text-xs bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                    </div>
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-bold text-xs shadow-md transition-all duration-150 flex items-center justify-center gap-1.5 border border-[#8C464C]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span>Cari</span>
                    </button>
                </form>
            </div>

            <!-- Categories Card -->
            <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-5 space-y-3">
                <h3 class="font-extrabold text-white text-sm flex items-center gap-2 pb-2 border-b border-[#4E4640]">
                    <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Kategori
                </h3>
                <ul class="space-y-1.5 text-xs font-semibold">
                    <li>
                        <a href="{{ route('products.index', request()->only('q')) }}" 
                           class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ !request('category') ? 'bg-[#72383D] text-white border border-[#8C464C] font-bold' : 'text-[#E8D5B7] hover:bg-[#49423C] hover:text-white' }}">
                            <span>Semua Produk</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products.index', array_merge(request()->only('q'), ['category' => $category->slug])) }}"
                               class="flex items-center justify-between px-3.5 py-2 rounded-xl transition {{ request('category') === $category->slug ? 'bg-[#72383D] text-white border border-[#8C464C] font-bold' : 'text-[#E8D5B7] hover:bg-[#49423C] hover:text-white' }}">
                                <span>{{ $category->name }}</span>
                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-[#24201D] text-[#BBAE9F] border border-[#4E4640]">
                                    {{ $category->products_count }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Product Grid Area -->
        <div class="flex-1 space-y-4 w-full">
            
            @if(request('q') || request('category'))
                <div class="flex items-center justify-between bg-[#3D3732] px-4 py-2.5 rounded-xl border border-[#4E4640] text-xs">
                    <span class="text-[#E8D5B7]">
                        Hasil pencarian untuk: 
                        @if(request('q')) <strong class="text-white">"{{ request('q') }}"</strong> @endif
                        @if(request('category')) <span class="text-[#E2C599] font-semibold"> (Kategori: {{ request('category') }})</span> @endif
                    </span>
                    <a href="{{ route('products.index') }}" class="text-[#E2C599] hover:text-white font-bold underline">
                        Reset Filter
                    </a>
                </div>
            @endif

            @if($products->isEmpty())
                <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-12 text-center space-y-3">
                    <div class="w-16 h-16 rounded-full bg-[#24201D] text-[#BBAE9F] flex items-center justify-center mx-auto border border-[#4E4640]">
                        <svg class="w-8 h-8 text-[#BBAE9F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-white text-lg">Produk Tidak Ditemukan</h3>
                    <p class="text-[#BBAE9F] text-xs max-w-sm mx-auto">Maaf, kue yang Anda cari tidak tersedia. Coba kata kunci atau kategori lainnya.</p>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                
                @if($products->hasPages())
                    <div class="pt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            @endif

        </div>

    </div>

</div>
@endsection

