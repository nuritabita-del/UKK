<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Mengelola alur checkout, pemprosesan pesanan, dan halaman pembayaran.
 */
class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout pesanan.
     */
    public function index()
    {
        $cart = Auth::user()->cart()->with('items.variant.product')->first();

        // Pastikan keranjang belanja tidak kosong
        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu masih kosong.');
        }

        return view('checkout.index', compact('cart'));
    }

    /**
     * Memproses formulir checkout dan membuat pesanan baru dalam transaksi database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input pengiriman
        $data = $request->validate([
            'delivery_method' => ['required', 'in:pickup,delivery'],
            'recipient_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required_if:delivery_method,delivery', 'nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        $cart = Auth::user()->cart()->with('items.variant')->first();

        // Pastikan keranjang tidak kosong
        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu masih kosong.');
        }

        // 2. Verifikasi ketersediaan stok setiap item
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->variant->stock) {
                return back()->with('error', "Stok {$item->variant->name} tidak mencukupi.");
            }
        }

        // 3. Simpan transaksi pesanan dan kurangi stok
        $order = DB::transaction(function () use ($data, $cart) {
            $subtotal = $cart->items->sum(fn ($i) => $i->quantity * $i->variant->price);
            $shippingCost = $data['delivery_method'] === 'delivery' ? 15000 : 0;

            // Buat record pesanan baru
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'delivery_method' => $data['delivery_method'],
                'recipient_name' => $data['recipient_name'],
                'phone' => $data['phone'],
                'address' => $data['address'] ?? null,
                'notes' => $data['notes'] ?? null,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $subtotal + $shippingCost,
                'status' => 'pending',
                'payment_method' => 'qris',
                'payment_status' => Order::PAYMENT_PENDING,
            ]);

            // Simpan detail item pesanan & potong stok produk
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item->variant->id,
                    'product_name' => $item->variant->product->name,
                    'variant_name' => $item->variant->name,
                    'price' => $item->variant->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->quantity * $item->variant->price,
                ]);

                $item->variant->decrement('stock', $item->quantity);
            }

            // Kosongkan keranjang belanja pengguna
            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('checkout.pay', $order)->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    /**
     * Menampilkan halaman instruksi pembayaran QRIS / Bank Transfer.
     */
    public function pay(Order $order)
    {
        // Pengamanan akses: hanya pemilik pesanan yang dapat melihat halaman ini
        abort_if($order->user_id !== Auth::id(), 403);

        $qrisImage = Setting::get('qris_image');
        $bcaNumber = Setting::get('bca_account_number', '1234 5678 90');
        $bcaName = Setting::get('bca_account_name', "Karen's Bakery");

        return view('checkout.pay', compact('order', 'qrisImage', 'bcaNumber', 'bcaName'));
    }
}
