@extends('layouts.admin')

@section('title', 'Admin Dashboard | Crumb & Co.')
@section('page_title', 'Ringkasan Toko & Kinerja Penjualan')

@section('content')
<div class="space-y-8">
    
    <!-- Stat Cards Metric Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue Card -->
        <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm space-y-2">
            <div class="flex items-center justify-between text-stone-500 text-xs font-semibold">
                <span>Total Omset Penjualan</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                    Rp
                </div>
            </div>
            <div class="font-serif text-2xl font-bold text-stone-800">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </div>
            <span class="text-[11px] text-emerald-600 font-semibold block">&uarr; Berdasarkan pesanan aktif</span>
        </div>

        <!-- Orders Card -->
        <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm space-y-2">
            <div class="flex items-center justify-between text-stone-500 text-xs font-semibold">
                <span>Total Pesanan Masuk</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                    #
                </div>
            </div>
            <div class="font-serif text-2xl font-bold text-stone-800">
                {{ $totalOrders }} Pesanan
            </div>
            <span class="text-[11px] text-amber-700 font-semibold block">{{ $newOrdersCount }} pesanan baru menunggu proses</span>
        </div>

        <!-- Products Card -->
        <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm space-y-2">
            <div class="flex items-center justify-between text-stone-500 text-xs font-semibold">
                <span>Katalog Roti & Pastry</span>
                <div class="w-8 h-8 rounded-xl bg-crumb-100 text-crumb-800 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
            <div class="font-serif text-2xl font-bold text-stone-800">
                {{ $totalProducts }} Produk
            </div>
            <span class="text-[11px] text-stone-500 font-semibold block">Dalam 4 kategori pilihan</span>
        </div>

        <!-- Customers Card -->
        <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm space-y-2">
            <div class="flex items-center justify-between text-stone-500 text-xs font-semibold">
                <span>Pelanggan Terdaftar</span>
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <div class="font-serif text-2xl font-bold text-stone-800">
                {{ $totalCustomers }} Akun
            </div>
            <span class="text-[11px] text-blue-600 font-semibold block">Pencinta roti Crumb & Co.</span>
        </div>
    </div>

    <!-- Quick Shortcuts Card -->
    <div class="bg-white rounded-3xl p-6 border border-stone-200/80 shadow-sm">
        <h3 class="font-serif text-base font-bold text-stone-800 mb-4">Akses Cepat Pengelolaan</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-bold">
            <a href="{{ route('admin.products.create') }}" class="p-4 rounded-2xl bg-crumb-50 hover:bg-crumb-100 text-crumb-800 border border-crumb-200 flex flex-col items-center justify-center gap-2 text-center transition">
                <span class="text-xl">+</span>
                <span>Tambah Produk Roti</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="p-4 rounded-2xl bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-200 flex flex-col items-center justify-center gap-2 text-center transition">
                <span class="text-xl">📋</span>
                <span>Proses Pesanan ({{ $newOrdersCount }} Baru)</span>
            </a>
            <a href="{{ route('admin.categories') }}" class="p-4 rounded-2xl bg-stone-50 hover:bg-stone-100 text-stone-800 border border-stone-200 flex flex-col items-center justify-center gap-2 text-center transition">
                <span class="text-xl">🏷️</span>
                <span>Kelola Kategori</span>
            </a>
            <a href="{{ route('admin.messages') }}" class="p-4 rounded-2xl bg-blue-50 hover:bg-blue-100 text-blue-900 border border-blue-200 flex flex-col items-center justify-center gap-2 text-center transition">
                <span class="text-xl">✉️</span>
                <span>Lihat Pesan Kontak ({{ $unreadMessagesCount }})</span>
            </a>
        </div>
    </div>

    <!-- Recent Orders Table Card -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-stone-100 flex items-center justify-between">
            <div>
                <h3 class="font-serif text-lg font-bold text-stone-800">Pesanan Masuk Terbaru</h3>
                <p class="text-xs text-stone-500">Daftar transaksi terkini dari pelanggan Crumb & Co.</p>
            </div>
            <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-crumb-600 hover:text-crumb-800">
                Lihat Semua Pesanan &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 border-b border-stone-200 text-stone-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3.5 px-6">No. Pesanan</th>
                        <th class="py-3.5 px-6">Pelanggan</th>
                        <th class="py-3.5 px-6">Metode</th>
                        <th class="py-3.5 px-6">Total Tagihan</th>
                        <th class="py-3.5 px-6">Status Pengerjaan</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-stone-50/70 transition">
                            <td class="py-4 px-6 font-mono font-bold text-stone-800">
                                {{ $order->order_number }}
                                <span class="block text-[10px] font-sans font-normal text-stone-400">{{ $order->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-stone-800 block">{{ $order->customer_name }}</span>
                                <span class="text-[11px] text-stone-500">{{ $order->customer_phone }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="uppercase font-bold text-[10px] text-stone-600 block">{{ $order->payment_method }}</span>
                                <span class="text-[10px] text-stone-400">{{ $order->delivery_method === 'pickup' ? 'Ambil Sendiri' : 'Antar Kurir' }}</span>
                            </td>
                            <td class="py-4 px-6 font-bold text-stone-800 font-serif text-sm">
                                {{ $order->formatted_total }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $order->status_badge_class }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3.5 py-1.5 rounded-xl bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs transition shadow-sm inline-block">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-stone-500">Belum ada pesanan terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
