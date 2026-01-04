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
                <p class="text-xs text-gray-500">Total Transaksi Online </p>
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

            <div class="bg-white rounded-lg shadow p-5 h-full xl:col-span-2">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Tren Rupiah </h3>
                <div class="relative h-64">
                    <canvas id="growthChartAdmin"></canvas>
                </div>
             <div class="flex justify-between items-center text-xs mt-4">

                <div class="flex gap-4">
                    <span class="flex items-center gap-1 text-red-500"><span class="w-2 h-2 rounded-full bg-red-500"></span> High</span>
                    <span class="flex items-center gap-1 text-blue-600"><span class="w-2 h-2 rounded-full bg-blue-600"></span> Close</span>
                    <span class="flex items-center gap-1 text-green-600"><span class="w-2 h-2 rounded-full bg-green-600"></span> Open</span>
                    <span class="flex items-center gap-1 text-orange-500"><span class="w-2 h-2 rounded-full bg-orange-500"></span> Low</span>
                </div>

                <div class="flex gap-2">
                  <button 
                    data-modal-target="modalTambahRupiah" 
                    data-modal-toggle="modalTambahRupiah"
                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah
                </button>
                </div>
            </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 h-full">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Kategori Anggota Berdasarkan Kelayakan</h3>
                <div class="relative h-64 flex justify-center items-center">
                    <canvas id="memberCategoryChart"></canvas>
                </div>
              
            </div>
            

            <div class="bg-white rounded-lg shadow p-5 ">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Distribusi Jenis Transaksi</h3>
                <div class="relative h-64">
                    <canvas id="transactionBarChart"></canvas>
                </div>
                <div class="flex justify-center gap-2 text-xs mt-4">
                    <span class="flex items-center gap-1 text-green-600"><span
                            class="w-2 h-2 rounded-full bg-green-600"></span> Jumlah Transaksi</span>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-5 h-full xl:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base font-semibold text-gray-800">Grafik Pembayaran Harian</h3>

                    <input type="month" id="filterMonth"
                        class="border rounded-lg px-3 py-2 text-sm focus:ring focus:ring-indigo-200">
                </div>

                <div class="relative h-64">
                    <canvas id="dailyPaymentChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 h-full xl:col-span-2">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Distribusi Range Pinjaman</h3>
                <div class="relative h-64">
                    <canvas id="loanDistributionChart"></canvas>
                </div>
                <p class="text-xs text-center text-gray-500 mt-4 italic">*Menampilkan jumlah anggota berdasarkan rentang pinjaman</p>
            </div>
                
            <div class="bg-white rounded-lg shadow p-5 h-full xl:col-span-2">
                <div class="container-fluid">
                    <div class="p-6 space-y-8">
                        <div class="bg-white shadow-sm rounded ">
                              <h3 class="text-base font-semibold text-gray-800 ">Hasil Kelayakan Pinjaman Anggota C4.5</h3>
                            <div class="bg-white shadow-sm rounded">
                                    <div class="px-3 py-2 border-b text-sm font-semibold text-gray-700">
                                        Hasil Penentuan Batas Pinjaman Anggota
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full text-xs text-center">
                                            <thead class="bg-gray-800 text-white">
                                                <tr>
                                                    <th class="px-2 py-1">No</th>
                                                    <th class="px-2 py-1">Nama</th>
                                                    <th class="px-2 py-1">Tren</th>
                                                    <th class="px-2 py-1">Simpanan</th>
                                                    <th class="px-2 py-1">Bayar</th>
                                                    <th class="px-2 py-1">Pinjam</th>
                                                    <th class="px-2 py-1">Entropy</th>
                                                    <th class="px-2 py-1">Batas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($hasil as $i => $h)
                                                <tr class="border-t hover:bg-gray-50">
                                                    <td class="px-2 py-1">{{ $i+1 }}</td>
                                                    <td class="px-2 py-1 font-medium">{{ $h['nama'] }}</td>
                                                    <td class="px-2 py-1">{{ number_format($h['tren_rupiah'],1) }}</td>
                                                    <td class="px-2 py-1">{{ number_format($h['simpanan']) }}</td>
                                                    <td class="px-2 py-1">{{ number_format($h['pembayaran']) }}</td>
                                                    <td class="px-2 py-1">{{ $h['kali'] }}x</td>
                                                    <td class="px-2 py-1 font-mono">{{ number_format($h['entropy_kelas'],4) }}</td>
                                                    
                                                    <td class="px-2 py-1">
                                                        <div class="flex justify-start"> <span class="inline-flex items-center px-2.5 py-1 rounded-md border font-bold text-xs tracking-tight
                                                                {{ $h['batas_pinjaman'] >= 150000000 ? 'bg-green-50 border-green-200 text-green-700' :
                                                                ($h['batas_pinjaman'] >= 75000000 ? 'bg-yellow-50 border-yellow-200 text-yellow-700' :
                                                                'bg-red-50 border-red-200 text-red-700') }}">
                                                                
                                                                <i class="bi bi-shield-check mr-1"></i> 
                                                                <span>Rp {{ number_format($h['batas_pinjaman'], 0, ',', '.') }}</span>
                                                            </span>
                                                        </div>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>

                              
                     </div>
            </div>
            </div>

        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-5 h-full">
                <h3 class="text-base font-semibold text-gray-800 mb-4">Aktivitas Terkini</h3>

            @foreach ($notifikasi as $notif)
                <div class="border-b pb-4">
                    <!-- Username dari anggota -->
                    <p class="font-medium text-gray-900">{{ $notif->username ?? 'Admin' }}</p>

                    <!-- Judul & waktu -->
                    <div class="flex justify-between items-center text-sm">
                        <p class="text-gray-600">{{ $notif->judul }}</p>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($notif->tanggal)->diffForHumans() }}</p>
                    </div>

                    <!-- Isi notifikasi / jumlah nominal -->
                    @if (preg_match('/\d+/', $notif->isi, $matches))
                        <p class=" text-green-600 text-sm">{{ $notif->isi }}</p>
                    @else
                        <p class="text-gray-700 text-sm">{{ $notif->isi }}</p>
                    @endif
                </div>
                @endforeach
                        </div>
                    </div>
                </div>

            </div>



            {{-- modal tren rupiah --}}
           <div id="modalTambahRupiah" tabindex="-1" aria-hidden="true"
                class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-all duration-300">

                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 tracking-tight">
                                Update Trend Rupiah
                            </h3>
                            <p class="text-xs text-gray-500 mt-0.5">Input nilai tukar mata uang terbaru</p>
                        </div>
                        <button data-modal-hide="modalTambahRupiah" 
                                class="p-2 rounded-full text-gray-400 hover:bg-white hover:text-red-500 transition-colors shadow-sm border border-transparent hover:border-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form action="" method="POST" class="p-6">
                        @csrf
                        <div class="mb-6">
                            <label for="trend_rupiah" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nilai Tukar (IDR)
                            </label>
                            
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-400 font-medium group-focus-within:text-green-600 transition-colors">Rp</span>
                                </div>
                                
                                <input 
                                    type="number" 
                                    name="trend_rupiah"
                                    id="trend_rupiah"
                                    required
                                    class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none placeholder:text-gray-400"
                                    placeholder="15.500"
                                >
                            </div>
                            <p class="mt-2 text-[11px] text-gray-400 italic">*Masukkan angka saja tanpa titik atau koma.</p>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-2">
                            <button type="button"
                                    data-modal-hide="modalTambahRupiah"
                                    class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100 transition-all active:scale-95">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-6 py-2.5 rounded-xl text-sm font-semibold bg-green-600 text-white hover:bg-green-700 hover:shadow-lg hover:shadow-green-600/30 transition-all active:scale-95">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {

    
const labels    = @json($labels);
const highData  = @json($highData);
const closeData = @json($closeData);
const openData  = @json($openData);
const lowData   = @json($lowData);

new Chart(document.getElementById('growthChartAdmin'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            { label: 'High',  data: highData,  borderColor:'#ef4444', tension:0.4 },
            { label: 'Close', data: closeData, borderColor:'#3b82f6', tension:0.4 },
            { label: 'Open',  data: openData,  borderColor:'#10b981', tension:0.4 },
            { label: 'Low',   data: lowData,   borderColor:'#f97316', tension:0.4 }
        ]
    },
    options: {
        responsive:true,
        maintainAspectRatio:false,
        plugins:{ legend:{ position:'bottom' }},
        scales:{
            y:{
                ticks:{
                    callback:(v)=>'Rp '+v.toLocaleString('id-ID')
                }
            }
        }
    }
});
   

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =======================
       PIE KATEGORI ANGGOTA
    ======================= */
    const pieCtx = document.getElementById('memberCategoryChart');

    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: [
                    'Layak Tinggi (150 jt)',
                    'Layak Menengah (75 jt)',
                    'Layak Rendah (30 jt)'
                ],
                datasets: [{
                    data: [
                        {{ $kategori150 }},
                        {{ $kategori75 }},
                        {{ $kategori30 }}
                    ],
                    backgroundColor: ['#16a34a','#facc15','#ef4444']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    @if(isset($transactionChartData))
    const ctx = document.getElementById('transactionBarChart');

    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Simpanan Pokok',
                    'Simpanan Wajib',
                    'Simpanan Hari Raya',
                    'Pembayaran',
                    'Pinjaman'
                ],
                datasets: [{
                    data: @json($transactionChartData),
                    backgroundColor: '#10b981',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: v => 'Rp ' + v.toLocaleString('id-ID')
                        }
                    }
                }
            }
        });
    }
    @endif

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const labels = @json($loan_dist_labels);
    const values = @json($loan_dist_values);

    const distCtx = document.getElementById('loanDistributionChart');

    if (distCtx) {
        new Chart(distCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Anggota',
                    data: values,
                    backgroundColor: '#6366f1',
                    borderColor: '#4f46e5',
                    borderWidth: 1,
                    barPercentage: 1,
                    categoryPercentage: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Orang' }},
                    x: { title: { display: true, text: 'Rentang Pinjaman' }}
                }
            }
        });
    }
});
</script>

{{-- grafik pembayaran --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    let labels = @json($payment_labels);
    let values = @json($payment_values);

    const ctx = document.getElementById('dailyPaymentChart');

    const paymentChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Pembayaran (Rp)',
                data: values,
                borderWidth: 2,
                fill: true,
                tension: 0.3,
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,0.15)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    ticks: {
                        callback: v => 'Rp ' + v.toLocaleString('id-ID')
                    }
                }
            }
        }
    });

    // FILTER PER BULAN
    document.getElementById('filterMonth').addEventListener('change', function () {

        const selectedMonth = this.value; // yyyy-mm

        fetch(`/dashboard/payments/${selectedMonth}`)
            .then(res => res.json())
            .then(res => {
                paymentChart.data.labels = res.labels;
                paymentChart.data.datasets[0].data = res.values;
                paymentChart.update();
            });
    });

});
</script>





@endsection