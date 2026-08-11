<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentProofController extends Controller
{
    /**
     * Customer mengupload foto bukti transfer/QRIS.
     * Status pembayaran akan berubah jadi "menunggu_verifikasi".
     */
    public function store(Request $request, Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        if (! $order->isAwaitingProof()) {
            return back()->with('error', 'Bukti pembayaran untuk pesanan ini sudah dikirim.');
        }

        $request->validate([
            'proof' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ], [
            'proof.required' => 'Silakan pilih foto bukti pembayaran.',
            'proof.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
        ]);

        // Hapus bukti lama jika sebelumnya sempat ditolak & upload ulang.
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        $path = $request->file('proof')->store('payment-proofs', 'public');

        $order->update([
            'payment_proof' => $path,
            'payment_status' => Order::PAYMENT_WAITING_VERIFICATION,
        ]);

        return redirect()->route('checkout.pay', $order)
            ->with('success', 'Bukti pembayaran berhasil dikirim.');
    }
}
