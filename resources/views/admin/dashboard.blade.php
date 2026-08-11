@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </span>
            Dashboard Overview
        </h1>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-5 space-y-2">
            <p class="text-xs font-bold text-[#BBAE9F] uppercase tracking-wider">Total Produk</p>
            <p class="text-3xl font-extrabold text-white">{{ $totalProducts }}</p>
        </div>
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-5 space-y-2">
            <p class="text-xs font-bold text-[#BBAE9F] uppercase tracking-wider">Total Pesanan</p>
            <p class="text-3xl font-extrabold text-white">{{ $totalOrders }}</p>
        </div>
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-5 space-y-2">
            <p class="text-xs font-bold text-[#E2C599] uppercase tracking-wider">Pesanan Pending</p>
            <p class="text-3xl font-extrabold text-[#E2C599]">{{ $pendingOrders }}</p>
        </div>
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-5 space-y-2">
            <p class="text-xs font-bold text-emerald-300 uppercase tracking-wider">Total Pendapatan</p>
            <p class="text-2xl sm:text-3xl font-extrabold text-emerald-300">Rp {{ number_format($revenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- 2 Column Widgets -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Low Stock Widget -->
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-6 space-y-4">
            <h2 class="font-extrabold text-white text-base flex items-center gap-2 border-b border-[#4E4640] pb-3">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Stok Menipis
            </h2>
            <div class="divide-y divide-[#4E4640]">
                @forelse($lowStockVariants as $variant)
                    <div class="flex justify-between items-center text-sm py-3">
                        <span class="text-[#E8D5B7] font-medium">{{ $variant->product->name }} - {{ $variant->name }}</span>
                        <span class="font-extrabold text-rose-300 bg-rose-950/60 px-2.5 py-0.5 rounded-lg border border-rose-800/60 text-xs">Sisa {{ $variant->stock }}</span>
                    </div>
                @empty
                    <p class="text-xs text-[#BBAE9F] italic py-2">Stok semua produk dalam kondisi aman.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Orders Widget -->
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-6 space-y-4">
            <h2 class="font-extrabold text-white text-base flex items-center gap-2 border-b border-[#4E4640] pb-3">
                <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Pesanan Terbaru
            </h2>
            <div class="divide-y divide-[#4E4640]">
                @forelse($latestOrders as $order)
                    <a href="{{ route('admin.orders.show', $order) }}" class="flex justify-between items-center text-sm py-3 hover:text-[#E2C599] transition-colors group">
                        <div>
                            <span class="font-bold text-white group-hover:text-[#E2C599]">#{{ $order->order_number }}</span>
                            <span class="text-xs text-[#BBAE9F] block">{{ $order->user->name ?? 'Guest' }}</span>
                        </div>
                        <span class="capitalize text-xs font-bold px-2.5 py-1 rounded-full bg-[#24201D] text-[#E2C599] border border-[#4E4640]">
                            {{ $order->status }}
                        </span>
                    </a>
                @empty
                    <p class="text-xs text-[#BBAE9F] italic py-2">Belum ada pesanan masuk.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

