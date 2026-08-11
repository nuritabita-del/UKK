<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view("auth.register");
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255", "unique:users,email"],
            "phone" => ["required", "string", "max:20"],
            "password" => ["required", "confirmed", Password::min(8)],
        ]);

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "phone" => $data["phone"],
            "password" => Hash::make($data["password"]),
        ]);

        Cart::create(["user_id" => $user->id]);

        Auth::login($user);

        return redirect()->route("home")->with("success", "Selamat datang, {$user->name}!");
    }

    public function showLogin()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        if (! Auth::attempt($credentials, $request->boolean("remember"))) {
            return back()->withErrors([
                "email" => "Email atau password salah.",
            ])->onlyInput("email");
        }

        $request->session()->regenerate();

        if (Auth::user()->is_admin) {
            return redirect()->intended(route("admin.dashboard"));
        }

        return redirect()->intended(route("home"));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("home");
    }
}
