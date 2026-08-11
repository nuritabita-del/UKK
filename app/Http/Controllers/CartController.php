<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart()->with("items.variant.product")->first();

        return view("cart.index", compact("cart"));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "product_variant_id" => ["required", "exists:product_variants,id"],
            "quantity" => ["required", "integer", "min:1"],
        ]);

        $variant = ProductVariant::findOrFail($data["product_variant_id"]);

        if ($variant->stock < $data["quantity"]) {
            return back()->with("error", "Stok tidak mencukupi. Sisa stok: {$variant->stock}.");
        }

        $cart = Auth::user()->cart()->firstOrCreate([]);

        $item = $cart->items()->where("product_variant_id", $variant->id)->first();

        if ($item) {
            $newQty = $item->quantity + $data["quantity"];
            if ($newQty > $variant->stock) {
                return back()->with("error", "Stok tidak mencukupi.");
            }
            $item->update(["quantity" => $newQty]);
        } else {
            $cart->items()->create([
                "product_variant_id" => $variant->id,
                "quantity" => $data["quantity"],
            ]);
        }

        return back()->with("success", "Produk ditambahkan ke keranjang.");
    }

    public function update(Request $request, $itemId)
    {
        $data = $request->validate([
            "quantity" => ["required", "integer", "min:1"],
        ]);

        $item = Auth::user()->cart->items()->findOrFail($itemId);

        if ($data["quantity"] > $item->variant->stock) {
            return back()->with("error", "Stok tidak mencukupi.");
        }

        $item->update(["quantity" => $data["quantity"]]);

        return back()->with("success", "Keranjang diperbarui.");
    }

    public function destroy($itemId)
    {
        $item = Auth::user()->cart->items()->findOrFail($itemId);
        $item->delete();

        return back()->with("success", "Produk dihapus dari keranjang.");
    }
}
