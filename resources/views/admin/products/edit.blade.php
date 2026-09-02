@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-4xl space-y-6">

    <!-- Header & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <nav class="flex items-center gap-2 text-xs font-semibold text-[#BBAE9F] mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Admin</a>
                <span>/</span>
                <a href="{{ route('admin.products.index') }}" class="hover:text-white transition-colors">Produk</a>
                <span>/</span>
                <span class="text-white">Edit</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-9 h-9 rounded-xl bg-[#3D3732] text-[#E2C599] flex items-center justify-center border border-[#4E4640]">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </span>
                Edit Produk: {{ $product->name }}
            </h1>
        </div>

        <a href="{{ route('admin.products.index') }}" 
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-[#4E4640] bg-[#3D3732] text-[#F5EFEA] hover:bg-[#49423C] text-sm font-semibold shadow-sm transition-all duration-200">
            <svg class="w-4 h-4 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Form Container -->
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden p-6 sm:p-8 space-y-6">
        @csrf @method('PUT')

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">Nama Produk <span class="text-rose-400">*</span></label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                @error('name') <p class="text-rose-400 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">Kategori</label>
                <select name="category_id" class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                    <option value="">- Tanpa Kategori -</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">Deskripsi Produk</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">Harga Dasar (Tampil di Katalog)</label>
                    <input type="number" name="base_price" value="{{ old('base_price', $product->base_price) }}" required class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white text-sm bg-[#24201D] focus:bg-[#2A2522] focus:outline-none focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">Ganti Foto Produk (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-[#E8D5B7] file:mr-4 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#72383D] file:text-white hover:file:bg-[#8C464C] border border-[#4E4640] rounded-xl cursor-pointer bg-[#24201D]">
                </div>
            </div>

            @if($product->image)
                <div class="space-y-1">
                    <span class="text-xs text-[#BBAE9F] font-semibold block">Gambar Aktif Saat Ini:</span>
                    <img src="{{ asset('storage/' . $product->image) }}" class="h-24 rounded-xl border border-[#4E4640] object-cover">
                </div>
            @endif

            <div>
                <label class="block text-xs font-bold text-[#E8D5B7] mb-2 uppercase tracking-wider">Status Tampilan Produk</label>
                <div class="flex items-center gap-3 bg-[#24201D] p-3 rounded-xl border border-[#4E4640] max-w-md">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('_token') ? old('is_active') : $product->is_active) class="w-4 h-4 rounded border-[#4E4640] bg-[#322D29] text-[#72383D] focus:ring-[#72383D] focus:ring-offset-0 cursor-pointer accent-[#72383D]">
                    <label for="is_active" class="text-xs font-bold text-white cursor-pointer select-none">
                        Produk Aktif (Tampilkan di Katalog Pembeli)
                    </label>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-[#4E4640] space-y-4">
            <div class="flex justify-between items-center">
                <label class="block text-xs font-bold text-[#E2C599] uppercase tracking-wider">Varian Produk (Rasa / Ukuran / Harga / Stok)</label>
                <button type="button" onclick="addVariantRow()" class="text-xs bg-[#24201D] hover:bg-[#322D29] text-[#E2C599] border border-[#4E4640] px-3.5 py-1.5 rounded-xl font-bold transition">+ Tambah Varian</button>
            </div>
            @error('variants') <p class="text-rose-400 text-xs font-semibold">{{ $message }}</p> @enderror

            <div id="variant-rows" class="space-y-3">
                @foreach($product->variants as $variant)
                    <div class="variant-row grid grid-cols-12 gap-2 items-center border border-[#4E4640] bg-[#24201D] rounded-xl p-3">
                        <input type="hidden" name="variants[{{ $loop->index }}][id]" value="{{ $variant->id }}">
                        <input type="text" name="variants[{{ $loop->index }}][name]" value="{{ $variant->name }}" placeholder="Nama Varian" class="col-span-4 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none" required>
                        <input type="text" name="variants[{{ $loop->index }}][flavor]" value="{{ $variant->flavor }}" placeholder="Rasa" class="col-span-2 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none">
                        <input type="text" name="variants[{{ $loop->index }}][size]" value="{{ $variant->size }}" placeholder="Ukuran" class="col-span-2 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none">
                        <input type="number" name="variants[{{ $loop->index }}][price]" value="{{ $variant->price }}" placeholder="Harga" class="col-span-1 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none" required>
                        <input type="number" name="variants[{{ $loop->index }}][stock]" value="{{ $variant->stock }}" placeholder="Stok" class="col-span-1 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none" required>
                        <button type="button" onclick="this.closest('.variant-row').remove()" class="col-span-2 text-rose-400 hover:text-rose-200 text-xs font-bold">Hapus</button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="pt-4 border-t border-[#4E4640] flex justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-bold text-sm shadow-md transition-all border border-[#8C464C]">
                Simpan Perubahan
            </button>
        </div>
    </form>

    <template id="variant-row-template">
        <div class="variant-row grid grid-cols-12 gap-2 items-center border border-[#4E4640] bg-[#24201D] rounded-xl p-3">
            <input type="text" name="variants[__INDEX__][name]" placeholder="Nama Varian (mis: Coklat - 250gr)" class="col-span-4 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none" required>
            <input type="text" name="variants[__INDEX__][flavor]" placeholder="Rasa" class="col-span-2 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none">
            <input type="text" name="variants[__INDEX__][size]" placeholder="Ukuran" class="col-span-2 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none">
            <input type="number" name="variants[__INDEX__][price]" placeholder="Harga" class="col-span-1 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none" required>
            <input type="number" name="variants[__INDEX__][stock]" placeholder="Stok" class="col-span-1 border border-[#4E4640] bg-[#322D29] text-white rounded-lg px-2.5 py-1.5 text-xs focus:outline-none" required>
            <button type="button" onclick="this.closest('.variant-row').remove()" class="col-span-2 text-rose-400 hover:text-rose-200 text-xs font-bold">Hapus</button>
        </div>
    </template>

    <script>
        let variantIndex = {{ $product->variants->count() }} + 1000;
        function addVariantRow() {
            const template = document.getElementById('variant-row-template').innerHTML.replaceAll('__INDEX__', variantIndex);
            const wrapper = document.createElement('div');
            wrapper.innerHTML = template;
            document.getElementById('variant-rows').appendChild(wrapper.firstElementChild);
            variantIndex++;
        }
    </script>
</div>
@endsection

