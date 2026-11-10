@extends('layouts.app')

@section('title', 'Cerita & Filosofi Kami | Crumb & Co.')

@section('content')
<!-- Page Header Banner -->
<section class="bg-crumb-100 py-16 border-b border-crumb-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-3xl">
        <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-2">Cerita Kami</span>
        <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-crumb-800 leading-tight">
            Menghidupkan Kembali Tradisi Roti Sejati.
        </h1>
        <p class="text-sm sm:text-base text-crumb-800/70 mt-4 leading-relaxed">
            Crumb & Co. lahir dari kecintaan mendalam terhadap seni fermentasi alami, keharuman gandum organik, dan kerenyahan mentega Prancis autentik di Jakarta Selatan.
        </p>
    </div>
</section>

<!-- Story Section 1: The Beginning -->
<section class="py-20 bg-crumb-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block">Awal Mula</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800 leading-snug">
                    Dari Dapur Sederhana Menjadi Destinasi Roti Artisan Pilihan
                </h2>
                <p class="text-sm sm:text-base text-crumb-800/80 leading-relaxed">
                    Perjalanan kami dimulai pada tahun 2018 dengan sebuah bibit ragi alami (sourdough starter) bernama <em>"Levain 18"</em> yang kami rawat dengan cermat setiap pagi dan malam. Kami muak dengan roti modern pabrikan yang penuh dengan pengawet kimia, pemutih tepung sintetis, dan ragi instan yang membuat perut terasa kembung.
                </p>
                <p class="text-sm sm:text-base text-crumb-800/80 leading-relaxed">
                    Kami bertekad menghadirkan kembali rasa roti kuno Eropa: roti yang membutuhkan waktu 36 jam fermentasi dingin untuk memecah gluten dan asam fitat, menghasilkan aroma karamel gandum murni, kerak berkilau, dan remah yang lembut serta bernutrisi tinggi.
                </p>
            </div>

            <div class="lg:col-span-6">
                <div class="aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl bg-crumb-200 border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=1000&q=80" 
                         alt="Proses Pemanggangan Roti Crumb & Co." 
                         class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4 Pillars Section -->
<section class="py-20 bg-white border-y border-crumb-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-2">Prinsip Tanpa Kompromi</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800">
                Empat Pilar Kualitas Crumb & Co.
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="p-6 rounded-3xl bg-crumb-50 border border-crumb-200 space-y-3">
                <span class="font-serif text-3xl font-bold text-crumb-500 block">01</span>
                <h3 class="font-serif text-lg font-bold text-crumb-800">Fermentasi Alami 36 Jam</h3>
                <p class="text-xs text-crumb-800/70 leading-relaxed">
                    Kami memberikan waktu adonan bernafas dan berkembang perlahan, menciptakan struktur alveoli sarang lebah yang kenyal dan mudah dicerna.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-crumb-50 border border-crumb-200 space-y-3">
                <span class="font-serif text-3xl font-bold text-crumb-500 block">02</span>
                <h3 class="font-serif text-lg font-bold text-crumb-800">Mentega Prancis AOP</h3>
                <p class="text-xs text-crumb-800/70 leading-relaxed">
                    Tidak ada kompromi dengan margarin. Kami mengimpor langsung butter AOP dari Charentes-Poitou untuk rasa gurih creamy yang murni.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-crumb-50 border border-crumb-200 space-y-3">
                <span class="font-serif text-3xl font-bold text-crumb-500 block">03</span>
                <h3 class="font-serif text-lg font-bold text-crumb-800">Tepung Gandum Organik</h3>
                <p class="text-xs text-crumb-800/70 leading-relaxed">
                    Dipilih dari penggilingan batu tradisional tanpa pemutih sintetis, kaya serat pangan, vitamin B kompleks, dan mineral alami.
                </p>
            </div>

            <div class="p-6 rounded-3xl bg-crumb-50 border border-crumb-200 space-y-3">
                <span class="font-serif text-3xl font-bold text-crumb-500 block">04</span>
                <h3 class="font-serif text-lg font-bold text-crumb-800">Oven Dek Batu Panas</h3>
                <p class="text-xs text-crumb-800/70 leading-relaxed">
                    Setiap loaf sourdough dipanggang di atas pelat batu granit panas dengan injeksi uap air bersuhu 250°C untuk karamelisasi kerak yang sempurna.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-crumb-100 text-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <h2 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800">
            Ingin Mencicipi Hasil Karya Dapur Kami?
        </h2>
        <p class="text-sm text-crumb-800/70 leading-relaxed">
            Pesanan batch pagi siap dikirim mulai pukul 07.30 WIB setiap hari.
        </p>
        <div class="pt-2">
            <a href="{{ route('shop.index') }}" class="px-8 py-4 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs uppercase tracking-wider transition shadow-lg">
                Pesan Menu Favoritmu &rarr;
            </a>
        </div>
    </div>
</section>
@endsection
