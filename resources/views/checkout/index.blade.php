@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </span>
            Form Checkout Pesanan
        </h1>
    </div>

    <div class="grid md:grid-cols-3 gap-6 items-start">
        
        <!-- Checkout Form Card (2 Cols) -->
        <form method="POST" action="{{ route('checkout.store') }}" class="md:col-span-2 bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-6 sm:p-8 space-y-5">
            @csrf

            <!-- Delivery Method Option -->
            <div>
                <label class="block text-xs font-bold text-[#E8D5B7] mb-2 uppercase tracking-wider">
                    Metode Pengambilan <span class="text-rose-400">*</span>
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <label class="flex items-center gap-3 p-3.5 rounded-xl border cursor-pointer transition bg-[#24201D] border-[#4E4640] hover:border-[#72383D]">
                        <input type="radio" name="delivery_method" value="pickup" onchange="toggleAddress()" {{ old('delivery_method') === 'pickup' ? 'checked' : '' }} class="w-4 h-4 text-[#72383D] focus:ring-[#72383D]/30">
                        <div>
                            <span class="font-extrabold text-white text-xs block">Ambil di Tempat (Pickup)</span>
                            <span class="text-[11px] text-[#BBAE9F]">Ambil pesanan langsung di toko</span>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-xl border cursor-pointer transition bg-[#24201D] border-[#4E4640] hover:border-[#72383D]">
                        <input type="radio" name="delivery_method" value="delivery" onchange="toggleAddress()" {{ old('delivery_method', 'delivery') === 'delivery' ? 'checked' : '' }} class="w-4 h-4 text-[#72383D] focus:ring-[#72383D]/30">
                        <div>
                            <span class="font-extrabold text-white text-xs block">Diantar (+Rp 15.000)</span>
                            <span class="text-[11px] text-[#BBAE9F]">Kurir mengantar kue ke alamatmu</span>
                        </div>
                    </label>
                </div>
                @error('delivery_method') <p class="text-rose-400 text-xs font-semibold mt-1.5">{{ $message }}</p> @enderror
            </div>

            <!-- Recipient Name -->
            <div>
                <label for="recipient_name" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                    Nama Penerima <span class="text-rose-400">*</span>
                </label>
                <input type="text" 
                       id="recipient_name" 
                       name="recipient_name" 
                       value="{{ old('recipient_name', auth()->user()->name) }}"
                       required
                       placeholder="Nama lengkap penerima..."
                       class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] placeholder-[#BBAE9F] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                @error('recipient_name') <p class="text-rose-400 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                    No. HP / WhatsApp <span class="text-rose-400">*</span>
                </label>
                <input type="text" 
                       id="phone" 
                       name="phone" 
                       value="{{ old('phone', auth()->user()->phone) }}"
                       required
                       placeholder="081234567890"
                       class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] placeholder-[#BBAE9F] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                @error('phone') <p class="text-rose-400 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Delivery Address -->
            <div id="address-field">
                <label for="address" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                    Alamat Pengiriman Lengkap
                </label>
                <textarea id="address" 
                          name="address" 
                          rows="3" 
                          placeholder="Jalan, No. Rumah, RT/RW, Kecamatan, Kota..."
                          class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] placeholder-[#BBAE9F] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">{{ old('address') }}</textarea>
                @error('address') <p class="text-rose-400 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                    Catatan Pesanan (opsional)
                </label>
                <textarea id="notes" 
                          name="notes" 
                          rows="2" 
                          placeholder="Contoh: Titip di satpam / tulisan ucapan ulang tahun..."
                          class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] placeholder-[#BBAE9F] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-extrabold text-sm shadow-lg shadow-[#72383D]/30 hover:shadow-xl active:scale-[0.99] transition-all flex items-center justify-center gap-2 border border-[#8C464C]">
                <span>Buat Pesanan Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>

        <!-- Summary Side Card (1 Col) -->
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-6 h-fit space-y-4">
            <h2 class="font-extrabold text-white text-sm uppercase tracking-wider flex items-center gap-2 border-b border-[#4E4640] pb-3">
                <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Ringkasan Pesanan
            </h2>
            <ul class="text-xs space-y-3">
                @foreach($cart->items as $item)
                    <li class="flex justify-between items-start gap-2 border-b border-[#4E4640] pb-2.5 last:border-0">
                        <div>
                            <span class="font-extrabold text-white block">{{ $item->variant->product->name }}</span>
                            <span class="text-[11px] text-[#BBAE9F] font-medium">Varian: {{ $item->variant->name }} (x{{ $item->quantity }})</span>
                        </div>
                        <span class="font-bold text-[#E2C599] shrink-0">Rp {{ number_format($item->subtotal(), 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="border-t border-[#4E4640] pt-3 font-extrabold flex justify-between text-white text-sm">
                <span>Subtotal Produk</span>
                <span class="text-[#E2C599]">Rp {{ number_format($cart->total(), 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <script>
        function toggleAddress() {
            const delivery = document.querySelector("input[name=delivery_method]:checked");
            const field = document.getElementById("address-field");
            field.style.display = (delivery && delivery.value === "pickup") ? "none" : "block";
        }
        document.addEventListener("DOMContentLoaded", toggleAddress);
    </script>
</div>
@endsection


