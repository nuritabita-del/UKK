<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Mengelola keranjang belanja pengguna (tampil, tambah, ubah jumlah, dan hapus item).
 */
class CartController extends Controller
{
    /**
     * Menampilkan daftar item dalam keranjang belanja pengguna.
     */
    public function index()
    {
        $cart = Auth::user()->cart()->with("items.variant.product")->first();

        return view("cart.index", compact("cart"));
    }

    /**
     * Menambahkan item varian produk ke keranjang belanja.
     */
    public function store(Request $request)
    {
        // Validasi pilihan varian produk dan jumlah pembelian
        $data = $request->validate([
            "product_variant_id" => ["required", "exists:product_variants,id"],
            "quantity" => ["required", "integer", "min:1"],
        ]);

        $variant = ProductVariant::with("product")->findOrFail($data["product_variant_id"]);

        if (! $variant->product || ! $variant->product->is_active) {
            return back()->with("error", "Produk tidak aktif dan tidak dapat dibeli.");
        }

        // Periksa ketersediaan stok produk
        if ($variant->stock < $data["quantity"]) {
            return back()->with("error", "Stok tidak mencukupi. Sisa stok: {$variant->stock}.");
        }

        // Ambil atau buat keranjang belanja untuk pengguna
        $cart = Auth::user()->cart()->firstOrCreate([]);

        $item = $cart->items()->where("product_variant_id", $variant->id)->first();

        // Jika item sudah ada di keranjang, perbarui jumlahnya
        if ($item) {
            $newQty = $item->quantity + $data["quantity"];
            if ($newQty > $variant->stock) {
                return back()->with("error", "Stok tidak mencukupi.");
            }
            $item->update(["quantity" => $newQty]);
        } else {
            // Jika item belum ada, buat record item baru
            $cart->items()->create([
                "product_variant_id" => $variant->id,
                "quantity" => $data["quantity"],
            ]);
        }

        return back()->with("success", "Produk ditambahkan ke keranjang.");
    }

    /**
     * Memperbarui kuantitas item di keranjang belanja.
     */
    public function update(Request $request, $itemId)
    {
        $data = $request->validate([
            "quantity" => ["required", "integer", "min:1"],
        ]);

        $item = Auth::user()->cart->items()->findOrFail($itemId);

        // Periksa stok sebelum memperbarui jumlah
        if ($data["quantity"] > $item->variant->stock) {
            return back()->with("error", "Stok tidak mencukupi.");
        }

        $item->update(["quantity" => $data["quantity"]]);

        return back()->with("success", "Keranjang diperbarui.");
    }

    /**
     * Menghapus item dari keranjang belanja.
     */
    public function destroy($itemId)
    {
        $item = Auth::user()->cart->items()->findOrFail($itemId);
        $item->delete();

        return back()->with("success", "Produk dihapus dari keranjang.");
    }
}
