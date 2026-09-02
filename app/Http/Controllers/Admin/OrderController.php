<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

/**
 * Mengelola daftar pesanan, perombakan status pesanan, serta verifikasi bukti pembayaran pelanggan.
 */
class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan masuk dengan opsi filter status dan nomor pesanan.
     */
    public function index(Request $request)
    {
        $query = Order::with("user");

        // Filter berdasarkan status pesanan
        if ($request->filled("status")) {
            $query->where("status", $request->status);
        }

        // Filter berdasarkan nomor pesanan
        if ($request->filled("q")) {
            $query->where("order_number", "like", "%" . $request->q . "%");
        }

        $orders = $query->latest()->paginate(15)->withQueryString();

        return view("admin.orders.index", compact("orders"));
    }

    /**
     * Menampilkan rincian pesanan, data pemesan, dan bukti pembayaran yang diunggah.
     */
    public function show(Order $order)
    {
        $order->load(["items", "user"]);

        return view("admin.orders.show", compact("order"));
    }

    /**
     * Memperbarui status pengerjaan / pengiriman pesanan.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            "status" => ["required", "in:pending,paid,processing,shipped,completed,cancelled"],
        ]);

        $order->update($data);

        return back()->with("success", "Status pesanan diperbarui.");
    }

    /**
     * Menyetujui (ACC) bukti pembayaran dari pelanggan dan melanjutkan pesanan ke status diproses.
     */
    public function approvePayment(Order $order)
    {
        // Pastikan pesanan sedang dalam status menunggu verifikasi
        if (! $order->isAwaitingVerification()) {
            return back()->with("error", "Pesanan ini tidak sedang menunggu verifikasi.");
        }

        $order->update([
            "payment_status" => Order::PAYMENT_PAID,
            "payment_verified_at" => now(),
            "status" => "processing",
        ]);

        return back()->with("success", "Bukti pembayaran diterima. Pesanan diteruskan ke proses.");
    }

    /**
     * Menolak bukti pembayaran pelanggan (misal: foto tidak valid/jelas) sehingga pelanggan harus unggah ulang.
     */
    public function rejectPayment(Order $order)
    {
        // Pastikan pesanan sedang dalam status menunggu verifikasi
        if (! $order->isAwaitingVerification()) {
            return back()->with("error", "Pesanan ini tidak sedang menunggu verifikasi.");
        }

        $order->update([
            "payment_status" => Order::PAYMENT_REJECTED,
        ]);

        return back()->with("success", "Bukti pembayaran ditolak. Customer akan diminta upload ulang.");
    }
}
