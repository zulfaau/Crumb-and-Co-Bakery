@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->order_number . ' | Crumb & Co.')
@section('page_title', 'Detail & Manajemen Pesanan #' . $order->order_number)

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-stone-500 hover:text-stone-800 flex items-center gap-1">
            &larr; Kembali ke Daftar Pesanan
        </a>

        <div class="flex items-center gap-3">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}?text=Halo%20{{ urlencode($order->customer_name) }},%20kami%20dari%20tim%20bakery%20Crumb%20%26%20Co.%20mengenai%20pesanan%20nomor%20{{ $order->order_number }}..."
               target="_blank"
               class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-sm flex items-center gap-2">
                <span>Hubungi Pembeli via WA</span>
            </a>
            <button type="button" onclick="window.print()" class="px-4 py-2 rounded-xl border border-stone-300 bg-white hover:bg-stone-50 text-stone-700 text-xs font-bold transition shadow-sm">
                Cetak Invoice
            </button>
        </div>
    </div>

    <!-- Status Updater Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-stone-200/80 shadow-sm space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-stone-100">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-crumb-500 block">Status Saat Ini</span>
                <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border {{ $order->status_badge_class }}">
                    {{ $order->status_label }}
                </span>
            </div>
            <div class="text-xs text-stone-500">
                Waktu Pesan: <strong>{{ $order->created_at->translatedFormat('d F Y, H:i') }} WIB</strong>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end pt-2">
            @csrf
            <div class="sm:col-span-5 space-y-1.5">
                <label class="block text-xs font-bold text-stone-800">Ubah Status Pengerjaan Pesanan</label>
                <select name="status" class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                    <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>Pesanan Baru (Diterima)</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Sedang Dipanggang / Diproses</option>
                    <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Siap Diambil / Diserahkan ke Kurir</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai (Sudah Diterima Pembeli)</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            <div class="sm:col-span-4 space-y-1.5">
                <label class="block text-xs font-bold text-stone-800">Status Pembayaran</label>
                <select name="payment_status" class="w-full px-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs sm:text-sm font-semibold focus:bg-white focus:outline-none focus:ring-2 focus:ring-crumb-500">
                    <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending (Menunggu Bayar)</option>
                    <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid (Lunas)</option>
                    <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed / Gagal</option>
                </select>
            </div>

            <div class="sm:col-span-3">
                <button type="submit" class="w-full py-2.5 px-6 rounded-xl bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs transition shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- 2 Column Details (Customer & Order Items) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left: Order Items Table (8 cols) -->
        <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-8 border border-stone-200/80 shadow-sm space-y-6">
            <h3 class="font-serif text-lg font-bold text-stone-800 pb-3 border-b border-stone-100">
                Item Roti & Pastry yang Dipesan
            </h3>

            <div class="divide-y divide-stone-100">
                @foreach($order->items as $item)
                    <div class="py-4 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3.5">
                            @if($item->product && $item->product->image_url)
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" class="w-14 h-14 rounded-xl object-cover bg-stone-100 border border-stone-200 shrink-0">
                            @endif
                            <div>
                                <h4 class="font-bold text-stone-800 text-sm">{{ $item->product_name }}</h4>
                                <span class="text-xs text-stone-500">{{ $item->quantity }} &times; {{ $item->formatted_price }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="font-bold text-stone-800 font-serif text-sm">{{ $item->formatted_subtotal }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pt-4 border-t border-stone-200 space-y-2 text-xs sm:text-sm text-stone-700">
                <div class="flex justify-between">
                    <span>Subtotal Produk</span>
                    <span class="font-semibold text-stone-800">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Ongkos Kirim ({{ $order->delivery_method === 'pickup' ? 'Ambil di Toko' : 'Kurir' }})</span>
                    <span class="font-semibold text-stone-800">{{ $order->shipping_cost === 0 ? 'GRATIS' : 'Rp ' . number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="pt-3 border-t border-stone-200 flex justify-between items-baseline font-bold text-base text-stone-800">
                    <span>Total Pembayaran</span>
                    <span class="font-serif text-xl font-bold text-crumb-600">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>

        <!-- Right: Customer Info Box (4 cols) -->
        <div class="lg:col-span-4 bg-white rounded-3xl p-6 border border-stone-200/80 shadow-sm space-y-6">
            <h3 class="font-serif text-lg font-bold text-stone-800 pb-3 border-b border-stone-100">
                Informasi Pelanggan
            </h3>

            <div class="space-y-4 text-xs text-stone-700">
                <div>
                    <span class="text-[10px] uppercase font-bold text-stone-400 block mb-0.5">Nama Lengkap</span>
                    <strong class="text-stone-800 text-sm block">{{ $order->customer_name }}</strong>
                </div>

                <div>
                    <span class="text-[10px] uppercase font-bold text-stone-400 block mb-0.5">Kontak WhatsApp</span>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" class="text-emerald-700 font-bold hover:underline block">
                        {{ $order->customer_phone }} ↗
                    </a>
                </div>

                @if($order->customer_email)
                    <div>
                        <span class="text-[10px] uppercase font-bold text-stone-400 block mb-0.5">Email</span>
                        <span class="text-stone-800 block">{{ $order->customer_email }}</span>
                    </div>
                @endif

                <div class="pt-2 border-t border-stone-100">
                    <span class="text-[10px] uppercase font-bold text-stone-400 block mb-0.5">Metode Pengiriman</span>
                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold inline-block {{ $order->delivery_method === 'pickup' ? 'bg-purple-100 text-purple-800' : 'bg-stone-100 text-stone-800' }}">
                        {{ $order->delivery_method === 'pickup' ? 'Ambil di Toko Senopati' : 'Pengiriman ke Rumah' }}
                    </span>
                </div>

                <div>
                    <span class="text-[10px] uppercase font-bold text-stone-400 block mb-0.5">Alamat Lengkap</span>
                    <p class="leading-relaxed text-stone-800 bg-stone-50 p-3 rounded-xl border border-stone-200">
                        {{ $order->shipping_address }}
                    </p>
                </div>

                @if($order->notes)
                    <div>
                        <span class="text-[10px] uppercase font-bold text-amber-700 block mb-0.5">Catatan Khusus</span>
                        <p class="bg-amber-50 p-3 rounded-xl border border-amber-200 text-amber-900 italic">
                            "{{ $order->notes }}"
                        </p>
                    </div>
                @endif

                <div class="pt-2 border-t border-stone-100">
                    <span class="text-[10px] uppercase font-bold text-stone-400 block mb-0.5">Metode Pembayaran</span>
                    <span class="uppercase font-bold text-stone-800 block">{{ $order->payment_method }}</span>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
