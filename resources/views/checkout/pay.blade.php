@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="max-w-lg mx-auto space-y-6">

    <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] p-6 sm:p-8 space-y-6">
        
        <!-- Header -->
        <div class="text-center space-y-1.5 border-b border-[#4E4640] pb-5">
            <span class="text-xs font-bold uppercase tracking-wider text-[#BBAE9F]">Kode Pesanan</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white font-mono">#{{ $order->order_number }}</h1>
            <p class="text-sm font-semibold text-[#E8D5B7]">
                Total Tagihan: <span class="text-xl font-extrabold text-[#E2C599]">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </p>
        </div>

        @if($order->isPaid())
            <!-- Sudah di-ACC admin -->
            <div class="py-8 text-center space-y-3">
                <div class="w-16 h-16 rounded-full bg-emerald-950/80 text-emerald-300 flex items-center justify-center mx-auto shadow-inner border border-emerald-800/80">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-xl font-extrabold text-emerald-300">Pembayaran Terkonfirmasi!</h2>
                <p class="text-xs sm:text-sm text-[#E8D5B7] max-w-sm mx-auto leading-relaxed">
                    Terima kasih, pembayaran Anda telah diverifikasi oleh admin. Kami sedang menyiapkan pesanan kue Anda dengan penuh cinta.
                </p>
            </div>

        @elseif($order->isAwaitingVerification())
            <!-- Bukti sudah diupload, menunggu ACC admin -->
            <div class="py-8 text-center space-y-3">
                <div class="w-16 h-16 rounded-full bg-[#72383D]/40 text-[#E2C599] flex items-center justify-center mx-auto shadow-inner border border-[#72383D]">
                    <svg class="w-8 h-8 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-xl font-extrabold text-white">Bukti Terkirim, Menunggu Verifikasi</h2>
                <p class="text-xs sm:text-sm text-[#E8D5B7] max-w-sm mx-auto leading-relaxed">
                    Bukti pembayaran Anda sedang kami periksa. Halaman ini akan otomatis memperbarui status setelah disetujui admin.
                </p>
            </div>

        @else
            <!-- Belum bayar / bukti ditolak -->
            @if($order->payment_status === \App\Models\Order::PAYMENT_REJECTED)
                <div class="bg-rose-950/60 text-rose-200 border border-rose-800/80 p-4 rounded-xl text-xs sm:text-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-rose-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <span class="font-bold block">Bukti Pembayaran Ditolak</span>
                        <span class="text-xs text-rose-300">Bukti sebelumnya belum dapat kami verifikasi. Silakan lakukan upload ulang foto bukti transfer yang valid.</span>
                    </div>
                </div>
            @endif

            <!-- REKENING BANK BCA RESMI KAREN'S BAKERY -->
            <div class="bg-[#24201D] rounded-2xl p-5 border border-[#4E4640] space-y-3">
                <div class="flex items-center gap-2 border-b border-[#4E4640] pb-2.5">
                    <svg class="w-5 h-5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    <h3 class="font-extrabold text-white text-sm">Transfer Bank BCA</h3>
                </div>
                <p class="text-xs text-[#BBAE9F]">Silakan lakukan transfer ke nomor rekening BCA resmi milik Karen's Bakery di bawah ini:</p>

                <!-- Rekening BCA Card -->
                <div class="bg-[#3D3732] rounded-xl p-4 border border-[#4E4640] flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-7 rounded bg-blue-900 text-white font-extrabold text-[10px] flex items-center justify-center tracking-tighter shrink-0 border border-blue-700">
                            BCA
                        </div>
                        <div>
                            <span class="font-mono font-extrabold text-base text-[#E2C599] block">{{ $bcaNumber }}</span>
                            <span class="text-xs text-[#BBAE9F] font-semibold">a.n. {{ $bcaName }}</span>
                        </div>
                    </div>
                    <button type="button" 
                            onclick="copyToClipboard('{{ str_replace(' ', '', $bcaNumber) }}', this)" 
                            class="px-3 py-1.5 rounded-lg bg-[#72383D] hover:bg-[#8C464C] text-white border border-[#8C464C] text-xs font-bold transition flex items-center gap-1.5 shrink-0">
                        <svg class="w-3.5 h-3.5 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        <span>Salin No. Rek</span>
                    </button>
                </div>
            </div>

            <!-- Foto QRIS Pembayaran -->
            <div class="bg-[#24201D] rounded-2xl p-6 text-center border border-[#4E4640] space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#BBAE9F] block">Atau Scan QRIS di Bawah Ini</span>
                @if($qrisImage)
                    <img src="{{ asset('storage/' . $qrisImage) }}" alt="QRIS" class="mx-auto w-64 h-64 object-contain bg-white rounded-xl shadow border border-[#4E4640]">
                @else
                    <div class="mx-auto w-64 h-64 flex items-center justify-center bg-[#3D3732] rounded-xl border border-[#4E4640] text-[#BBAE9F] text-xs">
                        QRIS belum diunggah oleh admin
                    </div>
                @endif
                <p class="text-xs text-[#BBAE9F] leading-relaxed">
                    Scan QRIS menggunakan Gopay, OVO, Dana, ShopeePay, atau aplikasi Mobile Banking Anda.
                </p>
            </div>

            <!-- Form Upload Bukti Pembayaran -->
            <form method="POST" action="{{ route('checkout.uploadProof', $order) }}" enctype="multipart/form-data" class="space-y-4 pt-2">
                @csrf
                <div>
                    <label for="proof" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                        Upload Bukti Pembayaran (JPG/PNG) <span class="text-rose-400">*</span>
                    </label>
                    <input type="file" 
                           id="proof" 
                           name="proof" 
                           accept="image/jpeg,image/png" 
                           required 
                           class="w-full text-xs text-[#E8D5B7] file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#72383D] file:text-white hover:file:bg-[#8C464C] border border-[#4E4640] rounded-xl cursor-pointer bg-[#24201D]">
                    @error('proof') 
                        <p class="text-rose-400 text-xs font-semibold mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                <button type="submit" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-extrabold text-sm shadow-lg shadow-[#72383D]/30 hover:shadow-xl active:scale-[0.99] transition-all duration-150 flex items-center justify-center gap-2 border border-[#8C464C]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span>Kirim Bukti Pembayaran</span>
                </button>
            </form>
        @endif

        <div class="pt-2 text-center border-t border-[#4E4640]">
            <a href="{{ route('orders.show', $order) }}" class="text-xs font-bold text-[#E2C599] hover:text-[#F2E3CD] underline transition-colors">
                Lihat Detail Pesanan &rarr;
            </a>
        </div>
    </div>

</div>

<!-- Copy to Clipboard Script -->
<script>
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btn.querySelector('span').innerText;
            btn.querySelector('span').innerText = 'Tersalin!';
            btn.classList.add('bg-emerald-900/80', 'text-emerald-200', 'border-emerald-600');
            setTimeout(() => {
                btn.querySelector('span').innerText = originalText;
                btn.classList.remove('bg-emerald-900/80', 'text-emerald-200', 'border-emerald-600');
            }, 2000);
        }).catch(err => {
            alert('Nomor rekening: ' + text);
        });
    }
</script>
@endsection

