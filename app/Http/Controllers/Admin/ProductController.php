<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with("category")->withCount("variants");

        if ($request->filled("q")) {
            $query->where("name", "like", "%" . $request->q . "%");
        }

        $products = $query->latest()->paginate(15)->withQueryString();

        return view("admin.products.index", compact("products"));
    }

    public function create()
    {
        $categories = Category::all();

        return view("admin.products.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);

        if ($request->hasFile("image")) {
            $data["image"] = $request->file("image")->store("products", "public");
        }

        $data["slug"] = Str::slug($data["name"]) . "-" . Str::random(4);
        $data["is_active"] = $request->boolean("is_active", true);

        $variants = $data["variants"] ?? [];
        unset($data["variants"]);

        $product = Product::create($data);

        foreach ($variants as $variant) {
            $product->variants()->create($variant);
        }

        return redirect()->route("admin.products.index")->with("success", "Produk berhasil ditambahkan.");
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load("variants");

        return view("admin.products.edit", compact("product", "categories"));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);

        if ($request->hasFile("image")) {
            if ($product->image) {
                Storage::disk("public")->delete($product->image);
            }
            $data["image"] = $request->file("image")->store("products", "public");
        }

        $data["is_active"] = $request->boolean("is_active", true);

        $variants = $data["variants"] ?? [];
        unset($data["variants"]);

        $product->update($data);

        // Sinkronisasi varian: hapus yang tidak ada di form, update yang ada, buat yang baru.
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

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk("public")->delete($product->image);
        }

        $product->delete();

        return back()->with("success", "Produk berhasil dihapus.");
    }

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
