<div class="group bg-white rounded-3xl p-4 border border-crumb-200/80 hover:border-crumb-300 transition-all duration-300 hover:shadow-xl flex flex-col justify-between">
    <div>
        <!-- Product Image Container -->
        <div class="relative w-full aspect-square rounded-2xl overflow-hidden bg-crumb-100 mb-4">
            <img src="{{ $product->image_url }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 loading="lazy">

            <!-- Badges -->
            <div class="absolute top-3 left-3 flex flex-col gap-1.5 z-10">
                @if($product->featured)
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-crumb-800 text-white shadow-sm">
                        Terlaris
                    </span>
                @endif
                @if($product->newest)
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-crumb-500 text-white shadow-sm">
                        Baru
                    </span>
                @endif
                @if(!$product->available)
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-rose-600 text-white shadow-sm">
                        Habis Hari Ini
                    </span>
                @endif
            </div>

            <!-- Quick View Overlay Button -->
            <a href="{{ route('shop.show', $product->slug) }}" 
               class="absolute inset-0 bg-crumb-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center"
               title="Lihat Detail {{ $product->name }}">
                <span class="sr-only">Lihat Detail</span>
            </a>
        </div>

        <!-- Category & Title -->
        <div class="space-y-1">
            <span class="text-[10px] uppercase font-bold tracking-[0.2em] text-crumb-500">
                {{ $product->category?->name ?? 'Artisan Bakes' }}
            </span>
            <h3 class="font-serif text-lg font-bold text-crumb-800 group-hover:text-crumb-500 transition leading-snug">
                <a href="{{ route('shop.show', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h3>
            <p class="text-xs text-crumb-800/60 line-clamp-2 leading-relaxed pt-0.5">
                {{ $product->short_description }}
            </p>
        </div>
    </div>

    <!-- Price and Add to Cart Action -->
    <div class="mt-5 pt-3 border-t border-crumb-100 flex items-center justify-between gap-3">
        <div>
            <span class="text-[10px] text-crumb-800/50 block font-medium">Harga</span>
            <span class="text-base font-bold text-crumb-800 font-serif">
                {{ $product->formatted_price }}
            </span>
        </div>

        @if($product->available)
            <button type="button" 
                    @click="addToCart({{ $product->id }})"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-crumb-100 hover:bg-crumb-800 text-crumb-800 hover:text-white transition-all text-xs font-bold active:scale-95 shadow-sm"
                    title="Tambah ke Keranjang">
                <span>+ Keranjang</span>
            </button>
        @else
            <button disabled 
                    class="px-3 py-1.5 rounded-full bg-crumb-100 text-crumb-400 text-xs font-semibold cursor-not-allowed">
                Habis
            </button>
        @endif
    </div>
</div>
