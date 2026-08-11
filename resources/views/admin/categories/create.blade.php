@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')

@section('content')
<div class="max-w-4xl space-y-6">

    <!-- Header & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-[#BBAE9F] mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Admin</a>
                <span>/</span>
                <a href="{{ route('admin.categories.index') }}" class="hover:text-white transition-colors">Kategori</a>
                <span>/</span>
                <span class="text-white">Tambah Baru</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </span>
                Tambah Kategori
            </h1>
        </div>

        <a href="{{ route('admin.categories.index') }}" 
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-[#4E4640] bg-[#3D3732] text-[#F5EFEA] hover:bg-[#49423C] text-sm font-semibold shadow-sm transition-all duration-200">
            <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Main Grid Layout: Form + Live Preview -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Form Container (7 Cols on LG) -->
        <div class="lg:col-span-7 bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-[#72383D] via-[#E2C599] to-[#8C464C]"></div>

            <form method="POST" action="{{ route('admin.categories.store') }}" class="p-6 sm:p-8 space-y-6">
                @csrf

                <!-- Nama Kategori Field -->
                <div>
                    <label for="name" class="block text-sm font-bold text-[#E8D5B7] mb-2">
                        Nama Kategori <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus
                               placeholder="Contoh: Chocolate Cookies, Pastry, Dessert"
                               oninput="updatePreview()"
                               class="w-full px-4 py-3 rounded-xl border text-white placeholder-[#BBAE9F] bg-[#24201D] transition-all duration-200 focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] @error('name') border-rose-500 bg-rose-950/30 @else border-[#4E4640] @enderror">
                    </div>
                    @error('name')
                        <p class="mt-2 text-xs font-semibold text-rose-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @else
                        <p class="mt-1.5 text-xs text-[#BBAE9F]">Nama kategori unik yang menarik bagi pelanggan bakery Anda.</p>
                    @enderror
                </div>

                <!-- Deskripsi Field -->
                <div>
                    <label for="description" class="block text-sm font-bold text-[#E8D5B7] mb-2">
                        Deskripsi
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              placeholder="Tulis penjelasan singkat mengenai varian cookies atau produk dalam kategori ini..."
                              oninput="updatePreview()"
                              class="w-full px-4 py-3 rounded-xl border text-white placeholder-[#BBAE9F] bg-[#24201D] transition-all duration-200 focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] @error('description') border-rose-500 bg-rose-950/30 @else border-[#4E4640] @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-xs font-semibold text-rose-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @else
                        <p class="mt-1.5 text-xs text-[#BBAE9F]">Opsional. Penjelasan singkat untuk memberikan informasi lebih lengkap.</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 border-t border-[#4E4640] flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('admin.categories.index') }}" 
                       class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-[#4E4640] bg-[#24201D] text-[#E8D5B7] hover:bg-[#322D29] text-sm font-semibold text-center transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white text-sm font-bold shadow-md shadow-[#72383D]/30 hover:shadow-lg active:scale-95 transition-all duration-150 flex items-center justify-center gap-2 border border-[#8C464C]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>

        <!-- Live Interactive Preview Widget (5 Cols on LG) -->
        <div class="lg:col-span-5 space-y-4">
            <div class="bg-[#24201D] rounded-2xl p-6 text-white shadow-2xl border border-[#4E4640] relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-36 h-36 rounded-full bg-[#E2C599]/10 blur-xl pointer-events-none"></div>

                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#E2C599] flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-[#E2C599] animate-pulse"></span>
                        Pratinjau Kartu
                    </span>
                    <span class="text-[10px] text-[#BBAE9F] bg-[#3D3732] px-2 py-0.5 rounded-md font-mono border border-[#4E4640]">Live Card</span>
                </div>

                <!-- Card Badge Component -->
                <div class="bg-[#3D3732] rounded-xl p-5 border border-[#4E4640] space-y-3 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#E2C599] to-[#72383D] flex items-center justify-center text-white font-bold shadow-inner">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <div>
                            <h3 id="preview-name" class="font-extrabold text-base text-white tracking-tight">
                                {{ old('name') ? old('name') : 'Nama Kategori' }}
                            </h3>
                            <span class="text-[11px] text-[#E2C599] font-medium">0 Produk Terdaftar</span>
                        </div>
                    </div>
                    <p id="preview-desc" class="text-xs text-[#BBAE9F] line-clamp-3 leading-relaxed">
                        {{ old('description') ? old('description') : 'Deskripsi singkat kategori akan muncul di sini secara otomatis saat Anda mengetik.' }}
                    </p>
                </div>

                <div class="mt-4 pt-3 border-t border-[#4E4640] flex items-center justify-between text-[11px] text-[#BBAE9F]">
                    <span>Status: <strong class="text-emerald-400">Aktif</strong></span>
                    <span>Tampilan Pelanggan</span>
                </div>
            </div>

            <!-- Helpful Tips Card -->
            <div class="bg-[#3D3732] border border-[#4E4640] rounded-2xl p-5 text-[#E8D5B7] space-y-2">
                <h4 class="text-xs font-bold uppercase tracking-wide text-[#E2C599] flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tips Pengelolaan Kategori
                </h4>
                <ul class="text-xs text-[#BBAE9F] space-y-1.5 list-disc list-inside">
                    <li>Gunakan nama singkat yang jelas (misal: <em>Cookies Premium</em>).</li>
                    <li>Deskripsi membantu pelanggan memahami keunikan varian kue Anda.</li>
                    <li>Slug URL akan dibuat secara otomatis dari nama kategori.</li>
                </ul>
            </div>
        </div>

    </div>
</div>

<script>
    function updatePreview() {
        const nameInput = document.getElementById('name').value.trim();
        const descInput = document.getElementById('description').value.trim();
        
        document.getElementById('preview-name').innerText = nameInput ? nameInput : 'Nama Kategori';
        document.getElementById('preview-desc').innerText = descInput ? descInput : 'Deskripsi singkat kategori akan muncul di sini secara otomatis saat Anda mengetik.';
    }
</script>
@endsection

