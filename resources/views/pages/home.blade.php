@extends('layouts.app')

@section('title', 'Crumb & Co. | Artisan Bakery & Patisserie Jakarta')

@section('content')
<!-- Hero Section -->
<section class="relative bg-crumb-50 overflow-hidden border-b border-crumb-200/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Hero Content -->
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-crumb-200/60 border border-crumb-300/40 text-xs font-bold uppercase tracking-[0.2em] text-crumb-600">
                    <span class="w-2 h-2 rounded-full bg-crumb-500"></span>
                    Dipanggang Segar Setiap Hari
                </div>

                <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight text-crumb-800 leading-[1.05]">
                    Freshly Baked,<br>
                    <span class="font-normal italic text-crumb-500">Made with Love.</span>
                </h1>

                <p class="text-base sm:text-lg text-crumb-800/70 leading-relaxed max-w-xl">
                    Nikmati sensasi roti sourdough fermentasi lambat, croissant mentega AOP Prancis berpori sarang lebah, dan pastry gurih hangat yang baru keluar dari tungku oven batu kami.
                </p>

                <!-- Action Buttons -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a href="{{ route('shop.index') }}" 
                       class="px-8 py-4 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-sm tracking-wide transition-all shadow-lg hover:shadow-xl flex items-center gap-3 group">
                        <span>Pesan Roti Hari Ini</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('about') }}" 
                       class="px-8 py-4 rounded-full border-2 border-crumb-800/20 hover:border-crumb-800 text-crumb-800 font-bold text-sm tracking-wide transition-all">
                        Cerita & Filosofi Kami
                    </a>
                </div>

                <!-- USP Micro Stats -->
                <div class="pt-8 border-t border-crumb-200/80 grid grid-cols-3 gap-6 text-crumb-800">
                    <div>
                        <span class="block font-serif text-3xl font-bold text-crumb-800">36 Jam</span>
                        <span class="text-xs text-crumb-800/60 font-medium">Fermentasi Dingin</span>
                    </div>
                    <div>
                        <span class="block font-serif text-3xl font-bold text-crumb-800">100%</span>
                        <span class="text-xs text-crumb-800/60 font-medium">Mentega Prancis AOP</span>
                    </div>
                    <div>
                        <span class="block font-serif text-3xl font-bold text-crumb-800">0%</span>
                        <span class="text-xs text-crumb-800/60 font-medium">Bahan Kimia Pengawet</span>
                    </div>
                </div>
            </div>

            <!-- Right Hero Visual -->
            <div class="lg:col-span-6 relative">
                <div class="relative mx-auto max-w-lg lg:max-w-none">
                    <!-- Main Artistic Image Frame -->
                    <div class="aspect-[4/3] sm:aspect-[5/4] rounded-3xl overflow-hidden shadow-2xl bg-crumb-200 border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=1200&q=85" 
                             alt="French Butter Croissant Crumb & Co." 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Floating Special Product Card Badge -->
                    <div class="absolute -bottom-6 -left-4 sm:left-6 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-crumb-200 max-w-xs flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-xl bg-crumb-100 overflow-hidden shrink-0">
                            <img src="https://images.unsplash.com/photo-1589367920969-ab8e050bbb04?auto=format&fit=crop&w=200&q=80" alt="Country Sourdough" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="text-[9px] font-bold uppercase tracking-widest text-crumb-500 block">Favorit Pagi Ini</span>
                            <h4 class="font-serif text-sm font-bold text-crumb-800">Country Sourdough Boule</h4>
                            <span class="text-xs font-semibold text-crumb-600">Rp 45.000</span>
                        </div>
                    </div>

                    <!-- Floating Quality Badge -->
                    <div class="absolute -top-4 -right-2 bg-crumb-800 text-crumb-50 px-4 py-2.5 rounded-2xl shadow-lg border border-crumb-700 flex items-center gap-2 text-xs font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Batch Pagi Ready di Oven
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Value Pillars Section -->
<section class="py-16 bg-white border-b border-crumb-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 rounded-3xl bg-crumb-50 border border-crumb-200/80 flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-crumb-800 text-crumb-50 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-serif text-lg font-bold text-crumb-800">Fermentasi Alami 36 Jam</h3>
                    <p class="text-xs text-crumb-800/70 mt-1 leading-relaxed">
                        Menggunakan starter liar alami berusia 8 tahun. Ramah bagi lambung, rendah indeks glikemik, dan kaya nutrisi.
                    </p>
                </div>
            </div>

            <div class="p-6 rounded-3xl bg-crumb-50 border border-crumb-200/80 flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-crumb-500 text-white flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                </div>
                <div>
                    <h3 class="font-serif text-lg font-bold text-crumb-800">Mentega AOP Asli Prancis</h3>
                    <p class="text-xs text-crumb-800/70 mt-1 leading-relaxed">
                        Hanya menggunakan Elle & Vire Beurre de Tourage dari Prancis untuk menghasilkan 27 lapisan croissant yang harum dan renyah.
                    </p>
                </div>
            </div>

            <div class="p-6 rounded-3xl bg-crumb-50 border border-crumb-200/80 flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-700 text-white flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-serif text-lg font-bold text-crumb-800">Pengiriman Kilat Hari Ini</h3>
                    <p class="text-xs text-crumb-800/70 mt-1 leading-relaxed">
                        Pesanan langsung dikirim hangat menggunakan kurir instan atau sameday ke seluruh area Jabodetabek.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Best Sellers Section -->
