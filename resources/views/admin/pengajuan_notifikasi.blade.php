@extends('material/temp_admin')

@section('content')
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold">Notifikasi Pengajuan</h2>
            <div class="flex items-center gap-2">
                <a href="?show=all" class="px-3 py-2 bg-gray-100 rounded">Tampilkan Semua</a>
                <button id="mark-read-btn" class="px-3 py-2 bg-emerald-600 text-white rounded">Tandai Dibaca</button>
            </div>
        </div>

        <form id="notifs-form">
            <table class="w-full bg-white rounded shadow overflow-hidden table-auto">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="p-3"><input id="check-all" type="checkbox"></th>
                        <th class="p-3">ID</th>
                        <th class="p-3">Judul</th>
                        <th class="p-3">Isi</th>
                        <th class="p-3">Dari Anggota</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Admin Read</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifikasis as $n)
                        <tr class="border-t">
                            <td class="p-3"><input name="ids[]" value="{{ $n->notifikasi_id }}" type="checkbox" class="row-check"></td>
                            <td class="p-3">{{ $n->notifikasi_id }}</td>
                            <td class="p-3 font-semibold">{{ $n->judul }}</td>
                            <td class="p-3">{{ Str::limit($n->isi, 140) }}</td>
                            <td class="p-3">{{ $n->anggota_id }} @if(isset($n->username)) ({{ $n->username }}) @endif</td>
                            <td class="p-3">{{ $n->created_at->format('d M Y H:i') }}</td>
                            <td class="p-3">@if($n->is_admin_read) <span class="text-sm text-green-600 font-medium">Dibaca</span> @else <span class="text-sm text-red-600 font-medium">Belum</span> @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        <div class="mt-4">
            {{ $notifikasis->links() }}
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function(){
            $('#check-all').on('change', function(){
                $('.row-check').prop('checked', this.checked);
            });

            $('#mark-read-btn').on('click', function(e){
                e.preventDefault();
                var ids = $('input.row-check:checked').map(function(){ return $(this).val(); }).get();
                if (!ids.length) { alert('Pilih minimal satu notifikasi'); return; }

                $.post('/notifikasi/mark-read', { id: ids, _token: '{{ csrf_token() }}' })
                    .done(function(res){
                        if (res.ok) {
                            // reload to reflect changes
                            location.reload();
                        } else {
                            alert('Gagal menandai dibaca');
                        }
                    })
                    .fail(function(){ alert('Terjadi kesalahan jaringan'); });
            });
        });
    </script>
@endsection
@extends('material.temp_admin')

@section('content')
<div class="max-w-5xl mx-auto p-4">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Notifikasi Pengajuan Pinjaman</h2>
        <div class="text-right">
            <p class="text-sm text-gray-500">Halaman {{ $notifikasis->currentPage() ?? 1 }} — Total {{ $notifikasis->total() ?? 0 }}</p>
            @if(isset($showAll) && $showAll)
                <a href="{{ url('/admin/notifikasi/pengajuan') }}" class="text-xs text-blue-600 hover:underline">Tampilkan belum dibaca</a>
            @else
                <a href="{{ url('/admin/notifikasi/pengajuan?show=all') }}" class="text-xs text-blue-600 hover:underline">Tampilkan semua</a>
            @endif
        </div>
    </div>

    <div class="space-y-3">
        @foreach($notifikasis as $notif)
            @php
                $dt = null;
                try { $dt = \Carbon\Carbon::parse($notif->created_at); } catch (\Exception $e) {}
            @endphp

            <div class="flex items-start gap-4 p-4 rounded-lg shadow-sm bg-white border">
                <div class="text-2xl text-blue-600 mt-1">
                    <i class="bi bi-send-fill"></i>
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
