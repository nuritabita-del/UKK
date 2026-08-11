<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(["category", "variants"])->where("is_active", true);

        if ($request->filled("category")) {
            $query->whereHas("category", fn ($q) => $q->where("slug", $request->category));
        }

        if ($request->filled("q")) {
            $query->where("name", "like", "%" . $request->q . "%");
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view("products.index", compact("products", "categories"));
    }

    public function show(Product $product)
    {
        $product->load(["category", "activeVariants"]);

        $related = Product::where("category_id", $product->category_id)
            ->where("id", "!=", $product->id)
            ->where("is_active", true)
            ->take(4)
            ->get();

        return view("products.show", compact("product", "related"));
    }
}
