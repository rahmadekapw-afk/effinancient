@extends('material/temp_admin')

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-6">

        <div>
            <h2 class="text-xl font-bold text-gray-800">Manajemen Transaksi</h2>
            <p class="text-sm text-gray-600">Kelola semua transaksi koperasi</p>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-3">

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Transaksi Hari ini</p>
                        <p class="text-2xl font-bold text-green-700 mt-1"> {{ $transaksi_sekarang }}</p>
                    </div>
                    <i class="bi bi-graph-up text-3xl text-green-500"></i>
                </div>
                <p class="text-xs text-green-500 mt-1">Total Transaksi Hari ini</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Total Pengeluaran</p>
                        <p class="text-2xl font-bold text-red-500 mt-1">Rp {{ number_format($total_pinjaman_menunggu)  }}
                        </p>
                    </div>
                    <i class="bi bi-graph-down text-3xl text-red-500"></i>
                </div>
                <p class="text-xs text-red-500 mt-1">Dana Dipinjamkan</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Transaksi Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_pinjaman_terima }}</p>
                    </div>
                    <i class="bi bi-check-circle-fill text-3xl text-blue-500"></i>
                </div>
                <p class="text-xs text-blue-500 mt-1">Pinjaman Diterima</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-orange-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Pending Approval</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $pending }}</p>
                    </div>
                    <i class="bi bi-clock-history text-3xl text-orange-500"></i>
                </div>
                <p class="text-xs text-orange-500 mt-1">Belum Di konfirmasi</p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-5">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="md:col-span-2">
                    <div class="relative">
                        <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="search-input"
                            class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-green-500 focus:border-green-500"
                            placeholder="Cari transaksi, anggota, atau ID..." />
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <select id="jenis-filter"
                            class="w-full border border-gray-300 rounded-lg appearance-none py-2 px-4 pr-8 text-sm focus:ring-green-500 focus:border-green-500 bg-white">
                            <option value="">Semua Jenis</option>
                            <option value="Simpanan Wajib">Simpanan Wajib</option>
                            <option value="Pengajuan Pinjaman">Pengajuan Pinjaman</option>
                            <option value="Penarikan">Penarikan</option>
                        </select>
                        <i
                            class="bi bi-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <select
                            class="w-full border border-gray-300 rounded-lg appearance-none py-2 px-4 pr-8 text-sm focus:ring-green-500 focus:border-green-500 bg-white">
                            <option>Bulan Ini</option>
                            <option>Bulan Lalu</option>
                            <option>Tahun Ini</option>
                        </select>
                        <i
                            class="bi bi-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 mt-4">
                <button
                    class="border border-green-600 text-green-600 hover:bg-green-50 font-medium py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors text-sm">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </button>
                <button
                    class="border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors text-sm">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </button>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-5">
            <div class="overflow-x-auto">
                <table id="transaksi-admin-table" class="w-full text-sm text-left text-gray-500">
                 <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-3 py-3 font-semibold">ID</th>
                            <th class="px-3 py-3 font-semibold">TANGGAL & WAKTU</th>
                            <th class="px-3 py-3 font-semibold">ANGGOTA</th>
                            <th class="px-3 py-3 font-semibold">JENIS TRANSAKSI</th>
                            <th class="px-3 py-3 font-semibold">NOMINAL</th>

                            <!-- TAMBAHAN -->
                            <th class="px-3 py-3 font-semibold">BUNGA</th>
                            <th class="px-3 py-3 font-semibold">JANGKA WAKTU</th>
                            <th class="px-3 py-3 font-semibold">ANGSURAN / BULAN</th>

                            <th class="px-3 py-3 font-semibold">STATUS</th>
                            <th class="px-3 py-3 font-semibold">METODE</th>
                            <th class="px-3 py-3 font-semibold">KONFIRMASI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinjaman as $p)
                        @php
                            $bungaPerBulan = 0.007;
                            $totalBunga   = $p->nominal * $bungaPerBulan * $p->jangka_waktu;
                            $totalPinjaman = $p->nominal + $totalBunga;
                            $angsuran = $p->jangka_waktu > 0 ? $totalPinjaman / $p->jangka_waktu : 0;
                        @endphp

                        <tr class="bg-white border-b">

                            {{-- ID --}}
                            <td class="px-3 py-4 font-medium text-green-600">
                                {{ $p->pinjaman_id }}
                            </td>

                            {{-- TANGGAL --}}
                            <td class="px-3 py-4">
                                {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d/m/Y') }}
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('H:i') }}
                                </div>
                            </td>

                            {{-- ANGGOTA --}}
                            <td class="px-3 py-4">
                                <p class="text-gray-800 font-medium">{{ $p->nama_lengkap }}</p>
                                <p class="text-xs text-gray-500">{{ $p->anggota_id }}</p>
                            </td>

                            {{-- JENIS --}}
                            <td class="px-3 py-4 font-medium text-blue-600">
                                Pengajuan Pinjaman
                            </td>

                            {{-- NOMINAL --}}
                            <td class="px-3 py-4 font-medium text-green-600">
                                Rp {{ number_format($p->nominal, 0, ',', '.') }}
                            </td>

                            {{-- BUNGA --}}
                            <td class="px-3 py-4 text-gray-700">
                                0,7% / bulan
                            </td>

                            {{-- JANGKA WAKTU --}}
                            <td class="px-3 py-4 text-gray-700">
                                {{ $p->jangka_waktu }} bulan
                            </td>

                            {{-- ANGSURAN --}}
                            <td class="px-3 py-4 font-medium text-green-700">
                                Rp {{ number_format($angsuran, 0, ',', '.') }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-3 py-4">
                                @if($p->status_pinjaman == 'menunggu')
                                    <span class="text-xs font-medium text-orange-800 bg-orange-100 px-2 py-0.5 rounded">
                                        Pending
                                    </span>
                                @elseif($p->status_pinjaman == 'disetujui')
                                    <span class="text-xs font-medium text-black bg-yellow-100 px-2 py-0.5 rounded">
                                        Diterima
                                    </span>
                                @elseif($p->status_pinjaman == 'lunas')
                                    <span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">
                                        Lunas
                                    </span>
                                @else
                                    <span class="text-xs font-medium text-red-800 bg-red-100 px-2 py-0.5 rounded">
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            <td class="px-3 py-4 text-gray-700">
                                {{ $p->pembayaran }}
                            </td>

                            {{-- KONFIRMASI --}}
                            <td class="px-3 py-4">
                                    {{-- STATUS MENUNGGU --}}
                                    @if ($p->status_pinjaman === 'menunggu')
                                        <div class="flex gap-2">
                                            <button onclick="approvePinjaman({{ $p->pinjaman_id }})"
                                                class="px-3 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700">
                                                Setujui
                                            </button>

                                            <button onclick="rejectPinjaman({{ $p->pinjaman_id }})"
                                                class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                                                Tolak
                                            </button>
                                        </div>

                                    {{-- STATUS DISETUJUI --}}
                                    @elseif ($p->status_pinjaman === 'disetujui')
                                        <div class="flex flex-col gap-2">
                                            <span class="text-xs font-semibold text-blue-700">
                                                Sedang Diproses
                                            </span>

                                            <button onclick="lunasPinjaman({{ $p->pinjaman_id }})"
                                                class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 w-max">
                                                Tandai Lunas
                                            </button>
                                        </div>

                                    {{-- STATUS LUNAS --}}
                                    @elseif ($p->status_pinjaman === 'lunas')
                                        <span class="text-xs font-semibold text-green-800 bg-green-100 px-2 py-1 rounded">
                                            LUNAS ✔
                                        </span>

                                    {{-- STATUS DITOLAK --}}
                                    @elseif ($p->status_pinjaman === 'ditolak')
                                        <span class="text-xs font-semibold text-red-800 bg-red-100 px-2 py-1 rounded">
                                            DITOLAK
                                        </span>
                                    @endif

                                </td>

                        </tr>
                        @endforeach
                        </tbody>


                </table>
            </div>

            <div id="datatables-transaksi-info" class="mt-4 flex justify-between items-center text-sm text-gray-600">
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/2.0.2/js/jquery.dataTables.min.js"></script>

   <script>
       function lunasPinjaman(id) {
        if (!confirm('Yakin ingin menandai pinjaman ini sebagai LUNAS?')) return;

        fetch(`/admin/pinjaman/${id}/lunas`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // refresh agar status berubah
            } else {
                alert('Gagal mengubah status');
            }
        })
        .catch(() => alert('Terjadi kesalahan'));
    }
   </script>
   <script>
        
        $(document).ready(function () {
            // Inisialisasi Datatables
            var table = $('#transaksi-admin-table').DataTable({
                "dom": 'rtip', // Hanya tampilkan Tabel, Info, dan Pagination
                "pagingType": "simple_numbers",
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/2.0.2/i18n/id.json" // Bahasa Indonesia
                },
                "order": [[0, "desc"]] // Default urutkan berdasarkan ID Transaksi (terbaru di atas)
            });

            // 1. Kustomisasi Pencarian Global
            $('#search-input').on('keyup', function () {
                table.search(this.value).draw();
            });

            // 2. Kustomisasi Filter Jenis Transaksi (Kolom ke-3)
            $('#jenis-filter').on('change', function () {
                // Kolom ke-3 adalah JENIS TRANSAKSI (indeks 3)
                table.column(3).search(this.value).draw();
            });

            // Pindahkan elemen Datatables ke wrapper yang lebih cocok
            $('#transaksi-admin-table_info').appendTo('#datatables-transaksi-info');
            $('#transaksi-admin-table_paginate').appendTo('#datatables-transaksi-info');
        });
    </script>
    <script>
    function lunasPinjaman(id) {
        Swal.fire({
            title: 'Tandai Pinjaman Lunas?',
            text: 'Status pinjaman akan diubah menjadi LUNAS.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#16a34a', // hijau
            cancelButtonColor: '#dc2626', // merah
            confirmButtonText: 'Ya, Lunas',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                fetch(`/admin/pinjaman/${id}/lunas`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pinjaman telah ditandai LUNAS.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', data.message ?? 'Tidak dapat mengubah status', 'error');
                    }
                })
                .catch(() => {
                    Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                });
            }
        });
    }
</script>


    <script>
        function approvePinjaman(idPinjaman) {
            Swal.fire({
                title: "Setujui Pengajuan?",
                text: "Pengajuan pinjaman anggota ini akan disetujui.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Setujui",
                cancelButtonText: "Batal",
                confirmButtonColor: "#16a34a",
                cancelButtonColor: "#6b7280",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/transaksi/konfirmasi/" + idPinjaman + "?status=disetujui";
                }
            });
        }

        function rejectPinjaman(idPinjaman) {
            Swal.fire({
                title: "Tolak Pengajuan?",
                text: "Pengajuan pinjaman anggota ini akan ditolak.",
                icon: "error",
                showCancelButton: true,
                confirmButtonText: "Ya, Tolak",
                cancelButtonText: "Batal",
                confirmButtonColor: "#dc2626",
                cancelButtonColor: "#6b7280",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/transaksi/konfirmasi/" + idPinjaman + "?status=menunggu";
                }
            });
        }

    </script>
@endsection