@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header & Back Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <nav class="flex items-center gap-2 text-xs font-semibold text-[#BBAE9F] mb-1">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('orders.index') }}" class="hover:text-white transition-colors">Pesanan Saya</a>
                <span>/</span>
                <span class="text-white">#{{ $order->order_number }}</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </span>
                Rincian Pemesanan
            </h1>
        </div>

        <a href="{{ route('orders.index') }}" 
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-[#4E4640] bg-[#3D3732] text-[#F5EFEA] hover:bg-[#49423C] text-xs font-semibold shadow-sm transition">
            <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Pesanan Saya
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden p-6 sm:p-8 space-y-6">
        
        <!-- Header Info Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-[#4E4640]">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-[#BBAE9F]">Nomor Pesanan</span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-white font-mono">#{{ $order->order_number }}</h2>
                <p class="text-xs text-[#BBAE9F] mt-1 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-[#BBAE9F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $order->created_at->translatedFormat('d M Y, H:i') }} WIB
                </p>
            </div>
            
            <div>
                @php
                    $statusStyles = [
                        'pending' => 'bg-[#72383D]/40 text-[#E2C599] border-[#72383D]',
                        'paid' => 'bg-emerald-950/60 text-emerald-300 border-emerald-800/60',
                        'processing' => 'bg-blue-950/60 text-blue-300 border-blue-800/60',
                        'shipped' => 'bg-indigo-950/60 text-indigo-300 border-indigo-800/60',
                        'completed' => 'bg-purple-950/60 text-purple-300 border-purple-800/60',
                        'cancelled' => 'bg-rose-950/60 text-rose-300 border-rose-800/60',
                    ];
                    $style = $statusStyles[$order->status] ?? 'bg-gray-900 text-gray-300 border-gray-700';
                @endphp
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-extrabold border capitalize tracking-wide {{ $style }}">
                    <span class="w-2 h-2 rounded-full bg-current animate-pulse"></span>
                    {{ $order->status }}
                </span>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
            <div class="bg-[#24201D] p-4 rounded-xl border border-[#4E4640] space-y-1">
                <p class="text-[#BBAE9F] font-semibold uppercase tracking-wider text-[10px]">Metode Pengambilan</p>
                <p class="font-extrabold text-white text-sm flex items-center gap-2 pt-0.5">
                    @if($order->delivery_method === 'pickup')
                        <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Ambil di Tempat (Pickup)
                    @else
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Diantar ke Alamat (Delivery)
                    @endif
                </p>
            </div>

            <div class="bg-[#24201D] p-4 rounded-xl border border-[#4E4640] space-y-1">
                <p class="text-[#BBAE9F] font-semibold uppercase tracking-wider text-[10px]">Nama Penerima & No. HP</p>
                <p class="font-extrabold text-white text-sm pt-0.5">{{ $order->recipient_name }}</p>
                <p class="text-[#E2C599] font-mono text-xs">{{ $order->phone }}</p>
            </div>

            @if($order->address)
                <div class="sm:col-span-2 bg-[#24201D] p-4 rounded-xl border border-[#4E4640] space-y-1">
                    <p class="text-[#BBAE9F] font-semibold uppercase tracking-wider text-[10px]">Alamat Pengiriman</p>
                    <p class="font-semibold text-[#F5EFEA] text-xs leading-relaxed pt-0.5">{{ $order->address }}</p>
                </div>
            @endif

            @if($order->notes)
                <div class="sm:col-span-2 bg-[#72383D]/20 p-4 rounded-xl border border-[#72383D]/40 space-y-1">
                    <p class="text-[#E2C599] font-semibold uppercase tracking-wider text-[10px]">Catatan Tambahan</p>
                    <p class="italic text-[#E2C599] text-xs pt-0.5">"{{ $order->notes }}"</p>
                </div>
            @endif
        </div>

        <!-- Items Table -->
        <div class="space-y-3">
            <h3 class="font-extrabold text-white text-sm uppercase tracking-wider flex items-center gap-2 border-b border-[#4E4640] pb-2">
                <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Item Pesanan
            </h3>

            <div class="overflow-x-auto rounded-xl border border-[#4E4640]">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-[#24201D] border-b border-[#4E4640] text-[#E8D5B7] font-bold uppercase tracking-wider">
                            <th class="py-3 px-4">Produk & Varian</th>
                            <th class="py-3 px-4 text-center">Jumlah</th>
                            <th class="py-3 px-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#4E4640]">
                        @foreach($order->items as $item)
                            <tr class="hover:bg-[#49423C] transition-colors">
                                <td class="py-3.5 px-4">
                                    <span class="font-extrabold text-white block text-sm">{{ $item->product_name }}</span>
                                    <span class="text-[#BBAE9F] font-medium">Varian: {{ $item->variant_name }}</span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="inline-block px-2.5 py-1 rounded-lg bg-[#24201D] text-[#E2C599] font-extrabold text-xs border border-[#4E4640]">
                                        x{{ $item->quantity }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right font-extrabold text-[#E2C599] text-sm">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary Totals -->
        <div class="bg-[#24201D] p-5 rounded-xl border border-[#4E4640] space-y-2 text-xs">
            <div class="flex justify-between text-[#BBAE9F]">
                <span>Subtotal Produk</span>
                <span class="font-semibold text-[#F5EFEA]">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-[#BBAE9F]">
                <span>Ongkos Kirim</span>
                <span class="font-semibold text-[#F5EFEA]">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between font-extrabold text-base text-white border-t border-[#4E4640] pt-3">
                <span>Total Pembayaran</span>
                <span class="text-[#E2C599] text-lg">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Payment Status Actions Banner -->
        @if($order->isAwaitingProof())
            <div class="space-y-3 pt-2">
                <a href="{{ route('checkout.pay', $order) }}" 
                   class="block text-center bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white py-3.5 px-6 rounded-xl font-extrabold text-sm shadow-lg shadow-[#72383D]/30 transition transform active:scale-95 border border-[#8C464C]">
                    {{ $order->payment_status === \App\Models\Order::PAYMENT_REJECTED ? 'Upload Ulang Bukti Pembayaran' : 'Bayar Sekarang (BCA / QRIS)' }} &rarr;
                </a>
            </div>
        @elseif($order->isAwaitingVerification())
            <div class="text-center bg-[#72383D]/30 text-[#E2C599] border border-[#72383D]/60 p-4 rounded-xl font-semibold text-xs sm:text-sm space-y-1">
                <p class="font-bold flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-[#E2C599] animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Permintaan Anda terkirim!
                </p>
                <p class="text-[#BBAE9F] text-xs">Bukti pembayaran Anda sedang diverifikasi oleh tim Karen's Bakery. Mohon tunggu sebentar ya :)</p>
            </div>
        @elseif($order->isPaid())
            <div class="text-center bg-emerald-950/60 text-emerald-300 border border-emerald-800/80 p-4 rounded-xl font-semibold text-xs sm:text-sm space-y-1">
                <p class="font-bold flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Pembayaran Terkonfirmasi
                </p>
                <p class="text-[#E8D5B7] text-xs">Terima kasih, pesanan Anda telah diproses dan siap disajikan!</p>
            </div>
        @endif

    </div>

</div>
@endsection


