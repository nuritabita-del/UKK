@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<div class="space-y-6 max-w-6xl">

    <!-- Header & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-[#BBAE9F] mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Admin</a>
                <span>/</span>
                <a href="{{ route('admin.orders.index') }}" class="hover:text-white transition-colors">Pesanan</a>
                <span>/</span>
                <span class="text-white">Detail #{{ $order->order_number }}</span>
            </nav>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Pesanan #{{ $order->order_number }}
                </h1>
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
                <span class="px-3 py-1 rounded-full text-xs font-extrabold border capitalize shadow-xs {{ $style }}">
                    {{ $order->status }}
                </span>
            </div>
        </div>

        <a href="{{ route('admin.orders.index') }}" 
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-[#4E4640] bg-[#3D3732] text-[#F5EFEA] hover:bg-[#49423C] text-sm font-semibold shadow-sm transition-all duration-200">
            <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Section: Order Items & Totals (7 Cols on LG) -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Items Table Card -->
            <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden">
                <div class="p-6 border-b border-[#4E4640] flex items-center justify-between">
                    <h2 class="font-extrabold text-white text-base flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Rincian Item Pesanan
                    </h2>
                    <span class="text-xs font-semibold text-[#BBAE9F] font-mono">{{ $order->items->count() }} Items</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-[#24201D] border-b border-[#4E4640] text-[#E8D5B7] text-xs font-bold uppercase tracking-wider">
                                <th class="py-3 px-6">Produk</th>
                                <th class="py-3 px-4 text-center">Qty</th>
                                <th class="py-3 px-6 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#4E4640]">
                            @foreach($order->items as $item)
                                <tr class="hover:bg-[#49423C] transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-[#24201D] text-[#E2C599] flex items-center justify-center font-bold shrink-0 border border-[#4E4640]">
                                                <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.701 2.701 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.701 2.701 0 01-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M3 21h18M3 10h18M3 7l9-4 9 4v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"></path></svg>
                                            </div>
                                            <div>
                                                <span class="font-bold text-white block leading-snug">
                                                    {{ $item->product_name }}
                                                </span>
                                                <span class="text-xs font-medium text-[#BBAE9F]">
                                                    Varian: {{ $item->variant_name }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="inline-block px-2.5 py-1 rounded-lg bg-[#24201D] text-[#E2C599] font-extrabold text-xs border border-[#4E4640]">
                                            x{{ $item->quantity }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right font-extrabold text-[#E2C599]">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Financial Totals -->
                <div class="p-6 bg-[#24201D] border-t border-[#4E4640] space-y-2.5 text-sm">
                    <div class="flex justify-between text-[#BBAE9F] font-medium">
                        <span>Subtotal Produk</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-[#BBAE9F] font-medium">
                        <span>Ongkos Kirim</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-extrabold text-lg text-white border-t border-[#4E4640] pt-3">
                        <span>Total Pembayaran</span>
                        <span class="text-[#E2C599]">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Status Alert Banner -->
            <div class="bg-[#3D3732] rounded-2xl p-6 shadow-2xl border border-[#4E4640] space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[#BBAE9F]">Status Pembayaran Saat Ini</h3>
                <div>
                    @if($order->payment_status === \App\Models\Order::PAYMENT_PENDING)
                        <div class="p-4 rounded-xl bg-[#24201D] border border-[#4E4640] flex items-center gap-3 text-[#E8D5B7]">
                            <svg class="w-5 h-5 text-[#BBAE9F] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <span class="font-bold text-sm text-white block">Belum Upload Bukti</span>
                                <span class="text-xs text-[#BBAE9F]">Customer belum mengunggah foto bukti transfer.</span>
                            </div>
                        </div>
                    @elseif($order->payment_status === \App\Models\Order::PAYMENT_WAITING_VERIFICATION)
                        <div class="p-4 rounded-xl bg-[#72383D]/30 border border-[#72383D]/60 flex items-center gap-3 text-[#E2C599]">
                            <svg class="w-5 h-5 text-[#E2C599] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <div>
                                <span class="font-bold text-sm block">Menunggu Verifikasi</span>
                                <span class="text-xs text-[#E2C599]">Customer telah mengunggah bukti pembayaran. Periksa bukti di samping.</span>
                            </div>
                        </div>
                    @elseif($order->payment_status === \App\Models\Order::PAYMENT_PAID)
                        <div class="p-4 rounded-xl bg-emerald-950/60 border border-emerald-800/80 flex items-center gap-3 text-emerald-200">
                            <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <span class="font-bold text-sm block">Pembayaran Diverifikasi</span>
                                <span class="text-xs text-emerald-300">Bukti pembayaran telah disetujui oleh admin.</span>
                            </div>
                        </div>
                    @elseif($order->payment_status === \App\Models\Order::PAYMENT_REJECTED)
                        <div class="p-4 rounded-xl bg-rose-950/60 border border-rose-800/80 flex items-center gap-3 text-rose-200">
                            <svg class="w-5 h-5 text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <span class="font-bold text-sm block">Pembayaran Ditolak</span>
                                <span class="text-xs text-rose-300">Bukti transfer ditolak. Menunggu upload ulang dari customer.</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Right Section: Customer Info, Proof & Status Update (5 Cols on LG) -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Customer Info Card -->
            <div class="bg-[#3D3732] rounded-2xl p-6 shadow-2xl border border-[#4E4640] space-y-4">
                <h2 class="font-extrabold text-white text-base flex items-center gap-2 pb-3 border-b border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Informasi Pelanggan
                </h2>

                <div class="space-y-3 text-sm">
                    <div>
                        <span class="text-xs text-[#BBAE9F] font-semibold uppercase tracking-wider block">Akun / Nama</span>
                        <span class="font-bold text-white">{{ $order->user->name ?? '-' }}</span>
                        <span class="text-xs text-[#BBAE9F] block">{{ $order->user->email ?? '-' }}</span>
                    </div>

                    <div class="pt-2 border-t border-[#4E4640]">
                        <span class="text-xs text-[#BBAE9F] font-semibold uppercase tracking-wider block">Penerima & Kontak</span>
                        <span class="font-semibold text-white block">{{ $order->recipient_name }}</span>
                        <span class="text-xs font-mono text-[#E2C599] bg-[#24201D] px-2 py-0.5 rounded border border-[#4E4640] inline-block mt-0.5">
                            {{ $order->phone }}
                        </span>
                    </div>

                    <div class="pt-2 border-t border-[#4E4640]">
                        <span class="text-xs text-[#BBAE9F] font-semibold uppercase tracking-wider block">Metode Pengiriman</span>
                        @if($order->delivery_method === 'pickup')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-extrabold bg-[#24201D] text-[#E2C599] mt-1 border border-[#4E4640]">
                                <svg class="w-3.5 h-3.5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Ambil di Tempat (Pickup)
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-extrabold bg-blue-950/60 text-blue-300 mt-1 border border-blue-800/60">
                                <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Diantar ke Alamat
                            </span>
                        @endif
                    </div>

                    @if($order->address)
                        <div class="pt-2 border-t border-[#4E4640]">
                            <span class="text-xs text-[#BBAE9F] font-semibold uppercase tracking-wider block">Alamat Pengiriman</span>
                            <p class="text-xs text-[#E8D5B7] leading-relaxed bg-[#24201D] p-2.5 rounded-xl border border-[#4E4640] mt-1">
                                {{ $order->address }}
                            </p>
                        </div>
                    @endif

                    @if($order->notes)
                        <div class="pt-2 border-t border-[#4E4640]">
                            <span class="text-xs text-[#BBAE9F] font-semibold uppercase tracking-wider block">Catatan Pesanan</span>
                            <p class="text-xs text-[#E2C599] italic bg-[#72383D]/20 p-2.5 rounded-xl border border-[#72383D]/40 mt-1">
                                "{{ $order->notes }}"
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment Proof Card -->
            <div class="bg-[#3D3732] rounded-2xl p-6 shadow-2xl border border-[#4E4640] space-y-4">
                <h2 class="font-extrabold text-white text-base flex items-center gap-2 pb-3 border-b border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Bukti Pembayaran
                </h2>

                @if($order->payment_proof)
                    <div class="space-y-3">
                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="block group relative overflow-hidden rounded-xl border border-[#4E4640] shadow-sm">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-[#24201D]/60 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-bold transition-opacity">
                                Klik untuk Memperbesar
                            </div>
                        </a>
                    </div>
                @else
                    <div class="p-4 rounded-xl bg-[#24201D] border border-[#4E4640] text-center text-[#BBAE9F] text-xs italic">
                        Belum ada foto bukti pembayaran yang diunggah.
                    </div>
                @endif

                @if($order->isAwaitingVerification())
                    <div class="pt-2 flex gap-3">
                        <form method="POST" action="{{ route('admin.orders.approvePayment', $order) }}" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 rounded-xl text-xs shadow-md transition-all flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                ACC Bukti Bayar
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.orders.rejectPayment', $order) }}" class="flex-1" onsubmit="return confirm('Tolak bukti pembayaran ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-rose-600 hover:bg-rose-500 text-white font-bold py-2.5 rounded-xl text-xs shadow-md transition-all flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Tolak
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Update Order Status Card -->
            <div class="bg-[#3D3732] rounded-2xl p-6 shadow-2xl border border-[#4E4640] space-y-4">
                <h2 class="font-extrabold text-white text-base flex items-center gap-2 pb-3 border-b border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Ubah Status Pesanan
                </h2>

                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label for="status" class="block text-xs font-bold text-[#E8D5B7] mb-1.5">Pilih Status Baru</label>
                        <select id="status" name="status" class="w-full px-3.5 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                            @foreach(['pending' => 'Pending', 'paid' => 'Sudah Bayar', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $key => $label)
                                <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-bold py-2.5 rounded-xl text-xs shadow-md transition-all border border-[#8C464C]">
                        Simpan Status
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection

