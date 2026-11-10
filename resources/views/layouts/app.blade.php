<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Crumb & Co. | Artisan Bakery & Patisserie')</title>
    <meta name="description" content="@yield('meta_description', 'Toko roti artisan dan patisserie segar setiap hari di Jakarta. Menghadirkan sourdough, viennoiserie, croissant mentega Prancis, dan kue pilihan.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        crumb: {
                            50: '#FAF7F0',
                            100: '#F5EFEB',
                            200: '#EDE3D5',
                            300: '#D4A373',
                            400: '#C58969',
                            500: '#B97859',
                            600: '#9E5B3E',
                            700: '#75432D',
                            800: '#49352A',
                            900: '#2E2019',
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        ::selection { background-color: #B97859; color: #FAF7F0; }
    </style>
    @stack('styles')
</head>
<body class="bg-crumb-50 font-sans text-crumb-800 antialiased min-h-screen flex flex-col"
      x-data="cartStore()"
      x-init="initCart()">

    <!-- Top Announcement Bar -->
    <div class="bg-crumb-800 text-crumb-50 text-xs py-2 px-4 text-center tracking-wide font-medium flex items-center justify-center gap-2">
        <span class="inline-block w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
        <span>Dipanggang segar setiap pagi pukul 06.00 WIB &bull; <strong>GRATIS Ongkir</strong> se-Jakarta untuk pembelian min. Rp 150.000</span>
    </div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-40 bg-crumb-50/90 backdrop-blur-md border-b border-crumb-200/60 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Mobile Menu Toggle Button -->
                <div class="flex items-center lg:hidden">
                    <button type="button" 
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="p-2 rounded-xl text-crumb-800 hover:bg-crumb-100 transition focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-10 h-10 rounded-full bg-crumb-800 flex items-center justify-center text-crumb-50 font-serif font-bold text-xl group-hover:bg-crumb-500 transition shadow-sm">
                        c.
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif text-2xl font-bold tracking-tight text-crumb-800 group-hover:text-crumb-500 transition leading-none">
                            Crumb <span class="font-normal italic text-crumb-500">&</span> Co.
                        </span>
                        <span class="text-[9px] tracking-[0.25em] uppercase text-crumb-500 font-semibold mt-1">Artisan Bakery</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-crumb-500 font-semibold' : 'text-crumb-800/80 hover:text-crumb-500' }} transition">
                        Beranda
                    </a>
                    <a href="{{ route('shop.index') }}" class="{{ request()->routeIs('shop.*') ? 'text-crumb-500 font-semibold' : 'text-crumb-800/80 hover:text-crumb-500' }} transition">
                        Menu & Toko
                    </a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-crumb-500 font-semibold' : 'text-crumb-800/80 hover:text-crumb-500' }} transition">
                        Cerita Kami
                    </a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-crumb-500 font-semibold' : 'text-crumb-800/80 hover:text-crumb-500' }} transition">
                        Kontak & Lokasi
                    </a>
                </nav>

                <!-- Right Action Icons (Search, User, Cart) -->
                <div class="flex items-center gap-3">
                    <!-- Search Icon (Links to Shop with autofocus) -->
                    <a href="{{ route('shop.index') }}" class="p-2.5 rounded-full hover:bg-crumb-100 text-crumb-800/80 hover:text-crumb-800 transition" title="Cari Roti & Pastry">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </a>

                    <!-- Account / Auth Dropdown -->
                    @auth
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                            <button @click="open = !open" class="flex items-center gap-2 p-1.5 pl-3 pr-2.5 rounded-full bg-crumb-100 hover:bg-crumb-200/70 text-xs font-semibold text-crumb-800 transition">
                                <span>{{ Str::limit(Auth::user()->name, 12) }}</span>
                                <div class="w-6 h-6 rounded-full bg-crumb-800 text-crumb-50 flex items-center justify-center text-[10px]">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </button>
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl py-2 border border-crumb-200/80 z-50 text-xs"
                                 x-cloak>
                                @if(Auth::user()->isAdmin())
                                    <div class="px-4 py-2 border-b border-crumb-100 font-semibold text-crumb-500 uppercase tracking-wider text-[10px]">
                                        Admin Workspace
                                    </div>
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-crumb-800 hover:bg-crumb-50 transition">
                                        <svg class="w-4 h-4 text-crumb-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                        Dashboard Toko
                                    </a>
                                @endif
                                <a href="{{ route('account.orders') }}" class="flex items-center gap-2 px-4 py-2.5 text-crumb-800 hover:bg-crumb-50 transition">
                                    <svg class="w-4 h-4 text-crumb-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    Pesanan Saya
                                </a>
                                <div class="border-t border-crumb-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-rose-600 hover:bg-rose-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Keluar Akun
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center px-4 py-2 rounded-full border border-crumb-200 text-xs font-semibold text-crumb-800 hover:bg-crumb-100 transition">
                            Masuk
                        </a>
                    @endauth

                    <!-- Cart Button with Counter Badge -->
                    <button type="button" 
                            @click="cartDrawerOpen = true"
                            class="relative p-2.5 rounded-full bg-crumb-800 text-crumb-50 hover:bg-crumb-500 transition shadow-sm flex items-center justify-center"
                            aria-label="Keranjang Belanja">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span x-show="itemCount > 0" 
                              x-text="itemCount"
                              x-cloak
                              class="absolute -top-1.5 -right-1.5 min-w-[20px] h-5 px-1 rounded-full bg-crumb-500 text-white text-[11px] font-bold flex items-center justify-center border-2 border-crumb-50 shadow-sm animate-bounce">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden border-b border-crumb-200 bg-crumb-50 px-4 pt-3 pb-6 space-y-3"
             x-cloak>
            <a href="{{ route('home') }}" class="block py-2 text-base font-semibold {{ request()->routeIs('home') ? 'text-crumb-500' : 'text-crumb-800' }}">Beranda</a>
            <a href="{{ route('shop.index') }}" class="block py-2 text-base font-semibold {{ request()->routeIs('shop.*') ? 'text-crumb-500' : 'text-crumb-800' }}">Menu & Toko</a>
            <a href="{{ route('about') }}" class="block py-2 text-base font-semibold {{ request()->routeIs('about') ? 'text-crumb-500' : 'text-crumb-800' }}">Cerita Kami</a>
            <a href="{{ route('contact') }}" class="block py-2 text-base font-semibold {{ request()->routeIs('contact') ? 'text-crumb-500' : 'text-crumb-800' }}">Kontak & Lokasi</a>
            <div class="pt-3 border-t border-crumb-200 flex items-center gap-3">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="flex-1 text-center py-2.5 rounded-xl bg-crumb-800 text-white font-semibold text-xs">Admin Dashboard</a>
                    @endif
                    <a href="{{ route('account.orders') }}" class="flex-1 text-center py-2.5 rounded-xl bg-crumb-100 text-crumb-800 font-semibold text-xs">Pesanan Saya</a>
                @else
                    <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 rounded-xl bg-crumb-800 text-white font-semibold text-xs">Masuk Akun</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center py-2.5 rounded-xl border border-crumb-300 text-crumb-800 font-semibold text-xs">Daftar Akun</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Global Toast Alert Container -->
    <div aria-live="assertive" class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start z-50">
        <div class="w-full flex flex-col items-center space-y-3 sm:items-end">
            <!-- Toast notification template via Alpine -->
            <template x-for="(toast, index) in toasts" :key="index">
                <div x-show="toast.visible"
                     x-transition:enter="transform ease-out duration-300 transition"
                     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="max-w-md w-full bg-white shadow-2xl rounded-2xl pointer-events-auto border border-crumb-200 p-4 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0"
                         :class="toast.type === 'error' ? 'bg-rose-100 text-rose-600' : 'bg-emerald-100 text-emerald-600'">
                        <svg x-show="toast.type !== 'error'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <svg x-show="toast.type === 'error'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-bold text-crumb-800" x-text="toast.title || 'Informasi'"></p>
                        <p class="text-xs text-crumb-800/70 mt-0.5" x-text="toast.message"></p>
                    </div>
                    <button @click="toast.visible = false" class="text-crumb-400 hover:text-crumb-800 p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </template>
        </div>
    </div>

    <!-- Flash message detector from Laravel Session -->
    @if(session('success'))
        <div x-init="showToast('Berhasil', '{{ addslashes(session('success')) }}', 'success')"></div>
    @endif
    @if(session('error'))
        <div x-init="showToast('Perhatian', '{{ addslashes(session('error')) }}', 'error')"></div>
    @endif
    @if(session('info'))
        <div x-init="showToast('Info', '{{ addslashes(session('info')) }}', 'info')"></div>
    @endif

    <!-- Main Content Slot -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Slide-over Cart Drawer -->
    <div x-show="cartDrawerOpen" 
         class="fixed inset-0 z-50 overflow-hidden" 
         aria-labelledby="slide-over-title" 
         role="dialog" 
         aria-modal="true"
         x-cloak>
        <div class="absolute inset-0 overflow-hidden">
            <!-- Background Backdrop -->
            <div x-show="cartDrawerOpen"
                 x-transition:enter="ease-in-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in-out duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="cartDrawerOpen = false"
                 class="absolute inset-0 bg-crumb-900/50 backdrop-blur-sm transition-opacity"></div>

            <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
                <div x-show="cartDrawerOpen"
                     x-transition:enter="transform transition ease-in-out duration-300"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-300"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full"
                     class="w-screen max-w-md bg-white shadow-2xl flex flex-col">
                    
                    <!-- Drawer Header -->
                    <div class="p-6 border-b border-crumb-200/80 bg-crumb-50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-crumb-800 text-crumb-50 flex items-center justify-center font-serif font-bold">
                                c.
                            </div>
                            <div>
                                <h2 class="font-serif text-lg font-bold text-crumb-800" id="slide-over-title">Keranjang Belanja</h2>
                                <p class="text-xs text-crumb-500 font-medium" x-text="itemCount + ' item dipilih'"></p>
                            </div>
                        </div>
                        <button type="button" 
                                @click="cartDrawerOpen = false"
                                class="p-2 rounded-full text-crumb-400 hover:text-crumb-800 hover:bg-crumb-200/50 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Free Shipping Indicator -->
                    <div class="px-6 py-3 bg-amber-50/70 border-b border-amber-200/50">
                        <div class="flex justify-between items-center text-xs mb-1.5 font-medium">
                            <span class="text-amber-900" x-show="totals.amount_left_free_shipping > 0">
                                Tambah <strong class="text-amber-700" x-text="formatRupiah(totals.amount_left_free_shipping)"></strong> lagi untuk <strong>GRATIS Ongkir</strong>!
                            </span>
                            <span class="text-emerald-800 font-bold flex items-center gap-1" x-show="totals.amount_left_free_shipping <= 0">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Selamat! Anda berhak GRATIS Ongkir se-Jakarta!
                            </span>
                        </div>
                        <div class="w-full bg-amber-200/60 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-amber-600 h-1.5 rounded-full transition-all duration-500" :style="'width: ' + totals.progress + '%'"></div>
                        </div>
                    </div>

                    <!-- Drawer Item List -->
                    <div class="flex-1 overflow-y-auto p-6 divide-y divide-crumb-100">
                        <template x-if="items.length === 0">
                            <div class="text-center py-16">
                                <div class="w-16 h-16 mx-auto rounded-full bg-crumb-100 flex items-center justify-center text-crumb-400 mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </div>
                                <h3 class="font-serif text-base font-bold text-crumb-800">Keranjang Masih Kosong</h3>
                                <p class="text-xs text-crumb-500 mt-1 max-w-xs mx-auto">Aroma roti hangat menantimu. Yuk, jelajahi pilihan roti artisan kami hari ini!</p>
                                <a href="{{ route('shop.index') }}" 
                                   @click="cartDrawerOpen = false"
                                   class="mt-6 inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-crumb-800 text-white text-xs font-bold hover:bg-crumb-500 transition shadow-sm">
                                    Mulai Belanja &rarr;
                                </a>
                            </div>
                        </template>

                        <template x-for="item in items" :key="item.id">
                            <div class="py-4 flex gap-4 items-center">
                                <img :src="item.image_url" :alt="item.name" class="w-16 h-16 rounded-2xl object-cover bg-crumb-100 shrink-0 border border-crumb-200/50">
                                <div class="flex-1 min-w-0">
                                    <p class="text-[10px] uppercase tracking-wider text-crumb-500 font-semibold truncate" x-text="item.category_name"></p>
                                    <h4 class="text-sm font-bold text-crumb-800 truncate" x-text="item.name"></h4>
                                    <p class="text-xs font-semibold text-crumb-600 mt-0.5" x-text="formatRupiah(item.price)"></p>
                                    
                                    <div class="flex items-center gap-2 mt-2">
                                        <div class="inline-flex items-center border border-crumb-200 rounded-full bg-crumb-50 p-0.5">
                                            <button @click="updateQuantity(item.id, item.quantity - 1)" class="w-6 h-6 rounded-full flex items-center justify-center text-crumb-800 hover:bg-crumb-200 transition text-xs font-bold">-</button>
                                            <span class="w-8 text-center text-xs font-bold" x-text="item.quantity"></span>
                                            <button @click="updateQuantity(item.id, item.quantity + 1)" class="w-6 h-6 rounded-full flex items-center justify-center text-crumb-800 hover:bg-crumb-200 transition text-xs font-bold">+</button>
                                        </div>
                                        <button @click="removeItem(item.id)" class="text-xs text-rose-500 hover:text-rose-700 ml-2">Hapus</button>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-bold text-crumb-800" x-text="formatRupiah(item.price * item.quantity)"></span>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Drawer Footer / Checkout CTA -->
                    <div class="p-6 border-t border-crumb-200/80 bg-crumb-50 space-y-4" x-show="items.length > 0">
                        <div class="space-y-1.5 text-xs">
                            <div class="flex justify-between text-crumb-800/70">
                                <span>Subtotal</span>
                                <span class="font-semibold text-crumb-800" x-text="formatRupiah(totals.subtotal)"></span>
                            </div>
                            <div class="flex justify-between text-crumb-800/70">
                                <span>Ongkos Kirim</span>
                                <span class="font-semibold" :class="totals.shipping === 0 ? 'text-emerald-600' : 'text-crumb-800'" x-text="totals.shipping === 0 ? 'GRATIS' : formatRupiah(totals.shipping)"></span>
                            </div>
                            <div class="flex justify-between text-base font-bold text-crumb-800 pt-2 border-t border-crumb-200">
                                <span>Total Perkiraan</span>
                                <span class="text-crumb-600 font-serif text-lg" x-text="formatRupiah(totals.total)"></span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <a href="{{ route('cart.index') }}" 
                               @click="cartDrawerOpen = false"
                               class="py-3 px-4 rounded-full border border-crumb-800 text-crumb-800 text-xs font-bold text-center hover:bg-crumb-100 transition">
                                Lihat Keranjang
                            </a>
                            <a href="{{ route('checkout.index') }}" 
                               @click="cartDrawerOpen = false"
                               class="py-3 px-4 rounded-full bg-crumb-800 text-white text-xs font-bold text-center hover:bg-crumb-500 transition shadow-md flex items-center justify-center gap-1.5">
                                Checkout &rarr;
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Store Footer -->
    <footer class="bg-crumb-800 text-crumb-50 mt-20 pt-16 pb-12 border-t border-crumb-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-crumb-700/60">
                <!-- Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-full bg-crumb-50 text-crumb-800 flex items-center justify-center font-serif font-bold text-xl">
                            c.
                        </div>
                        <span class="font-serif text-2xl font-bold tracking-tight text-crumb-50">
                            Crumb <span class="italic text-crumb-300">&</span> Co.
                        </span>
                    </div>
                    <p class="text-xs leading-relaxed text-crumb-200/70 max-w-sm">
                        Kami memanggang roti sourdough alami, viennoiserie berlapis mentega Prancis, dan camilan manis autentik setiap hari dengan dedikasi penuh terhadap cita rasa dan bahan alami terbaik.
                    </p>
                    <div class="pt-2 flex items-center gap-4 text-crumb-300">
                        <span class="text-xs font-medium">Temukan kami:</span>
                        <a href="https://instagram.com" target="_blank" class="hover:text-crumb-50 transition" title="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-crumb-50 transition" title="WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Nav Column 1 -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-crumb-300 mb-4">Koleksi Menu</h4>
                    <ul class="space-y-2.5 text-xs text-crumb-200/80">
                        <li><a href="{{ route('shop.index', ['category' => 'roti-artisan']) }}" class="hover:text-white transition">Roti Sourdough</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 'viennoiserie']) }}" class="hover:text-white transition">French Croissant</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 'pastry-gurih']) }}" class="hover:text-white transition">Savory Danish</a></li>
                        <li><a href="{{ route('shop.index', ['category' => 'kue-dan-dessert']) }}" class="hover:text-white transition">Basque Cheesecake</a></li>
                    </ul>
                </div>

                <!-- Nav Column 2 -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-crumb-300 mb-4">Informasi</h4>
                    <ul class="space-y-2.5 text-xs text-crumb-200/80">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Jam & Lokasi</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition">Keranjang Belanja</a></li>
                        <li><a href="{{ route('account.orders') }}" class="hover:text-white transition">Lacak Pesanan</a></li>
                    </ul>
                </div>

                <!-- Store Hour & Address -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-crumb-300 mb-4">Kunjungi Toko</h4>
                    <div class="space-y-3 text-xs text-crumb-200/80 leading-relaxed">
                        <p><strong>Crumb & Co. Bakeshop</strong><br>Jl. Senopati No. 42, Kebayoran Baru<br>Jakarta Selatan 12190</p>
                        <p class="pt-1">
                            <span class="block text-crumb-50 font-semibold">Jam Operasional:</span>
                            Selasa – Minggu: 07.00 – 19.00 WIB<br>
                            <span class="text-amber-400 text-[11px]">(Senin Libur Pembersihan Oven)</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-crumb-300/60">
                <p>&copy; {{ date('Y') }} Crumb & Co. Bakery Shop. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <span class="text-[11px]">Database: MySQL on Port 3310 &bull; Powered by Laravel 11</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Alpine Cart Data Store Script -->
    <script>
        function cartStore() {
            return {
                mobileMenuOpen: false,
                cartDrawerOpen: false,
                items: [],
                itemCount: 0,
                totals: {
                    subtotal: 0,
                    shipping: 0,
                    total: 0,
                    item_count: 0,
                    progress: 0,
                    amount_left_free_shipping: 150000,
                },
                toasts: [],

                initCart() {
                    this.fetchCart();
                },

                async fetchCart() {
                    try {
                        const res = await fetch("{{ route('cart.data') }}");
                        if (res.ok) {
                            const data = await res.json();
                            this.items = data.items || [];
                            this.totals = data.totals || this.totals;
                            this.itemCount = this.totals.item_count || 0;
                        }
                    } catch (e) {
                        console.error('Error fetching cart:', e);
                    }
                },

                async addToCart(productId, quantity = 1) {
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const res = await fetch("{{ route('cart.add') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({ product_id: productId, quantity: quantity })
                        });

                        const data = await res.json();
                        if (res.ok && data.success) {
                            this.items = data.cart;
                            this.totals = data.totals;
                            this.itemCount = data.totals.item_count;
                            this.showToast('Sukses Ditambahkan', data.message, 'success');
                            this.cartDrawerOpen = true;
                        } else {
                            this.showToast('Gagal', data.message || 'Gagal menambahkan produk.', 'error');
                        }
                    } catch (e) {
                        this.showToast('Error', 'Terjadi kesalahan jaringan.', 'error');
                    }
                },

                async updateQuantity(productId, quantity) {
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const res = await fetch("{{ route('cart.update') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({ product_id: productId, quantity: quantity })
                        });

                        const data = await res.json();
                        if (res.ok && data.success) {
                            this.items = data.cart;
                            this.totals = data.totals;
                            this.itemCount = data.totals.item_count;
                        }
                    } catch (e) {
                        console.error(e);
                    }
                },

                async removeItem(productId) {
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const res = await fetch("{{ route('cart.remove') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({ product_id: productId })
                        });

                        const data = await res.json();
                        if (res.ok && data.success) {
                            this.items = data.cart;
                            this.totals = data.totals;
                            this.itemCount = data.totals.item_count;
                            this.showToast('Dihapus', data.message, 'info');
                        }
                    } catch (e) {
                        console.error(e);
                    }
                },

                showToast(title, message, type = 'success') {
                    const id = Date.now();
                    this.toasts.push({ id, title, message, type, visible: true });
                    setTimeout(() => {
                        const t = this.toasts.find(item => item.id === id);
                        if (t) t.visible = false;
                    }, 4000);
                },

                formatRupiah(number) {
                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
                }
            };
        }
    </script>
    @stack('scripts')
</body>
</html>
