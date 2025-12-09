@extends('material/temp')

@section('content')
    <div class="p-4 md:p-6">

        <h2 class="text-xl font-bold text-gray-800">Riwayat Transaksi</h2>
        <p class="text-sm text-gray-600 mb-6">Semua transaksi keuangan Anda</p>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-500">
                <p class="text-sm text-gray-600 font-medium">Total Pemasukan</p>
                <p class="text-2xl font-bold text-green-700 mt-1">Rp 3.100.000</p>
                <p class="text-xs text-green-500 mt-1">
                    <i class="bi bi-arrow-up-right"></i> Simpanan & Pinjaman
                </p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-500">
                <p class="text-sm text-gray-600 font-medium">Total Pengeluaran</p>
                <p class="text-2xl font-bold text-red-500 mt-1">Rp 250.000</p>
                <p class="text-xs text-red-500 mt-1">
                    <i class="bi bi-arrow-down-left"></i> Penarikan & Angsuran
                </p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-blue-500">
                <p class="text-sm text-gray-600 font-medium">Total Transaksi</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">8</p>
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
                        <tr class="bg-white border-b">
                            <td class="px-4 py-3 font-medium text-gray-800">TRX001</td>
                            <td class="px-4 py-3">05 Nov 2024<div class="text-xs text-gray-500">09:30</div></td>
                            <td class="px-4 py-3 flex items-center gap-2 text-green-700"><i class="bi bi-arrow-up-right"></i> Setor Simpanan Wajib</td>
                            <td class="px-4 py-3 font-medium text-green-600">+Rp 100.000</td>
                            <td class="px-4 py-3">Transfer Bank</td>
                            <td class="px-4 py-3"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-3 font-medium text-gray-800">TRX002</td>
                            <td class="px-4 py-3">01 Nov 2024<div class="text-xs text-gray-500">14:15</div></td>
                            <td class="px-4 py-3 flex items-center gap-2 text-red-600"><i class="bi bi-arrow-down-left"></i> Angsuran Pinjaman</td>
                            <td class="px-4 py-3 font-medium text-red-600">-Rp 50.000</td>
                            <td class="px-4 py-3">Auto Debit</td>
                            <td class="px-4 py-3"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-3 font-medium text-gray-800">TRX003</td>
                            <td class="px-4 py-3">28 Okt 2024<div class="text-xs text-gray-500">11:20</div></td>
                            <td class="px-4 py-3 flex items-center gap-2 text-green-700"><i class="bi bi-arrow-up-right"></i> Setor Simpanan Sukarela</td>
                            <td class="px-4 py-3 font-medium text-green-600">+Rp 500.000</td>
                            <td class="px-4 py-3">Transfer Bank</td>
                            <td class="px-4 py-3"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-3 font-medium text-gray-800">TRX004</td>
                            <td class="px-4 py-3">25 Okt 2024<div class="text-xs text-gray-500">16:45</div></td>
                            <td class="px-4 py-3 flex items-center gap-2 text-red-600"><i class="bi bi-arrow-down-left"></i> Penarikan Simpanan</td>
                            <td class="px-4 py-3 font-medium text-red-600">-Rp 200.000</td>
                            <td class="px-4 py-3">Transfer Bank</td>
                            <td class="px-4 py-3"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-3 font-medium text-gray-800">TRX005</td>
                            <td class="px-4 py-3">20 Okt 2024<div class="text-xs text-gray-500">10:00</div></td>
                            <td class="px-4 py-3 flex items-center gap-2 text-green-700"><i class="bi bi-arrow-up-right"></i> Pencairan Pinjaman</td>
                            <td class="px-4 py-3 font-medium text-green-600">+Rp 2.000.000</td>
                            <td class="px-4 py-3">Transfer Bank</td>
                            <td class="px-4 py-3"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-3 font-medium text-gray-800">TRX006</td>
                            <td class="px-4 py-3">05 Okt 2024<div class="text-xs text-gray-500">09:30</div></td>
                            <td class="px-4 py-3 flex items-center gap-2 text-green-700"><i class="bi bi-arrow-up-right"></i> Setor Simpanan Wajib</td>
                            <td class="px-4 py-3 font-medium text-green-600">+Rp 100.000</td>
                            <td class="px-4 py-3">Tunai</td>
                            <td class="px-4 py-3"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-3 font-medium text-gray-800">TRX007</td>
                            <td class="px-4 py-3">20 Sep 2024<div class="text-xs text-gray-500">13:15</div></td>
                            <td class="px-4 py-3 flex items-center gap-2 text-green-700"><i class="bi bi-arrow-up-right"></i> Setor Simpanan Sukarela</td>
                            <td class="px-4 py-3 font-medium text-green-600">+Rp 300.000</td>
                            <td class="px-4 py-3">Transfer Bank</td>
                            <td class="px-4 py-3"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="px-4 py-3 font-medium text-gray-800">TRX008</td>
                            <td class="px-4 py-3">05 Sep 2024<div class="text-xs text-gray-500">09:30</div></td>
                            <td class="px-4 py-3 flex items-center gap-2 text-green-700"><i class="bi bi-arrow-up-right"></i> Setor Simpanan Wajib</td>
                            <td class="px-4 py-3 font-medium text-green-600">+Rp 100.000</td>
                            <td class="px-4 py-3">Transfer Bank</td>
                            <td class="px-4 py-3"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
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