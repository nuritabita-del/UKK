@extends('layouts.admin')

@section('title', 'Pengaturan Pembayaran')

@section('content')
<div class="space-y-6 max-w-4xl">

    <!-- Header & Breadcrumbs -->
    <div>
        <nav class="flex items-center gap-2 text-xs font-semibold text-[#BBAE9F] mb-1">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Admin</a>
            <span>/</span>
            <span class="text-white">Pengaturan Pembayaran</span>
        </nav>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m0 14v1m9-10h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </span>
            Pengaturan Pembayaran & Rekening
        </h1>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Form Card (7 Cols on LG) -->
        <div class="lg:col-span-7 bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-[#72383D] via-[#E2C599] to-[#8C464C]"></div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
                @csrf
                
                <!-- Section 1: Nomor Rekening Bank BCA -->
                <div class="space-y-4 pb-6 border-b border-[#4E4640]">
                    <div class="space-y-1">
                        <h2 class="font-extrabold text-white text-base flex items-center gap-2">
                            <span class="w-7 h-5 rounded bg-blue-900 text-white font-extrabold text-[9px] flex items-center justify-center tracking-tighter shrink-0 border border-blue-700">BCA</span>
                            Pengaturan Rekening BCA
                        </h2>
                        <p class="text-xs text-[#BBAE9F]">
                            Ketik nomor rekening BCA resmi milik Karen's Bakery untuk ditampilkan kepada pembeli.
                        </p>
                    </div>

                    <div>
                        <label for="bca_account_number" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                            Nomor Rekening BCA <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" 
                               id="bca_account_number" 
                               name="bca_account_number" 
                               value="{{ old('bca_account_number', $bcaNumber) }}" 
                               placeholder="Contoh: 1234567890" 
                               class="w-full px-4 py-2.5 rounded-xl border text-white font-mono text-sm bg-[#24201D] transition-all focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] @error('bca_account_number') border-rose-500 bg-rose-950/30 @else border-[#4E4640] @enderror">
                        @error('bca_account_number')
                            <p class="mt-1 text-xs font-semibold text-rose-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="bca_account_name" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                            Atas Nama (A.N) Rekening <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" 
                               id="bca_account_name" 
                               name="bca_account_name" 
                               value="{{ old('bca_account_name', $bcaName) }}" 
                               placeholder="Contoh: Karen's Bakery" 
                               class="w-full px-4 py-2.5 rounded-xl border text-white text-sm bg-[#24201D] transition-all focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] @error('bca_account_name') border-rose-500 bg-rose-950/30 @else border-[#4E4640] @enderror">
                        @error('bca_account_name')
                            <p class="mt-1 text-xs font-semibold text-rose-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Section 2: Gambar QRIS -->
                <div class="space-y-4 pt-2">
                    <div class="space-y-1">
                        <h2 class="font-extrabold text-white text-base">Kelola Foto QRIS</h2>
                        <p class="text-xs text-[#BBAE9F]">
                            Upload atau ganti gambar barcode QRIS statis toko Anda.
                        </p>
                    </div>

                    @if($qrisImage)
                        <div class="space-y-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#BBAE9F] block">QRIS Aktif Saat Ini</span>
                            <div class="w-48 h-48 rounded-xl border border-[#4E4640] overflow-hidden p-2 bg-[#24201D]">
                                <img src="{{ asset('storage/' . $qrisImage) }}" alt="QRIS" class="w-full h-full object-contain bg-white rounded-lg shadow-xs">
                            </div>
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                            {{ $qrisImage ? 'Ganti Foto QRIS (Opsional)' : 'Upload Foto QRIS Baru' }}
                        </label>
                        <input type="file" 
                               name="qris_image" 
                               accept="image/*" 
                               class="w-full text-xs text-[#E8D5B7] file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#72383D] file:text-white hover:file:bg-[#8C464C] border border-[#4E4640] rounded-xl cursor-pointer bg-[#24201D]">
                        @error('qris_image') 
                            <p class="text-rose-400 text-xs font-semibold mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </p> 
                        @enderror
                    </div>
                </div>

                <div class="pt-4 border-t border-[#4E4640] flex justify-end">
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white text-xs font-bold shadow-md shadow-[#72383D]/30 hover:shadow-lg active:scale-95 transition-all border border-[#8C464C]">
                        Simpan Pengaturan Pembayaran
                    </button>
                </div>
            </form>
        </div>

        <!-- Live Preview Card (5 Cols on LG) -->
        <div class="lg:col-span-5 space-y-4">
            <div class="bg-[#3D3732] border border-[#4E4640] rounded-2xl p-6 space-y-3 shadow-2xl">
                <div class="flex items-center gap-2 border-b border-[#4E4640] pb-2.5">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <h3 class="font-extrabold text-white text-sm">Tampilan Pelanggan (Checkout)</h3>
                </div>
                <p class="text-xs text-[#BBAE9F] leading-relaxed">
                    Hanya nomor rekening BCA resmi di bawah ini yang akan muncul di layar pembayaran pembeli:
                </p>

                <div class="bg-[#24201D] p-4 rounded-xl border border-[#4E4640] shadow-sm space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-7 rounded bg-blue-900 text-white font-extrabold text-[10px] flex items-center justify-center tracking-tighter shrink-0 border border-blue-700">
                            BCA
                        </div>
                        <div>
                            <span class="font-mono font-bold text-sm text-[#E2C599] block">{{ $bcaNumber }}</span>
                            <span class="text-xs text-[#BBAE9F]">a.n. {{ $bcaName }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

