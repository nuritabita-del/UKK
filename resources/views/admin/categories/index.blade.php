@extends('layouts.admin')

@section('title', 'Daftar Kategori')

@section('content')
<div class="space-y-6">

    <!-- Header & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-[#BBAE9F] mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Admin</a>
                <span>/</span>
                <span class="text-white">Kategori</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </span>
                Daftar Kategori
            </h1>
        </div>

        <a href="{{ route('admin.categories.create') }}" 
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white text-sm font-bold shadow-md shadow-[#72383D]/30 transition-all duration-150 border border-[#8C464C]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kategori Baru
        </a>
    </div>

    <!-- Data Table Card -->
    <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden">
        @if($categories->isEmpty())
            <!-- Empty State -->
            <div class="p-12 text-center space-y-4">
                <div class="w-16 h-16 rounded-full bg-[#24201D] text-[#BBAE9F] flex items-center justify-center mx-auto border border-[#4E4640]">
                    <svg class="w-8 h-8 text-[#BBAE9F]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <div class="space-y-1">
                    <h3 class="font-bold text-white text-lg">Belum ada kategori</h3>
                    <p class="text-[#BBAE9F] text-sm max-w-sm mx-auto">Mulai tambahkan kategori produk cookies atau bakery pertama Anda.</p>
                </div>
                <a href="{{ route('admin.categories.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#72383D] text-white text-xs font-bold shadow hover:bg-[#8C464C] transition border border-[#8C464C]">
                    + Tambah Kategori Pertama
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#24201D] border-b border-[#4E4640] text-[#E8D5B7] text-xs font-bold uppercase tracking-wider">
                            <th class="py-3.5 px-6">Kategori</th>
                            <th class="py-3.5 px-6">Slug</th>
                            <th class="py-3.5 px-6">Jumlah Produk</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#4E4640] text-sm">
                        @foreach($categories as $category)
                            <tr class="hover:bg-[#49423C] transition-colors group">
                                <!-- Category Name & Description -->
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-[#24201D] text-[#E2C599] flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform border border-[#4E4640]">
                                            <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                        </div>
                                        <div>
                                            <span class="font-extrabold text-white block leading-snug">
                                                {{ $category->name }}
                                            </span>
                                            @if($category->description)
                                                <span class="text-xs text-[#BBAE9F] line-clamp-1">
                                                    {{ $category->description }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Slug -->
                                <td class="py-4 px-6 font-mono text-xs text-[#E2C599]">
                                    {{ $category->slug }}
                                </td>

                                <!-- Product Count Badge -->
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#24201D] text-[#E2C599] border border-[#4E4640]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#E2C599]"></span>
                                        {{ $category->products_count }} Produk
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" 
                                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-[#4E4640] bg-[#24201D] text-[#F5EFEA] hover:bg-[#322D29] text-xs font-semibold shadow-xs transition-all">
                                            <svg class="w-3.5 h-3.5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-rose-900/60 bg-rose-950/40 text-rose-300 hover:bg-rose-900/60 text-xs font-semibold transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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

    <!-- Pagination Links -->
    @if($categories->hasPages())
        <div class="pt-2">
            {{ $categories->links() }}
        </div>
    @endif

</div>
@endsection

