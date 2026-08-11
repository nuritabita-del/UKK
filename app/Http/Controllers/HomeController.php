<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount("products")->get();

        $featuredProducts = Product::with(["category", "variants"])
            ->where("is_active", true)
            ->latest()
            ->take(8)
            ->get();

        return view("home", compact("categories", "featuredProducts"));
    }

    public function about()
    {
        return view("about");
    }
}
