@extends('layouts.app')

@section('title', $product->name . ' | Crumb & Co. Artisan Bakery')
@section('meta_description', $product->short_description)

@section('content')
<!-- Breadcrumbs -->
<div class="bg-crumb-100/60 border-b border-crumb-200/60 py-3.5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-crumb-800/60">
            <a href="{{ route('home') }}" class="hover:text-crumb-800 transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-crumb-800 transition">Menu Toko</a>
            <span>/</span>
            @if($product->category)
                <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="hover:text-crumb-800 transition">
                    {{ $product->category->name }}
                </a>
                <span>/</span>
            @endif
            <span class="text-crumb-800 font-semibold truncate">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<!-- Product Main Detail Section -->
<section class="py-12 bg-crumb-50" x-data="{ qty: 1 }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Column: Product Visual Showcase -->
            <div class="lg:col-span-6 space-y-4">
                <div class="relative aspect-square w-full rounded-3xl overflow-hidden bg-white border border-crumb-200 shadow-lg">
                    <img src="{{ $product->image_url }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover">

                    <!-- Badges -->
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        @if($product->featured)
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-crumb-800 text-white shadow-md">
                                Rekomendasi Chef
                            </span>
                        @endif
                        @if($product->newest)
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-crumb-500 text-white shadow-md">
                                Menu Baru
                            </span>
                        @endif
                    </div>

                    <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-md px-3.5 py-1.5 rounded-full text-xs font-semibold text-crumb-800 border border-crumb-200 shadow-sm flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Fresh Daily Bake
                    </div>
                </div>

                <!-- Baking Notes Card -->
                <div class="p-4 rounded-2xl bg-crumb-100 border border-crumb-200/70 flex items-center justify-between text-xs text-crumb-800/80">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-crumb-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Jadwal Panggang: <strong>Pukul 06.00 WIB</strong></span>
                    </div>
                    <span class="text-crumb-500 font-semibold">&bull; Stok Tersedia Hari Ini</span>
                </div>
            </div>

            <!-- Right Column: Product Information & Purchase Form -->
            <div class="lg:col-span-6 space-y-6">
                <!-- Category Tag -->
                @if($product->category)
                    <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" 
                       class="inline-block text-xs uppercase font-bold tracking-[0.2em] text-crumb-500 hover:text-crumb-600 transition">
                        {{ $product->category->name }}
                    </a>
                @endif

                <!-- Title & Price -->
                <div class="space-y-2">
                    <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-crumb-800 leading-tight">
                        {{ $product->name }}
                    </h1>
                    <div class="flex items-baseline gap-4 pt-1">
                        <span class="font-serif text-3xl font-bold text-crumb-600">
                            {{ $product->formatted_price }}
                        </span>
                        <span class="text-xs text-crumb-500 font-medium">Termasuk PPN &bull; Per satuan</span>
                    </div>
                </div>

                <!-- Short Description -->
                <p class="text-sm sm:text-base text-crumb-800/80 leading-relaxed">
                    {{ $product->short_description }}
                </p>

                <!-- Quantity & Add to Cart -->
                <div class="p-6 rounded-3xl bg-white border border-crumb-200 shadow-sm space-y-4">
                    @if($product->available)
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                            <!-- Quantity Counter -->
                            <div class="flex items-center justify-between border-2 border-crumb-200 rounded-full px-2 py-1 bg-crumb-50 sm:w-36 shrink-0">
                                <button type="button" 
                                        @click="qty = Math.max(1, qty - 1)" 
                                        class="w-8 h-8 rounded-full flex items-center justify-center text-crumb-800 hover:bg-crumb-200 text-sm font-bold transition">
                                    -
                                </button>
                                <span class="font-bold text-sm text-crumb-800 w-8 text-center" x-text="qty"></span>
                                <button type="button" 
                                        @click="qty = Math.min(20, qty + 1)" 
                                        class="w-8 h-8 rounded-full flex items-center justify-center text-crumb-800 hover:bg-crumb-200 text-sm font-bold transition">
                                    +
                                </button>
                            </div>

                            <!-- Add to Cart CTA -->
                            <button type="button" 
                                    @click="addToCart({{ $product->id }}, qty)"
                                    class="flex-1 py-4 px-8 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-sm tracking-wide transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                <span>Tambah ke Keranjang</span>
                            </button>
                        </div>
                    @else
                        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold text-center">
                            Produk ini sudah habis terjual untuk batch hari ini. Nantikan batch panggangan berikutnya besok pagi pukul 06.00 WIB!
                        </div>
                    @endif

                    <div class="pt-2 flex items-center justify-between text-[11px] text-crumb-800/60 border-t border-crumb-100">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Jaminan Kualitas 100% Alami
                        </span>
                        <span>Pengiriman Instant & Sameday</span>
                    </div>
                </div>

                <!-- Product Details Accordion Tabs -->
                <div class="space-y-3 pt-4" x-data="{ tab: 'desc' }">
                    <!-- Tab Buttons -->
                    <div class="flex border-b border-crumb-200 gap-4 text-xs font-bold uppercase tracking-wider">
                        <button type="button" 
                                @click="tab = 'desc'" 
                                :class="tab === 'desc' ? 'border-b-2 border-crumb-800 text-crumb-800 pb-2.5' : 'text-crumb-400 hover:text-crumb-800 pb-2.5'">
                            Deskripsi Lengkap
                        </button>
                        <button type="button" 
                                @click="tab = 'ingredients'" 
                                :class="tab === 'ingredients' ? 'border-b-2 border-crumb-800 text-crumb-800 pb-2.5' : 'text-crumb-400 hover:text-crumb-800 pb-2.5'">
                            Komposisi Bahan
                        </button>
                        <button type="button" 
                                @click="tab = 'tips'" 
                                :class="tab === 'tips' ? 'border-b-2 border-crumb-800 text-crumb-800 pb-2.5' : 'text-crumb-400 hover:text-crumb-800 pb-2.5'">
                            Saran Penyajian
                        </button>
                    </div>

                    <!-- Tab Content: Description -->
                    <div x-show="tab === 'desc'" class="pt-3 text-xs sm:text-sm text-crumb-800/80 leading-relaxed space-y-2">
                        <p>{{ $product->description }}</p>
                    </div>

                    <!-- Tab Content: Ingredients -->
                    <div x-show="tab === 'ingredients'" class="pt-3 text-xs sm:text-sm text-crumb-800/80 leading-relaxed space-y-3" x-cloak>
                        <div>
                            <strong class="block text-crumb-800 font-bold mb-1">Bahan Baku Utama:</strong>
                            <p>{{ $product->ingredients ?? 'Tepung terigu pilihan, air terfiltrasi, ragi alami, garam laut.' }}</p>
                        </div>
                        @if($product->allergens)
                            <div class="p-3 rounded-xl bg-amber-50 border border-amber-200/60 text-amber-900 text-xs">
                                <strong>Pemberitahuan Alergen:</strong> {{ $product->allergens }}
                            </div>
                        @endif
                    </div>

                    <!-- Tab Content: Serving Tips -->
                    <div x-show="tab === 'tips'" class="pt-3 text-xs sm:text-sm text-crumb-800/80 leading-relaxed space-y-2" x-cloak>
                        <ul class="list-disc pl-5 space-y-1.5">
                            <li><strong>Untuk Roti Sourdough:</strong> Panaskan oven / toaster pada suhu 180°C selama 3-4 menit untuk mengembalikan aroma renyah keraknya.</li>
                            <li><strong>Untuk Croissant & Pastry:</strong> Jangan gunakan microwave karena akan membuat lembek. Cukup panaskan sebentar di oven atau air fryer pada suhu 160°C selama 2-3 menit.</li>
                            <li><strong>Penyimpanan:</strong> Simpan dalam wadah kedap udara atau kantong kertas di suhu ruang hingga 3 hari, atau simpan di freezer hingga 1 bulan.</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- Related Products Section -->
@if($relatedProducts->isNotEmpty())
<section class="py-16 bg-white border-t border-crumb-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10 flex items-end justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-1">Pilihan Terkait</span>
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-crumb-800">
                    Kamu Mungkin Juga Suka
                </h2>
            </div>
            <a href="{{ route('shop.index') }}" class="text-xs font-bold text-crumb-800 hover:text-crumb-500 transition">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $item)
                @include('partials.product-card', ['product' => $item])
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
