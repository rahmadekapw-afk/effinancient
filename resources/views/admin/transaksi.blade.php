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
                        <p class="text-sm text-gray-600 font-medium">Total Pemasukan</p>
                        <p class="text-2xl font-bold text-green-700 mt-1">Rp 8.5M</p>
                    </div>
                    <i class="bi bi-graph-up text-3xl text-green-500"></i>
                </div>
                <p class="text-xs text-green-500 mt-1">+12% dari bulan lalu</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Total Pengeluaran</p>
                        <p class="text-2xl font-bold text-red-500 mt-1">Rp 3.2M</p>
                    </div>
                    <i class="bi bi-graph-down text-3xl text-red-500"></i>
                </div>
                <p class="text-xs text-red-500 mt-1">+5% dari bulan lalu</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Transaksi Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">45</p>
                    </div>
                    <i class="bi bi-check-circle-fill text-3xl text-blue-500"></i>
                </div>
                <p class="text-xs text-blue-500 mt-1">3 pending</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-orange-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Pending Approval</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">8</p>
                    </div>
                    <i class="bi bi-clock-history text-3xl text-orange-500"></i>
                </div>
                <p class="text-xs text-orange-500 mt-1">Memerlukan review</p>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-5">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                
                <div class="md:col-span-2">
                    <div class="relative">
                        <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="search-input" class="w-full border border-gray-300 rounded-lg py-2 pl-10 pr-4 text-sm focus:ring-green-500 focus:border-green-500" placeholder="Cari transaksi, anggota, atau ID..." />
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <select id="jenis-filter" class="w-full border border-gray-300 rounded-lg appearance-none py-2 px-4 pr-8 text-sm focus:ring-green-500 focus:border-green-500 bg-white">
                            <option value="">Semua Jenis</option>
                            <option value="Simpanan Wajib">Simpanan Wajib</option>
                            <option value="Pengajuan Pinjaman">Pengajuan Pinjaman</option>
                            <option value="Penarikan">Penarikan</option>
                        </select>
                        <i class="bi bi-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <select class="w-full border border-gray-300 rounded-lg appearance-none py-2 px-4 pr-8 text-sm focus:ring-green-500 focus:border-green-500 bg-white">
                            <option>Bulan Ini</option>
                            <option>Bulan Lalu</option>
                            <option>Tahun Ini</option>
                        </select>
                        <i class="bi bi-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 mt-4">
                <button class="border border-green-600 text-green-600 hover:bg-green-50 font-medium py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors text-sm">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </button>
                <button class="border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors text-sm">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </button>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-5">
            <div class="overflow-x-auto">
                <table id="transaksi-admin-table" class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 py-3 font-semibold">ID TRANSAKSI</th>
                            <th scope="col" class="px-3 py-3 font-semibold">TANGGAL & WAKTU</th>
                            <th scope="col" class="px-3 py-3 font-semibold">ANGGOTA</th>
                            <th scope="col" class="px-3 py-3 font-semibold">JENIS TRANSAKSI</th>
                            <th scope="col" class="px-3 py-3 font-semibold">NOMINAL</th>
                            <th scope="col" class="px-3 py-3 font-semibold">METODE</th>
                            <th scope="col" class="px-3 py-3 font-semibold">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b">
                            <td class="px-3 py-4 font-medium text-green-600">TRX001</td>
                            <td class="px-3 py-4">5/11/2024<div class="text-xs text-gray-500">09:30</div></td>
                            <td class="px-3 py-4">
                                <p class="text-gray-800 font-medium">Ahmad Wijaya</p>
                                <p class="text-xs text-gray-500">A001</p>
                            </td>
                            <td class="px-3 py-4 font-medium text-green-700">Simpanan Wajib</td>
                            <td class="px-3 py-4 font-medium text-green-600">+Rp 100.000</td>
                            <td class="px-3 py-4">Transfer Bank</td>
                            <td class="px-3 py-4"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-3 py-4 font-medium text-green-600">TRX002</td>
                            <td class="px-3 py-4">5/11/2024<div class="text-xs text-gray-500">10:15</div></td>
                            <td class="px-3 py-4">
                                <p class="text-gray-800 font-medium">Siti Nurhaliza</p>
                                <p class="text-xs text-gray-500">A002</p>
                            </td>
                            <td class="px-3 py-4 font-medium text-blue-600">Pengajuan Pinjaman</td>
                            <td class="px-3 py-4 font-medium text-green-600">+Rp 5.000.000</td>
                            <td class="px-3 py-4">Manual</td>
                            <td class="px-3 py-4"><span class="text-xs font-medium text-orange-800 bg-orange-100 px-2 py-0.5 rounded">Pending</span></td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-3 py-4 font-medium text-green-600">TRX003</td>
                            <td class="px-3 py-4">5/11/2024<div class="text-xs text-gray-500">11:20</div></td>
                            <td class="px-3 py-4">
                                <p class="text-gray-800 font-medium">Budi Santoso</p>
                                <p class="text-xs text-gray-500">A003</p>
                            </td>
                            <td class="px-3 py-4 font-medium text-green-700">Simpanan Sukarela</td>
                            <td class="px-3 py-4 font-medium text-green-600">+Rp 500.000</td>
                            <td class="px-3 py-4">Tunai</td>
                            <td class="px-3 py-4"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-3 py-4 font-medium text-green-600">TRX004</td>
                            <td class="px-3 py-4">4/11/2024<div class="text-xs text-gray-500">14:45</div></td>
                            <td class="px-3 py-4">
                                <p class="text-gray-800 font-medium">Dewi Lestari</p>
                                <p class="text-xs text-gray-500">A004</p>
                            </td>
                            <td class="px-3 py-4 font-medium text-red-600">Penarikan</td>
                            <td class="px-3 py-4 font-medium text-red-600">-Rp 200.000</td>
                            <td class="px-3 py-4">Transfer Bank</td>
                            <td class="px-3 py-4"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
                        <tr class="bg-white">
                            <td class="px-3 py-4 font-medium text-green-600">TRX005</td>
                            <td class="px-3 py-4">4/11/2024<div class="text-xs text-gray-500">16:30</div></td>
                            <td class="px-3 py-4">
                                <p class="text-gray-800 font-medium">Rudi Hartono</p>
                                <p class="text-xs text-gray-500">A005</p>
                            </td>
                            <td class="px-3 py-4 font-medium text-green-700">Simpanan Pokok</td>
                            <td class="px-3 py-4 font-medium text-green-600">+Rp 1.000.000</td>
                            <td class="px-3 py-4">Transfer Bank</td>
                            <td class="px-3 py-4"><span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span></td>
                        </tr>
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Datatables
            var table = $('#transaksi-admin-table').DataTable({
                "dom": 'rtip', // Hanya tampilkan Tabel, Info, dan Pagination
                "pagingType": "simple_numbers",
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/2.0.2/i18n/id.json" // Bahasa Indonesia
                },
                "order": [[ 0, "desc" ]] // Default urutkan berdasarkan ID Transaksi (terbaru di atas)
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
@endsection