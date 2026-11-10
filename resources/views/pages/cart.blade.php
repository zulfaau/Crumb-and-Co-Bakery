@extends('layouts.app')

@section('title', 'Keranjang Belanja | Crumb & Co.')

@section('content')
<!-- Page Header Banner -->
<section class="bg-crumb-100 py-10 border-b border-crumb-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800">
            Keranjang Belanja Anda
        </h1>
        <p class="text-xs sm:text-sm text-crumb-800/60 mt-1">Periksa pesanan roti dan pastry pilihan Anda sebelum checkout.</p>
    </div>
</section>

<!-- Cart Content Section -->
<section class="py-12 bg-crumb-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(empty($cart))
            <!-- Empty Cart Card -->
            <div class="max-w-xl mx-auto text-center bg-white rounded-3xl p-12 border border-crumb-200 shadow-sm space-y-4">
                <div class="w-20 h-20 mx-auto rounded-full bg-crumb-100 flex items-center justify-center text-crumb-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h2 class="font-serif text-2xl font-bold text-crumb-800">Keranjang Anda Masih Kosong</h2>
                <p class="text-xs sm:text-sm text-crumb-800/70 max-w-sm mx-auto leading-relaxed">
                    Belum ada roti atau pastry yang dipilih. Yuk, temukan roti segar yang baru keluar dari oven kami!
                </p>
                <div class="pt-4">
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
                        Jelajahi Menu Toko &rarr;
                    </a>
                </div>
            </div>
        @else
            <!-- Free Shipping Progress Box -->
            <div class="bg-amber-50 rounded-2xl p-4 sm:p-5 border border-amber-200/70 mb-8 max-w-4xl mx-auto shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2 text-xs font-semibold">
                    @if($totals['amount_left_free_shipping'] > 0)
                        <span class="text-amber-900">
                            Tambah <strong class="text-amber-700 font-bold">Rp {{ number_format($totals['amount_left_free_shipping'], 0, ',', '.') }}</strong> lagi untuk mendapatkan <strong>GRATIS Ongkir</strong> se-Jakarta!
                        </span>
                    @else
                        <span class="text-emerald-800 font-bold flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Hebat! Anda mendapatkan penawaran GRATIS Ongkos Kirim!
                        </span>
                    @endif
                    <span class="text-amber-800/70 text-[11px]">Min. Rp 150.000</span>
                </div>
                <div class="w-full bg-amber-200/60 rounded-full h-2 overflow-hidden">
                    <div class="bg-amber-600 h-2 rounded-full transition-all duration-500" style="width: {{ $totals['progress'] }}%"></div>
                </div>
            </div>

            <!-- Cart Grid (Items & Summary) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: Cart Items List -->
                <div class="lg:col-span-8 bg-white rounded-3xl p-6 border border-crumb-200/80 shadow-sm divide-y divide-crumb-100">
                    <div class="pb-4 flex items-center justify-between text-xs text-crumb-800/60 font-medium">
                        <span>Daftar Produk ({{ count($cart) }} item)</span>
                        <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Kosongkan semua isi keranjang?')">
                            @csrf
                            <button type="submit" class="text-rose-600 hover:text-rose-800 text-xs font-semibold">
                                Kosongkan Keranjang
                            </button>
                        </form>
                    </div>

                    @foreach($cart as $id => $item)
                        <div class="py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <!-- Product Info -->
                            <div class="flex items-center gap-4">
                                <img src="{{ $item['image_url'] }}" 
                                     alt="{{ $item['name'] }}" 
                                     class="w-20 h-20 rounded-2xl object-cover bg-crumb-100 shrink-0 border border-crumb-200/50">
                                <div>
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-crumb-500 block">
                                        {{ $item['category_name'] }}
                                    </span>
                                    <h3 class="font-serif text-base font-bold text-crumb-800">
                                        <a href="{{ route('shop.show', $item['slug']) }}" class="hover:text-crumb-500 transition">
                                            {{ $item['name'] }}
                                        </a>
                                    </h3>
                                    <span class="text-xs font-bold text-crumb-600">
                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Quantity Controls & Subtotal -->
                            <div class="flex items-center justify-between w-full sm:w-auto gap-6 sm:justify-end">
                                <!-- Quantity Form -->
                                <div class="flex items-center border border-crumb-200 rounded-full bg-crumb-50 p-1">
                                    <form method="POST" action="{{ route('cart.update') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <input type="hidden" name="quantity" value="{{ max(0, $item['quantity'] - 1) }}">
                                        <button type="submit" class="w-7 h-7 rounded-full flex items-center justify-center text-crumb-800 hover:bg-crumb-200 transition font-bold text-xs">-</button>
                                    </form>
                                    <span class="w-8 text-center text-xs font-bold">{{ $item['quantity'] }}</span>
                                    <form method="POST" action="{{ route('cart.update') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <input type="hidden" name="quantity" value="{{ min(50, $item['quantity'] + 1) }}">
                                        <button type="submit" class="w-7 h-7 rounded-full flex items-center justify-center text-crumb-800 hover:bg-crumb-200 transition font-bold text-xs">+</button>
                                    </form>
                                </div>

                                <!-- Item Subtotal -->
                                <div class="text-right min-w-[90px]">
                                    <span class="text-sm font-bold text-crumb-800 block">
                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </span>
                                    <form method="POST" action="{{ route('cart.remove') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <button type="submit" class="text-[11px] text-rose-500 hover:text-rose-700">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="pt-6 flex justify-between items-center">
                        <a href="{{ route('shop.index') }}" class="text-xs font-bold text-crumb-800 hover:text-crumb-500 transition flex items-center gap-1.5">
                            &larr; Tambah Roti Lainnya
                        </a>
                    </div>
                </div>

                <!-- Right: Order Summary Card -->
                <div class="lg:col-span-4 bg-white rounded-3xl p-6 border border-crumb-200/80 shadow-sm space-y-6 sticky top-28">
                    <h3 class="font-serif text-lg font-bold text-crumb-800 pb-3 border-b border-crumb-100">
                        Ringkasan Pesanan
                    </h3>

                    <div class="space-y-3 text-xs text-crumb-800/80">
                        <div class="flex justify-between">
                            <span>Subtotal Belanja</span>
                            <span class="font-bold text-crumb-800">Rp {{ number_format($totals['subtotal'], 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Perkiraan Ongkir</span>
                            @if($totals['shipping'] === 0)
                                <span class="font-bold text-emerald-600">GRATIS</span>
                            @else
                                <span class="font-bold text-crumb-800">Rp {{ number_format($totals['shipping'], 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="pt-3 border-t border-crumb-200 flex justify-between items-baseline">
                            <span class="text-sm font-bold text-crumb-800">Total Akhir</span>
                            <span class="font-serif text-2xl font-bold text-crumb-600">
                                Rp {{ number_format($totals['total'], 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <a href="{{ route('checkout.index') }}" 
                       class="w-full py-4 px-6 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-sm tracking-wide text-center block transition shadow-lg hover:shadow-xl">
                        Lanjut ke Pembayaran &rarr;
                    </a>

                    <!-- Security note -->
                    <div class="pt-2 text-center text-[11px] text-crumb-800/50 space-y-1">
                        <p class="flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Checkout Cepat, Aman & Terpercaya
                        </p>
                        <p>Mendukung Transfer Bank, QRIS, & COD</p>
                    </div>
                </div>

            </div>
        @endif

    </div>
</section>
@endsection
