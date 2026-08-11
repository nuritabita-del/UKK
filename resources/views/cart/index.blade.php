@extends("layouts.app")

@section("title", "Keranjang Belanja")

@section("content")
<div class="max-w-4xl mx-auto space-y-6">
    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
        <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
            <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        </span>
        Keranjang Belanja
    </h1>

    @if(!$cart || $cart->items->isEmpty())
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-12 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-[#24201D] text-[#BBAE9F] flex items-center justify-center mx-auto border border-[#4E4640]">
                <svg class="w-8 h-8 text-[#BBAE9F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <p class="text-[#BBAE9F] text-sm">Keranjang kamu masih kosong.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-bold px-6 py-2.5 rounded-xl text-sm transition shadow-md border border-[#8C464C]">
                Belanja Sekarang
            </a>
        </div>
    @else
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] divide-y divide-[#4E4640] overflow-hidden">
            @foreach($cart->items as $item)
                <div class="p-4 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <p class="font-extrabold text-white text-base">{{ $item->variant->product->name }}</p>
                        <p class="text-xs font-semibold text-[#E2C599]">Varian: {{ $item->variant->name }}</p>
                        <p class="text-xs text-[#BBAE9F]">Rp {{ number_format($item->variant->price, 0, ",", ".") }} / pcs</p>
                    </div>

                    <div class="flex items-center justify-between sm:justify-end gap-4">
                        <div class="flex items-center gap-3">
                            <form method="POST" action="{{ route('cart.update', $item->id) }}" class="flex items-center gap-2">
                                @csrf @method("PATCH")
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                       max="{{ $item->variant->stock }}" class="w-16 border border-[#4E4640] bg-[#24201D] text-white rounded-xl px-2 py-1 text-sm text-center">
                                <button class="text-xs text-[#E2C599] hover:text-white font-semibold underline">Update</button>
                            </form>

                            <form method="POST" action="{{ route('cart.destroy', $item->id) }}">
                                @csrf @method("DELETE")
                                <button class="text-xs text-rose-300 hover:text-rose-100 font-semibold underline">Hapus</button>
                            </form>
                        </div>

                        <div class="font-extrabold text-[#E2C599] text-base min-w-[100px] text-right">
                            Rp {{ number_format($item->subtotal(), 0, ",", ".") }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <span class="text-xs text-[#BBAE9F] font-semibold block">Total Keranjang</span>
                <span class="text-2xl font-extrabold text-[#E2C599]">
                    Rp {{ number_format($cart->items->sum(fn($i) => $i->subtotal()), 0, ",", ".") }}
                </span>
            </div>
            <a href="{{ route('checkout.index') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-extrabold text-sm shadow-lg text-center transition border border-[#8C464C]">
                Lanjut ke Checkout &rarr;
            </a>
        </div>
    @endif
</div>
@endsection


