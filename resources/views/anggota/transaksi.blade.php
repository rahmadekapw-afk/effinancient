@extends('material/temp')

@section('content')
    <div class="p-4 md:p-6">

        <h2 class="text-xl font-bold text-gray-800">Riwayat Transaksi</h2>
        <p class="text-sm text-gray-600 mb-6">Semua transaksi keuangan Anda</p>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-500">
                <p class="text-sm text-gray-600 font-medium">Total Pemasukan</p>
                <p class="text-2xl font-bold text-green-700 mt-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                <p class="text-xs text-green-500 mt-1">
                    <i class="bi bi-arrow-up-right"></i> Simpanan & Pinjaman
                </p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-500">
                <p class="text-sm text-gray-600 font-medium">Total Pengeluaran</p>
                <p class="text-2xl font-bold text-red-500 mt-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                <p class="text-xs text-red-500 mt-1">
                    <i class="bi bi-arrow-down-left"></i> Penarikan & Angsuran
                </p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-blue-500">
                <p class="text-sm text-gray-600 font-medium">Total Transaksi</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalTransaksi }} Transaksi</p>
                <p class="text-xs text-blue-500 mt-1">Semua periode</p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-5 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                
                <div class="md:col-span-6">
                    <div class="relative">
                        <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="searchInput" class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-green-500 focus:border-green-500" placeholder="Cari transaksi..." />
                    </div>
                </div>

                <div class="md:col-span-3">
                    <div class="relative">
                        <i class="bi bi-funnel absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <select class="w-full border border-gray-300 rounded-lg appearance-none py-2 pl-10 pr-4 text-sm focus:ring-green-500 focus:border-green-500">
                            <option>Semua Jenis</option>
                            <option>Pemasukan</option>
                            <option>Pengeluaran</option>
                            <option>Simpanan Wajib</option>
                        </select>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <button class="w-full border border-green-600 text-green-600 hover:bg-green-50 font-medium py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors text-sm">
                        <i class="bi bi-download"></i> Export
                    </button>
                </div>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-5">
            <div class="overflow-x-auto">
                <table id="transactionTable" class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 font-semibold">ID</th>
                            <th scope="col" class="px-4 py-3 font-semibold">TANGGAL & WAKTU</th>
                            <th scope="col" class="px-4 py-3 font-semibold">JENIS TRANSAKSI</th>
                            <th scope="col" class="px-4 py-3 font-semibold">NOMINAL</th>
                            <th scope="col" class="px-4 py-3 font-semibold">METODE</th>
                            <th scope="col" class="px-4 py-3 font-semibold">STATUS</th>
                        </tr>
                    </thead>
                   <tbody>
                        @forelse($transaksi as $index => $row)
                        <tr class="bg-white border-b">

                            {{-- ID --}}
                            <td class="px-4 py-3 font-medium text-gray-800">
                                TRX{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                            </td>

                            {{-- TANGGAL & WAKTU --}}
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($row['tanggal'])->format('d M Y') }}
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($row['tanggal'])->format('H:i') }}
                                </div>
                            </td>

                            {{-- JENIS TRANSAKSI --}}
                            <td class="px-4 py-3 flex items-center gap-2
                                {{ $row['jenis'] === 'Pinjaman' ? 'text-green-700' : 'text-red-700' }}">

                                @if($row['jenis'] === 'Pinjaman')
                                    <i class="bi bi-arrow-up-right"></i>
                                    {{ $row['jenis'] }}
                                @else
                                    <i class="bi bi-arrow-down-left"></i>
                                    {{ $row['jenis'] }}
                                @endif
                            </td>

                            {{-- NOMINAL --}}
                            <td class="px-4 py-3 font-medium
                                {{ $row['jenis'] === 'Pinjaman' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $row['jenis'] === 'Pinjaman' ? '+' : '-' }}
                                Rp {{ number_format($row['jumlah'], 0, ',', '.') }}
                            </td>

                            {{-- METODE --}}
                            <td class="px-4 py-3">
                                {{ $row['metode'] }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-4 py-3">
                                <span class="text-xs font-medium px-2 py-0.5 rounded
                                    {{ in_array($row['status'], ['berhasil', 'disetujui'])
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($row['status']) }}
                                </span>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">
                                Belum ada transaksi
                            </td>
                        </tr>
                        @endforelse
                        </tbody>


                </table>
            </div>
        </section>

    </div>

    <script>
        // Menggunakan jQuery yang sudah dimuat di temp.blade.php
        $(document).ready(function() {
            var table = $('#transactionTable').DataTable({
                searching: true,
                lengthChange: true,
                pageLength: 5, // Tampilkan 5 baris per halaman
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/id.json' // Bahasa Indonesia
                }
            });

            // Tambahkan fungsi pencarian kustom ke input di luar DataTables
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });
            
            // Sembunyikan filter bawaan DataTables karena kita sudah buat filter kustom
            $('.dataTables_filter').hide();
        });
    </script>
@endsection