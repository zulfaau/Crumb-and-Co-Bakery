@extends('layouts.app')

@section('title', 'Menu & Belanja Roti Artisan | Crumb & Co.')
@section('meta_description', 'Jelajahi seluruh varian roti sourdough, viennoiserie, croissant mentega, dan kue pilihan Crumb & Co. Jakarta.')

@section('content')
<!-- Page Header Banner -->
<section class="bg-crumb-100 py-12 border-b border-crumb-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-3xl">
        <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-2">Katalog Bakeshop</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-bold text-crumb-800">
            Menu & Toko Roti Kami
        </h1>
        <p class="text-sm sm:text-base text-crumb-800/70 mt-3 leading-relaxed">
            Semua roti dipanggang segar setiap subuh menggunakan bahan alami tanpa pengawet. Pilih roti favoritmu untuk dikirim langsung ke rumah.
        </p>
    </div>
</section>

<!-- Shop Explorer & Product Grid -->
<section class="py-12 bg-crumb-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter & Search Controls Bar -->
        <div class="bg-white rounded-3xl p-4 sm:p-6 border border-crumb-200/80 shadow-sm mb-10">
            <form method="GET" action="{{ route('shop.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                
                <!-- Search Bar -->
                <div class="md:col-span-5 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-crumb-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari roti, croissant, atau kue..." 
                           class="w-full pl-10 pr-4 py-3 rounded-2xl bg-crumb-50 border border-crumb-200 text-xs sm:text-sm text-crumb-800 placeholder-crumb-400 focus:outline-none focus:ring-2 focus:ring-crumb-500 focus:bg-white transition">
                </div>

                <!-- Category Selector -->
                <div class="md:col-span-4">
                    <select name="category" 
                            onchange="this.form.submit()"
                            class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border border-crumb-200 text-xs sm:text-sm text-crumb-800 focus:outline-none focus:ring-2 focus:ring-crumb-500 focus:bg-white transition">
                        <option value="all">Semua Kategori ({{ \App\Models\Product::count() }})</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sorting Selector -->
                <div class="md:col-span-3">
                    <select name="sort" 
                            onchange="this.form.submit()"
                            class="w-full px-4 py-3 rounded-2xl bg-crumb-50 border border-crumb-200 text-xs sm:text-sm text-crumb-800 focus:outline-none focus:ring-2 focus:ring-crumb-500 focus:bg-white transition">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Urutkan: Menu Terbaru</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Urutkan: Paling Populer</option>
                        <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Harga: Terendah ke Tertinggi</option>
                        <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Harga: Tertinggi ke Terendah</option>
                    </select>
                </div>
            </form>

            <!-- Category Fast Pills -->
            <div class="mt-4 pt-4 border-t border-crumb-100 flex items-center gap-2 overflow-x-auto pb-1 text-xs">
                <span class="text-crumb-400 font-medium shrink-0 mr-1">Kategori:</span>
                <a href="{{ route('shop.index', array_merge(request()->except(['category', 'page']), ['category' => 'all'])) }}"
                   class="px-3.5 py-1.5 rounded-full font-semibold transition shrink-0 {{ !request('category') || request('category') === 'all' ? 'bg-crumb-800 text-white' : 'bg-crumb-100 text-crumb-800 hover:bg-crumb-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('shop.index', array_merge(request()->except(['category', 'page']), ['category' => $cat->slug])) }}"
                       class="px-3.5 py-1.5 rounded-full font-semibold transition shrink-0 {{ request('category') === $cat->slug ? 'bg-crumb-800 text-white' : 'bg-crumb-100 text-crumb-800 hover:bg-crumb-200' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Result Status -->
        <div class="flex items-center justify-between mb-6 text-xs text-crumb-800/60 font-medium px-1">
            <p>
                Menampilkan <strong>{{ $products->total() }}</strong> varian roti & pastry segar
                @if(request('search')) untuk kata kunci "<em>{{ request('search') }}</em>"@endif
            </p>
            @if(request('search') || (request('category') && request('category') !== 'all'))
                <a href="{{ route('shop.index') }}" class="text-crumb-500 hover:underline font-bold">
                    Reset Filter &times;
                </a>
            @endif
        </div>

        <!-- Product Grid -->
        @include('partials.product-grid', ['products' => $products])

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>

    </div>
</section>
@endsection
