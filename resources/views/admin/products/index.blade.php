@extends('layouts.admin')

@section('title', 'Kelola Produk Roti | Crumb & Co.')
@section('page_title', 'Katalog Produk Roti & Pastry')

@section('content')
<div class="space-y-6">
    
    <!-- Top Action Bar -->
    <div class="bg-white rounded-3xl p-6 border border-stone-200/80 shadow-sm flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        <!-- Search & Category Filters -->
        <form method="GET" action="{{ route('admin.products') }}" class="flex-1 flex flex-col sm:flex-row items-center gap-3">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Cari nama produk..." 
                   class="w-full sm:w-64 px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
            
            <select name="category" 
                    onchange="this.form.submit()"
                    class="w-full sm:w-56 px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2.5 rounded-xl bg-stone-800 text-white text-xs font-bold hover:bg-stone-700 transition">
                Cari
            </button>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.products') }}" class="text-xs text-rose-500 hover:underline">Reset</a>
            @endif
        </form>

        <a href="{{ route('admin.products.create') }}" class="px-6 py-2.5 rounded-xl bg-crumb-800 hover:bg-crumb-500 text-white text-xs font-bold transition shadow-sm flex items-center justify-center gap-2">
            <span>+ Tambah Roti Baru</span>
        </a>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 border-b border-stone-200 text-stone-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3.5 px-6">Produk</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Harga Satuan</th>
                        <th class="py-3.5 px-6">Stok</th>
                        <th class="py-3.5 px-6">Ketersediaan</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-stone-50/70 transition">
                            <td class="py-4 px-6 flex items-center gap-3">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-xl object-cover bg-stone-100 shrink-0 border border-stone-200">
                                <div>
                                    <h4 class="font-bold text-stone-800 text-sm">{{ $product->name }}</h4>
                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        @if($product->featured)
                                            <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-amber-100 text-amber-800">Terlaris</span>
                                        @endif
                                        @if($product->newest)
                                            <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-blue-100 text-blue-800">Baru</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-stone-600">
                                {{ $product->category?->name ?? '-' }}
                            </td>
                            <td class="py-4 px-6 font-bold text-stone-800 font-serif text-sm">
                                {{ $product->formatted_price }}
                            </td>
                            <td class="py-4 px-6 font-bold text-stone-700">
                                {{ $product->stock }} loaf / pcs
                            </td>
                            <td class="py-4 px-6">
                                <form method="POST" action="{{ route('admin.products.toggle', $product->id) }}">
                                    @csrf
                                    <button type="submit" 
                                            class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider transition {{ $product->available ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-rose-100 text-rose-800 hover:bg-rose-200' }}"
                                            title="Klik untuk mengubah ketersediaan">
                                        {{ $product->available ? 'Tersedia' : 'Habis' }}
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1.5 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-800 font-bold transition inline-block">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" class="inline" onsubmit="return confirm('Hapus produk {{ $product->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-stone-500">Tidak ada produk ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-stone-100">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection
