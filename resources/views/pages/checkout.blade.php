@extends('layouts.app')

@section('title', 'Checkout Pesanan | Crumb & Co.')

@section('content')
<!-- Page Header -->
<section class="bg-crumb-100 py-10 border-b border-crumb-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800">
            Checkout & Pembayaran
        </h1>
        <p class="text-xs sm:text-sm text-crumb-800/60 mt-1">Lengkapi data pengiriman dan pilih metode pembayaran pesanan Anda.</p>
    </div>
</section>

<!-- Checkout Form & Summary Grid -->
<section class="py-12 bg-crumb-50" x-data="{ deliveryMethod: 'delivery', paymentMethod: 'bank_transfer' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <form method="POST" action="{{ route('checkout.store') }}" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            @csrf

            <!-- Left: Checkout Details Form (8 cols) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- 1. Customer Information Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-crumb-200/80 shadow-sm space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-crumb-100">
                        <div class="w-8 h-8 rounded-full bg-crumb-800 text-crumb-50 flex items-center justify-center font-bold text-xs">1</div>
                        <h2 class="font-serif text-xl font-bold text-crumb-800">Data Pelanggan & Penerima</h2>
                    </div>

                    @if(!auth()->check())
                        <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 flex items-center justify-between">
                            <span>Sudah punya akun pelanggan?</span>
                            <a href="{{ route('login') }}" class="font-bold underline text-amber-950">Masuk Akun &rarr;</a>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Customer Name -->
                        <div class="space-y-1.5 sm:col-span-2">
                            <label class="block text-xs font-bold text-crumb-800">Nama Lengkap Penerima <span class="text-rose-500">*</span></label>
                            <input type="text" 
                                   name="customer_name" 
                                   value="{{ old('customer_name', $user?->name) }}"
                                   required
                                   placeholder="Contoh: Budi Santoso"
                                   class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('customer_name') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                            @error('customer_name') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Phone / WhatsApp -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-crumb-800">Nomor WhatsApp / Telepon <span class="text-rose-500">*</span></label>
                            <input type="tel" 
                                   name="customer_phone" 
                                   value="{{ old('customer_phone', $user?->phone) }}"
                                   required
                                   placeholder="Contoh: 081234567890"
                                   class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('customer_phone') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                            <p class="text-[10px] text-crumb-400">Untuk update status pesanan dan konfirmasi kurir.</p>
                            @error('customer_phone') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-crumb-800">Alamat Email (Opsional)</label>
                            <input type="email" 
                                   name="customer_email" 
                                   value="{{ old('customer_email', $user?->email) }}"
                                   placeholder="nama@email.com"
                                   class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('customer_email') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                            <p class="text-[10px] text-crumb-400">Untuk pengiriman invoice elektronik.</p>
                            @error('customer_email') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- 2. Delivery Method & Address Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-crumb-200/80 shadow-sm space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-crumb-100">
                        <div class="w-8 h-8 rounded-full bg-crumb-800 text-crumb-50 flex items-center justify-center font-bold text-xs">2</div>
                        <h2 class="font-serif text-xl font-bold text-crumb-800">Metode Pengiriman & Alamat</h2>
                    </div>

                    <!-- Delivery vs Pickup Switcher -->
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative p-4 rounded-2xl border-2 cursor-pointer transition flex flex-col justify-between"
                               :class="deliveryMethod === 'delivery' ? 'border-crumb-800 bg-crumb-50/70' : 'border-crumb-200 hover:border-crumb-300'">
                            <input type="radio" name="delivery_method" value="delivery" x-model="deliveryMethod" class="sr-only">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-5 h-5 text-crumb-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <span class="font-bold text-xs sm:text-sm text-crumb-800">Kirim ke Alamat</span>
                            </div>
                            <span class="text-[11px] text-crumb-600">Kurir instan / sameday langsung ke rumah</span>
                        </label>

                        <label class="relative p-4 rounded-2xl border-2 cursor-pointer transition flex flex-col justify-between"
                               :class="deliveryMethod === 'pickup' ? 'border-crumb-800 bg-crumb-50/70' : 'border-crumb-200 hover:border-crumb-300'">
                            <input type="radio" name="delivery_method" value="pickup" x-model="deliveryMethod" class="sr-only">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-5 h-5 text-crumb-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span class="font-bold text-xs sm:text-sm text-crumb-800">Ambil di Toko (Self-Pickup)</span>
                            </div>
                            <span class="text-[11px] text-crumb-600">Butik Bakeshop Senopati (Gratis Ongkir)</span>
                        </label>
                    </div>

                    <!-- Address Input (Always required for record / confirmation) -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-crumb-800">
                            <span x-text="deliveryMethod === 'delivery' ? 'Alamat Lengkap Pengiriman' : 'Alamat Domisili Pemesan'"></span>
                            <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="shipping_address" 
                                  rows="3" 
                                  required
                                  placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, patokan jalan..."
                                  class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border @error('shipping_address') border-rose-500 @else border-crumb-200 @enderror text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">{{ old('shipping_address', $user?->address) }}</textarea>
                        @error('shipping_address') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Notes -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-crumb-800">Catatan Khusus Pesanan (Opsional)</label>
                        <input type="text" 
                               name="notes" 
                               value="{{ old('notes') }}"
                               placeholder="Contoh: Tolong roti dipotong/slice tebal, titipkan di pos satpam, dll."
                               class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border border-crumb-200 text-xs sm:text-sm text-crumb-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                    </div>
                </div>

                <!-- 3. Payment Method Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-crumb-200/80 shadow-sm space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-crumb-100">
                        <div class="w-8 h-8 rounded-full bg-crumb-800 text-crumb-50 flex items-center justify-center font-bold text-xs">3</div>
                        <h2 class="font-serif text-xl font-bold text-crumb-800">Metode Pembayaran</h2>
                    </div>

                    <div class="space-y-3">
                        <!-- Transfer Bank -->
                        <label class="p-4 rounded-2xl border-2 cursor-pointer transition flex items-center justify-between"
                               :class="paymentMethod === 'bank_transfer' ? 'border-crumb-800 bg-crumb-50/70' : 'border-crumb-200 hover:border-crumb-300'">
                            <div class="flex items-center gap-3.5">
                                <input type="radio" name="payment_method" value="bank_transfer" x-model="paymentMethod" class="text-crumb-800 focus:ring-crumb-500">
                                <div>
                                    <span class="block font-bold text-xs sm:text-sm text-crumb-800">Transfer Bank / Virtual Account (BCA, Mandiri, BRI)</span>
                                    <span class="block text-[11px] text-crumb-600 mt-0.5">Petunjuk nomor rekening akan tertera otomatis setelah tombol pesan ditekan.</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold px-2.5 py-1 bg-crumb-200 text-crumb-800 rounded-lg shrink-0">BCA / Mandiri</span>
                        </label>

                        <!-- QRIS -->
                        <label class="p-4 rounded-2xl border-2 cursor-pointer transition flex items-center justify-between"
                               :class="paymentMethod === 'qris' ? 'border-crumb-800 bg-crumb-50/70' : 'border-crumb-200 hover:border-crumb-300'">
                            <div class="flex items-center gap-3.5">
                                <input type="radio" name="payment_method" value="qris" x-model="paymentMethod" class="text-crumb-800 focus:ring-crumb-500">
                                <div>
                                    <span class="block font-bold text-xs sm:text-sm text-crumb-800">QRIS (Gopay, OVO, DANA, ShopeePay, Mobile Banking)</span>
                                    <span class="block text-[11px] text-crumb-600 mt-0.5">Pindai kode QR instan dari semua e-wallet dan aplikasi bank Indonesia.</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold px-2.5 py-1 bg-crumb-200 text-crumb-800 rounded-lg shrink-0">QRIS All</span>
                        </label>

                        <!-- COD -->
                        <label class="p-4 rounded-2xl border-2 cursor-pointer transition flex items-center justify-between"
                               :class="paymentMethod === 'cod' ? 'border-crumb-800 bg-crumb-50/70' : 'border-crumb-200 hover:border-crumb-300'">
                            <div class="flex items-center gap-3.5">
                                <input type="radio" name="payment_method" value="cod" x-model="paymentMethod" class="text-crumb-800 focus:ring-crumb-500">
                                <div>
                                    <span class="block font-bold text-xs sm:text-sm text-crumb-800">Cash on Delivery (Bayar Tunai saat Roti Diterima)</span>
                                    <span class="block text-[11px] text-crumb-600 mt-0.5">Bayar langsung kepada kurir kami saat roti hangat tiba di lokasi Anda.</span>
                                </div>
                            </div>
                            <span class="text-xs font-bold px-2.5 py-1 bg-crumb-200 text-crumb-800 rounded-lg shrink-0">COD</span>
                        </label>
                    </div>
                </div>

            </div>

            <!-- Right: Order Summary Sidebar (4 cols) -->
            <div class="lg:col-span-4 bg-white rounded-3xl p-6 border border-crumb-200/80 shadow-sm space-y-6 sticky top-28">
                <h3 class="font-serif text-lg font-bold text-crumb-800 pb-3 border-b border-crumb-100 flex items-center justify-between">
                    <span>Item Pesanan</span>
                    <span class="text-xs font-sans text-crumb-500 font-semibold">{{ count($cart) }} macam</span>
                </h3>

                <!-- Items Mini List -->
                <div class="space-y-3 max-h-72 overflow-y-auto divide-y divide-crumb-100 pr-1">
                    @foreach($cart as $item)
                        <div class="pt-3 first:pt-0 flex items-center justify-between gap-3 text-xs">
                            <div class="flex items-center gap-3 min-w-0">
                                <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="w-12 h-12 rounded-xl object-cover bg-crumb-100 shrink-0">
                                <div class="min-w-0">
                                    <p class="font-bold text-crumb-800 truncate">{{ $item['name'] }}</p>
                                    <p class="text-[11px] text-crumb-500">{{ $item['quantity'] }} &times; Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <span class="font-bold text-crumb-800 shrink-0">
                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Price Calculations -->
                <div class="space-y-2.5 pt-4 border-t border-crumb-100 text-xs text-crumb-800/80">
                    <div class="flex justify-between">
                        <span>Subtotal Belanja</span>
                        <span class="font-bold text-crumb-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between items-center" x-show="deliveryMethod === 'delivery'">
                        <span>Ongkos Kirim</span>
                        @if($shipping === 0)
                            <span class="font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">GRATIS ONGKIR</span>
                        @else
                            <span class="font-bold text-crumb-800">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <div class="flex justify-between items-center" x-show="deliveryMethod === 'pickup'" x-cloak>
                        <span>Ongkos Kirim (Pickup)</span>
                        <span class="font-bold text-emerald-600">GRATIS</span>
                    </div>

                    <div class="pt-3 border-t border-crumb-200 flex justify-between items-baseline">
                        <span class="text-sm font-bold text-crumb-800">Total Pembayaran</span>
                        <span class="font-serif text-2xl font-bold text-crumb-600" 
                              x-text="deliveryMethod === 'pickup' ? 'Rp {{ number_format($subtotal, 0, ',', '.') }}' : 'Rp {{ number_format($total, 0, ',', '.') }}'">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-4 px-6 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-sm tracking-wide text-center transition shadow-xl hover:shadow-2xl flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Konfirmasi & Buat Pesanan</span>
                </button>

                <p class="text-[11px] text-center text-crumb-800/60 leading-relaxed">
                    Dengan menekan tombol di atas, pesanan Anda akan langsung diproses oleh tim baker Crumb & Co.
                </p>
            </div>

        </form>

    </div>
</section>
@endsection
