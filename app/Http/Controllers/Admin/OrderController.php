<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with("user");

        if ($request->filled("status")) {
            $query->where("status", $request->status);
        }

        if ($request->filled("q")) {
            $query->where("order_number", "like", "%" . $request->q . "%");
        }

        $orders = $query->latest()->paginate(15)->withQueryString();

        return view("admin.orders.index", compact("orders"));
    }

    public function show(Order $order)
    {
        $order->load(["items", "user"]);

        return view("admin.orders.show", compact("order"));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            "status" => ["required", "in:pending,paid,processing,shipped,completed,cancelled"],
        ]);

        $order->update($data);

        return back()->with("success", "Status pesanan diperbarui.");
    }

    /**
     * Admin menyetujui bukti pembayaran yang diupload customer.
     */
    public function approvePayment(Order $order)
    {
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
     * Admin menolak bukti pembayaran (misal foto tidak jelas / nominal tidak sesuai).
     * Customer akan diminta upload ulang.
     */
    public function rejectPayment(Order $order)
    {
        if (! $order->isAwaitingVerification()) {
            return back()->with("error", "Pesanan ini tidak sedang menunggu verifikasi.");
        }

        $order->update([
            "payment_status" => Order::PAYMENT_REJECTED,
        ]);

        return back()->with("success", "Bukti pembayaran ditolak. Customer akan diminta upload ulang.");
    }
}
