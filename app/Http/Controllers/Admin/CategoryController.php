<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Mengelola data kategori produk (CRUD) untuk panel admin.
 */
class CategoryController extends Controller
{
    /**
     * Menampilkan daftar seluruh kategori produk beserta jumlah produk terkait.
     */
    public function index()
    {
        $categories = Category::withCount("products")->latest()->paginate(15);

        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Menampilkan formulir pembuatan kategori baru.
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Menyimpan data kategori baru ke database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string", "max:255"],
            "description" => ["nullable", "string"],
        ]);

        $data["slug"] = Str::slug($data["name"]) . "-" . Str::random(4);

        Category::create($data);

        return redirect()->route("admin.categories.index")->with("success", "Kategori berhasil ditambahkan.");
    }

    /**
     * Menampilkan formulir penyuntingan kategori.
     */
    public function edit(Category $category)
    {
        return view("admin.categories.edit", compact("category"));
    }

    /**
     * Memperbarui data kategori yang sudah ada.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            "name" => ["required", "string", "max:255"],
            "description" => ["nullable", "string"],
        ]);

        $category->update($data);

        return redirect()->route("admin.categories.index")->with("success", "Kategori berhasil diperbarui.");
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with("success", "Kategori berhasil dihapus.");
    }
}
