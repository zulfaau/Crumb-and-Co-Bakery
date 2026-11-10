@extends('layouts.app')

@section('title', 'Masuk Akun | Crumb & Co.')

@section('content')
<section class="py-16 bg-crumb-50 min-h-[75vh] flex items-center justify-center">
    <div class="max-w-md w-full mx-auto px-4">
        
        <div class="bg-white rounded-3xl p-8 border border-crumb-200/80 shadow-xl space-y-6">
            <!-- Brand Badge -->
            <div class="text-center space-y-2">
                <div class="w-12 h-12 mx-auto rounded-full bg-crumb-800 text-crumb-50 flex items-center justify-center font-serif font-bold text-2xl shadow-md">
                    c.
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-crumb-800">Selamat Datang Kembali</h1>
                <p class="text-xs text-crumb-800/60">Masuk untuk melihat pesanan atau mengelola toko Anda.</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-crumb-800">Alamat Email</label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           placeholder="nama@email.com"
                           class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('email') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                    @error('email') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-crumb-800">Kata Sandi</label>
                    <input type="password" 
                           name="password" 
                           required
                           placeholder="••••••••"
                           class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('password') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                    @error('password') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 text-crumb-800/80 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded text-crumb-800 focus:ring-crumb-500">
                        <span>Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3.5 px-6 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs uppercase tracking-wider transition shadow-lg hover:shadow-xl">
                    Masuk Sekarang &rarr;
                </button>
            </form>

            <!-- Quick Demo Credentials Box -->
            <div class="p-4 rounded-2xl bg-crumb-50 border border-crumb-200 text-xs space-y-2">
                <span class="font-bold text-crumb-800 block text-[11px] uppercase tracking-wider">Akun Bawaan (Demo):</span>
                <div class="flex flex-col gap-1 text-[11px] text-crumb-700">
                    <p><strong>Admin:</strong> <code>admin@crumbandco.com</code> | <code>password123</code></p>
                    <p><strong>Pelanggan:</strong> <code>pelanggan@crumbandco.com</code> | <code>password123</code></p>
                </div>
            </div>

            <div class="pt-2 text-center text-xs text-crumb-800/60 border-t border-crumb-100">
                <span>Belum memiliki akun?</span>
                <a href="{{ route('register') }}" class="font-bold text-crumb-500 hover:underline ml-1">Daftar Akun Baru</a>
            </div>
        </div>

    </div>
</section>
@endsection
