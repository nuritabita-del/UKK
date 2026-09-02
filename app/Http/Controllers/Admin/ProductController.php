<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Mengelola kelola produk dan variannya (CRUD) untuk panel admin.
 */
class ProductController extends Controller
{
    /**
     * Menampilkan daftar seluruh produk beserta jumlah varian dan pencarian.
     */
    public function index(Request $request)
    {
        $query = Product::with("category")->withCount("variants");

        if ($request->filled("q")) {
            $query->where("name", "like", "%" . $request->q . "%");
        }

        $products = $query->latest()->paginate(15)->withQueryString();

        return view("admin.products.index", compact("products"));
    }

    /**
     * Menampilkan formulir penambahan produk baru.
     */
    public function create()
    {
        $categories = Category::all();

        return view("admin.products.create", compact("categories"));
    }

    /**
     * Menyimpan data produk baru beserta gambar dan variannya ke database.
     */
    public function store(Request $request)
    {
        $data = $this->validateProduct($request);

        // Unggah gambar produk jika tersedia
        if ($request->hasFile("image")) {
            $data["image"] = $request->file("image")->store("products", "public");
        }

        $data["slug"] = Str::slug($data["name"]) . "-" . Str::random(4);
        $data["is_active"] = $request->boolean("is_active");

        $variants = $data["variants"] ?? [];
        unset($data["variants"]);

        // Simpan data produk utama
        $product = Product::create($data);

        // Simpan setiap varian produk
        foreach ($variants as $variant) {
            $product->variants()->create($variant);
        }

        return redirect()->route("admin.products.index")->with("success", "Produk berhasil ditambahkan.");
    }

    /**
     * Menampilkan formulir penyuntingan produk dan variannya.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load("variants");

        return view("admin.products.edit", compact("product", "categories"));
    }

    /**
     * Memperbarui data produk, mengganti gambar, dan mengoperasikan sinkronisasi varian.
     */
    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);

        // Ganti gambar jika diunggah file baru
        if ($request->hasFile("image")) {
            if ($product->image) {
                Storage::disk("public")->delete($product->image);
            }
            $data["image"] = $request->file("image")->store("products", "public");
        }

        $data["is_active"] = $request->boolean("is_active");

        $variants = $data["variants"] ?? [];
        unset($data["variants"]);

        $product->update($data);

        // Sinkronisasi varian: hapus varian yang dihilangkan dari form, perbarui yang ada, buat varian baru
        $existingIds = collect($variants)->pluck("id")->filter()->toArray();
        $product->variants()->whereNotIn("id", $existingIds)->delete();

        foreach ($variants as $variant) {
            if (! empty($variant["id"])) {
                $product->variants()->where("id", $variant["id"])->update(collect($variant)->except("id")->toArray());
            } else {
                $product->variants()->create(collect($variant)->except("id")->toArray());
            }
        }

        return redirect()->route("admin.products.index")->with("success", "Produk berhasil diperbarui.");
    }

    /**
     * Menghapus produk beserta gambar terkait dari sistem.
     */
    public function destroy(Product $product)
    {
        // Hapus file gambar dari penyimpanan jika ada
        if ($product->image) {
            Storage::disk("public")->delete($product->image);
        }

        $product->delete();

        return back()->with("success", "Produk berhasil dihapus.");
    }

    /**
     * Mengubah status aktif/nonaktif produk secara instan.
     */
    public function toggleStatus(Product $product)
    {
        $product->update([
            "is_active" => ! $product->is_active,
        ]);

        $statusLabel = $product->is_active ? "diaktifkan (tampil di toko)" : "dinonaktifkan (disembunyikan dari toko)";

        return back()->with("success", "Status produk \"{$product->name}\" berhasil {$statusLabel}.");
    }

    /**
     * Validasi aturan form untuk data produk dan variannya.
     */
    private function validateProduct(Request $request): array
    {
        return $request->validate([
            "category_id" => ["nullable", "exists:categories,id"],
            "name" => ["required", "string", "max:255"],
            "description" => ["nullable", "string"],
            "base_price" => ["required", "numeric", "min:0"],
            "image" => ["nullable", "image", "max:2048"],
            "is_active" => ["nullable", "boolean"],
            "variants" => ["required", "array", "min:1"],
            "variants.*.id" => ["nullable", "integer"],
            "variants.*.name" => ["required", "string", "max:255"],
            "variants.*.flavor" => ["nullable", "string", "max:255"],
            "variants.*.size" => ["nullable", "string", "max:255"],
            "variants.*.sku" => ["nullable", "string", "max:255"],
            "variants.*.price" => ["required", "numeric", "min:0"],
            "variants.*.stock" => ["required", "integer", "min:0"],
        ]);
    }
}
