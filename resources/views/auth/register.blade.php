@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="max-w-md mx-auto my-4 sm:my-8">

    <div class="bg-[#3D3732] rounded-2xl shadow-2xl border border-[#4E4640] overflow-hidden">
        <!-- Top Gradient Accent -->
        <div class="h-2 bg-gradient-to-r from-[#72383D] via-[#E2C599] to-[#8C464C]"></div>

        <div class="p-6 sm:p-8 space-y-6">
            
            <!-- Header Section -->
            <div class="text-center space-y-2">
                <div class="w-14 h-14 rounded-2xl bg-[#24201D] text-[#E2C599] flex items-center justify-center mx-auto shadow-inner border border-[#4E4640]">
                    <svg class="w-7 h-7 text-[#E2C599]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
                <h1 class="text-2xl font-extrabold text-white tracking-tight">Buat Akun Baru</h1>
                <p class="text-xs text-[#BBAE9F]">Daftar akun sekarang dan mulailah memesan kue favoritmu!</p>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Nama Lengkap Field -->
                <div>
                    <label for="name" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                        Nama Lengkap <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           placeholder="Contoh: Budi Santoso" 
                           class="w-full px-4 py-2.5 rounded-xl border text-white placeholder-[#BBAE9F] text-sm bg-[#24201D] transition-all focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] @error('name') border-rose-500 bg-rose-950/30 @else border-[#4E4640] @enderror">
                    @error('name')
                        <p class="mt-1 text-xs font-semibold text-rose-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                        Email Address <span class="text-rose-400">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           placeholder="nama@email.com" 
                           class="w-full px-4 py-2.5 rounded-xl border text-white placeholder-[#BBAE9F] text-sm bg-[#24201D] transition-all focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] @error('email') border-rose-500 bg-rose-950/30 @else border-[#4E4640] @enderror">
                    @error('email')
                        <p class="mt-1 text-xs font-semibold text-rose-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- No HP Field -->
                <div>
                    <label for="phone" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                        No. HP / WhatsApp <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone') }}" 
                           required 
                           placeholder="081234567890" 
                           class="w-full px-4 py-2.5 rounded-xl border text-white placeholder-[#BBAE9F] text-sm bg-[#24201D] transition-all focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] @error('phone') border-rose-500 bg-rose-950/30 @else border-[#4E4640] @enderror">
                    @error('phone')
                        <p class="mt-1 text-xs font-semibold text-rose-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                        Password <span class="text-rose-400">*</span>
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           placeholder="••••••••" 
                           class="w-full px-4 py-2.5 rounded-xl border text-white placeholder-[#BBAE9F] text-sm bg-[#24201D] transition-all focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D] @error('password') border-rose-500 bg-rose-950/30 @else border-[#4E4640] @enderror">
                    @error('password')
                        <p class="mt-1 text-xs font-semibold text-rose-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-[#E8D5B7] mb-1.5 uppercase tracking-wider">
                        Konfirmasi Password <span class="text-rose-400">*</span>
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           required 
                           placeholder="••••••••" 
                           class="w-full px-4 py-2.5 rounded-xl border border-[#4E4640] text-white placeholder-[#BBAE9F] text-sm bg-[#24201D] transition-all focus:outline-none focus:bg-[#2A2522] focus:ring-2 focus:ring-[#72383D]/40 focus:border-[#72383D]">
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#72383D] to-[#8C464C] hover:from-[#8C464C] hover:to-[#72383D] text-white font-extrabold text-sm shadow-lg shadow-[#72383D]/30 hover:shadow-xl active:scale-[0.99] transition-all duration-150 flex items-center justify-center gap-2 mt-2 border border-[#8C464C]">
                    <span>Daftar Akun</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

            <!-- Bottom Login Redirect -->
            <div class="pt-4 border-t border-[#4E4640] text-center text-xs text-[#BBAE9F]">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-extrabold text-[#E2C599] hover:text-[#F2E3CD] underline transition-colors">
                    Masuk di sini
                </a>
            </div>

        </div>
    </div>

</div>
@endsection

