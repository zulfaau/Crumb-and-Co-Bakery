@extends('layouts.admin')

@section('title', 'Kelola Kategori Produk | Crumb & Co.')
@section('page_title', 'Kategori Roti & Pastry')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start max-w-6xl mx-auto">
    
    <!-- Left: Categories List (7 cols) -->
    <div class="lg:col-span-7 bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-stone-100 flex items-center justify-between">
            <div>
                <h3 class="font-serif text-lg font-bold text-stone-800">Daftar Kategori Toko</h3>
                <p class="text-xs text-stone-500">Kelompokkan menu agar pelanggan mudah menjelajah.</p>
            </div>
            <span class="text-xs font-bold text-crumb-600 bg-crumb-50 px-3 py-1 rounded-full border border-crumb-200">
                {{ $categories->count() }} Kategori
            </span>
        </div>

        <div class="divide-y divide-stone-100">
            @foreach($categories as $category)
                <div class="p-6 flex items-center justify-between gap-4 hover:bg-stone-50/60 transition">
                    <div class="flex items-center gap-4">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-14 h-14 rounded-2xl object-cover bg-stone-100 border border-stone-200 shrink-0">
                        <div>
                            <h4 class="font-serif font-bold text-stone-800 text-base">{{ $category->name }}</h4>
                            <span class="text-[11px] text-crumb-600 font-semibold">{{ $category->products_count }} produk terdaftar</span>
                            <p class="text-xs text-stone-500 line-clamp-1 mt-0.5">{{ $category->description }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        @if($category->products_count === 0)
                            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Hapus kategori {{ $category->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-rose-500 hover:text-rose-700 rounded-xl hover:bg-rose-50 transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Right: Add Category Form (5 cols) -->
    <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-stone-200/80 shadow-sm space-y-6">
        <div class="pb-3 border-b border-stone-100">
            <h3 class="font-serif text-lg font-bold text-stone-800">Tambah Kategori Baru</h3>
            <p class="text-xs text-stone-500">Buat kelompok menu baru untuk bakeshop.</p>
        </div>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
            @csrf

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-800">Nama Kategori <span class="text-rose-500">*</span></label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       placeholder="Contoh: Danish & Puff Pastry"
                       class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border @error('name') border-rose-500 @else border-stone-200 @enderror text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                @error('name') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-800">URL Gambar Sampul Kategori</label>
                <input type="url" 
                       name="image_url" 
                       value="{{ old('image_url') }}" 
                       placeholder="https://images.unsplash.com/..."
                       class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-800">Deskripsi Kategori</label>
                <textarea name="description" 
                          rows="3" 
                          placeholder="Jelaskan jenis roti atau pastry dalam kategori ini..."
                          class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">{{ old('description') }}</textarea>
            </div>

            <button type="submit" 
                    class="w-full py-3 px-6 rounded-xl bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
                + Tambah Kategori
            </button>
        </form>
    </div>

</div>
@endsection
