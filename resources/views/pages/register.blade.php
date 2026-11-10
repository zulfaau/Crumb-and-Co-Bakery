@extends('layouts.app')

@section('title', 'Daftar Akun Pelanggan | Crumb & Co.')

@section('content')
<section class="py-16 bg-crumb-50 min-h-[80vh] flex items-center justify-center">
    <div class="max-w-md w-full mx-auto px-4">
        
        <div class="bg-white rounded-3xl p-8 border border-crumb-200/80 shadow-xl space-y-6">
            <!-- Brand Badge -->
            <div class="text-center space-y-2">
                <div class="w-12 h-12 mx-auto rounded-full bg-crumb-800 text-crumb-50 flex items-center justify-center font-serif font-bold text-2xl shadow-md">
                    c.
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-crumb-800">Daftar Akun Baru</h1>
                <p class="text-xs text-crumb-800/60">Bergabunglah dengan komunitas pencinta roti artisan Crumb & Co.</p>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-crumb-800">Nama Lengkap</label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           placeholder="Contoh: Sarah Wijaya"
                           class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('name') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                    @error('name') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-crumb-800">Alamat Email</label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           placeholder="nama@email.com"
                           class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('email') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                    @error('email') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                </div>

                <!-- Phone -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-crumb-800">Nomor WhatsApp / Telepon</label>
                    <input type="tel" 
                           name="phone" 
                           value="{{ old('phone') }}" 
                           placeholder="081234567890"
                           class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('phone') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                    @error('phone') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                </div>

                <!-- Address -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-crumb-800">Alamat Pengiriman (Opsional)</label>
                    <textarea name="address" 
                              rows="2" 
                              placeholder="Alamat domisili atau kantor Anda..."
                              class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('address') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">{{ old('address') }}</textarea>
                    @error('address') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-crumb-800">Kata Sandi (Min. 6 Karakter)</label>
                    <input type="password" 
                           name="password" 
                           required
                           placeholder="••••••••"
                           class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('password') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                    @error('password') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-crumb-800">Konfirmasi Kata Sandi</label>
                    <input type="password" 
                           name="password_confirmation" 
                           required
                           placeholder="••••••••"
                           class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border border-crumb-200 text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3.5 px-6 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs uppercase tracking-wider transition shadow-lg hover:shadow-xl">
                    Daftar Sekarang &rarr;
                </button>
            </form>

            <div class="pt-2 text-center text-xs text-crumb-800/60 border-t border-crumb-100">
                <span>Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="font-bold text-crumb-500 hover:underline ml-1">Masuk di sini</a>
            </div>
        </div>

    </div>
</section>
@endsection
