<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Mengelola tampilan katalog produk dan rincian produk untuk pelanggan.
 */
class ProductController extends Controller
{
    /**
     * Menampilkan katalog produk aktif dengan fitur pencarian dan penyaringan kategori.
     */
    public function index(Request $request)
    {
        $query = Product::with(["category", "variants"])->where("is_active", true);

        // Filter berdasarkan kategori jika dipilih
        if ($request->filled("category")) {
            $query->whereHas("category", fn ($q) => $q->where("slug", $request->category));
        }

        // Filter berdasarkan kata kunci nama produk
        if ($request->filled("q")) {
            $query->where("name", "like", "%" . $request->q . "%");
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view("products.index", compact("products", "categories"));
    }

    /**
     * Menampilkan detail produk spesifik beserta rekomendasi produk terkait.
     */
    public function show(Product $product)
    {
        if (! $product->is_active) {
            abort(404);
        }

        $product->load(["category", "activeVariants"]);

        // Rekomendasi produk lain dalam kategori yang sama
        $related = Product::where("category_id", $product->category_id)
            ->where("id", "!=", $product->id)
            ->where("is_active", true)
            ->take(4)
            ->get();

        return view("products.show", compact("product", "related"));
    }
}
