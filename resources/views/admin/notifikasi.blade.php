@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Notifikasi Admin</h1>

    @forelse($notifikasis as $notif)
        <div class="border rounded p-4 mb-3
            {{ $notif->is_admin_read ? 'bg-gray-100' : 'bg-yellow-50' }}">
            
            <h3 class="font-semibold">
                {{ $notif->judul }}
            </h3>

            <p class="text-sm text-gray-700 mt-1">
                {{ $notif->isi }}
            </p>

            <span class="text-xs text-gray-500">
                {{ $notif->tanggal }}
            </span>
        </div>
    @empty
        <p>Tidak ada notifikasi</p>
    @endforelse
</div>
@endsection
