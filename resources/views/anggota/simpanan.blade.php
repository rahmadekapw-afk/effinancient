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
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<section id="luxury-gold-card" class="relative overflow-hidden bg-[#FFC107] text-[#064e3b] rounded-2xl shadow-[0_20px_40px_rgba(251,191,36,0.3)] p-8 grid grid-cols-2 gap-8 border-b-4 border-[#e6af06] opacity-0 translate-y-10">
    
    <div class="absolute inset-0 opacity-5 pointer-events-none" 
         style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');">
    </div>

    <div class="relative z-10">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-[#064e3b]/10 rounded-lg">
                <i class="bi bi-cash-stack text-[#064e3b] text-xl"></i>
            </div>
            <p class="text-xs uppercase tracking-[0.2em] font-black opacity-70">Total Simpanan</p>
        </div>
        <p class="text-4xl font-black tracking-tighter">
            <span class="opacity-60 text-2xl">Rp</span> <span class="count-up" data-target="{{ $total_saldo }}">0</span>
        </p>
    </div>

    <div class="relative z-10 border-l border-[#064e3b]/10 pl-8">
        <p class="text-[10px] uppercase tracking-widest font-bold opacity-70 mb-1">Simpanan Pokok</p>
        <p class="text-2xl font-bold flex items-baseline gap-1">
            <span class="opacity-60 text-sm">Rp</span>
            <span class="count-up" data-target="{{ $pokok }}">0</span>
        </p>
        
        <div class="mt-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-[#064e3b] text-white shadow-lg">
                <span class="w-1.5 h-1.5 rounded-full bg-green-400 mr-2 animate-pulse"></span>
                TERVERIFIKASI
            </span>
        </div>
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
                <p class="text-xl font-bold text-gray-900 mt-1">Rp {{ number_format($wajib, 0, ',', '.') }}</p>
                <div class="flex justify-between items-center text-sm mt-3 border-t pt-2">
                    <p class="text-gray-600">Setoran Rutin</p>
                    <p class="font-semibold text-green-700">Rp 150.000/bulan</p>
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
                <h4 class="text-base font-semibold text-gray-800 mt-3">Simpanan Hari Raya</h4>
                <p class="text-xl font-bold text-gray-900 mt-1">Rp {{ number_format($hari_raya, 0, ',', '.') }}</p>
                <div class="flex justify-between items-center text-sm mt-3 border-t pt-2">
                    {{-- <p class="text-gray-600">Tanggal Setor</p>
                    <p class="font-semibold text-blue-700">15 Jan 2023</p> --}}
                </div>
                <p class="text-xs text-gray-500 mt-1">Dibayar saat hari raya Qurban / Natal</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex justify-between items-center">
                    <div class="p-2 bg-purple-100 rounded-lg text-purple-700">
                        <i class="bi bi-graph-up text-xl"></i>
                    </div>
                    <span
                        class="text-xs font-medium text-purple-800 bg-purple-100 px-2 py-0.5 rounded-full">Fleksibel</span>
                </div>
                <h4 class="text-base font-semibold text-gray-800 mt-3">Simpanan Sehat</h4>
                <p class="text-xl font-bold text-gray-900 mt-1">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                <div class="flex justify-between items-center text-sm mt-3 border-t pt-2">
                    {{-- <p class="text-gray-600">Rata-rata Setoran</p>
                    <p class="font-semibold text-purple-700">Rp 500.000</p> --}}
                </div>
                <p class="text-xs text-gray-500 mt-1"></p>
            </div>
        </section>


        <section class="bg-white rounded-lg shadow p-5">
            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-base font-semibold text-gray-800">
                        Pertumbuhan Pinjaman
                    </h4>
                    <div class="flex items-center gap-2 text-xs text-gray-600">
                        <i class="bi bi-calendar"></i>
                        <span>6 Bulan Terakhir</span>
                    </div>
                </div>

                <div class="relative h-64">
                    <canvas id="growthChart"></canvas>
                </div>
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
                            @forelse ($info as $item)
                                <tr class="bg-white border-b">
                                    {{-- TANGGAL --}}
                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    </td>

                                    {{-- JENIS SIMPANAN / JUDUL --}}
                                    <td class="px-6 py-4">
                                        {{ $item->judul }}
                                    </td>

                                    {{-- JUMLAH (ambil dari isi jika ada nominal) --}}
                                    <td class="px-6 py-4 font-medium text-green-600">
                                        {{ $item->isi }}
                                    </td>

                                    {{-- METODE --}}
                                    <td class="px-6 py-4">
                                        Sistem
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-6 py-4">

                                        <span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded">
                                            Notifikasi
                                        </span>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada notifikasi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </section>

    </div>
   <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
   <script>
 

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('growthChart');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');

    // =============================
    // DATA DARI CONTROLLER
    // =============================
    const labels = @json($chart_labels);
    const angsuran = @json($chart_values);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Angsuran Pinjaman per Bulan',
                    data: angsuran,
                    borderColor: '#22c55e',
                    backgroundColor: '#22c55e',
                    tension: 0.4,
                    pointRadius: 4,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function (ctx) {
                            return 'Rp ' + ctx.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Entrance Animation
    gsap.to("#luxury-gold-card", {
        opacity: 1,
        y: 0,
        duration: 1.2,
        ease: "elastic.out(1, 0.8)" // Efek membal yang elegan
    });

    // 2. Counter Logic
    const formatIDR = (n) => new Intl.NumberFormat('id-ID').format(Math.floor(n));
    const counters = document.querySelectorAll('.count-up');

    counters.forEach(el => {
        const target = parseFloat(el.getAttribute('data-target'));
        const data = { val: 0 };

        gsap.to(data, {
            val: target,
            duration: 2.5,
            ease: "power4.out",
            onUpdate: () => {
                el.innerText = formatIDR(data.val);
            }
        });
    });

    // 3. Hover Interaction (3D Floating)
    const card = document.querySelector('#luxury-gold-card');
    card.addEventListener('mousemove', (e) => {
        const { left, top, width, height } = card.getBoundingClientRect();
        const x = (e.clientX - left) / width - 0.5;
        const y = (e.clientY - top) / height - 0.5;

        gsap.to(card, {
            rotationY: x * 15,
            rotationX: y * -15,
            transformPerspective: 1000,
            duration: 0.4,
            ease: "power2.out"
        });
    });

    card.addEventListener('mouseleave', () => {
        gsap.to(card, { 
            rotationY: 0, 
            rotationX: 0, 
            duration: 0.8, 
            ease: "elastic.out(1, 0.5)" 
        });
    });
});
</script>


@endsection