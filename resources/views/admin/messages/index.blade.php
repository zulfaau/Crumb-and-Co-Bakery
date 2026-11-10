@extends('layouts.admin')

@section('title', 'Pesan Kontak Pelanggan | Crumb & Co.')
@section('page_title', 'Pesan & Pertanyaan Masuk')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-stone-100 flex items-center justify-between">
            <div>
                <h3 class="font-serif text-lg font-bold text-stone-800">Daftar Pertanyaan Masuk</h3>
                <p class="text-xs text-stone-500">Pesan yang dikirimkan pelanggan melalui formulir kontak.</p>
            </div>
            <span class="text-xs font-bold text-crumb-600 bg-crumb-50 px-3 py-1 rounded-full border border-crumb-200">
                {{ $messages->total() }} Pesan
            </span>
        </div>

        <div class="divide-y divide-stone-100">
            @forelse($messages as $msg)
                <div class="p-6 {{ $msg->is_read ? 'bg-white' : 'bg-crumb-50/60' }} space-y-3 transition">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 rounded-full {{ $msg->is_read ? 'bg-stone-300' : 'bg-crumb-500' }}"></span>
                            <h4 class="font-bold text-stone-800 text-sm">{{ $msg->name }}</h4>
                            <span class="text-xs text-stone-500">&bull; {{ $msg->email }}</span>
                            @if($msg->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="text-xs text-emerald-600 font-semibold hover:underline">
                                    {{ $msg->phone }} ↗
                                </a>
                            @endif
                        </div>
                        <span class="text-[11px] text-stone-400">
                            {{ $msg->created_at->translatedFormat('d M Y, H:i') }} WIB ({{ $msg->created_at->diffForHumans() }})
                        </span>
                    </div>

                    <div class="pl-5 space-y-1">
                        <strong class="text-xs font-bold text-stone-800 block">Subjek: {{ $msg->subject }}</strong>
                        <p class="text-xs text-stone-700 leading-relaxed bg-white p-3 rounded-xl border border-stone-200/80">
                            {{ $msg->message }}
                        </p>
                    </div>

                    @if(!$msg->is_read)
                        <div class="pl-5 pt-1">
                            <form method="POST" action="{{ route('admin.messages.read', $msg->id) }}">
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-700 text-[11px] font-bold transition">
                                    Tandai Sudah Dibaca &check;
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="py-12 text-center text-stone-500 text-xs">
                    Belum ada pesan kontak dari pelanggan.
                </div>
            @endforelse
        </div>

        <div class="p-6 border-t border-stone-100">
            {{ $messages->links() }}
        </div>
    </div>

</div>
@endsection
