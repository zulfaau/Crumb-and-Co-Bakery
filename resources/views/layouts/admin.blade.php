<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard | Crumb & Co.')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

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
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-stone-100 font-sans text-stone-800 antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-stone-900/50 z-40 lg:hidden" 
         x-cloak></div>

    <!-- Admin Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed inset-y-0 left-0 w-64 bg-crumb-900 text-stone-200 z-50 flex flex-col justify-between transition-transform duration-300 ease-in-out border-r border-stone-800">
        
        <div>
            <!-- Admin Brand -->
            <div class="h-20 flex items-center gap-3 px-6 border-b border-stone-800 bg-crumb-900/80">
                <div class="w-10 h-10 rounded-full bg-crumb-500 text-white flex items-center justify-center font-serif font-bold text-xl">
                    c.
                </div>
                <div>
                    <span class="font-serif text-lg font-bold text-white block leading-tight">Crumb & Co.</span>
                    <span class="text-[9px] uppercase tracking-widest text-crumb-400 font-semibold">Admin Workspace</span>
                </div>
            </div>

            <!-- Sidebar Navigation Links -->
            <nav class="p-4 space-y-1 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-crumb-800 text-white font-bold shadow-sm' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    <svg class="w-5 h-5 text-crumb-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.products') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.products*') ? 'bg-crumb-800 text-white font-bold shadow-sm' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    <svg class="w-5 h-5 text-crumb-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span>Kelola Produk</span>
                </a>

                <a href="{{ route('admin.orders') }}" 
                   class="flex items-center justify-between px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.orders*') ? 'bg-crumb-800 text-white font-bold shadow-sm' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-crumb-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Pesanan Masuk</span>
                    </div>
                    @php $newCount = \App\Models\Order::where('status', 'new')->count(); @endphp
                    @if($newCount > 0)
                        <span class="px-2 py-0.5 rounded-full bg-amber-500 text-white text-[10px] font-bold">{{ $newCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.categories') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.categories*') ? 'bg-crumb-800 text-white font-bold shadow-sm' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    <svg class="w-5 h-5 text-crumb-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span>Kategori Produk</span>
                </a>

                <a href="{{ route('admin.messages') }}" 
                   class="flex items-center justify-between px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.messages*') ? 'bg-crumb-800 text-white font-bold shadow-sm' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-crumb-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        <span>Pesan Pelanggan</span>
                    </div>
                    @php $unreadMsgs = \App\Models\Contact::where('is_read', false)->count(); @endphp
                    @if($unreadMsgs > 0)
                        <span class="px-2 py-0.5 rounded-full bg-crumb-500 text-white text-[10px] font-bold">{{ $unreadMsgs }}</span>
                    @endif
                </a>
            </nav>
        </div>

        <!-- Sidebar Bottom (Return to Front & User Info) -->
        <div class="p-4 border-t border-stone-800 space-y-3">
            <a href="{{ route('home') }}" target="_blank" 
               class="flex items-center justify-between px-4 py-2.5 rounded-xl bg-stone-800/70 hover:bg-stone-800 text-crumb-300 text-xs font-semibold transition">
                <span>Lihat Web Toko</span>
                <span>↗</span>
            </a>

            <div class="flex items-center justify-between pt-1 px-1">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-crumb-700 text-white text-xs font-bold flex items-center justify-center">
                        A
                    </div>
                    <div>
                        <span class="text-xs font-bold text-white block">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-stone-400">Administrator</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-1.5 text-stone-400 hover:text-rose-400 transition" title="Keluar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 lg:pl-64 flex flex-col min-w-0">
        <!-- Admin Topbar -->
        <header class="h-20 bg-white border-b border-stone-200 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-sm">
            <div class="flex items-center gap-4">
                <button type="button" @click="sidebarOpen = true" class="lg:hidden p-2 text-stone-600 hover:bg-stone-100 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1 class="text-base sm:text-lg font-bold text-stone-800">@yield('page_title', 'Dashboard')</h1>
                    <span class="text-[11px] text-stone-500">Database: MySQL (Port 3310) &bull; {{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.create') }}" class="px-4 py-2 rounded-xl bg-crumb-800 hover:bg-crumb-500 text-white text-xs font-bold transition shadow-sm flex items-center gap-1.5">
                    <span>+ Tambah Produk</span>
                </a>
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <span class="text-emerald-500 font-bold">&check;</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <span class="text-rose-500 font-bold">&times;</span>
            </div>
        @endif

        <!-- Page Content -->
        <main class="p-6 sm:p-8 flex-1">
            @yield('content')
        </main>
    </div>

</body>
</html>
