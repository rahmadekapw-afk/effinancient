@extends('material/temp_admin')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center">
            <div>
                <div class="p-2 bg-blue-100 rounded-lg text-blue-600 mb-2">
                    <i class="bi bi-people-fill text-xl"></i>
                </div>
                <p class="text-lg font-bold text-gray-800">{{ $jumlah_anggota }}</p>
                <p class="text-xs text-gray-500">Total Anggota</p>
            </div>
            <div class="flex items-center text-sm text-green-600 font-medium">
                <i class="bi bi-arrow-up-right"></i> Anggota
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center">
            <div>
                <div class="p-2 bg-green-100 rounded-lg text-green-600 mb-2">
                    <i class="bi bi-wallet-fill text-xl"></i>
                </div>
                <p class="text-lg font-bold text-gray-800">Rp {{ number_format($simpanan)  }}</p>
                <p class="text-xs text-gray-500">Total Simpanan</p>
            </div>
            <div class="flex items-center text-sm text-green-600 font-medium">
                <i class="bi bi-arrow-up-right"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center">
            <div>
                <div class="p-2 bg-purple-100 rounded-lg text-purple-600 mb-2">
                    <i class="bi bi-arrow-down-up text-xl"></i>
                </div>
                <p class="text-lg font-bold text-gray-800">{{ $total_transaksi }}</p>
                <p class="text-xs text-gray-500">Transaksi Bulan Ini</p>
            </div>
            <div class="flex items-center text-sm text-green-600 font-medium">
                <i class="bi bi-arrow-up-right"></i> 
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center">
            <div>
                <div class="p-2 bg-orange-100 rounded-lg text-orange-600 mb-2">
                    <i class="bi bi-graph-up text-xl"></i>
                </div>
                <p class="text-lg font-bold text-gray-800">{{ $pertumbuhan }}</p>
                <p class="text-xs text-gray-500">Pertumbuhan</p>
            </div>
            <div class="flex items-center text-sm text-green-600 font-medium">
                <i class="bi bi-arrow-up-right"></i> {{ number_format($presentase, 2)  }} %
            </div>
        </div>

        <div class="lg:col-span-3 grid grid-cols-1 xl:grid-cols-2 gap-6">

            <div class="bg-white rounded-lg shadow p-5 h-full">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Pertumbuhan Bulanan</h3>
                <div class="relative h-64">
                    <canvas id="growthChartAdmin"></canvas>
                </div>
                <div class="flex justify-center gap-4 text-xs mt-4">
                    <span class="flex items-center gap-1 text-blue-600"><span
                            class="w-2 h-2 rounded-full bg-blue-600"></span> Pinjaman (Juta)</span>
                    <span class="flex items-center gap-1 text-green-600"><span
                            class="w-2 h-2 rounded-full bg-green-600"></span> Simpanan (Juta)</span>
                    <span class="flex items-center gap-1 text-orange-500"><span
                            class="w-2 h-2 rounded-full bg-orange-500"></span> Transaksi</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 h-full">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Kategori Anggota</h3>
                <div class="relative h-64 flex justify-center items-center">
                    <canvas id="memberCategoryChart"></canvas>
                </div>
                <div class="flex justify-center gap-4 text-xs mt-4">
                    <span class="flex items-center gap-1 text-green-600"><span
                            class="w-2 h-2 rounded-full bg-green-600"></span> Aktif 69%</span>
                    <span class="flex items-center gap-1 text-orange-500"><span
                            class="w-2 h-2 rounded-full bg-orange-500"></span> Pasif 20%</span>
                    <span class="flex items-center gap-1 text-blue-500"><span
                            class="w-2 h-2 rounded-full bg-blue-500"></span> Baru 11%</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 xl:col-span-2">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Distribusi Jenis Transaksi</h3>
                <div class="relative h-64">
                    <canvas id="transactionBarChart"></canvas>
                </div>
                <div class="flex justify-center gap-2 text-xs mt-4">
                    <span class="flex items-center gap-1 text-green-600"><span
                            class="w-2 h-2 rounded-full bg-green-600"></span> Jumlah Transaksi</span>
                </div>
            </div>

        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-5 h-full">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Aktivitas Terkini</h3>

                <div class="space-y-4">
                    <div class="border-b pb-4">
                        <p class="font-medium text-gray-900">Ahmad Wijaya</p>
                        <div class="flex justify-between items-center text-sm">
                            <p class="text-gray-600">Setor Simpanan Wajib</p>
                            <p class="text-xs text-gray-500">5 menit lalu</p>
                        </div>
                        <p class="font-bold text-green-600 text-sm">Rp 100.000</p>
                    </div>
                    <div class="border-b pb-4">
                        <p class="font-medium text-gray-900">Siti Nurhaliza</p>
                        <div class="flex justify-between items-center text-sm">
                            <p class="text-gray-600">Pengajuan Pinjaman</p>
                            <p class="text-xs text-gray-500">15 menit lalu</p>
                        </div>
                        <p class="font-bold text-red-500 text-sm">Rp 5.000.000</p>
                    </div>
                    <div class="pb-4">
                        <p class="font-medium text-gray-900">Budi Santoso</p>
                        <div class="flex justify-between items-center text-sm">
                            <p class="text-gray-600">Setor Simpanan Sukarela</p>
                            <p class="text-xs text-gray-500">32 menit lalu</p>
                        </div>
                        <p class="font-bold text-green-600 text-sm">Rp 500.000</p>
                    </div>
                    <div class="text-sm text-gray-500 italic">
                        Dewi Lestari (dll...)
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // PENTING: Gunakan Vanilla JS DOMContentLoaded untuk keandalan
        document.addEventListener('DOMContentLoaded', function () {

            // Memberi sedikit delay jika diperlukan
            setTimeout(function () {

                // Data simulasi sesuai gambar
                const pinjamanData = [100, 110, 130, 150, 170, 190];
                const simpananData = [170, 180, 200, 220, 240, 260];
                const transaksiData = [85, 95, 105, 120, 140, 160];
                const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];

                // Fungsi Pembantu untuk Membuat Chart
                function createChart(id, type, data, options) {
                    const ctx = document.getElementById(id);
                    if (ctx && typeof Chart !== 'undefined') {
                        new Chart(ctx.getContext('2d'), {
                            type: type,
                            data: data,
                            options: options
                        });
                    }
                }

                // 1. GRAFIK GARIS: Pertumbuhan Bulanan
                const growthData = {
                    labels: labels,
                    datasets: [
                        { label: 'Pinjaman (Juta)', data: pinjamanData, borderColor: '#3b82f6', tension: 0.4, fill: false, pointRadius: 4, pointBackgroundColor: '#3b82f6' },
                        { label: 'Simpanan (Juta)', data: simpananData, borderColor: '#10b981', tension: 0.4, fill: false, pointRadius: 4, pointBackgroundColor: '#10b981' },
                        { label: 'Transaksi', data: transaksiData, borderColor: '#f97316', tension: 0.4, fill: false, pointRadius: 4, pointBackgroundColor: '#f97316' }
                    ]
                };
                const growthOptions = {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, max: 340, ticks: { stepSize: 85 } },
                        x: { grid: { display: false } }
                    }
                };
                createChart('growthChartAdmin', 'line', growthData, growthOptions);


                // 2. GRAFIK PIE: Kategori Anggota
                const memberData = {
                    labels: ['Aktif 69%', 'Pasif 20%', 'Baru 11%'],
                    datasets: [{
                        data: [69, 20, 11],
                        backgroundColor: ['#10b981', '#f97316', '#3b82f6'],
                        hoverOffset: 4
                    }]
                };
                createChart('memberCategoryChart', 'pie', memberData, {
                    responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { enabled: true } }
                });


                // 3. GRAFIK BAR: Distribusi Jenis Transaksi
                const transactionData = {
                    labels: ['Simpanan Pokok', 'Simpanan Wajib', 'Simpanan Sukarela', 'Penarikan', 'Pinjaman'],
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: [100, 360, 180, 80, 100],
                        backgroundColor: '#10b981',
                        borderRadius: 4
                    }]
                };
                const transactionOptions = {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, max: 360, ticks: { stepSize: 90 } },
                        x: { grid: { display: false } }
                    }
                };
                createChart('transactionBarChart', 'bar', transactionData, transactionOptions);

            }, 50);
        });
    </script>
@endsection