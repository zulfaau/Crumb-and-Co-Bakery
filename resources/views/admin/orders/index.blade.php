@extends('layouts.admin')

@section('title', 'Kelola Pesanan Masuk | Crumb & Co.')
@section('page_title', 'Daftar Pesanan Toko')

@section('content')
<div class="space-y-6">
    
    <!-- Status Filter Tabs & Search -->
    <div class="bg-white rounded-3xl p-6 border border-stone-200/80 shadow-sm space-y-4">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
            <!-- Search -->
            <form method="GET" action="{{ route('admin.orders') }}" class="flex items-center gap-3">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Cari nomor pesanan atau nama..." 
                       class="w-full sm:w-72 px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-stone-800 text-white text-xs font-bold hover:bg-stone-700 transition">
                    Cari
                </button>
            </form>

            <span class="text-xs text-stone-500">
                Total: <strong>{{ $orders->total() }}</strong> pesanan tercatat
            </span>
        </div>

        <!-- Filter Status Pills -->
        <div class="pt-3 border-t border-stone-100 flex items-center gap-2 overflow-x-auto pb-1 text-xs">
            <span class="text-stone-400 font-semibold mr-1 shrink-0">Filter Status:</span>
            <a href="{{ route('admin.orders', ['status' => 'all']) }}" 
               class="px-3.5 py-1.5 rounded-full font-bold transition shrink-0 {{ !request('status') || request('status') === 'all' ? 'bg-stone-800 text-white' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
                Semua
            </a>
            <a href="{{ route('admin.orders', ['status' => 'new']) }}" 
               class="px-3.5 py-1.5 rounded-full font-bold transition shrink-0 {{ request('status') === 'new' ? 'bg-amber-500 text-white' : 'bg-amber-50 text-amber-800 hover:bg-amber-100' }}">
                Baru ({{ \App\Models\Order::where('status', 'new')->count() }})
            </a>
            <a href="{{ route('admin.orders', ['status' => 'processing']) }}" 
               class="px-3.5 py-1.5 rounded-full font-bold transition shrink-0 {{ request('status') === 'processing' ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-800 hover:bg-blue-100' }}">
                Dipanggang / Diproses
            </a>
            <a href="{{ route('admin.orders', ['status' => 'ready']) }}" 
               class="px-3.5 py-1.5 rounded-full font-bold transition shrink-0 {{ request('status') === 'ready' ? 'bg-purple-600 text-white' : 'bg-purple-50 text-purple-800 hover:bg-purple-100' }}">
                Siap Diambil/Dikirim
            </a>
            <a href="{{ route('admin.orders', ['status' => 'completed']) }}" 
               class="px-3.5 py-1.5 rounded-full font-bold transition shrink-0 {{ request('status') === 'completed' ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100' }}">
                Selesai
            </a>
            <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" 
               class="px-3.5 py-1.5 rounded-full font-bold transition shrink-0 {{ request('status') === 'cancelled' ? 'bg-rose-600 text-white' : 'bg-rose-50 text-rose-800 hover:bg-rose-100' }}">
                Dibatalkan
            </a>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 border-b border-stone-200 text-stone-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3.5 px-6">No. Pesanan & Waktu</th>
                        <th class="py-3.5 px-6">Pelanggan</th>
                        <th class="py-3.5 px-6">Pengiriman</th>
                        <th class="py-3.5 px-6">Pembayaran</th>
                        <th class="py-3.5 px-6">Total Tagihan</th>
                        <th class="py-3.5 px-6">Status Pengerjaan</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-stone-50/70 transition">
                            <td class="py-4 px-6 font-mono font-bold text-stone-800">
                                {{ $order->order_number }}
                                <span class="block text-[10px] font-sans font-normal text-stone-400 mt-0.5">
                                    {{ $order->created_at->translatedFormat('d M Y, H:i') }} WIB
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-stone-800 block">{{ $order->customer_name }}</span>
                                <span class="text-[11px] text-stone-500">{{ $order->customer_phone }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $order->delivery_method === 'pickup' ? 'bg-purple-100 text-purple-800' : 'bg-stone-100 text-stone-700' }}">
                                    {{ $order->delivery_method === 'pickup' ? 'Ambil di Toko' : 'Kirim ke Alamat' }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="uppercase font-bold text-[10px] text-stone-700 block">{{ $order->payment_method }}</span>
                                <span class="text-[10px] font-semibold {{ $order->payment_status === 'paid' ? 'text-emerald-600' : 'text-amber-600' }}">
                                    {{ $order->payment_status === 'paid' ? 'LUNAS' : 'Pending' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-bold text-stone-800 font-serif text-sm">
                                {{ $order->formatted_total }}
                                <span class="block text-[10px] font-sans font-normal text-stone-400">{{ $order->items->count() }} macam roti</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $order->status_badge_class }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="px-4 py-1.5 rounded-xl bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs transition shadow-sm inline-block">
                                    Lihat & Update
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-500">Tidak ada pesanan yang sesuai dengan filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-stone-100">
            {{ $orders->links() }}
        </div>
    </div>

</div>
@endsection
