<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

/**
 * Mengelola halaman beranda (Home) dan halaman informasi (Tentang Kami).
 */
class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama toko beserta daftar kategori dan produk unggulan.
     */
    public function index()
    {
        // Ambil kategori beserta jumlah produk aktif di dalamnya
        $categories = Category::withCount(["products" => fn ($q) => $q->where("is_active", true)])->get();

        // Ambil 8 produk aktif terbaru untuk ditampilkan di beranda
        $featuredProducts = Product::with(["category", "variants"])
            ->where("is_active", true)
            ->latest()
            ->take(8)
            ->get();

        return view("home", compact("categories", "featuredProducts"));
    }

    /**
     * Menampilkan halaman informasi profil toko (Tentang Kami).
     */
    public function about()
    {
        return view("about");
    }
}
