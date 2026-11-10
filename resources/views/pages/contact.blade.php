@extends('layouts.app')

@section('title', 'Kontak & Lokasi Butik | Crumb & Co.')

@section('content')
<!-- Page Header Banner -->
<section class="bg-crumb-100 py-12 border-b border-crumb-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-3xl">
        <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-2">Hubungi Kami</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-bold text-crumb-800">
            Kunjungi Butik Bakeshop Kami
        </h1>
        <p class="text-sm sm:text-base text-crumb-800/70 mt-3 leading-relaxed">
            Punya pertanyaan mengenai pesanan khusus, katering corporate, atau sekadar ingin menyapa? Kami selalu siap mendengar.
        </p>
    </div>
</section>

<!-- Contact Info & Form Grid -->
<section class="py-16 bg-crumb-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left: Store Information (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Address Card -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-crumb-200 shadow-sm space-y-6">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-crumb-500 block mb-1">Lokasi Kami</span>
                        <h3 class="font-serif text-xl font-bold text-crumb-800">Crumb & Co. Bakeshop Senopati</h3>
                        <p class="text-xs sm:text-sm text-crumb-800/70 mt-2 leading-relaxed">
                            Jl. Senopati No. 42, RT 01 / RW 02, Selong, Kebayoran Baru, Jakarta Selatan, DKI Jakarta 12190
                        </p>
                    </div>

                    <div class="pt-4 border-t border-crumb-100 space-y-3 text-xs sm:text-sm text-crumb-800/80">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-crumb-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <strong class="block text-crumb-800">Jam Buka:</strong>
                                <span>Selasa – Minggu: 07.00 – 19.00 WIB</span><br>
                                <span class="text-amber-600 text-[11px]">(Senin Libur Perawatan Oven)</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 pt-2">
                            <svg class="w-5 h-5 text-crumb-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <div>
                                <strong class="block text-crumb-800">Telepon & WhatsApp:</strong>
                                <a href="https://wa.me/6281234567890" target="_blank" class="text-crumb-500 font-bold hover:underline">
                                    +62 812-3456-7890
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 pt-2">
                            <svg class="w-5 h-5 text-crumb-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <div>
                                <strong class="block text-crumb-800">Email Resmi:</strong>
                                <span>hello@crumbandco.com</span>
                            </div>
                        </div>
                    </div>

                    <!-- Direct WhatsApp Button -->
                    <div class="pt-4 border-t border-crumb-100">
                        <a href="https://wa.me/6281234567890?text=Halo%20Crumb%20%26%20Co.,%20saya%20ingin%20bertanya%20mengenai%20menu%20dan%20pemesanan." 
                           target="_blank" 
                           class="w-full py-3.5 px-6 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-2 transition shadow-md">
                            <span>Chat Langsung via WhatsApp</span>
                            &rarr;
                        </a>
                    </div>
                </div>

                <!-- Google Maps Illustration / Placeholder Card -->
                <div class="rounded-3xl overflow-hidden border border-crumb-200 shadow-sm aspect-video bg-crumb-200 relative">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80" 
                         alt="Interior Bakery Crumb & Co." 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-crumb-900/80 via-transparent to-transparent flex items-end p-6">
                        <div class="text-white text-xs">
                            <span class="font-bold block">Ruang Duduk & Dine-In Nyaman</span>
                            <span class="text-crumb-200/80">Nikmati croissant hangat ditemani secangkir cappuccino segar.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Message Form (7 cols) -->
            <div class="lg:col-span-7 bg-white p-6 sm:p-10 rounded-3xl border border-crumb-200 shadow-sm space-y-6">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-crumb-500 block mb-1">Kirim Pesan</span>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-crumb-800">Sampaikan Pesan Anda</h2>
                    <p class="text-xs sm:text-sm text-crumb-800/70 mt-1">
                        Isi formulir di bawah ini dan tim pelayanan kami akan membalas dalam waktu maksimal 2 jam kerja.
                    </p>
                </div>

                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-crumb-800">Nama Lengkap <span class="text-rose-500">*</span></label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   required 
                                   placeholder="Contoh: Rian Hidayat"
                                   class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('name') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                            @error('name') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-crumb-800">Alamat Email <span class="text-rose-500">*</span></label>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required 
                                   placeholder="nama@email.com"
                                   class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('email') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                            @error('email') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Phone -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-crumb-800">Nomor Telepon / WhatsApp</label>
                            <input type="tel" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   placeholder="081234567890"
                                   class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border border-crumb-200 text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                        </div>

                        <!-- Subject -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-crumb-800">Subjek Pesan <span class="text-rose-500">*</span></label>
                            <input type="text" 
                                   name="subject" 
                                   value="{{ old('subject') }}"
                                   required 
                                   placeholder="Contoh: Pesanan Katering Acara"
                                   class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('subject') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">
                            @error('subject') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-crumb-800">Isi Pesan <span class="text-rose-500">*</span></label>
                        <textarea name="message" 
                                  rows="5" 
                                  required 
                                  placeholder="Tuliskan pesan, pertanyaan, atau detail kebutuhan pemesanan khusus Anda..."
                                  class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('message') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500 transition">{{ old('message') }}</textarea>
                        @error('message') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" 
                                class="px-8 py-4 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs uppercase tracking-wider transition shadow-lg hover:shadow-xl flex items-center gap-2">
                            <span>Kirimkan Pesan Anda</span>
                            &rarr;
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
