@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="max-w-md mx-auto my-4 sm:my-8">

    <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden">
        <!-- Top Gradient Accent -->
        <div class="h-2 bg-gradient-to-r from-[#72383D] via-[#E2C599] to-[#8C464C]"></div>

        <div class="p-6 sm:p-8 space-y-6">
            
            <!-- Header Section -->
            <div class="text-center space-y-2">
                <div class="w-14 h-14 rounded-2xl bg-[#24201D] text-[#E2C599] flex items-center justify-center mx-auto shadow-inner border border-[#4E4640]">
                    <svg class="w-7 h-7 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h1 class="text-2xl font-extrabold text-white tracking-tight">Masuk ke Akunmu</h1>
                <p class="text-xs text-[#BBAE9F]">Selamat datang kembali! Masuk untuk melihat kue favoritmu.</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                        Email Address <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#BBAE9F]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        </div>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               placeholder="nama@email.com" 
                               class="w-full pl-10 pr-4 py-3 rounded-xl border text-white placeholder-[#BBAE9F] text-sm bg-[#24201D] transition-all focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] @error('email') border-rose-500 bg-rose-950/30 @else border-[#4E4640] @enderror">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs font-semibold text-rose-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                        Password <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-[#BBAE9F]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required 
                               placeholder="••••••••" 
                               class="w-full pl-10 pr-10 py-3 rounded-xl border border-[#4E4640] text-white placeholder-[#BBAE9F] text-sm bg-[#24201D] transition-all focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D]">
                        
                        <!-- Show/Hide Password Toggle -->
                        <button type="button" 
                                onclick="togglePasswordVisibility('password', 'eye-icon')" 
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-[#BBAE9F] hover:text-white transition-colors">
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none text-xs font-semibold text-[#E8D5B7]">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-[#4E4640] bg-[#24201D] text-[#72383D] focus:ring-[#72383D]/30">
                        Ingat Saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-extrabold text-sm shadow-lg shadow-[#72383D]/30 hover:shadow-xl active:scale-[0.99] transition-all duration-150 flex items-center justify-center gap-2 border border-[#8C464C]">
                    <span>Masuk</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

            <!-- Bottom Register Redirect -->
            <div class="pt-4 border-t border-[#4E4640] text-center text-xs text-[#BBAE9F]">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-extrabold text-[#E2C599] hover:text-[#F2E3CD] underline transition-colors">
                    Daftar di sini
                </a>
            </div>

        </div>
    </div>

</div>

<script>
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>
@endsection


