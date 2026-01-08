<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effinancient - Koperasi Kemenag Kota Yogyakarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Custom colors untuk tema Kemenag Hijau */
        :root {
            --kemenag-green: #059669;
            /* Hijau Emerald */
            --kemenag-dark: #047857;
            /* Hijau Tua */
            --kemenag-yellow: #FFE797;
            /* kuning emas */
            --kemenag-orange: #FCB53B;
            /* oranye */
            --kemenag-red: #A72703;
            /* merah marun */
            --kemenag-bg: #F1F3E0;
            --bg-kemenag-gl: #ECF4E8;
        }

        .bg-kemenag-bg {
            background-color: var(--kemenag-bg);
        }

        .bg-kemenag-gl {
            background-color: var(--bg-kemenag-gl);
        }

        .bg-kemenag-green {
            background-color: var(--kemenag-green);
        }

        .text-kemenag-green {
            color: var(--kemenag-green);
        }

        .text-kemenag-orange {
            color: var(--kemenag-orange);
        }

        .text-kemenag-red {
            color: var(--kemenag-red);
        }

        .border-kemenag-green {
            border-color: var(--kemenag-green);
        }

        .hover\:bg-kemenag-dark:hover {
            background-color: var(--kemenag-dark);
        }

        .shadow-kemenag {
            box-shadow: 0 10px 30px -10px rgba(5, 150, 105, 0.6);
        }

        /* logo navbar */


        /* Card Variants */
        .card-pokok {
            background: linear-gradient(135deg, #ecfdf5, #ffffff);
            border-top: 8px solid var(--kemenag-green);
        }

        .card-wajib {
            background: linear-gradient(135deg, #fffbe6, #ffffff);
            border-top: 8px solid var(--kemenag-yellow);
        }

        .card-qurban {
            background: linear-gradient(135deg, #fff3e0, #ffffff);
            border-top: 8px solid var(--kemenag-orange);
        }

        /* Icon accent */
        .icon-pokok {
            color: var(--kemenag-green);
        }

        .icon-wajib {
            color: #d4a100;
            /* turunan kuning agar lebih lembut */
        }

        .icon-qurban {
            color: var(--kemenag-orange);
        }

        /* Button lembut untuk orang tua */
        .btn-soft {
            background-color: rgba(5, 150, 105, 0.1);
            color: var(--kemenag-green);
        }

        .btn-soft:hover {
            background-color: var(--kemenag-green);
            color: white;
        }


        /* Custom animation for pulsating button */
        @keyframes pulse-once {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-pulse-once {
            animation: pulse-once 1.5s ease-out 1;
        }

        /* --- REVISI BACKGROUND IMAGE --- */
        .hero-bg-image {
            background-image: url('/img/image.png');
            background-size: cover;
            background-position: center;
            filter: saturate(1.1) contrast(1.05);
        }


        .image-overlay {
            background: linear-gradient(to bottom,
                    rgba(6, 78, 50, 0.55),
                    rgba(6, 78, 50, 0.32),
                    rgba(6, 78, 50, 0.55));
        }


        /* ------------------------------- */

        /* PPID */
        .ppid-btn {
            width: 100%;
            text-align: left;
            padding: 12px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .ppid-btn.active {
            background-color: var(--kemenag-green);
            color: white;
        }

        /* ================= PPID ENHANCEMENT ================= */

        .ppid-sidebar {
            background: linear-gradient(180deg, #f0fdf9, #ffffff);
        }

        .ppid-btn {
            font-size: 15px;
            line-height: 1.6;
            color: #374151;
        }

        .ppid-btn:hover {
            background-color: #fff7d6;
        }

        .ppid-btn.active {
            background-color: var(--kemenag-green);
            color: white;
            box-shadow: 0 6px 16px rgba(5, 150, 105, 0.35);
            position: relative;
        }

        .ppid-btn.active::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 60%;
            background-color: var(--kemenag-orange);
            border-radius: 3px;
        }

        /* Konten kanan */
        .ppid-content-wrapper {
            background: linear-gradient(135deg, #ffffff, #f9fafb);
            border-left: 6px solid var(--kemenag-green);
        }

        .ppid-content h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--kemenag-green);
        }

        .ppid-content p {
            font-size: 16px;
            line-height: 1.9;
            color: #374151;
        }

        /* List di dalam konten */
        .ppid-content ol {
            margin-top: 16px;
            padding-left: 20px;
        }

        .ppid-content ol li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="font-sans bg-kemenag-bg text-gray-800">

    <header class="sticky top-0 z-50 bg-[#0B5E3C] shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">

                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('img/kemenag.png') }}" class="h-11 hover:scale-110 transition duration-300">
                        <img src="{{ asset('img/koperasi.png') }}" class="h-11 hover:scale-110 transition duration-300">
                    </div>

                    <div class="leading-tight border-l border-white/50 pl-3 hidden sm:block">
                        <p class="text-lg font-bold text-white tracking-wide">KPRI Bakti Mulia</p>
                        <p class="text-sm text-white/80 font-medium">Kementerian Agama Kota Yogyakarta</p>
                    </div>
                </div>

                <nav class="hidden md:flex items-center space-x-8 text-white font-medium">
                    <a href="#layanan" class="relative group">
                        <span>Layanan</span>
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#FCB53B] transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <a href="#berita" class="relative group">
                        <span>Berita</span>
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#FCB53B] transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <a href="#kontak" class="relative group">
                        <span>Kontak</span>
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#FCB53B] transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <div class="relative">
                        <button id="dataInfoBtn" aria-expanded="false"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 hover:text-[#FCB53B] transition duration-300">
                            Data & Informasi
                            <i id="dataInfoIcon"
                                class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
                        </button>

                        <div id="dataInfoMenu" aria-labelledby="dataInfoBtn"
                            class="absolute left-0 mt-3 w-64 bg-[#064E32] rounded-lg shadow-2xl overflow-hidden ring-1 ring-black ring-opacity-5 transform origin-top-left transition-all duration-200 hidden opacity-0 scale-95 -translate-y-2 pointer-events-none">
                            <a href="#"
                                class="block px-5 py-3 text-white hover:bg-white/10 hover:pl-7 transition-all duration-200">
                                Standar Layanan Informasi
                            </a>

                            <a href="#"
                                class="block px-5 py-3 text-white hover:bg-white/10 hover:pl-7 transition-all duration-200">
                                Neraca Koperasi
                            </a>

                            <a href="#"
                                class="block px-5 py-3 text-white hover:bg-white/10 hover:pl-7 transition-all duration-200">
                                Laporan & Statistik
                            </a>
                        </div>
                    </div>
                </nav>

                <a href="/login"
                    class="bg-white text-[#0B5E3C] font-semibold py-2 px-6 rounded-full shadow-lg transition duration-300 hover:bg-[#FCB53B] hover:text-white hover:scale-105 active:scale-95">
                    <i class="fas fa-sign-in-alt mr-2"></i> Anggota
                </a>

            </div>
        </div>
    </header>
<body>

<section class="bg-gray-100 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12">
            <div class="text-center md:text-left">
                <h1 class="text-4xl font-extrabold text-gray-800">
                    Semua Berita & Kegiatan
                </h1>
                <p class="text-gray-600 mt-2">
                    Informasi terbaru seputar kegiatan dan pengumuman
                </p>
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-6 md:mt-0 text-center">
                <a href="{{ url('/') }}"
                   class="inline-flex items-center gap-2 bg-white border border-kemenag-green text-kemenag-green font-semibold px-6 py-3 rounded-full shadow-sm hover:bg-kemenag-green hover:text-white transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        {{-- Grid Berita --}}
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($artikels as $a)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition hover:shadow-xl hover:-translate-y-1">

                    {{-- Gambar --}}
                   @if($a->gambar)
                        {{-- Mengambil file dari public/img/berita/ --}}
                        <img src="{{ asset('img/berita/' . $a->gambar) }}" 
                            class="h-48 w-full object-cover rounded-t-xl" 
                            alt="{{ $a->judul }}">
                    @else
                        <div class="h-48 bg-kemenag-green flex items-center justify-center text-white font-bold rounded-t-xl">
                            <div class="flex flex-col items-center gap-2">
                                <i data-lucide="image-off" class="w-8 h-8 opacity-50"></i>
                                <span class="text-sm">Tidak Ada Gambar</span>
                            </div>
                        </div>
                    @endif

                    {{-- Konten --}}
                    <div class="p-6">
                        <span class="text-xs font-semibold uppercase text-kemenag-green">
                            {{ $a->kategori ?? 'Berita' }}
                        </span>

                        <h3 class="text-xl font-bold text-gray-800 my-2">
                            {{ $a->judul }}
                        </h3>

                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($a->isi), 150) }}
                        </p>

                       <button onclick="openModalBerita(
                            '{{ addslashes($a->judul) }}',
                            `{!! addslashes($a->isi) !!}`,
                            '{{ $a->gambar ? asset("img/berita/".$a->gambar) : "" }}'
                        )"
                        class="inline-flex items-center gap-1 font-semibold text-kemenag-green hover:underline">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right text-sm"></i>
                        </button>

                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    Belum ada berita
                </div>
            @endforelse
        </div>

    </div>

    {{-- modal --}}
    <div id="modalBerita" class="fixed inset-0 z-[200] hidden overflow-y-auto">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModalBerita()"></div>

        <div class="relative bg-white rounded-3xl shadow-2xl max-w-4xl w-full overflow-hidden animate-fadeIn">
            <div class="bg-kemenag-green text-white px-6 py-4 flex justify-between items-center">
                <h3 id="modal-title" class="text-xl font-bold"></h3>
                <button onclick="closeModalBerita()" class="text-2xl hover:text-kemenag-orange">&times;</button>
            </div>

            <div class="p-8 max-h-[70vh] overflow-y-auto">
                <div id="modal-isi" class="prose max-w-none"></div>
                <div id="modal-gambar" class="mt-6"></div>
            </div>
        </div>
    </div>
</div>


<script>
function openModalBerita(judul, isi, gambar) {
    document.getElementById('modal-title').innerText = judul;
    document.getElementById('modal-isi').innerHTML = isi;

    if (gambar) {
        document.getElementById('modal-gambar').innerHTML =
            `<img src="${gambar}" class="rounded-xl shadow-lg w-full">`;
    } else {
        document.getElementById('modal-gambar').innerHTML = '';
    }

    document.getElementById('modalBerita').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModalBerita() {
    document.getElementById('modalBerita').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>

</body>