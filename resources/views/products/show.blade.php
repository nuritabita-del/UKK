@extends("layouts.app")

@section("title", $product->name)

@section("content")
<div class="space-y-10 max-w-5xl mx-auto">

    <!-- Product Detail Layout (2 Columns) -->
    <div class="grid md:grid-cols-2 gap-8 items-start">
        
        <!-- Image Card -->
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] h-80 sm:h-96 flex items-center justify-center overflow-hidden relative group">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="flex flex-col items-center justify-center space-y-2 text-[#BBAE9F]">
                    <svg class="w-16 h-16 text-[#BBAE9F] opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-xs font-semibold">Tidak ada foto produk</span>
                </div>
            @endif
        </div>

        <!-- Details & Order Form Column -->
        <div class="space-y-6">
            <div class="space-y-2">
                @if($product->category)
                    <span class="text-xs font-bold text-[#E2C599] uppercase tracking-widest block">{{ $product->category->name }}</span>
                @endif
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">{{ $product->name }}</h1>
                <p class="text-[#E8D5B7] text-sm leading-relaxed">{{ $product->description }}</p>
            </div>

            @auth
                <!-- Order Form Card -->
                <form method="POST" action="{{ route('cart.store') }}" class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-6 space-y-4">
                    @csrf
                    <div>
                        <label for="product_variant_id" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                            Pilih Varian (Rasa / Ukuran / Harga) <span class="text-rose-400">*</span>
                        </label>
                        <select id="product_variant_id" name="product_variant_id" required class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                            @foreach($product->activeVariants as $variant)
                                <option value="{{ $variant->id }}" @disabled($variant->stock <= 0)>
                                    {{ $variant->name }} - Rp {{ number_format($variant->price, 0, ",", ".") }}
                                    ({{ $variant->stock > 0 ? "Stok Tersedia: {$variant->stock}" : "Stok Habis" }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="quantity" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                            Jumlah Pesanan <span class="text-rose-400">*</span>
                        </label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" required class="w-32 px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                    </div>

                    <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-extrabold text-sm shadow-lg shadow-[#72383D]/30 hover:shadow-xl active:scale-[0.99] transition-all duration-150 flex items-center justify-center gap-2 border border-[#8C464C]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Tambah ke Keranjang</span>
                    </button>
                </form>
            @else
                <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-6 text-center space-y-3">
                    <p class="text-xs text-[#E8D5B7] font-medium">Silakan masuk ke akun Anda terlebih dahulu untuk memesan produk ini.</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-[#72383D] hover:bg-[#8C464C] text-white font-bold text-xs shadow-md transition border border-[#8C464C]">
                        <span>Masuk ke Akun</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            @endauth

            <!-- Available Variants Summary -->
            <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-5 space-y-3">
                <h3 class="font-extrabold text-white text-xs uppercase tracking-wider flex items-center gap-2 border-b border-[#4E4640] pb-2">
                    <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Varian Tersedia
                </h3>
                <ul class="text-xs space-y-2">
                    @foreach($product->activeVariants as $variant)
                        <li class="flex justify-between items-center py-1.5 border-b border-[#4E4640] last:border-0">
                            <span class="text-[#E8D5B7] font-medium">{{ $variant->name }}</span>
                            <span class="font-bold text-[#E2C599]">Rp {{ number_format($variant->price, 0, ",", ".") }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

    <!-- Related Products -->
    @if($related->isNotEmpty())
        <div class="space-y-4 pt-6 border-t border-[#4E4640]">
            <h2 class="text-xl font-extrabold text-white tracking-tight flex items-center gap-2">
                <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                Produk Terkait
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                @foreach($related as $item)
                    <x-product-card :product="$item" />
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection

