@extends('layouts.admin')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="space-y-6">

    <!-- Header & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-[#BBAE9F] mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Admin</a>
                <span>/</span>
                <span class="text-white">Pesanan</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </span>
                Daftar Pesanan
            </h1>
        </div>
    </div>

    <!-- Filter & Search Card -->
    <div class="bg-[#3D3732] rounded-2xl p-4 sm:p-5 shadow-2xl border border-[#4E4640]">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
            <!-- Search Input -->
            <div class="relative flex-1">
                <svg class="w-4 h-4 text-[#BBAE9F] absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" 
                       name="q" 
                       value="{{ request('q') }}" 
                       placeholder="Cari no. pesanan / nama customer..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition placeholder-[#BBAE9F]">
            </div>

            <!-- Status Dropdown -->
            <div class="sm:w-52">
                <select name="status" class="w-full px-3.5 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                    <option value="">Semua Status</option>
                    @foreach(['pending' => 'Pending', 'paid' => 'Sudah Bayar', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $key => $label)
                        <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-2">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-bold text-sm shadow-md transition-all flex items-center justify-center gap-2 border border-[#8C464C]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>
                @if(request('q') || request('status'))
                    <a href="{{ route('admin.orders.index') }}" class="px-3.5 py-2.5 rounded-xl border border-[#4E4640] bg-[#24201D] text-[#E8D5B7] hover:bg-[#322D29] text-xs font-semibold">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden">
        @if($orders->isEmpty())
            <!-- Empty State -->
            <div class="p-12 text-center space-y-3">
                <div class="w-16 h-16 rounded-full bg-[#24201D] text-[#BBAE9F] flex items-center justify-center mx-auto border border-[#4E4640]">
                    <svg class="w-8 h-8 text-[#BBAE9F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <h3 class="font-bold text-white text-lg">Tidak ada pesanan ditemukan</h3>
                <p class="text-[#BBAE9F] text-sm max-w-sm mx-auto">Coba ubah kata kunci pencarian atau status filter Anda.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#24201D] border-b border-[#4E4640] text-[#E8D5B7] text-xs font-bold uppercase tracking-wider">
                            <th class="py-3.5 px-6">No. Pesanan</th>
                            <th class="py-3.5 px-6">Customer</th>
                            <th class="py-3.5 px-6">Metode</th>
                            <th class="py-3.5 px-6">Total</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6">Tanggal</th>
                            <th class="py-3.5 px-6 text-right">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#4E4640] text-sm">
                        @foreach($orders as $order)
                            <tr class="hover:bg-[#49423C] transition-colors cursor-pointer group" 
                                onclick="window.location='{{ route('admin.orders.show', $order) }}'">
                                
                                <!-- No. Pesanan -->
                                <td class="py-4 px-6 font-bold text-white">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#24201D] text-[#E2C599] text-xs font-mono border border-[#4E4640]">
                                        #{{ $order->order_number }}
                                    </span>
                                </td>

                                <!-- Customer -->
                                <td class="py-4 px-6">
                                    <div class="font-semibold text-white">{{ $order->user->name ?? 'Guest' }}</div>
                                    <div class="text-xs text-[#BBAE9F]">{{ $order->user->email ?? '-' }}</div>
                                </td>

                                <!-- Delivery Method -->
                                <td class="py-4 px-6">
                                    @if($order->delivery_method === 'pickup')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#24201D] text-[#E2C599] border border-[#4E4640]">
                                            <svg class="w-3.5 h-3.5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                            Pickup
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-950/60 text-blue-300 border border-blue-800/60">
                                            <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                            Delivery
                                        </span>
                                    @endif
                                </td>

                                <!-- Total -->
                                <td class="py-4 px-6 font-extrabold text-[#E2C599]">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </td>

                                <!-- Status Badge -->
                                <td class="py-4 px-6">
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
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border capitalize {{ $style }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        {{ $order->status }}
                                    </span>
                                </td>

                                <!-- Tanggal -->
                                <td class="py-4 px-6 text-xs text-[#BBAE9F] font-medium">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>

                                <!-- Arrow Action -->
                                <td class="py-4 px-6 text-right">
                                    <span class="w-8 h-8 rounded-lg bg-[#24201D] text-[#E8D5B7] inline-flex items-center justify-center group-hover:bg-[#72383D] group-hover:text-white transition-colors border border-[#4E4640]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
        <div class="pt-2">
            {{ $orders->links() }}
        </div>
    @endif

</div>
@endsection
