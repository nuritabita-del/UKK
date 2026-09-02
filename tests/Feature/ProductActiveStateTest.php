<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductActiveStateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_deactivate_product()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $category = Category::create([
            'name' => 'Cookies',
            'slug' => 'cookies',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Choco Cookie',
            'slug' => 'choco-cookie-1234',
            'base_price' => 15000,
            'is_active' => true,
        ]);

        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'name' => 'Varian Top',
            'price' => 15000,
            'stock' => 10,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.products.update', ['product' => $product->id]), [
            'name' => $product->name,
            'category_id' => $category->id,
            'base_price' => $product->base_price,
            'is_active' => '0',
            'variants' => [
                [
                    'id' => $variant->id,
                    'name' => $variant->name,
                    'price' => $variant->price,
                    'stock' => $variant->stock,
                ]
            ],
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'is_active' => false,
        ]);
    }

    public function test_admin_can_toggle_product_status_instantly()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $product = Product::create([
            'name' => 'Test Cookie',
            'slug' => 'test-cookie',
            'base_price' => 10000,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->patch(route('admin.products.toggleStatus', $product));
        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'is_active' => false,
        ]);

        $response2 = $this->actingAs($admin)->patch(route('admin.products.toggleStatus', $product));
        $response2->assertRedirect();
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'is_active' => true,
        ]);
    }

    public function test_deactivated_product_is_hidden_from_public_catalog_and_returns_404_on_detail()
    {
        $category = Category::create([
            'name' => 'Cookies',
            'slug' => 'cookies',
        ]);

        $activeProduct = Product::create([
            'category_id' => $category->id,
            'name' => 'Kue Aktif',
            'slug' => 'kue-aktif',
            'base_price' => 20000,
            'is_active' => true,
        ]);

        $inactiveProduct = Product::create([
            'category_id' => $category->id,
            'name' => 'Kue Nonaktif',
            'slug' => 'kue-nonaktif',
            'base_price' => 20000,
            'is_active' => false,
        ]);

        // Catalog index check
        $response = $this->get(route('products.index'));
        $response->assertStatus(200);
        $response->assertSee('Kue Aktif');
        $response->assertDontSee('Kue Nonaktif');

        // Product detail page check
        $detailResponse = $this->get(route('products.show', $inactiveProduct->slug));
        $detailResponse->assertStatus(404);
    }

    public function test_cannot_add_inactive_product_to_cart()
    {
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $category = Category::create([
            'name' => 'Cookies',
            'slug' => 'cookies',
        ]);

        $inactiveProduct = Product::create([
            'category_id' => $category->id,
            'name' => 'Kue Nonaktif',
            'slug' => 'kue-nonaktif',
            'base_price' => 20000,
            'is_active' => false,
        ]);

        $variant = ProductVariant::create([
            'product_id' => $inactiveProduct->id,
            'name' => 'Varian Top',
            'price' => 20000,
            'stock' => 10,
        ]);

        $response = $this->actingAs($user)->post(route('cart.store'), [
            'product_variant_id' => $variant->id,
            'quantity' => 1,
        ]);

        $response->assertSessionHas('error', 'Produk tidak aktif dan tidak dapat dibeli.');
    }
}
