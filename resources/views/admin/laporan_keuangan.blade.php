@extends('material/temp_admin') 

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-6">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Laporan Keuangan</h2>
                <p class="text-sm text-gray-600">Smart Financial Report - Pelaporan otomatis keuangan koperasi</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition-colors shadow-md">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </button>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition-colors shadow-md">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </button>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4">
            <label class="text-sm font-medium text-gray-700 flex items-center gap-2">
                <i class="bi bi-calendar-event"></i> Periode Laporan:
            </label>
            <div class="relative">
                <select class="border border-gray-300 rounded-lg py-2 px-4 appearance-none focus:ring-green-500 focus:border-green-500 bg-white text-sm">
                    <option>Bulan Ini</option>
                    <option>Bulan Lalu</option>
                    <option>Tahun Ini</option>
                </select>
                <i class="bi bi-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
            </div>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="p-6 rounded-lg text-white shadow-xl bg-gradient-to-r from-green-500 to-green-700 relative overflow-hidden">
                <i class="bi bi-arrow-up-right text-4xl absolute -top-1 -right-1 opacity-20"></i>
                <p class="text-sm font-light">Total Pemasukan</p>
                <p class="text-3xl font-bold mt-1">Rp 9.0M</p>
                <span class="absolute top-4 right-4 text-xs font-semibold bg-white bg-opacity-20 px-2 py-1 rounded-full">+12%</span>
            </div>

            <div class="p-6 rounded-lg text-white shadow-xl bg-gradient-to-r from-red-500 to-red-700 relative overflow-hidden">
                <i class="bi bi-arrow-down-right text-4xl absolute -top-1 -right-1 opacity-20"></i>
                <p class="text-sm font-light">Total Pengeluaran</p>
                <p class="text-3xl font-bold mt-1">Rp 3.7M</p>
                <span class="absolute top-4 right-4 text-xs font-semibold bg-white bg-opacity-20 px-2 py-1 rounded-full">+8%</span>
            </div>

            <div class="p-6 rounded-lg text-white shadow-xl bg-gradient-to-r from-blue-500 to-blue-700 relative overflow-hidden">
                <i class="bi bi-currency-dollar text-4xl absolute -top-1 -right-1 opacity-20"></i>
                <p class="text-sm font-light">Laba Bersih</p>
                <p class="text-3xl font-bold mt-1">Rp 5.3M</p>
                <span class="absolute top-4 right-4 text-xs font-semibold bg-white bg-opacity-20 px-2 py-1 rounded-full">+15%</span>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Tren Keuangan Bulanan</h3>
                <div class="relative h-72">
                    <canvas id="financialTrendChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Perbandingan Pemasukan vs Pengeluaran</h3>
                <div class="relative h-72">
                    <canvas id="incomeVsExpenseChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Rincian Pemasukan</h3>
                <div class="relative h-72">
                    <canvas id="incomeDetailChart"></canvas>
                </div>
                <div class="flex flex-wrap justify-center gap-3 text-xs mt-4">
                    <span class="flex items-center gap-1 text-green-600"><span class="w-2 h-2 rounded-full bg-green-600"></span> Simpanan Wajib 39%</span>
                    <span class="flex items-center gap-1 text-blue-500"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Simpanan Sukarela 31%</span>
                    <span class="flex items-center gap-1 text-orange-500"><span class="w-2 h-2 rounded-full bg-orange-500"></span> Bunga Pinjaman 21%</span>
                    <span class="flex items-center gap-1 text-purple-500"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Lain-lain 9%</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Rincian Pengeluaran</h3>
                <div class="relative h-72">
                    <canvas id="expenseDetailChart"></canvas>
                </div>
                <div class="flex flex-wrap justify-center gap-3 text-xs mt-4">
                    <span class="flex items-center gap-1 text-red-600"><span class="w-2 h-2 rounded-full bg-red-600"></span> Operasional 32%</span>
                    <span class="flex items-center gap-1 text-orange-600"><span class="w-2 h-2 rounded-full bg-orange-600"></span> Gaji Karyawan 41%</span>
                    <span class="flex items-center gap-1 text-yellow-500"><span class="w-2 h-2 rounded-full bg-yellow-500"></span> Pemeliharaan 16%</span>
                    <span class="flex items-center gap-1 text-gray-500"><span class="w-2 h-2 rounded-full bg-gray-500"></span> Lain-lain 11%</span>
                </div>
            </div>
        </section>
        
        <section class="bg-white rounded-lg shadow p-5">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Laporan Arus Kas</h3>
            
            <div class="space-y-3">
                <div class="flex justify-between items-center py-2 px-3 rounded-lg bg-green-50 border-l-4 border-green-400">
                    <p class="font-semibold text-gray-800">Saldo Awal</p>
                    <p class="font-bold text-green-600">+Rp 12.500.000</p>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-200">
                    <p class="text-gray-700 ml-3">Simpanan Masuk</p>
                    <p class="text-green-600 font-medium">+Rp 8.500.000</p>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-200">
                    <p class="text-gray-700 ml-3">Pinjaman Keluar</p>
                    <p class="text-red-600 font-medium">-Rp 5.200.000</p>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-200">
                    <p class="text-gray-700 ml-3">Biaya Operasional</p>
                    <p class="text-red-600 font-medium">-Rp 1.800.000</p>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-200">
                    <p class="text-gray-700 ml-3">Penarikan Simpanan</p>
                    <p class="text-red-600 font-medium">-Rp 3.200.000</p>
                </div>
                <div class="flex justify-between items-center py-2 px-3 rounded-lg bg-green-50 border-l-4 border-green-400 mt-4">
                    <p class="font-bold text-gray-900">Saldo Akhir</p>
                    <p class="font-bold text-green-600">+Rp 10.800.000</p>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-600">Rasio Likuiditas</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">2.45</p>
                <p class="text-sm font-medium text-green-600">Sangat Baik</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-600">Rasio Rentabilitas</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">18.5%</p>
                <p class="text-sm font-medium text-green-600">Baik</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-600">Rasio Solvabilitas</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">1.85</p>
                <p class="text-sm font-medium text-blue-600">Stabil</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-600">ROA (Return on Assets)</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">12.3%</p>
                <p class="text-sm font-medium text-green-600">Efisien</p>
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <script>
        // Menggunakan Vanilla JavaScript DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            
            // Memberi waktu tunggu 50 milidetik untuk memastikan CDN terload
            setTimeout(function() {
                
                const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
                const dataPemasukan = [750, 800, 950, 900, 1050, 1200]; 
                const dataPengeluaran = [350, 400, 450, 400, 500, 550];  
                const dataLaba = dataPemasukan.map((p, i) => p - dataPengeluaran[i]);

                // Fungsi Pembantu untuk Membuat Chart
                function createChart(id, type, data, options) {
                    const ctx = document.getElementById(id);
                    if (ctx && typeof Chart !== 'undefined') { // Pastikan elemen dan Chart.js terdefinisi
                        new Chart(ctx.getContext('2d'), {
                            type: type,
                            data: data,
                            options: options
                        });
                    } else if (!ctx) {
                        console.error("Canvas element with ID '" + id + "' not found in DOM.");
                    } else if (typeof Chart === 'undefined') {
                        console.error("Error: Chart.js library is not loaded. Check CDN link.");
                    }
                }

                // 1. Tren Keuangan Bulanan (Grafik Garis)
                const trendData = {
                    labels: labels,
                    datasets: [
                        { label: 'Pemasukan (x10rb)', data: dataPemasukan, borderColor: '#10b981', tension: 0.4, fill: false, pointRadius: 4 },
                        { label: 'Laba (x10rb)', data: dataLaba, borderColor: '#3b82f6', tension: 0.4, fill: false, pointRadius: 4 },
                        { label: 'Pengeluaran (x10rb)', data: dataPengeluaran, borderColor: '#ef4444', tension: 0.4, fill: false, pointRadius: 4 }
                    ]
                };
                const trendOptions = {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, max: 1400, ticks: { stepSize: 350 } }, x: { grid: { display: false } } }
                };
                createChart('financialTrendChart', 'line', trendData, trendOptions);

                // 2. Perbandingan Pemasukan vs Pengeluaran (Grafik Bar)
                const barData = {
                    labels: labels,
                    datasets: [
                        { label: 'Pemasukan (x10rb)', data: dataPemasukan, backgroundColor: '#10b981', categoryPercentage: 0.7, barPercentage: 0.9 },
                        { label: 'Pengeluaran (x10rb)', data: dataPengeluaran, backgroundColor: '#ef4444', categoryPercentage: 0.7, barPercentage: 0.9 }
                    ]
                };
                const barOptions = {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, max: 1400, ticks: { stepSize: 350 } }, x: { stacked: false, grid: { display: false } } }
                };
                createChart('incomeVsExpenseChart', 'bar', barData, barOptions);
                
                // 3. Rincian Pemasukan (Grafik Pie Kiri)
                const incomeDetailData = {
                    labels: ['Simpanan Wajib 39%', 'Simpanan Sukarela 31%', 'Bunga Pinjaman 21%', 'Lain-lain 9%'],
                    datasets: [{
                        data: [39, 31, 21, 9],
                        backgroundColor: ['#10b981', '#3b82f6', '#f97316', '#a855f7'], 
                        hoverOffset: 4
                    }]
                };
                createChart('incomeDetailChart', 'doughnut', incomeDetailData, { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } });

                // 4. Rincian Pengeluaran (Grafik Pie Kanan)
                const expenseDetailData = {
                    labels: ['Gaji Karyawan 41%', 'Operasional 32%', 'Pemeliharaan 16%', 'Lain-lain 11%'],
                    datasets: [{
                        data: [41, 32, 16, 11],
                        backgroundColor: ['#f97316', '#ef4444', '#facc15', '#6b7280'], 
                        hoverOffset: 4
                    }]
                };
                createChart('expenseDetailChart', 'doughnut', expenseDetailData, { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } });

            }, 50); 
        });
    </script>
@endsection