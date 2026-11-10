@if($products->isEmpty())
    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-crumb-200/80 p-8">
        <div class="w-16 h-16 mx-auto rounded-full bg-crumb-100 flex items-center justify-center text-crumb-400 mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <h3 class="font-serif text-xl font-bold text-crumb-800">Tidak ada produk ditemukan</h3>
        <p class="text-sm text-crumb-600 mt-1 max-w-md mx-auto">
            Coba ubah kata kunci pencarian atau pilih kategori lain untuk menemukan roti pilihanmu.
        </p>
        <a href="{{ route('shop.index') }}" class="mt-6 inline-flex items-center px-6 py-2.5 rounded-full bg-crumb-800 text-white text-xs font-bold hover:bg-crumb-500 transition">
            Lihat Semua Produk
        </a>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
            @include('partials.product-card', ['product' => $product])
        @endforeach
    </div>
@endif