<section class="py-20 bg-crumb-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-2">Paling Dicari</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800">
                    Menu Terlaris & Rekomendasi Chef
                </h2>
                <p class="text-sm text-crumb-800/60 mt-1">Produk favorit pelanggan kami yang selalu habis sebelum tengah hari.</p>
            </div>
            <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-crumb-800 hover:text-crumb-500 transition group shrink-0">
                <span>Lihat Seluruh Menu Toko</span>
                <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($bestSellers as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>

<!-- Category Showcase Section -->
<section class="py-20 bg-white border-y border-crumb-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-2">Jelajahi Koleksi</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800">
                Pilihan Kategori Spesial
            </h2>
            <p class="text-sm text-crumb-800/60 mt-2">
                Dari sarapan renyah hingga hidangan penutup yang memanjakan akhir pekan Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $cat)
                <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" 
                   class="group relative rounded-3xl overflow-hidden aspect-[4/5] bg-crumb-900 shadow-md transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 block">
                    <img src="{{ $cat->image_url }}" 
                         alt="{{ $cat->name }}" 
                         class="w-full h-full object-cover opacity-80 group-hover:scale-105 group-hover:opacity-70 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-crumb-900/90 via-crumb-900/30 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white space-y-1.5">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-crumb-300 block">
                            {{ $cat->products_count }} Produk Tersedia
                        </span>
                        <h3 class="font-serif text-xl font-bold group-hover:text-crumb-300 transition">
                            {{ $cat->name }}
                        </h3>
                        <p class="text-xs text-crumb-100/70 line-clamp-2 leading-relaxed">
                            {{ $cat->description }}
                        </p>
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-crumb-300 pt-2 group-hover:underline">
                            Jelajahi Kategori &rarr;
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Fresh Bakes Highlights / Newest -->
@if($newestProducts->isNotEmpty())
<section class="py-20 bg-crumb-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-2">Kreasi Terbaru</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800">
                    Menu Baru Minggu Ini
                </h2>
                <p class="text-sm text-crumb-800/60 mt-1">Inovasi rasa baru dari para baker artisan Crumb & Co.</p>
            </div>
            <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-crumb-800 hover:text-crumb-500 transition group shrink-0">
                <span>Buka Menu Lengkap</span>
                <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($newestProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Artisan Story Banner -->
<section class="py-20 bg-crumb-800 text-crumb-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-300 block">Cerita Di Balik Roti</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">
                    Kami Percaya, Roti Sejati Tidak Mengenal Jalan Pintas.
                </h2>
                <p class="text-sm sm:text-base text-crumb-200/80 leading-relaxed max-w-2xl">
                    Di Crumb & Co., setiap adonan roti adalah dialog antara waktu, suhu ruang, dan keterampilan tangan manusia. Kami tidak memakai perenyah kimia atau pemanis buatan. Ragi alami kami dirawat dengan teliti setiap 12 jam, menghasilkan aroma karamel dan kerenyahan yang tak bisa ditiru oleh pabrik massal.
                </p>
                <div class="pt-4 flex items-center gap-4">
                    <a href="{{ route('about') }}" class="px-8 py-3.5 rounded-full bg-crumb-500 hover:bg-crumb-400 text-white font-bold text-xs uppercase tracking-wider transition shadow-lg">
                        Baca Cerita Lengkap Kami
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="aspect-square rounded-3xl overflow-hidden border-4 border-crumb-700 shadow-2xl bg-crumb-900">
                    <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80" 
                         alt="Baker Crumb & Co." 
                         class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Customer Reviews Section -->
<section class="py-20 bg-white border-b border-crumb-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-2">Ulasan Pelanggan</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800">
                Apa Kata Sahabat Crumb & Co.?
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 rounded-3xl bg-crumb-50 border border-crumb-200/80 space-y-4">
                <div class="flex text-amber-500 text-sm">★★★★★</div>
                <p class="text-xs sm:text-sm text-crumb-800/80 leading-relaxed italic">
                    "Sourdough terbaik di Jakarta Selatan! Keraknya luar biasa renyah dan asamnya pas banget di lidah. Selalu pesan seminggu dua kali buat sarapan keluarga."
                </p>
                <div class="pt-2 border-t border-crumb-200/60 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-crumb-800 text-crumb-50 font-bold text-xs flex items-center justify-center font-serif">
                        A
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-crumb-800">Aditya Pratama</h4>
                        <span class="text-[10px] text-crumb-500">Pelanggan Setia di Kebayoran Baru</span>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-3xl bg-crumb-50 border border-crumb-200/80 space-y-4">
                <div class="flex text-amber-500 text-sm">★★★★★</div>
                <p class="text-xs sm:text-sm text-crumb-800/80 leading-relaxed italic">
                    "Butter croissant-nya beneran wangi mentega Prancis authentic. Dipanaskan 3 menit di oven langsung renyah berlapis-lapis. Pelayanannya juga ramah banget!"
                </p>
                <div class="pt-2 border-t border-crumb-200/60 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-crumb-500 text-white font-bold text-xs flex items-center justify-center font-serif">
                        S
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-crumb-800">Siti Nurhaliza</h4>
                        <span class="text-[10px] text-crumb-500">Food Blogger Jakarta</span>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-3xl bg-crumb-50 border border-crumb-200/80 space-y-4">
                <div class="flex text-amber-500 text-sm">★★★★★</div>
                <p class="text-xs sm:text-sm text-crumb-800/80 leading-relaxed italic">
                    "Truffle mushroom danish dan Basque cheesecake mereka adalah kombinasi surga. Pengiriman instan selalu tiba dalam kondisi rapi dan masih hangat."
                </p>
                <div class="pt-2 border-t border-crumb-200/60 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-amber-800 text-white font-bold text-xs flex items-center justify-center font-serif">
                        K
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-crumb-800">Kevin Tanujaya</h4>
                        <span class="text-[10px] text-crumb-500">Pencinta Pastry & Kopi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Visit Store / Order -->
<section class="py-20 bg-crumb-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500">Mulai Harimu Bersama Kami</span>
        <h2 class="font-serif text-3xl sm:text-5xl font-bold text-crumb-800 leading-tight">
            Siap Menikmati Kehangatan Roti Artisan Hari Ini?
        </h2>
        <p class="text-sm sm:text-base text-crumb-800/70 max-w-xl mx-auto leading-relaxed">
            Pesan sekarang untuk pengiriman hari ini, atau singgahi butik bakeshop kami di Senopati untuk menikmati aroma roti panggang langsung dari oven.
        </p>
        <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('shop.index') }}" class="px-8 py-4 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-sm tracking-wide transition shadow-xl">
                Belanja Sekarang &rarr;
            </a>
            <a href="{{ route('contact') }}" class="px-8 py-4 rounded-full bg-white hover:bg-crumb-50 text-crumb-800 font-bold text-sm tracking-wide border border-crumb-300 transition">
                Petunjuk Arah ke Toko
            </a>
        </div>
    </div>
</section>
@endsection
