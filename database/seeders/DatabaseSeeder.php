<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            "name" => "Admin Cookie Shop",
            "email" => "admin@cookieshop.test",
            "password" => Hash::make("password"),
            "is_admin" => true,
            "phone" => "081234567890",
        ]);

        // Customer contoh
        $customer = User::create([
            "name" => "Budi Santoso",
            "email" => "customer@cookieshop.test",
            "password" => Hash::make("password"),
            "phone" => "081298765432",
        ]);
        Cart::create(["user_id" => $customer->id]);

        // Kategori
        $categories = [
            "Cookies Klasik" => "Kue kering renyah dengan rasa original yang tak lekang waktu.",
            "Cookies Premium" => "Varian kue kering dengan bahan pilihan dan topping istimewa.",
            "Cookies Kekinian" => "Rasa-rasa unik dan tren terbaru.",
            "Paket Hampers" => "Paket hadiah cookies untuk berbagai acara.",
        ];

        $categoryModels = [];
        foreach ($categories as $name => $desc) {
            $categoryModels[$name] = Category::create([
                "name" => $name,
                "slug" => Str::slug($name) . "-" . Str::random(4),
                "description" => $desc,
            ]);
        }

        // Produk + varian (rasa & ukuran)
        $products = [
            [
                "category" => "Cookies Klasik",
                "name" => "Choco Chip Cookies",
                "description" => "Cookies coklat chip klasik dengan tekstur renyah di luar, lembut di dalam.",
                "base_price" => 35000,
                "variants" => [
                    ["name" => "Original - 250gr", "flavor" => "Original", "size" => "250gr", "price" => 35000, "stock" => 40],
                    ["name" => "Original - 500gr", "flavor" => "Original", "size" => "500gr", "price" => 65000, "stock" => 25],
                    ["name" => "Extra Choco - 250gr", "flavor" => "Extra Choco", "size" => "250gr", "price" => 40000, "stock" => 30],
                ],
            ],
            [
                "category" => "Cookies Klasik",
                "name" => "Butter Cookies",
                "description" => "Kue kering mentega gurih dengan aroma khas yang menggoda.",
                "base_price" => 32000,
                "variants" => [
                    ["name" => "Original - 250gr", "flavor" => "Original", "size" => "250gr", "price" => 32000, "stock" => 35],
                    ["name" => "Original - 500gr", "flavor" => "Original", "size" => "500gr", "price" => 60000, "stock" => 20],
                ],
            ],
            [
                "category" => "Cookies Premium",
                "name" => "Red Velvet Cookies",
                "description" => "Cookies red velvet lembut dengan cream cheese di dalamnya.",
                "base_price" => 45000,
                "variants" => [
                    ["name" => "Cream Cheese - 250gr", "flavor" => "Cream Cheese", "size" => "250gr", "price" => 45000, "stock" => 20],
                    ["name" => "Cream Cheese - 500gr", "flavor" => "Cream Cheese", "size" => "500gr", "price" => 85000, "stock" => 15],
                ],
            ],
            [
                "category" => "Cookies Premium",
                "name" => "Almond Crunch Cookies",
                "description" => "Kue kering dengan taburan almond premium yang renyah.",
                "base_price" => 48000,
                "variants" => [
                    ["name" => "Original - 250gr", "flavor" => "Original", "size" => "250gr", "price" => 48000, "stock" => 18],
                ],
            ],
            [
                "category" => "Cookies Kekinian",
                "name" => "Matcha White Choco Cookies",
                "description" => "Perpaduan matcha Jepang dan white chocolate yang unik.",
                "base_price" => 42000,
                "variants" => [
                    ["name" => "Matcha - 250gr", "flavor" => "Matcha", "size" => "250gr", "price" => 42000, "stock" => 22],
                    ["name" => "Matcha - 500gr", "flavor" => "Matcha", "size" => "500gr", "price" => 78000, "stock" => 12],
                ],
            ],
            [
                "category" => "Cookies Kekinian",
                "name" => "Salted Caramel Cookies",
                "description" => "Manis gurih karamel asin yang bikin nagih.",
                "base_price" => 40000,
                "variants" => [
                    ["name" => "Original - 250gr", "flavor" => "Salted Caramel", "size" => "250gr", "price" => 40000, "stock" => 4],
                ],
            ],
            [
                "category" => "Paket Hampers",
                "name" => "Hampers Toples 4 Rasa",
                "description" => "Satu toples besar berisi 4 varian rasa cookies, cocok untuk hadiah.",
                "base_price" => 120000,
                "variants" => [
                    ["name" => "Toples 1kg Mix Rasa", "flavor" => "Mix", "size" => "1kg", "price" => 120000, "stock" => 10],
                ],
            ],
        ];

        foreach ($products as $p) {
            $product = Product::create([
                "category_id" => $categoryModels[$p["category"]]->id,
                "name" => $p["name"],
                "slug" => Str::slug($p["name"]) . "-" . Str::random(4),
                "description" => $p["description"],
                "base_price" => $p["base_price"],
                "is_active" => true,
            ]);

            foreach ($p["variants"] as $v) {
                $product->variants()->create($v);
            }
        }
    }
}
