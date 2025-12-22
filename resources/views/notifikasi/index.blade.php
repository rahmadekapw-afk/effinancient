@extends('material.temp')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Notifikasi</h2>
        <p class="text-sm text-gray-500">Halaman {{ $notifikasis->currentPage() ?? 1 }} — Total {{ $notifikasis->total() ?? 0 }}</p>
    </div>

    <div class="space-y-3">
        @foreach($notifikasis as $notif)
            @php
                $title = $notif->judul ?? '';
                $icon = 'bi-info-circle-fill';
                $bg = 'bg-white';
                $border = 'border-transparent';

                if (stripos($title, 'Pengajuan') !== false) { $icon = 'bi-send-fill'; }
                elseif (stripos($title, 'Disetujui') !== false) { $icon = 'bi-check-circle-fill'; }
                elseif (stripos($title, 'Lunas') !== false) { $icon = 'bi-cash-stack'; }
                elseif (stripos($title, 'Pembayaran') !== false) { $icon = 'bi-credit-card-fill'; }
                elseif (stripos($title, 'Anggota') !== false) { $icon = 'bi-person-plus-fill'; }

                // highlight unread for convenience (is_admin_read may be used for admin-side)
                if (isset($notif->is_admin_read) && $notif->is_admin_read == 0) {
                    $bg = 'bg-green-50';
                    $border = 'border-green-400';
                }

                // friendly date
                try { $dt = \Carbon\Carbon::parse($notif->created_at); }
                catch (\Exception $e) { $dt = null; }
            @endphp

            <div class="flex items-start gap-4 p-4 rounded-lg shadow-sm border-l-4 {{ $border }} {{ $bg }}">
                <div class="text-2xl text-green-600 mt-1">
                    <i class="bi {{ $icon }}"></i>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800">{{ $notif->judul }}</h3>
                            <p class="text-xs text-gray-500 mt-1">{{ $notif->isi }}</p>
                        </div>
                        <div class="text-right text-xs text-gray-400">
                            @if($dt)
                                <div>{{ $dt->translatedFormat('d M Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $dt->format('H:i') }}</div>
                            @else
                                <div>{{ $notif->tanggal }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-3 flex items-center gap-2">
                        <a href="javascript:void(0)" class="text-xs text-blue-600 hover:underline mark-as-read" data-id="{{ $notif->notifikasi_id }}">Tandai dibaca</a>
                        <span class="text-xs text-gray-400">•</span>
                        <a href="javascript:void(0)" class="text-xs text-red-600 hover:underline delete-notif" data-id="{{ $notif->notifikasi_id }}">Hapus</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        @if(method_exists($notifikasis, 'links'))
            <div class="flex justify-center">
                {{ $notifikasis->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
$(function(){
    // Tandai notifikasi spesifik sebagai dibaca via AJAX (update is_admin_read)
    $('.mark-as-read').on('click', function(){
        var id = $(this).data('id');
        if (! id) return;
        $.ajax({
            url: '/notifikasi/mark-read',
            method: 'POST',
            data: { id: id, _token: '{{ csrf_token() }}' }
        }).done(function(){
            location.reload();
        }).fail(function(){
            alert('Gagal menandai dibaca');
        });
    });

    // Hapus notifikasi dengan konfirmasi
    $('.delete-notif').on('click', function(){
        var id = $(this).data('id');
        if (! id) return;
        if (! confirm('Yakin ingin menghapus notifikasi ini?')) return;
        $.ajax({
            url: '/notifikasi/delete',
            method: 'POST',
            data: { id: id, _token: '{{ csrf_token() }}' }
        }).done(function(){
            location.reload();
        }).fail(function(){
            alert('Gagal menghapus notifikasi');
        });
    });
});
</script>
@endsection
