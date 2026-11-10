@extends('layouts.app')

@section('title', 'Konfirmasi Pesanan #' . $order->order_number . ' | Crumb & Co.')

@section('content')
<section class="py-12 bg-crumb-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Success Greeting Card -->
        <div class="bg-white rounded-3xl p-8 border border-crumb-200/80 shadow-md text-center space-y-4">
            <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-crumb-500 block mb-1">Pesanan Berhasil Dibuat</span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-crumb-800">
                    Terima Kasih, {{ $order->customer_name }}!
                </h1>
                <p class="text-xs sm:text-sm text-crumb-800/70 mt-2 max-w-lg mx-auto">
                    Pesanan Anda telah kami terima dan segera disiapkan oleh tim baker kami dengan penuh cinta.
                </p>
            </div>

            <!-- Order Number Badge -->
            <div class="inline-flex items-center gap-3 bg-crumb-100 px-5 py-2.5 rounded-2xl border border-crumb-200" 
                 x-data="{ copied: false }">
                <span class="text-xs text-crumb-800/60 font-medium">Nomor Pesanan:</span>
                <strong class="font-mono text-sm sm:text-base font-bold text-crumb-800 tracking-wider">
                    {{ $order->order_number }}
                </strong>
                <button type="button" 
                        @click="navigator.clipboard.writeText('{{ $order->order_number }}'); copied = true; setTimeout(() => copied = false, 2000)"
                        class="text-xs text-crumb-500 hover:text-crumb-800 font-bold ml-1 underline">
                    <span x-text="copied ? 'Tersalin!' : 'Salin'"></span>
                </button>
            </div>
        </div>

        <!-- Order Tracking Status Timeline -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-crumb-200/80 shadow-sm">
            <h3 class="font-serif text-base font-bold text-crumb-800 mb-6">Status Pengerjaan Pesanan</h3>

            <div class="grid grid-cols-4 gap-2 text-center text-xs">
                <!-- Step 1: Diterima -->
                <div class="space-y-2">
                    <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold {{ in_array($order->status, ['new', 'processing', 'ready', 'completed']) ? 'bg-crumb-800 text-white' : 'bg-crumb-100 text-crumb-400' }}">
                        1
                    </div>
                    <span class="block font-bold text-crumb-800 text-[11px] sm:text-xs">Pesanan Diterima</span>
                    <span class="text-[10px] text-crumb-500 block">{{ $order->created_at->format('H:i WIB') }}</span>
                </div>

                <!-- Step 2: Diproses -->
                <div class="space-y-2">
                    <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold {{ in_array($order->status, ['processing', 'ready', 'completed']) ? 'bg-crumb-800 text-white' : 'bg-crumb-100 text-crumb-400' }}">
                        2
                    </div>
                    <span class="block font-bold text-crumb-800 text-[11px] sm:text-xs">Dipanggang / Siap</span>
                    <span class="text-[10px] text-crumb-500 block">Dapur Bakery</span>
                </div>

                <!-- Step 3: Siap Dikirim -->
                <div class="space-y-2">
                    <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold {{ in_array($order->status, ['ready', 'completed']) ? 'bg-crumb-800 text-white' : 'bg-crumb-100 text-crumb-400' }}">
                        3
                    </div>
                    <span class="block font-bold text-crumb-800 text-[11px] sm:text-xs">{{ $order->delivery_method === 'pickup' ? 'Siap Diambil' : 'Dalam Pengiriman' }}</span>
                    <span class="text-[10px] text-crumb-500 block">Kurir Khusus</span>
                </div>

                <!-- Step 4: Selesai -->
                <div class="space-y-2">
                    <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold {{ $order->status === 'completed' ? 'bg-emerald-600 text-white' : 'bg-crumb-100 text-crumb-400' }}">
                        4
                    </div>
                    <span class="block font-bold text-crumb-800 text-[11px] sm:text-xs">Selesai</span>
                    <span class="text-[10px] text-crumb-500 block">Diterima Hangat</span>
                </div>
            </div>
        </div>

        <!-- Payment Instructions Card -->
        <div class="bg-amber-50 rounded-3xl p-6 sm:p-8 border border-amber-200/80 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-amber-200/70 pb-3">
                <h3 class="font-serif text-lg font-bold text-amber-950">Petunjuk Pembayaran</h3>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $order->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-200 text-amber-900' }}">
                    {{ $order->payment_status === 'paid' ? 'LUNAS' : 'MENUNGGU PEMBAYARAN' }}
                </span>
            </div>

            @if($order->payment_method === 'bank_transfer')
                <div class="space-y-3 text-xs sm:text-sm text-amber-900/90 leading-relaxed">
                    <p>Silakan transfer total pembayaran sebesar <strong>{{ $order->formatted_total }}</strong> ke salah satu rekening resmi Crumb & Co. berikut:</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <!-- BCA Card -->
                        <div class="bg-white p-4 rounded-2xl border border-amber-200 shadow-sm" x-data="{ copied: false }">
                            <span class="text-[11px] font-bold text-blue-700 block mb-1">BANK CENTRAL ASIA (BCA)</span>
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-base font-bold text-crumb-800">8830-1928-31</span>
                                <button type="button" 
                                        @click="navigator.clipboard.writeText('8830192831'); copied = true; setTimeout(() => copied = false, 2000)"
                                        class="text-xs text-crumb-500 hover:text-crumb-800 font-bold">
                                    <span x-text="copied ? 'Tersalin' : 'Salin'"></span>
                                </button>
                            </div>
                            <span class="text-[11px] text-crumb-500">a/n Crumb & Co Bakery Indonesia</span>
                        </div>

                        <!-- Mandiri Card -->
                        <div class="bg-white p-4 rounded-2xl border border-amber-200 shadow-sm" x-data="{ copied: false }">
                            <span class="text-[11px] font-bold text-amber-700 block mb-1">BANK MANDIRI</span>
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-base font-bold text-crumb-800">123-000-9876543</span>
                                <button type="button" 
                                        @click="navigator.clipboard.writeText('1230009876543'); copied = true; setTimeout(() => copied = false, 2000)"
                                        class="text-xs text-crumb-500 hover:text-crumb-800 font-bold">
                                    <span x-text="copied ? 'Tersalin' : 'Salin'"></span>
                                </button>
                            </div>
                            <span class="text-[11px] text-crumb-500">a/n Crumb & Co Bakery Indonesia</span>
                        </div>
                    </div>
                </div>
            @elseif($order->payment_method === 'qris')
                <div class="space-y-3 text-xs sm:text-sm text-amber-900/90 leading-relaxed text-center">
                    <p>Buka aplikasi e-wallet pilihan Anda (Gopay, OVO, DANA, ShopeePay, BCA Mobile) dan lakukan pemindaian kode QRIS di bawah ini:</p>
                    <div class="w-48 h-48 mx-auto bg-white p-3 rounded-2xl border border-amber-200 shadow-md flex items-center justify-center">
                        <!-- Simulated QRIS Graphic -->
                        <div class="w-full h-full border-2 border-dashed border-crumb-400 rounded-xl flex flex-col items-center justify-center p-2 text-center">
                            <span class="font-mono font-bold text-xs text-crumb-800">QRIS STANDAR</span>
                            <span class="text-[10px] text-crumb-500 mt-1">Crumb & Co. Bakeshop</span>
                            <span class="font-serif font-bold text-sm text-crumb-700 mt-2">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-xs sm:text-sm text-amber-900/90 leading-relaxed">
                    <p>Metode Pembayaran: <strong>Cash on Delivery (Bayar Tunai di Tempat)</strong></p>
                    <p class="text-xs text-amber-800 mt-1">Harap siapkan uang tunai pas sebesar <strong>{{ $order->formatted_total }}</strong> saat kurir mengantarkan pesanan Anda.</p>
                </div>
            @endif

            <!-- Direct WhatsApp Confirmation Link -->
            <div class="pt-4 border-t border-amber-200/60 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-amber-900">
                    Ingin mengirimkan bukti transfer atau cek status pemanggangan roti?
                </p>
                <a href="{{ $waLink }}" target="_blank" 
                   class="px-6 py-3 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-2 transition shadow-md shrink-0">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>Konfirmasi via WhatsApp &rarr;</span>
                </a>
            </div>
        </div>

        <!-- Itemized Order Receipt Details -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-crumb-200/80 shadow-sm space-y-6">
            <div class="flex items-center justify-between border-b border-crumb-100 pb-4">
                <h3 class="font-serif text-lg font-bold text-crumb-800">Rincian Belanja & Invoice</h3>
                <button type="button" onclick="window.print()" class="text-xs font-bold text-crumb-600 hover:text-crumb-800 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span>Cetak Struk</span>
                </button>
            </div>

            <!-- Items Table -->
            <div class="divide-y divide-crumb-100">
                @foreach($order->items as $item)
                    <div class="py-3 flex items-center justify-between gap-4 text-xs sm:text-sm">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-lg bg-crumb-100 text-crumb-800 font-bold flex items-center justify-center text-xs">
                                {{ $item->quantity }}&times;
                            </span>
                            <span class="font-bold text-crumb-800">{{ $item->product_name }}</span>
                        </div>
                        <span class="font-bold text-crumb-800 font-serif">{{ $item->formatted_subtotal }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Cost Totals -->
            <div class="pt-4 border-t border-crumb-200 space-y-2 text-xs sm:text-sm text-crumb-800/80">
                <div class="flex justify-between">
                    <span>Subtotal Produk</span>
                    <span class="font-semibold text-crumb-800">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Biaya Pengiriman</span>
                    <span class="font-semibold text-crumb-800">{{ $order->shipping_cost === 0 ? 'GRATIS' : 'Rp ' . number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="pt-2 border-t border-crumb-200 flex justify-between items-baseline text-base sm:text-lg font-bold text-crumb-800">
                    <span>Total Pembayaran</span>
                    <span class="font-serif text-crumb-600 text-xl font-bold">{{ $order->formatted_total }}</span>
                </div>
            </div>

            <!-- Destination Info Box -->
            <div class="pt-4 border-t border-crumb-100 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-crumb-800/80">
                <div>
                    <span class="font-bold text-crumb-800 block mb-1">Informasi Penerima:</span>
                    <p>{{ $order->customer_name }} &bull; {{ $order->customer_phone }}</p>
                    @if($order->customer_email) <p>{{ $order->customer_email }}</p> @endif
                </div>
                <div>
                    <span class="font-bold text-crumb-800 block mb-1">Tujuan Pengiriman:</span>
                    <p class="leading-relaxed">{{ $order->shipping_address }}</p>
                    @if($order->notes) <p class="text-[11px] text-crumb-500 italic mt-1">Catatan: "{{ $order->notes }}"</p> @endif
                </div>
            </div>
        </div>

        <!-- Back to Store Action -->
        <div class="text-center pt-4">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-crumb-800 hover:bg-crumb-500 text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
                &larr; Kembali ke Beranda
            </a>
        </div>

    </div>
</section>
@endsection
