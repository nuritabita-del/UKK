@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </span>
            Pesanan Saya
        </h1>
    </div>

    @if($orders->isEmpty())
        <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-12 text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-[#24201D] text-[#BBAE9F] flex items-center justify-center mx-auto border border-[#4E4640]">
                <svg class="w-8 h-8 text-[#BBAE9F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <p class="text-[#BBAE9F] text-sm">Kamu belum punya pesanan kue saat ini.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-bold px-6 py-2.5 rounded-xl text-sm transition shadow-md border border-[#8C464C]">
                Pesan Sekarang
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-[#3D3732] rounded-2xl shadow-xl border border-[#4E4640] p-5 sm:p-6 hover:border-[#72383D] transition duration-200 space-y-4">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-[#4E4640] pb-4">
                        <div>
                            <span class="text-[11px] font-bold text-[#BBAE9F] uppercase tracking-wider block">Nomor Pesanan</span>
                            <span class="font-extrabold text-white text-base font-mono">#{{ $order->order_number }}</span>
                            <span class="text-xs text-[#BBAE9F] ml-2 font-medium">({{ $order->created_at->format('d M Y, H:i') }})</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-semibold text-[#E8D5B7] bg-[#24201D] px-3 py-1 rounded-lg border border-[#4E4640] uppercase tracking-wider">
                                {{ $order->delivery_method === 'pickup' ? 'Ambil di Tempat' : 'Diantar' }}
                            </span>

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
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold border capitalize tracking-wide {{ $style }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="text-xs text-[#BBAE9F] space-y-1">
                            <p class="font-medium text-[#E8D5B7]">
                                Total {{ $order->items->sum('quantity') }} item pesanan
                            </p>
                            <p class="text-sm font-extrabold text-[#E2C599]">
                                Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('orders.show', $order) }}" class="px-4 py-2 rounded-xl bg-[#24201D] border border-[#4E4640] hover:bg-[#322D29] text-white text-xs font-bold transition">
                                Lihat Rincian &rarr;
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="pt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection

