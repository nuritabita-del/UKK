<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentProofController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ==========================================
// Rute Publik (Dapat Diakses Tanpa Login)
// ==========================================
Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/tentang-kami", [HomeController::class, "about"])->name("about");
Route::get("/produk", [ProductController::class, "index"])->name("products.index");
Route::get("/produk/{product:slug}", [ProductController::class, "show"])->name("products.show");

// ==========================================
// Rute Autentikasi (Guest & Auth)
// ==========================================
Route::middleware("guest")->group(function () {
    Route::get("/register", [AuthController::class, "showRegister"])->name("register");
    Route::post("/register", [AuthController::class, "register"]);
    Route::get("/login", [AuthController::class, "showLogin"])->name("login");
    Route::post("/login", [AuthController::class, "login"]);
});
Route::post("/logout", [AuthController::class, "logout"])->name("logout")->middleware("auth");

// ==========================================
// Rute Pelanggan / Customer (Wajib Login)
// ==========================================
Route::middleware("auth")->group(function () {
    // Manajemen Keranjang Belanja
    Route::get("/keranjang", [CartController::class, "index"])->name("cart.index");
    Route::post("/keranjang", [CartController::class, "store"])->name("cart.store");
    Route::patch("/keranjang/{item}", [CartController::class, "update"])->name("cart.update");
    Route::delete("/keranjang/{item}", [CartController::class, "destroy"])->name("cart.destroy");

    // Proses Transaksi & Pembayaran
    Route::get("/checkout", [CheckoutController::class, "index"])->name("checkout.index");
    Route::post("/checkout", [CheckoutController::class, "store"])->name("checkout.store");
    Route::get("/checkout/{order}/bayar", [CheckoutController::class, "pay"])->name("checkout.pay");
    Route::post("/checkout/{order}/upload-bukti", [PaymentProofController::class, "store"])->name("checkout.uploadProof");

    // Riwayat & Detail Pesanan Saya
    Route::get("/pesanan-saya", [OrderController::class, "index"])->name("orders.index");
    Route::get("/pesanan-saya/{order}", [OrderController::class, "show"])->name("orders.show");
});

// ==========================================
// Rute Panel Administrator
// ==========================================
Route::prefix("admin")->name("admin.")->middleware(["auth", "admin"])->group(function () {
    // Dashboard Utama
    Route::get("/", [DashboardController::class, "index"])->name("dashboard");

    // Manajemen Kategori Produk
    Route::resource("kategori", AdminCategoryController::class)->parameters(["kategori" => "category"])->names([
        "index" => "categories.index",
        "create" => "categories.create",
        "store" => "categories.store",
        "edit" => "categories.edit",
        "update" => "categories.update",
        "destroy" => "categories.destroy",
    ]);

    // Manajemen Data Produk & Varian
    Route::resource("produk", AdminProductController::class)->parameters(["produk" => "product"])->except(["show"])->names([
        "index" => "products.index",
        "create" => "products.create",
        "store" => "products.store",
        "edit" => "products.edit",
        "update" => "products.update",
        "destroy" => "products.destroy",
    ]);
    Route::patch("/produk/{product}/toggle-status", [AdminProductController::class, "toggleStatus"])->name("products.toggleStatus");

    // Kelola Pesanan & Verifikasi Pembayaran
    Route::get("/pesanan", [AdminOrderController::class, "index"])->name("orders.index");
    Route::get("/pesanan/{order}", [AdminOrderController::class, "show"])->name("orders.show");
    Route::patch("/pesanan/{order}/status", [AdminOrderController::class, "updateStatus"])->name("orders.updateStatus");
    Route::patch("/pesanan/{order}/acc", [AdminOrderController::class, "approvePayment"])->name("orders.approvePayment");
    Route::patch("/pesanan/{order}/tolak", [AdminOrderController::class, "rejectPayment"])->name("orders.rejectPayment");

    // Pengaturan QRIS & Rekening Bank
    Route::get("/pengaturan-qris", [AdminSettingController::class, "edit"])->name("settings.edit");
    Route::post("/pengaturan-qris", [AdminSettingController::class, "update"])->name("settings.update");
});
