@props(["product"])

<a href="{{ route('products.show', $product) }}" class="bg-[#3D3732] rounded-2xl shadow-xl border border-[#4E4640] hover:border-[#72383D] transition-all duration-200 overflow-hidden block group">
    <div class="h-44 bg-[#24201D] flex items-center justify-center overflow-hidden relative">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <svg class="w-12 h-12 text-[#BBAE9F] opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        @endif
    </div>
    <div class="p-4 space-y-1.5">
        @if($product->category)
            <span class="text-[11px] font-bold text-[#E2C599] uppercase tracking-wider block">{{ $product->category->name }}</span>
        @endif
        <h3 class="font-extrabold text-base text-white group-hover:text-[#E2C599] transition-colors line-clamp-1">{{ $product->name }}</h3>
        <p class="text-[#E2C599] font-extrabold text-sm pt-0.5">
            Rp {{ number_format($product->cheapestPrice(), 0, ",", ".") }}
        </p>
    </div>
</a>



