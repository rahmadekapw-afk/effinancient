@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto py-12">
    <h1 class="text-3xl font-extrabold mb-6">Semua Berita dan Kegiatan</h1>

    @if($beritas->count())
        <div class="grid md:grid-cols-2 gap-6">
            @foreach($beritas as $b)
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($b->gambar)
                        <img src="/{{ $b->gambar }}" alt="{{ $b->judul }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="text-xs text-kemenag-green font-semibold uppercase mb-2">{{ strtoupper($b->kategori ?? 'Berita') }}</div>
                        <h2 class="text-xl font-bold mb-2">{{ $b->judul }}</h2>
                        <p class="text-sm text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($b->isi ?? ''), 200) }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</span>
                            @php
                                $targetLink = $b->external_url ?? null;
                                if (! $targetLink && preg_match('#https?://#i', $b->slug ?? '')) {
                                    $targetLink = $b->slug;
                                }
                            @endphp
                            @if($targetLink)
                                <a href="{{ $targetLink }}" target="_blank" rel="noopener" class="text-kemenag-green font-semibold">Baca Selengkapnya</a>
                            @else
                                <a href="{{ url('/berita/'.$b->slug) }}" class="text-kemenag-green font-semibold">Baca Selengkapnya</a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $beritas->links() }}
        </div>
    @else
        <p class="text-gray-600">Belum ada berita.</p>
    @endif
</div>
@endsection
