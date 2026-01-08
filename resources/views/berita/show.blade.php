@extends('layout')

@section('title', $berita->judul)

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">{{ $berita->judul }}</h1>
        <div class="flex gap-2">
            <a href="javascript:history.back()" class="px-3 py-2 bg-gray-200 rounded">Kembali</a>
            @if($berita->external_url)
                <a href="{{ $berita->external_url }}" target="_blank" rel="noopener" class="px-3 py-2 bg-kemenag-green text-white rounded">Buka Sumber</a>
            @endif
        </div>
    </div>

    @if($berita->gambar)
        <img src="/{{ $berita->gambar }}" alt="cover" class="w-full max-h-80 object-cover rounded">
    @endif

    <div class="text-sm text-gray-500">{{ $berita->tanggal }} · {{ $berita->views }} views</div>

    

    <div class="prose max-w-none mt-4">
        {!! $berita->isi !!}
    </div>
</div>
@endsection
