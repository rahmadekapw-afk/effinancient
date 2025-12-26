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
                <h3 class="text-base font-semibold text-gray-800 mb-4">Pertumbuhan Bulanan</h3>
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
                    <a href="{{ route('tren_rupiah.create') }}" class="bg-green-500 text-white px-3 rounded">
                        + Tambah
                    </a>
                </div>
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
                                                    <th class="px-2 py-1">IG</th>
                                                    <th class="px-2 py-1">GR</th>
                                                    <th class="px-2 py-1">Root</th>
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
                                                    <td class="px-2 py-1 font-mono">{{ number_format($h['information_gain'],4) }}</td>
                                                    <td class="px-2 py-1 font-mono">{{ number_format($h['gain_ratio'],4) }}</td>
                                                   <td class="px-2 py-1 font-semibold text-indigo-600">
                                                        {{ ucfirst($root) }}
                                                    </td>
                                                    <td class="px-2 py-1">
                                                        <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-semibold">
                                                            {{ number_format($h['batas_pinjaman']) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="px-3 py-2 border-b text-sm font-semibold text-gray-700">
                                    Dataset Training
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full text-xs text-center">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-2 py-1">Tren</th>
                                                <th class="px-2 py-1">Simpanan</th>
                                                <th class="px-2 py-1">Frekuensi</th>
                                                <th class="px-2 py-1">Bayar</th>
                                                <th class="px-2 py-1">Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach([
                                                ['rendah','besar','sering','besar','tinggi'],
                                                ['sedang','sedang','jarang','sedang','menengah'],
                                                ['tinggi','kecil','jarang','kecil','rendah'],
                                                ['sedang','besar','sering','besar','tinggi'],
                                                ['rendah','kecil','jarang','kecil','rendah']
                                            ] as $row)
                                            <tr class="border-t">
                                                @foreach($row as $cell)
                                                    <td class="px-2 py-1">{{ ucfirst($cell) }}</td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">

                                {{-- Entropy --}}
                                <div class="bg-white shadow-sm rounded px-3 py-2 text-sm">
                                    <div class="text-gray-500">Entropy Kelas</div>
                                    <div class="font-mono font-semibold text-indigo-600">
                                        {{ number_format($entropyKelas,4) }}
                                    </div>
                                </div>

                                {{-- Information Gain --}}
                                <div class="bg-white shadow-sm rounded px-3 py-2 text-sm">
                                    <div class="text-gray-500">Information Gain ({{ ucfirst($root) }})</div>
                                    <div class="font-mono font-semibold text-blue-600">
                                        {{ number_format($informationGain[$root],4) }}
                                    </div>
                                </div>

                                {{-- Gain Ratio --}}
                                <div class="bg-white shadow-sm rounded px-3 py-2 text-sm">
                                    <div class="text-gray-500">Gain Ratio (Root)</div>
                                    <div class="font-mono font-semibold text-green-600">
                                        {{ number_format($gainRatio[$root],4) }}
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
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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




@endsection