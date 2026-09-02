<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * Mengelola otentikasi pengguna (Registrasi, Login, dan Logout).
 */
class AuthController extends Controller
{
    /**
     * Menampilkan formulir pendaftaran akun baru.
     */
    public function showRegister()
    {
        return view("auth.register");
    }

    /**
     * Memproses pendaftaran pengguna baru dan membuat keranjang belanja otomatis.
     */
    public function register(Request $request)
    {
        // Validasi input pendaftaran
        $data = $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255", "unique:users,email"],
            "phone" => ["required", "string", "max:20"],
            "password" => ["required", "confirmed", Password::min(8)],
        ]);

        // Buat record user baru
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "phone" => $data["phone"],
            "password" => Hash::make($data["password"]),
        ]);

        // Buat keranjang belanja kosong secara otomatis untuk user baru
        Cart::create(["user_id" => $user->id]);

        // Langsung autentikasi user setelah berhasil mendaftar
        Auth::login($user);

        return redirect()->route("home")->with("success", "Selamat datang, {$user->name}!");
    }

    /**
     * Menampilkan formulir masuk (login).
     */
    public function showLogin()
    {
        return view("auth.login");
    }

    /**
     * Memproses verifikasi kredensial login dan mengarahkan sesuai role user.
     */
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        // Verifikasi email dan password
        if (! Auth::attempt($credentials, $request->boolean("remember"))) {
            return back()->withErrors([
                "email" => "Email atau password salah.",
            ])->onlyInput("email");
        }

        // Regenerasi ID sesi untuk mencegah session fixation
        $request->session()->regenerate();

        // Pengarahan halaman berdasarkan role (Admin / Customer)
        if (Auth::user()->is_admin) {
            return redirect()->intended(route("admin.dashboard"));
        }

        return redirect()->intended(route("home"));
    }

    /**
     * Memproses proses keluar (logout) dan menghapus sesi.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("home");
    }
}
