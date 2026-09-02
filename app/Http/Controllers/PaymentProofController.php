<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Mengelola pengunggahan bukti pembayaran dari pelanggan.
 */
class PaymentProofController extends Controller
{
    /**
     * Memproses pengunggahan foto bukti transfer/QRIS pelanggan.
     * Mengubah status pembayaran menjadi "menunggu_verifikasi".
     */
    public function store(Request $request, Order $order)
    {
        // Pengamanan akses: pastikan pesanan milik pengguna yang sedang login
        abort_if($order->user_id !== Auth::id(), 403);

        // Cek status pesanan apakah masih dapat menerima bukti pembayaran
        if (! $order->isAwaitingProof()) {
            return back()->with('error', 'Bukti pembayaran untuk pesanan ini sudah dikirim.');
        }

        // Validasi ekstensi dan ukuran file gambar
        $request->validate([
            'proof' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ], [
            'proof.required' => 'Silakan pilih foto bukti pembayaran.',
            'proof.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
        ]);

        // Hapus file bukti lama jika pengunggahan ulang setelah ditolak
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        // Simpan file ke media penyimpanan publik
        $path = $request->file('proof')->store('payment-proofs', 'public');

        // Perbarui record status pembayaran pesanan
        $order->update([
            'payment_proof' => $path,
            'payment_status' => Order::PAYMENT_WAITING_VERIFICATION,
        ]);

        return redirect()->route('checkout.pay', $order)
            ->with('success', 'Bukti pembayaran berhasil dikirim.');
    }
}
