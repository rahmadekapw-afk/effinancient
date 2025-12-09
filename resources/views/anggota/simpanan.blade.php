@extends('material/temp')

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-4 md:gap-6">

        <div class="flex justify-between items-center mb-2">
            <h2 class="text-xl font-bold text-gray-800">Simpanan Saya</h2>
            <button
                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition-colors shadow-md">
                <i class="bi bi-plus text-xl"></i> Setor Simpanan
            </button>
        </div>
        <p class="text-sm text-gray-600 -mt-3">Kelola simpanan dan riwayat setoran Anda</p>

        <section class="bg-green-700 text-white rounded-lg shadow-lg p-5 grid grid-cols-3 gap-4">
            <div>
                <p class="text-sm font-semibold">Total Simpanan</p>
                <p class="text-2xl font-bold mt-1">Rp 6.500.000</p>
            </div>
            <div class="border-l border-green-600 pl-4">
                <p class="text-sm">Wajib</p>
                <p class="text-lg font-semibold">Rp 2.400.000</p>
            </div>
            <div class="border-l border-green-600 pl-4">
                <p class="text-sm">Sukarela</p>
                <p class="text-lg font-semibold">Rp 3.100.000</p>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex justify-between items-center">
                    <div class="p-2 bg-green-100 rounded-lg text-green-700">
                        <i class="bi bi-wallet2 text-xl"></i>
                    </div>
                    <span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded-full">Aktif</span>
                </div>
                <h4 class="text-base font-semibold text-gray-800 mt-3">Simpanan Wajib</h4>
                <p class="text-xl font-bold text-gray-900 mt-1">Rp 2.400.000</p>
                <div class="flex justify-between items-center text-sm mt-3 border-t pt-2">
                    <p class="text-gray-600">Setoran Rutin</p>
                    <p class="font-semibold text-green-700">Rp 100.000/bulan</p>
                </div>
                <p class="text-xs text-gray-500 mt-1">Total 24x setoran</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex justify-between items-center">
                    <div class="p-2 bg-blue-100 rounded-lg text-blue-700">
                        <i class="bi bi-box text-xl"></i>
                    </div>
                    <span class="text-xs font-medium text-blue-800 bg-blue-100 px-2 py-0.5 rounded-full">Terkunci</span>
                </div>
                <h4 class="text-base font-semibold text-gray-800 mt-3">Simpanan Pokok</h4>
                <p class="text-xl font-bold text-gray-900 mt-1">Rp 1.000.000</p>
                <div class="flex justify-between items-center text-sm mt-3 border-t pt-2">
                    <p class="text-gray-600">Tanggal Setor</p>
                    <p class="font-semibold text-blue-700">15 Jan 2023</p>
                </div>
                <p class="text-xs text-gray-500 mt-1">Dibayar saat pendaftaran</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex justify-between items-center">
                    <div class="p-2 bg-purple-100 rounded-lg text-purple-700">
                        <i class="bi bi-graph-up text-xl"></i>
                    </div>
                    <span
                        class="text-xs font-medium text-purple-800 bg-purple-100 px-2 py-0.5 rounded-full">Fleksibel</span>
                </div>
                <h4 class="text-base font-semibold text-gray-800 mt-3">Simpanan Sukarela</h4>
                <p class="text-xl font-bold text-gray-900 mt-1">Rp 3.100.000</p>
                <div class="flex justify-between items-center text-sm mt-3 border-t pt-2">
                    <p class="text-gray-600">Rata-rata Setoran</p>
                    <p class="font-semibold text-purple-700">Rp 500.000</p>
                </div>
                <p class="text-xs text-gray-500 mt-1">Total 12x setoran</p>
            </div>
        </section>


        <section class="bg-white rounded-lg shadow p-5">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-base font-semibold text-gray-800">Pertumbuhan Simpanan</h4>
                <div class="flex items-center gap-2 text-xs text-gray-600">
                    <i class="bi bi-calendar"></i>
                    <span>6 Bulan Terakhir</span>
                </div>
            </div>

            <div class="relative h-64 mb-6">
                <canvas id="growthChart"></canvas>
            </div>

            <div class="mt-8">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="text-base font-semibold text-gray-800">Riwayat Setoran</h4>
                    <a href="#" class="text-sm font-medium text-green-800 hover:underline flex items-center gap-1">
                        <i class="bi bi-box-arrow-down"></i> Export
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table id="depositTable" class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-semibold">TANGGAL</th>
                                <th scope="col" class="px-6 py-3 font-semibold">JENIS SIMPANAN</th>
                                <th scope="col" class="px-6 py-3 font-semibold">JUMLAH</th>
                                <th scope="col" class="px-6 py-3 font-semibold">METODE</th>
                                <th scope="col" class="px-6 py-3 font-semibold">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">05 Nov 2024</td>
                                <td class="px-6 py-4">Simpanan Wajib</td>
                                <td class="px-6 py-4 font-medium text-green-600">Rp 100.000</td>
                                <td class="px-6 py-4">Transfer</td>
                                <td class="px-6 py-4"><span
                                        class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span>
                                </td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">28 Okt 2024</td>
                                <td class="px-6 py-4">Simpanan Sukarela</td>
                                <td class="px-6 py-4 font-medium text-green-600">Rp 500.000</td>
                                <td class="px-6 py-4">Transfer</td>
                                <td class="px-6 py-4"><span
                                        class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span>
                                </td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">05 Okt 2024</td>
                                <td class="px-6 py-4">Simpanan Wajib</td>
                                <td class="px-6 py-4 font-medium text-green-600">Rp 100.000</td>
                                <td class="px-6 py-4">Tunai</td>
                                <td class="px-6 py-4"><span
                                        class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span>
                                </td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">20 Sep 2024</td>
                                <td class="px-6 py-4">Simpanan Sukarela</td>
                                <td class="px-6 py-4 font-medium text-green-600">Rp 300.000</td>
                                <td class="px-6 py-4">Transfer</td>
                                <td class="px-6 py-4"><span
                                        class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span>
                                </td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">05 Sep 2024</td>
                                <td class="px-6 py-4">Simpanan Wajib</td>
                                <td class="px-6 py-4 font-medium text-green-600">Rp 100.000</td>
                                <td class="px-6 py-4">Transfer</td>
                                <td class="px-6 py-4"><span
                                        class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span>
                                </td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">20 Agt 2024</td>
                                <td class="px-6 py-4">Simpanan Sukarela</td>
                                <td class="px-6 py-4 font-medium text-green-600">Rp 400.000</td>
                                <td class="px-6 py-4">Tunai</td>
                                <td class="px-6 py-4"><span
                                        class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">Berhasil</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. CHART.JS INITIALIZATION
            var ctx = document.getElementById('growthChart').getContext('2d');

            var growthData = {
                labels: ['Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov'],
                datasets: [
                    {
                        label: 'Simpanan Sukarela',
                        data: [2.0, 2.3, 2.6, 2.8, 3.1, 3.2],
                        borderColor: '#8b5cf6', // Ungu
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#8b5cf6',
                        fill: false
                    },
                    {
                        label: 'Simpanan Wajib',
                        data: [1.8, 2.0, 2.1, 2.2, 2.4, 2.4],
                        borderColor: '#22c55e', // Hijau
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#22c55e',
                        fill: false
                    }
                ]
            };

            var myChart = new Chart(ctx, {
                type: 'line',
                data: growthData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 3.5,
                            ticks: {
                                callback: function (value) { return value.toFixed(1); }
                            }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });

            // 2. DATATABLES INITIALIZATION
            $('#depositTable').DataTable({
                searching: true,
                lengthChange: true,
                pageLength: 5,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/id.json' // Bahasa Indonesia
                }
            });
        });
    </script>
@endsection