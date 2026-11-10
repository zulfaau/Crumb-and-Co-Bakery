@extends('layouts.app')

@section('title', 'Riwayat Pesanan Saya | Crumb & Co.')

@section('content')
<section class="bg-crumb-100 py-10 border-b border-crumb-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-serif text-3xl font-bold text-crumb-800">Riwayat Pesanan Saya</h1>
            <p class="text-xs text-crumb-800/60 mt-1">Halo, {{ Auth::user()->name }}! Pantau seluruh status pesanan bakery Anda.</p>
        </div>
        <a href="{{ route('shop.index') }}" class="px-6 py-2.5 rounded-full bg-crumb-800 text-white text-xs font-bold hover:bg-crumb-500 transition shadow-sm">
            + Pesan Roti Baru
        </a>
    </div>
</section>

<section class="py-12 bg-crumb-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($orders->isEmpty())
            <div class="max-w-md mx-auto text-center bg-white rounded-3xl p-10 border border-crumb-200 shadow-sm space-y-3">
                <div class="w-16 h-16 mx-auto rounded-full bg-crumb-100 flex items-center justify-center text-crumb-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h3 class="font-serif text-xl font-bold text-crumb-800">Belum Ada Pesanan</h3>
                <p class="text-xs text-crumb-600">Anda belum pernah melakukan pemesanan di Crumb & Co.</p>
                <div class="pt-2">
                    <a href="{{ route('shop.index') }}" class="inline-block px-6 py-2.5 rounded-full bg-crumb-800 text-white text-xs font-bold hover:bg-crumb-500 transition">
                        Buka Menu Toko
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $ord)
                    <div class="bg-white rounded-3xl p-6 border border-crumb-200 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6 hover:border-crumb-300 transition">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-sm font-bold text-crumb-800">{{ $ord->order_number }}</span>
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $ord->status_badge_class }}">
                                    {{ $ord->status_label }}
                                </span>
                            </div>
                            <p class="text-xs text-crumb-500">
                                Dipesan pada {{ $ord->created_at->translatedFormat('d F Y, H:i') }} WIB &bull; {{ $ord->delivery_method === 'pickup' ? 'Ambil di Toko' : 'Kirim ke Alamat' }}
                            </p>
                            <p class="text-xs text-crumb-800/80">
                                <strong>Item:</strong> 
                                @foreach($ord->items as $it)
                                    {{ $it->quantity }}x {{ $it->product_name }}@if(!$loop->last), @endif
                                @endforeach
                            </p>
                        </div>

                        <div class="flex items-center justify-between w-full md:w-auto gap-6 border-t md:border-t-0 pt-3 md:pt-0 border-crumb-100">
                            <div class="text-left md:text-right">
                                <span class="text-[10px] text-crumb-400 uppercase font-semibold block">Total</span>
                                <span class="font-serif text-lg font-bold text-crumb-600">{{ $ord->formatted_total }}</span>
                            </div>
                            <a href="{{ route('orders.show', $ord->order_number) }}" 
                               class="px-5 py-2.5 rounded-full border border-crumb-300 hover:bg-crumb-800 hover:text-white text-crumb-800 text-xs font-bold transition shadow-sm">
                                Detail Struk &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="pt-6">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
