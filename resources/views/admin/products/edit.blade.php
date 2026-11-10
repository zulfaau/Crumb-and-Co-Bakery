@extends('layouts.admin')

@section('title', 'Edit Produk ' . $product->name . ' | Crumb & Co.')
@section('page_title', 'Perbarui Informasi Produk')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.products') }}" class="text-xs font-bold text-stone-500 hover:text-stone-800 flex items-center gap-1">
            &larr; Kembali ke Daftar Produk
        </a>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-stone-200/80 shadow-sm">
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Product Name -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="block text-xs font-bold text-stone-800">Nama Produk <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border @error('name') border-rose-500 @else border-stone-200 @enderror text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                    @error('name') <p class="text-[11px] text-rose-500">{{ $message }}</p> @enderror
                </div>

                <!-- Category -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-800">Kategori <span class="text-rose-500">*</span></label>
                    <select name="category_id" required class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Price -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-800">Harga Satuan (Rupiah) <span class="text-rose-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" step="500"
                           class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border @error('price') border-rose-500 @else border-stone-200 @enderror text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                </div>

                <!-- Stock -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-800">Stok Batch Panggang Hari Ini <span class="text-rose-500">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                           class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                </div>

                <!-- Image URL -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-800">URL Gambar Produk</label>
                    <input type="url" name="image_url" value="{{ old('image_url', $product->image_url) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                </div>

                <!-- Short Description -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="block text-xs font-bold text-stone-800">Ringkasan Singkat (1 Kalimat) <span class="text-rose-500">*</span></label>
                    <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}" required
                           class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                </div>

                <!-- Full Description -->
                <div class="space-y-1.5 sm:col-span-2">
                    <label class="block text-xs font-bold text-stone-800">Deskripsi Lengkap <span class="text-rose-500">*</span></label>
                    <textarea name="description" rows="4" required
                              class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Ingredients -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-800">Komposisi Bahan</label>
                    <input type="text" name="ingredients" value="{{ old('ingredients', $product->ingredients) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                </div>

                <!-- Allergens -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-800">Alergen</label>
                    <input type="text" name="allergens" value="{{ old('allergens', $product->allergens) }}"
                           class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                </div>

                <!-- Checkboxes -->
                <div class="sm:col-span-2 flex flex-wrap items-center gap-6 pt-2 border-t border-stone-100">
                    <label class="flex items-center gap-2 text-xs font-bold text-stone-800 cursor-pointer">
                        <input type="checkbox" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }} class="rounded text-crumb-800 focus:ring-crumb-500">
                        <span>Tandai Rekomendasi / Terlaris</span>
                    </label>

                    <label class="flex items-center gap-2 text-xs font-bold text-stone-800 cursor-pointer">
                        <input type="checkbox" name="newest" value="1" {{ old('newest', $product->newest) ? 'checked' : '' }} class="rounded text-crumb-800 focus:ring-crumb-500">
                        <span>Tandai Menu Baru</span>
                    </label>

                    <label class="flex items-center gap-2 text-xs font-bold text-stone-800 cursor-pointer">
                        <input type="checkbox" name="available" value="1" {{ old('available', $product->available) ? 'checked' : '' }} class="rounded text-crumb-800 focus:ring-crumb-500">
                        <span>Tersedia untuk Dipesan</span>
                    </label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t border-stone-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products') }}" class="px-6 py-2.5 rounded-xl border border-stone-300 text-stone-700 text-xs font-bold hover:bg-stone-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-8 py-2.5 rounded-xl bg-crumb-800 hover:bg-crumb-500 text-white text-xs font-bold transition shadow-md">
                    Perbarui Data Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
