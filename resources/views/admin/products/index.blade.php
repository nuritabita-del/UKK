@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<div class="space-y-6">

    <!-- Header & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-[#BBAE9F] mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Admin</a>
                <span>/</span>
                <span class="text-white">Produk</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </span>
                Daftar Produk
            </h1>
        </div>

        <a href="{{ route('admin.products.create') }}" 
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white text-sm font-bold shadow-md shadow-[#72383D]/30 transition-all duration-150 border border-[#8C464C]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Produk Baru
        </a>
    </div>

    <!-- Filter Card -->
    <div class="bg-[#3D3732] rounded-2xl p-4 sm:p-5 shadow-2xl border border-[#4E4640]">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex items-center gap-3">
            <div class="relative flex-1 max-w-md">
                <svg class="w-4 h-4 text-[#BBAE9F] absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama produk..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition placeholder-[#BBAE9F]">
            </div>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#72383D] hover:bg-[#8C464C] text-white font-bold text-sm transition border border-[#8C464C]">
                Cari
            </button>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden">
        @if($products->isEmpty())
            <div class="p-12 text-center space-y-3">
                <div class="w-16 h-16 rounded-full bg-[#24201D] text-[#BBAE9F] flex items-center justify-center mx-auto border border-[#4E4640]">
                    <svg class="w-8 h-8 text-[#BBAE9F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="font-bold text-white text-lg">Belum ada produk</h3>
                <p class="text-[#BBAE9F] text-sm max-w-sm mx-auto">Tambahkan produk kue pertama Anda untuk mulai berjualan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#24201D] border-b border-[#4E4640] text-[#E8D5B7] text-xs font-bold uppercase tracking-wider">
                            <th class="py-3.5 px-6">Produk</th>
                            <th class="py-3.5 px-6">Kategori</th>
                            <th class="py-3.5 px-6">Varian</th>
                            <th class="py-3.5 px-6">Harga Dasar</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#4E4640] text-sm">
                        @foreach($products as $product)
                            <tr class="hover:bg-[#49423C] transition-colors">
                                <td class="py-4 px-6 font-bold text-white flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#24201D] overflow-hidden border border-[#4E4640] shrink-0 flex items-center justify-center">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-5 h-5 text-[#BBAE9F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <span class="line-clamp-1">{{ $product->name }}</span>
                                </td>
                                <td class="py-4 px-6 text-[#BBAE9F] font-semibold">{{ $product->category->name ?? '-' }}</td>
                                <td class="py-4 px-6 font-extrabold text-[#E2C599]">{{ $product->variants_count }} Varian</td>
                                <td class="py-4 px-6 font-bold text-white">Rp {{ number_format($product->base_price, 0, ',', '.') }}</td>
                                <td class="py-4 px-6">
                                    <form method="POST" action="{{ route('admin.products.toggleStatus', $product) }}" class="inline">
                                        @csrf @method('PATCH')
                                        @if($product->is_active)
                                            <button type="submit" title="Klik untuk menonaktifkan produk" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-bold bg-emerald-950/80 text-emerald-300 border border-emerald-700/70 hover:bg-rose-950 hover:text-rose-300 hover:border-rose-700 transition group cursor-pointer">
                                                <span class="w-2 h-2 rounded-full bg-emerald-400 group-hover:bg-rose-400"></span>
                                                <span>Aktif</span>
                                            </button>
                                        @else
                                            <button type="submit" title="Klik untuk mengaktifkan produk" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-bold bg-rose-950/80 text-rose-300 border border-rose-700/70 hover:bg-emerald-950 hover:text-emerald-300 hover:border-emerald-700 transition group cursor-pointer">
                                                <span class="w-2 h-2 rounded-full bg-rose-400 group-hover:bg-emerald-400"></span>
                                                <span>Nonaktif</span>
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="px-3 py-1.5 rounded-lg border border-[#4E4640] bg-[#24201D] text-[#F5EFEA] hover:bg-[#322D29] text-xs font-semibold shadow-xs">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 rounded-lg border border-rose-900/60 bg-rose-950/40 text-rose-300 hover:bg-rose-900/60 text-xs font-semibold">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @if($products->hasPages())
        <div class="pt-2">{{ $products->links() }}</div>
    @endif
</div>
@endsection

