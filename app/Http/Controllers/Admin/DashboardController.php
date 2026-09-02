<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

/**
 * Mengelola kalkulasi statistik dan penyajian ringkasan pada dashboard admin.
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan ringkasan statistik toko (produk, pesanan, pendapatan, stok menipis, dan pesanan terbaru).
     */
    public function index()
    {
        // Kalkulasi metrik utama
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where("status", "pending")->count();
        $revenue = Order::where("status", "paid")
            ->orWhere("status", "completed")
            ->sum("total");

        // Varian produk dengan stok menipis (<= 5)
        $lowStockVariants = ProductVariant::with("product")
            ->where("stock", "<=", 5)
            ->orderBy("stock")
            ->take(5)
            ->get();

        // 5 transaksi pesanan terbaru
        $latestOrders = Order::with("user")->latest()->take(5)->get();

        return view("admin.dashboard", compact(
            "totalProducts", "totalOrders", "pendingOrders", "revenue", "lowStockVariants", "latestOrders"
        ));
    }
}
