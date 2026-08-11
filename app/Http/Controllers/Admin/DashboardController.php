<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where("status", "pending")->count();
        $revenue = Order::where("status", "paid")
            ->orWhere("status", "completed")
            ->sum("total");

        $lowStockVariants = ProductVariant::with("product")
            ->where("stock", "<=", 5)
            ->orderBy("stock")
            ->take(5)
            ->get();

        $latestOrders = Order::with("user")->latest()->take(5)->get();

        return view("admin.dashboard", compact(
            "totalProducts", "totalOrders", "pendingOrders", "revenue", "lowStockVariants", "latestOrders"
        ));
    }
}
