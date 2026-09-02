<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

/**
 * Mengelola tampilan riwayat dan detail pesanan untuk sisi pelanggan (customer).
 */
class OrderController extends Controller
{
    /**
     * Menampilkan daftar riwayat pesanan milik pengguna yang sedang login.
     */
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);

        return view("orders.index", compact("orders"));
    }

    /**
     * Menampilkan rincian/detail satu pesanan spesifik milik pelanggan.
     */
    public function show(Order $order)
    {
        // Pengamanan akses: hanya pemilik pesanan yang diizinkan melihat detail pesanan ini
        abort_if($order->user_id !== Auth::id(), 403);

        $order->load("items");

        return view("orders.show", compact("order"));
    }
}
