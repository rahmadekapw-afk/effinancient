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
            background-image: url('/img/header_2.jpeg');
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

<header class="sticky top-0 z-[100] bg-[#0B5E3C] shadow-2xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-3 md:py-4">

            <div class="flex items-center gap-2 md:gap-4">
                <div class="flex items-center gap-1.5 md:gap-2">
                    <img src="{{ asset('img/kemenag.png') }}" class="h-8 md:h-11 hover:scale-110 transition duration-300">
                    <img src="{{ asset('img/koperasi.png') }}" class="h-8 md:h-11 hover:scale-110 transition duration-300">
                </div>

                <div class="leading-tight border-l border-white/50 pl-3 hidden xs:block sm:block">
                    <p class="text-xs md:text-lg font-bold text-white tracking-wide">KPRI Bakti Mulia</p>
                    <p class="text-[10px] md:text-sm text-white/80 font-medium hidden md:block">Kementerian Agama Kota Yogyakarta</p>
                </div>
            </div>

            <nav class="hidden lg:flex items-center space-x-6 xl:space-x-8 text-white font-medium">
                <a href="#layanan" class="relative group">
                    <span>Layanan</span>
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#FCB53B] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#berita" class="relative group">
                    <span>Berita</span>
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#FCB53B] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#kontak" class="relative group">
                    <span>Kontak</span>
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#FCB53B] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#informasi_2" class="relative group">
                    <span>Informasi</span>
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#FCB53B] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <div class="relative group">
                    <button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 hover:text-[#FCB53B] transition duration-300">
                        Lainnya <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="absolute left-0 mt-3 w-64 bg-[#064E32] rounded-lg shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-white/10">
                        <a href="#" class="block px-5 py-3 text-white hover:bg-white/10 transition">Standar Layanan Informasi</a>
                        <a href="#" class="block px-5 py-3 text-white hover:bg-white/10 transition">Neraca Koperasi</a>
                    </div>
                </div>
            </nav>

            <div class="flex items-center gap-2">
                <a href="/login"
                    class="bg-white text-[#0B5E3C] font-bold py-1.5 px-4 md:py-2 md:px-6 rounded-full shadow-lg transition duration-300 hover:bg-[#FCB53B] hover:text-white text-xs md:text-base flex items-center">
                    <i class="fas fa-user md:mr-2"></i> 
                    <span class="hidden md:inline">Anggota</span>
                </a>

                <button id="mobileMenuBtn" class="lg:hidden text-white p-2 focus:outline-none">
                    <i class="fas fa-bars text-xl" id="menuIcon"></i>
                </button>
            </div>

        </div>
    </div>

    <div id="mobileMenu" class="hidden lg:hidden bg-[#084d31] border-t border-white/10 shadow-inner">
        <div class="px-4 py-6 space-y-4 text-white">
            <a href="#layanan" class="block font-medium hover:text-[#FCB53B]">Layanan</a>
            <a href="#berita" class="block font-medium hover:text-[#FCB53B]">Berita</a>
            <a href="#kontak" class="block font-medium hover:text-[#FCB53B]">Kontak</a>
            <div class="pt-4 border-t border-white/5">
                <p class="text-[10px] uppercase text-white/40 mb-2">Informasi</p>
                <a href="#" class="block py-1 text-sm text-white/80">Neraca Koperasi</a>
                <a href="#" class="block py-1 text-sm text-white/80">Laporan Statistik</a>
            </div>
        </div>
    </div>
</header>

<script>
    // Script untuk buka-tutup menu mobile
    const btn = document.getElementById('mobileMenuBtn');
    const menu = document.getElementById('mobileMenu');
    const icon = document.getElementById('menuIcon');

    btn.addEventListener('click', () => {
        const isHidden = menu.classList.toggle('hidden');
        icon.classList.toggle('fa-bars', isHidden);
        icon.classList.toggle('fa-times', !isHidden);
    });
</script>



   <section class="hero-bg-image relative py-12 lg:py-32 overflow-hidden">
    <div class="absolute inset-0 image-overlay"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10" data-aos="fade-up">
        
        <h1 class="font-extrabold 
                   text-3xl sm:text-5xl lg:text-7xl 
                   tracking-wide 
                   text-kemenag-orange 
                   drop-shadow-[0_4px_10px_rgba(0,0,0,0.6)]">
            KPRI BAKTI MULIA
        </h1>

        <p class="mt-2 sm:mt-4 
                  text-lg sm:text-2xl lg:text-3xl 
                  font-semibold 
                  text-white 
                  drop-shadow-[0_3px_8px_rgba(0,0,0,0.5)]">
            KEMENTERIAN AGAMA KOTA YOGYAKARTA
        </p>

        <p class="mt-4 sm:mt-6 
                  text-sm sm:text-lg lg:text-2xl 
                  font-medium 
                  text-yellow-100 uppercase tracking-wider">
            "KOPERASI KUAT ANGGOTA SEJAHTERA"
        </p>

        <a href="/login" class="inline-block mt-8 sm:mt-12 
                                bg-white text-kemenag-green 
                                font-bold py-3 px-8 sm:py-4 sm:px-12 
                                rounded-full text-lg sm:text-xl 
                                shadow-2xl 
                                transition-all duration-500 
                                hover:bg-gray-100 
                                hover:-translate-y-1" 
           data-aos="zoom-in" data-aos-delay="400">
            <i class="fas fa-sign-in-alt mr-2"></i>
            Masuk
        </a>

    </div>
</section>

   <section id="layanan" class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-10 md:py-20">
    <div class="text-center mb-8 md:mb-16">
        <h2 class="text-[10px] md:text-sm font-semibold uppercase text-kemenag-green tracking-wider mb-1"
            data-aos="fade-down">Pilar Utama Effinancient</h2>
        <p class="text-xl md:text-4xl font-extrabold text-gray-800 px-2" data-aos="fade-down" data-aos-delay="100">
            Layanan Syariah
        </p>
    </div>

    <div class="grid grid-cols-3 md:grid-cols-3 gap-2 sm:gap-6 md:gap-8">
        
        <div class="card-pokok p-3 md:p-8 rounded-xl md:rounded-2xl shadow-md md:shadow-xl transition duration-500 transform hover:scale-[1.05]"
            data-aos="fade-up">
            <div class="text-2xl md:text-5xl icon-pokok mb-2 md:mb-4 text-center md:text-left">
                <i class="fas fa-piggy-bank"></i>
            </div>
            <h3 class="text-[11px] md:text-2xl font-bold mb-1 md:mb-3 text-gray-800 text-center md:text-left leading-tight">Simpanan Pokok</h3>
            <p class="hidden md:block text-sm md:text-base text-gray-700 leading-relaxed">
                Simpanan awal keanggotaan sebagai dasar kepesertaan koperasi.
            </p>
        </div>

        <div class="card-wajib p-3 md:p-8 rounded-xl md:rounded-2xl shadow-md md:shadow-xl transition duration-500 transform hover:scale-[1.05]"
            data-aos="fade-up" data-aos-delay="100">
            <div class="text-2xl md:text-5xl icon-wajib mb-2 md:mb-4 text-center md:text-left">
                <i class="fas fa-coins"></i>
            </div>
            <h3 class="text-[11px] md:text-2xl font-bold mb-1 md:mb-3 text-gray-800 text-center md:text-left leading-tight">Simpanan Wajib</h3>
            <p class="hidden md:block text-sm md:text-base text-gray-700 leading-relaxed">
                Setoran rutin bulanan anggota untuk memperkuat koperasi.
            </p>
        </div>

        <div class="card-qurban p-3 md:p-8 rounded-xl md:rounded-2xl shadow-md md:shadow-xl transition duration-500 transform hover:scale-[1.05]"
            data-aos="fade-up" data-aos-delay="200">
            <div class="text-2xl md:text-5xl icon-qurban mb-2 md:mb-4 text-center md:text-left">
                <i class="fas fa-mosque"></i>
            </div>
            <h3 class="text-[11px] md:text-2xl font-bold mb-1 md:mb-3 text-gray-800 text-center md:text-left leading-tight">Simpanan Hari Raya</h3>
            <p class="hidden md:block text-sm md:text-base text-gray-700 leading-relaxed">
                Tabungan khusus untuk persiapan ibadah 
            </p>
        </div>

    </div>
</section>

   <section id="angka" class="bg-gray-100 py-12 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-[10px] md:text-sm font-semibold uppercase text-kemenag-green tracking-wider mb-2 text-center"
            data-aos="zoom-in">Dampak Nyata</h2>
        <p class="text-xl md:text-4xl font-extrabold text-gray-800 mb-8 md:mb-12 text-center" data-aos="zoom-in" data-aos-delay="100">
            Effinancient Tumbuh Bersama Anggota
        </p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-12 text-center">
            
            <div data-aos="flip-up">
                <p class="text-3xl md:text-6xl font-extrabold text-kemenag-green mb-1 md:mb-2">
                    {{ $jumlah_anggota }}<span class="text-xl md:text-3xl">+</span>
                </p>
                <p class="text-[10px] md:text-base text-gray-600 font-medium border-t pt-2 border-kemenag-green/50 px-2 leading-tight">
                    Anggota Aktif Terdaftar
                </p>
            </div>

            <div data-aos="flip-up" data-aos-delay="100">
                <p class="text-3xl md:text-6xl font-extrabold text-kemenag-green mb-1 md:mb-2">
                    95<span class="text-xl md:text-3xl">%</span>
                </p>
                <p class="text-[10px] md:text-base text-gray-600 font-medium border-t pt-2 border-kemenag-green/50 px-2 leading-tight">
                    Tingkat Kepuasan Layanan
                </p>
            </div>
                 @php
                    $nominal = $simpanan;

                    if ($nominal >= 1000000000000) {
                        $hasil = round($nominal / 1000000000000, 1);
                        $satuan = 'T+';
                    } elseif ($nominal >= 1000000000) {
                        $hasil = round($nominal / 1000000000, 1);
                        $satuan = 'M+';
                    } elseif ($nominal >= 1000000) {
                        $hasil = round($nominal / 1000000, 1);
                        $satuan = 'jt+';
                    } else {
                        $hasil = number_format($nominal, 0, ',', '.');
                        $satuan = '';
                    }
                @endphp
                    <div data-aos="flip-up" data-aos-delay="200">
                        <p class="text-3xl md:text-6xl font-extrabold text-kemenag-green mb-1 md:mb-2">
                            {{ $hasil }}
                            <span class="text-xl md:text-3xl">{{ $satuan }}</span>
                        </p>

                        <p class="text-[10px] md:text-base text-gray-600 font-medium border-t pt-2 border-kemenag-green/50 px-2 leading-tight">
                            Total Aset Koperasi
                        </p>
                    </div>
                        <div data-aos="flip-up" data-aos-delay="300">
                            <p class="text-3xl md:text-6xl font-extrabold text-kemenag-green mb-1 md:mb-2">
                                100<span class="text-xl md:text-3xl">%</span>
                            </p>
                            <p class="text-[10px] md:text-base text-gray-600 font-medium border-t pt-2 border-kemenag-green/50 px-2 leading-tight">
                                RAT Tepat Waktu
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        <section class="py-12 md:py-20 bg-kemenag-gl overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">

            <div class="text-center mb-10 md:mb-14">
                <h2 class="text-xs md:text-sm font-semibold uppercase tracking-widest text-kemenag-green mb-2">
                    Visi dan Misi
                </h2>
                <p class="text-2xl md:text-4xl font-extrabold text-gray-800 leading-tight">
                    KPRI Bakti Mulia
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 mb-6 md:mb-10 border-l-8 border-kemenag-green" data-aos="fade-right">
                <div class="flex items-center mb-3 md:mb-4">
                    <i class="fas fa-eye text-2xl md:text-3xl text-kemenag-green mr-3"></i>
                    <h3 class="text-xl md:text-2xl font-extrabold text-kemenag-green">Visi</h3>
                </div>
                <p class="text-gray-700 text-base md:text-lg leading-relaxed text-left md:text-justify">
                    <span class="font-semibold">“Membangun koperasi</span> yang kuat yang mensejahterakan anggota”
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border-l-8 border-kemenag-orange" data-aos="fade-left">
                <div class="flex items-center mb-4 md:mb-6">
                    <i class="fas fa-bullseye text-2xl md:text-3xl text-kemenag-orange mr-3"></i>
                    <h3 class="text-xl md:text-2xl font-extrabold text-kemenag-orange">Misi</h3>
                </div>

                <ol class="space-y-3 md:space-y-4 text-gray-700 text-base md:text-lg list-decimal list-outside ml-5">
                    <li>Ikut serta dalam upaya meningkatkan kesejahteraan anggota.</li>
                    <li>Meningkatkan kualitas pelayanan dan tata kelola koperasi secara profesional.</li>
                </ol>
            </div>

        </div>
    </section>

   <section id="berita" class="bg-gray-100 py-10 md:py-20">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-6 md:mb-12" data-aos="fade-down">
            <h2 class="text-[10px] md:text-sm font-semibold uppercase text-kemenag-green tracking-wider mb-1">
                Informasi Terbaru
            </h2>
            <p class="text-xl md:text-4xl font-extrabold text-gray-800">
                Berita Koperasi
            </p>
        </div>

        {{-- Grid Berita: Langsung 3 kolom di HP --}}
        <div class="grid grid-cols-3 md:grid-cols-3 gap-2 md:gap-8">
            @forelse($artikels as $a)
                <div class="bg-white rounded-lg md:rounded-xl shadow-sm md:shadow-lg overflow-hidden transition hover:shadow-xl"
                    data-aos="fade-up">
                   
                   {{-- Gambar: Dibuat kotak (square) di HP agar rapi --}}
                   <div class="aspect-square md:aspect-video overflow-hidden">
                        @if($a->gambar)
                            <img src="{{ asset('img/berita/' . $a->gambar) }}" 
                                class="h-full w-full object-cover" 
                                alt="{{ $a->judul }}">
                        @else
                            <div class="h-full bg-emerald-700 flex items-center justify-center text-white">
                                <i class="fas fa-image text-xl opacity-30"></i>
                            </div>
                        @endif
                   </div>

                    <div class="p-2 md:p-6">
                        {{-- Kategori: Sangat kecil di HP --}}
                        <span class="hidden md:inline-block text-[10px] md:text-xs font-bold uppercase text-kemenag-green mb-1">
                            {{ $a->kategori ?? 'Berita' }}
                        </span>

                        {{-- Judul: Ukuran font sangat kecil di HP (text-[10px]) --}}
                        <h3 class="text-[10px] md:text-xl font-bold text-gray-800 leading-tight line-clamp-2 md:line-clamp-none min-h-[25px] md:min-h-0">
                            {{ $a->judul }}
                        </h3>

                        {{-- Deskripsi: DIHILANGKAN di HP agar muat 3 berjejer --}}
                        <p class="hidden md:block text-gray-600 text-sm mt-2 line-clamp-3">
                            {{ Str::limit(strip_tags($a->isi), 100) }}
                        </p>

                        {{-- Footer: Disederhanakan di HP --}}
                        <div class="mt-2 md:mt-4 border-t pt-2 flex flex-col md:flex-row justify-between items-start md:items-center">
                            <span class="text-[8px] md:text-xs text-gray-400">
                                {{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d/m/y') }}
                            </span>
                            <button onclick="openModalBerita(
                                '{{ addslashes($a->judul) }}',
                                `{!! addslashes($a->isi) !!}`,
                                '{{ $a->gambar ? asset('img/berita/'.$a->gambar) : '' }}'
                            )" 
                            class="text-emerald-600 font-bold text-[9px] md:text-sm mt-1 md:mt-0">
                                Baca <i class="fas fa-chevron-right text-[7px]"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10 text-gray-500 text-xs">
                    Belum ada berita
                </div>
            @endforelse
        </div>

        {{-- Tombol Selengkapnya --}}
        <div class="text-center mt-8 md:mt-12">
            <a href="{{ url('/berita_selengkapnya') }}"
            class="inline-block bg-kemenag-green text-white text-[10px] md:text-base font-bold py-2 px-6 md:py-3 md:px-8 rounded-full shadow-md">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</section>

    {{-- modal berita --}}
    <div id="modalLayanan" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModalLayanan()"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-white/20">
                    
                    <div class="bg-emerald-600 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white" id="modal-title">Detail Layanan</h3>
                        <button onclick="closeModalLayanan()" class="text-white/80 hover:text-white transition text-2xl">&times;</button>
                    </div>

                    <div class="px-8 py-8 max-h-[70vh] overflow-y-auto">
                        <div id="modal-isi-full" class="prose prose-emerald max-w-none text-gray-700 text-lg leading-relaxed mb-8">
                            </div>

                        <div id="modal-lampiran" class="border-t pt-8">
                            </div>
                    </div>

                    <div class="bg-gray-50 px-8 py-4 flex justify-end">
                        <button onclick="closeModalLayanan()" class="px-6 py-2 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>



    <!-- ================== STANDAR LAYANAN (DI ATAS FOOTER) ================== -->
   <section id="informasi_2" class="bg-gray-50 py-10 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-kemenag-green rounded-2xl px-6 py-8 md:px-8 md:py-10 mb-6 md:mb-8 shadow-lg">
            <h2 class="text-2xl md:text-4xl font-extrabold mb-3 text-white leading-tight">
                Informasi <span class="text-kemenag-yellow">Layanan Koperasi</span>
            </h2>
            <p class="text-white/80 text-sm md:text-base max-w-2xl">
                Pilih kategori layanan untuk melihat detail informasi dan mengunduh dokumen terkait.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 md:gap-8">
            
            <aside class="lg:col-span-1 h-fit">
                <p class="text-[10px] md:text-xs font-bold text-emerald-600 uppercase tracking-widest mb-3 px-1">Pilih Layanan</p>
                
                <div class="flex lg:flex-col overflow-x-auto lg:overflow-visible pb-4 lg:pb-0 gap-2 scrollbar-hide">
                    @foreach($jenis_layanan as $index => $l)
                        <button 
                            onclick="switchLayanan('layanan-{{ $l->id }}')"
                            class="ppid-btn flex-none w-auto lg:w-full text-left px-4 py-2 md:py-3 rounded-xl transition-all duration-300 flex items-center justify-between group whitespace-nowrap {{ $index == 0 ? 'active' : '' }}"
                            id="btn-layanan-{{ $l->id }}">
                            <span class="font-medium text-sm md:text-base">{{ $l->jenis_layanan }}</span>
                            <i class="fas fa-chevron-right text-[10px] hidden lg:block opacity-0 group-hover:opacity-100 transition-all"></i>
                        </button>
                    @endforeach
                </div>
            </aside>

            <div class="lg:col-span-3 bg-white rounded-2xl shadow-xl p-6 md:p-12 border border-emerald-50 min-h-[300px] md:min-h-[500px]">
                @foreach($jenis_layanan as $index => $l)
                    <div id="layanan-{{ $l->id }}" 
                         class="layanan-content transition-all duration-500 {{ $index == 0 ? '' : 'hidden opacity-0 translate-y-4' }}">
                        
                        <h3 class="text-xl md:text-3xl font-black text-emerald-900 mb-4 md:mb-6 border-b pb-4">{{ $l->jenis_layanan }}</h3>
                        
                        <div class="prose prose-sm md:prose-lg prose-emerald max-w-none text-gray-600 leading-relaxed mb-8">
                            {!! $l->isi !!}
                        </div>

                        @if($l->gambar)
                            @php
                                $ext = strtolower(pathinfo($l->gambar, PATHINFO_EXTENSION));
                                $filePath = asset('img/layanan/' . $l->gambar);
                                $isImage = in_array($ext, ['jpg','jpeg','png','webp','gif']);
                                $isPDF = ($ext === 'pdf');
                            @endphp

                            <div class="mt-8 border-t pt-6">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 italic">Lampiran Dokumen:</h4>

                                @if($isImage)
                                    <div class="rounded-xl border-2 border-emerald-100 overflow-hidden shadow-md">
                                        <img src="{{ $filePath }}" class="w-full h-auto">
                                        <div class="p-3 bg-gray-50 flex gap-2">
                                            <a href="{{ $filePath }}" target="_blank" class="flex-1 text-center bg-white text-emerald-700 py-2 rounded-lg font-bold text-xs border border-emerald-200">Buka</a>
                                            <a href="{{ $filePath }}" download class="flex-1 text-center bg-emerald-600 text-white py-2 rounded-lg font-bold text-xs">Simpan</a>
                                        </div>
                                    </div>

                                @elseif($isPDF)
                                    <div class="rounded-xl border border-gray-200 overflow-hidden shadow-lg bg-gray-50">
                                        <div class="hidden md:block">
                                            <embed src="{{ $filePath }}#toolbar=0" type="application/pdf" width="100%" height="400px" />
                                        </div>
                                        
                                        <div class="p-4 md:p-6 bg-white text-center">
                                            <div class="flex items-center justify-center gap-3 mb-4 md:hidden">
                                                <i class="fas fa-file-pdf text-4xl text-red-600"></i>
                                                <span class="text-sm font-bold text-gray-700">Dokumen PDF Tersedia</span>
                                            </div>
                                            <a href="{{ $filePath }}" download class="w-full md:w-auto inline-flex justify-center items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-emerald-700 transition shadow-md">
                                                <i class="fas fa-download"></i> Unduh Dokumen (PDF)
                                            </a>
                                        </div>
                                    </div>

                                @else
                                    <div class="rounded-xl border-2 border-dashed border-blue-100 p-4 md:p-6 bg-blue-50 flex flex-col md:flex-row items-center justify-between gap-4">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-file-word text-3xl md:text-4xl text-blue-600"></i>
                                            <div class="text-left">
                                                <p class="font-bold text-gray-800 text-sm md:text-base">File Dokumen ({{ strtoupper($ext) }})</p>
                                                <p class="text-[10px] md:text-sm text-gray-500">Klik untuk mengunduh berkas.</p>
                                            </div>
                                        </div>
                                        <a href="{{ $filePath }}" download class="w-full md:w-auto text-center px-6 py-2 bg-blue-600 text-white font-bold rounded-lg text-sm">Download</a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
/* CSS Tambahan agar scrollbar di menu mobile tidak muncul (opsional) */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>


   <footer id="kontak" class="bg-[#06291d] pt-12 md:pt-16 pb-6 md:pb-8 text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">

            <div class="space-y-4 md:space-y-6">
                <h3 class="text-2xl md:text-3xl font-black tracking-tighter">
                    Effin<span class="text-emerald-500">ancient</span>
                </h3>
                <p class="text-slate-400 text-xs md:text-sm leading-relaxed max-w-sm">
                    Koperasi Pegawai Kemenag Kota Yogyakarta. Berkah untuk Anggota, Maju Bersama melalui layanan
                    digital terpercaya.
                </p>
            </div>

            <div>
                <h4 class="text-sm md:text-lg font-bold mb-3 md:mb-5 text-emerald-500 uppercase tracking-widest">Navigasi</h4>
                <ul class="space-y-2 md:space-y-3">
                    <li><a href="#" class="text-slate-400 hover:text-white text-sm md:text-base transition">Tentang Kami</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-white text-sm md:text-base transition">Laporan SHU</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-white text-sm md:text-base transition">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm md:text-lg font-bold mb-3 md:mb-5 text-emerald-500 uppercase tracking-widest">Hubungi Kami</h4>
                <ul class="space-y-3 md:space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-emerald-500 mt-1"></i>
                        <span class="text-slate-400 text-xs md:text-sm leading-relaxed">
                            Jl. Ki Mangun Sarkoro No.43 A, Gunungketur, Pakualaman, Kota Yogyakarta
                        </span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-emerald-500"></i>
                        <span class="text-slate-400 text-xs md:text-sm">kpri.baktimulia@gmail.com</span>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm md:text-lg font-bold mb-3 md:mb-5 text-emerald-500 uppercase tracking-widest">Ikuti Kami</h4>
                <div class="flex space-x-3">
                    <a href="#" class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-slate-800 flex items-center justify-center hover:bg-emerald-600 transition">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-slate-800 flex items-center justify-center hover:bg-emerald-600 transition">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="#" class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-slate-800 flex items-center justify-center hover:bg-emerald-600 transition">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-12 md:mt-16 pt-6 md:pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4 text-center md:text-left">
            <p class="text-slate-500 text-[10px] md:text-xs tracking-widest uppercase">
                &copy; 2026 <span class="text-white font-bold">Effinancient</span>. All rights reserved.
            </p>
            <p class="text-slate-600 text-[10px] md:text-[11px]">
                Crafted with <span class="text-red-500">♥</span> for KPRI Bakti Mulia
            </p>
        </div>
    </div>
</footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true, // Only animate once
            easing: 'ease-in-out',
        });
    </script>

    <script>
        const buttons = document.querySelectorAll('.ppid-btn');
        const contents = document.querySelectorAll('.ppid-content');

        buttons.forEach(button => {
            button.addEventListener('click', () => {

                // Reset active button
                buttons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // Hide all content
                contents.forEach(content => content.classList.add('hidden'));

                // Show selected content
                const target = button.getAttribute('data-target');
                document.getElementById(target).classList.remove('hidden');
            });
        });
    </script>

    <script>
        document.addEventListener('click', function (e) {
            const btn = document.getElementById('dataInfoBtn');
            const menu = document.getElementById('dataInfoMenu');
            const icon = document.getElementById('dataInfoIcon');

            if (!btn || !menu) return;

            // Toggle dropdown when clicking the button (animated)
            if (btn.contains(e.target)) {
                const isHidden = menu.classList.contains('hidden');

                if (isHidden) {
                    // show: remove hidden and start enter classes
                    menu.classList.remove('hidden');
                    requestAnimationFrame(() => {
                        menu.classList.remove('opacity-0', 'scale-95', '-translate-y-2', 'pointer-events-none');
                        menu.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                    });
                    btn.setAttribute('aria-expanded', 'true');
                } else {
                    // hide: play exit classes then set hidden after transition
                    menu.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                    menu.classList.add('opacity-0', 'scale-95', '-translate-y-2', 'pointer-events-none');
                    btn.setAttribute('aria-expanded', 'false');
                    setTimeout(() => menu.classList.add('hidden'), 220);
                }

                icon.classList.toggle('rotate-180');
                return;
            }

            // Click outside: ensure hidden
            if (!menu.contains(e.target)) {
                if (!menu.classList.contains('hidden')) {
                    menu.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                    menu.classList.add('opacity-0', 'scale-95', '-translate-y-2', 'pointer-events-none');
                    icon.classList.remove('rotate-180');
                    btn.setAttribute('aria-expanded', 'false');
                    setTimeout(() => menu.classList.add('hidden'), 220);
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sectionAngka = document.getElementById('angka');
            const counters = sectionAngka.querySelectorAll('.text-6xl');
            let hasAnimated = false;

            const animateCounter = (el) => {
                const targetText = el.innerText;
                // Mengambil angka murni (menghapus +, %, M)
                const targetValue = parseInt(targetText.replace(/[^0-9]/g, ''));
                // Menyimpan simbol (suffix) seperti +, %, atau M+
                const suffix = targetText.replace(/[0-9]/g, '');

                let count = 0;
                const duration = 2000; // Durasi animasi 2 detik
                const increment = targetValue / (duration / 16); // 16ms per frame (60fps)

                const updateCount = () => {
                    count += increment;
                    if (count < targetValue) {
                        el.innerHTML = `${Math.ceil(count)}<span class="text-3xl">${suffix}</span>`;
                        requestAnimationFrame(updateCount);
                    } else {
                        el.innerHTML = `${targetValue}<span class="text-3xl">${suffix}</span>`;
                    }
                };

                updateCount();
            };

            // Deteksi scroll menggunakan Intersection Observer
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && !hasAnimated) {
                    counters.forEach(counter => animateCounter(counter));
                    hasAnimated = true; // Agar animasi hanya berjalan sekali
                }
            }, { threshold: 0.5 }); // Animasi dimulai saat 50% section terlihat

            observer.observe(sectionAngka);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Animasi Floating untuk Judul Utama
            const heroTitle = document.querySelector('.hero-bg-image h1');
            if (heroTitle) {
                heroTitle.animate([
                    { transform: 'translateY(0px)' },
                    { transform: 'translateY(-15px)' },
                    { transform: 'translateY(0px)' }
                ], {
                    duration: 5000,
                    iterations: Infinity,
                    easing: 'ease-in-out'
                });
            }

            // 2. Efek Parallax pada Background Hero
            const heroSection = document.querySelector('.hero-bg-image');
            window.addEventListener('scroll', () => {
                const scrollValue = window.scrollY;
                if (heroSection) {
                    // Background bergerak lebih lambat dari scroll (efek depth)
                    heroSection.style.backgroundPositionY = (scrollValue * 0.5) + 'px';
                }
            });

            // 3. Animasi Glow pada Tombol "Masuk" secara berkala
            const loginBtn = document.querySelector('.hero-bg-image a');
            if (loginBtn) {
                setInterval(() => {
                    loginBtn.classList.add('animate-pulse');
                    setTimeout(() => {
                        loginBtn.classList.remove('animate-pulse');
                    }, 2000);
                }, 4000);
            }

            // 4. Animasi Fade-in halus untuk Deskripsi
            const heroDesc = document.querySelector('.hero-bg-image p.mt-6');
            if (heroDesc) {
                heroDesc.style.opacity = '0';
                heroDesc.style.transform = 'translateY(20px)';
                heroDesc.style.transition = 'all 1s ease-out 0.8s';

                // Trigger setelah halaman dimuat
                setTimeout(() => {
                    heroDesc.style.opacity = '1';
                    heroDesc.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>

    <style>
        /* Menambahkan efek transisi smooth untuk parallax */
        .hero-bg-image {
            transition: background-position 0.1s ease-out;
            background-attachment: fixed;
            /* Membuat efek parallax lebih terasa */
        }

        /* Modifikasi drop shadow agar lebih dramatis saat animasi */
        h1.font-extrabold {
            text-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }
    </style>
    <style>
        /* 1. Efek Kilau Logam Bergerak pada Judul */
        .hero-bg-image h1 {
            background: linear-gradient(90deg, #FCB53B, #fff, #FCB53B);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine-gold 3s linear infinite;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.4));
        }

        @keyframes shine-gold {
            to {
                background-position: 200% center;
            }
        }

        /* 2. Efek Glassmorphism & Glow pada Tombol */
        .hero-bg-image a[href="/login"] {
            backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 20px rgba(5, 150, 105, 0.3), inset 0 0 10px rgba(255, 255, 255, 0.5);
            position: relative;
            overflow: hidden;
        }

        /* 3. Efek Cahaya Menyapu (Light Sweep) pada Tombol */
        .hero-bg-image a[href="/login"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.8), transparent);
            transform: skewX(-25deg);
            transition: 0.5s;
        }

        .hero-bg-image a[href="/login"]:hover::before {
            left: 150%;
        }

        /* 4. Overlay Gradasi untuk Kedalaman */
        .image-overlay {
            background: linear-gradient(135deg, rgba(4, 120, 87, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%);
        }
    </style>
    <script>
        document.addEventListener('mousemove', function (e) {
            const hero = document.querySelector('.hero-bg-image');
            const h1 = hero.querySelector('h1');
            const pSlogan = hero.querySelector('p.text-xl');
            const btn = hero.querySelector('a');

            // Menghitung posisi mouse
            let x = (window.innerWidth / 2 - e.pageX) / 30;
            let y = (window.innerHeight / 2 - e.pageY) / 30;

            // Memberikan efek gerakan berbeda (parallax) tiap layer tanpa ubah HTML
            // Judul bergerak paling lambat (jauh)
            h1.style.transform = `translateX(${x * 0.5}px) translateY(${y * 0.5}px)`;


            // Background bergerak sedikit berlawanan
            hero.style.backgroundPosition = `${50 + x * 0.1}% ${50 + y * 0.1}%`;
        });

        // Reset posisi saat mouse keluar area
        document.querySelector('.hero-bg-image').addEventListener('mouseleave', function () {
            const elements = this.querySelectorAll('h1, p, a');
            elements.forEach(el => {
                el.style.transform = `translateX(0) translateY(0)`;
                el.style.transition = 'transform 0.5s ease-out';
            });
        });
    </script>
    <style>
        /* Pewarnaan Ikon yang lebih hidup */
        .icon-pokok i {
            color: #059669;
            filter: drop-shadow(0 4px 6px rgba(5, 150, 105, 0.2));
        }

        .icon-wajib i {
            color: #FCB53B;
            filter: drop-shadow(0 4px 6px rgba(252, 181, 59, 0.2));
        }

        .icon-qurban i {
            color: #A72703;
            filter: drop-shadow(0 4px 6px rgba(167, 39, 3, 0.2));
        }

        /* Style untuk tombol di dalam card agar seragam */
        .btn-soft {
            background: rgba(5, 150, 105, 0.1);
            color: #059669;
            transition: all 0.3s ease;
        }

        .card-pokok:hover .btn-soft,
        .card-wajib:hover .btn-soft,
        .card-qurban:hover .btn-soft {
            background: #059669;
            color: white;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        /* Animasi mengapung untuk ikon saat card di-hover */
        .grid>div:hover i {
            animation: floatingIcon 2s ease-in-out infinite;
        }

        @keyframes floatingIcon {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Background Card saat Hover */
        .grid>div {
            background: white;
            border: 1px solid transparent;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .grid>div:hover {
            border-color: rgba(5, 150, 105, 0.2);
            background: linear-gradient(to bottom right, #ffffff, #f9fafb);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('#layanan .grid > div');

            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left; // posisi x mouse di dalam card
                    const y = e.clientY - rect.top;  // posisi y mouse di dalam card

                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    // Hitung rotasi (maksimal 5 derajat agar tidak pusing)
                    const rotateX = (centerY - y) / 10;
                    const rotateY = (x - centerX) / 10;

                    card.style.transform = `perspective(1000px) scale(1.05) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                    card.style.zIndex = "10";
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = `perspective(1000px) scale(1) rotateX(0deg) rotateY(0deg)`;
                    card.style.zIndex = "1";
                });
            });
        });
    </script>
    <style>
        /* 1. Efek Teks Berkilau (Shimmer) */
        .bg-white.rounded-2xl h3 {
            background: linear-gradient(90deg, #1f2937, #059669, #FCB53B, #1f2937);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textShimmer 3s linear infinite;
        }

        @keyframes textShimmer {
            to {
                background-position: 200% center;
            }
        }

        /* 2. Animasi Denyut pada Card saat Hover */
        .bg-white.rounded-2xl:hover {
            animation: hypePulse 2s infinite;
            border-color: #FCB53B !important;
        }

        @keyframes hypePulse {
            0% {
                box-shadow: 0 0 0 0 rgba(252, 181, 59, 0.4);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(252, 181, 59, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(252, 181, 59, 0);
            }
        }

        /* 3. Animasi Poin Misi saat masuk area */
        .space-y-4 li:hover {
            transform: scale(1.05) translateX(10px);
            background: rgba(252, 181, 59, 0.1) !important;
            font-weight: bold;
        }
    </style>

    <style>
        /* Link Navigasi */
        .footer-link {
            color: #94a3b8;
            /* slate-400 */
            transition: all 0.3s ease;
            display: inline-block;
            position: relative;
        }

        .footer-link:hover {
            color: #10b981;
            /* kemenag-green */
            transform: translateX(5px);
        }

        /* Ikon Sosial Media */
        .social-icon {
            width: 40px;
            height: 40px;
            background: #1e293b;
            /* slate-800 */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: #94a3b8;
            transition: all 0.4s ease;
            border: 1px solid transparent;
        }

        .social-icon:hover {
            background: #10b981;
            color: white;
            border-color: #34d399;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
            transform: translateY(-5px);
        }

        /* Dekorasi Background Footer (Statis) */
        #kontak {
            background: radial-gradient(circle at top right, #1e293b 0%, #0f172a 100%);
            position: relative;
            overflow: hidden;
        }

        /* Efek cahaya redup di pojok agar tidak flat */
        #kontak::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: rgba(16, 185, 129, 0.03);
            filter: blur(80px);
            border-radius: 50%;
        }

        /* Remove white boxes inside footer: make columns transparent */
        #kontak .grid>div {
            background: transparent !important;
            box-shadow: none !important;
            border-color: transparent !important;
        }

        /* Remove boxed look for the angka (counters) section */
        #angka .grid>div {
            background: transparent !important;
            box-shadow: none !important;
            border-color: transparent !important;
        }

        /* Ensure footer text remains readable on dark background */
        #kontak .footer-title,
        #kontak .contact-item,
        #kontak p,
        #kontak ul li,
        #kontak .social-box {
            color: #e6f7ef !important;
        }
    </style>
    <!-- Berita section animations: stagger reveal + hover effects -->
    <style>
        /* initial state for berita cards */
        #berita .grid>div {
            opacity: 0;
            transform: translateY(20px) scale(0.995);
            transition: transform 600ms cubic-bezier(.2, .9, .2, 1), opacity 600ms ease, box-shadow 300ms ease;
            will-change: transform, opacity;
        }

        /* visible state after observer */
        #berita .grid>div.entered {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* hover / focus interactions */
        #berita .grid>div:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 45px -12px rgba(5, 150, 105, 0.18);
            z-index: 5;
        }

        /* subtle image zoom on hover */
        #berita .grid>div img {
            transition: transform 600ms cubic-bezier(.2, .9, .2, 1);
            will-change: transform;
        }

        #berita .grid>div:hover img {
            transform: scale(1.06) translateZ(0);
        }

        /* small responsive tweak for smaller screens */
        @media (max-width: 640px) {
            #berita .grid>div {
                transform: translateY(8px) scale(0.998);
            }

            #berita .grid>div:hover {
                transform: translateY(-6px) scale(1.01);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = Array.from(document.querySelectorAll('#berita .grid > div'));
            if (!cards.length) return;

            const io = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const idx = cards.indexOf(entry.target);
                        // stagger reveal by index
                        setTimeout(() => entry.target.classList.add('entered'), idx * 120);
                        io.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.18 });

            cards.forEach(card => io.observe(card));

            // Optional lightweight tilt effect on mouse move for each card
            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = (e.clientX - rect.left) - rect.width / 2;
                    const y = (e.clientY - rect.top) - rect.height / 2;
                    const rotateX = (y / rect.height) * -6; // tilt amount
                    const rotateY = (x / rect.width) * 6;
                    card.style.transform = `translateY(-6px) scale(1.02) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = '';
                });
            });
        });
    </script>

    {{-- switch layanan --}}
    <script>
        function switchLayanan(id) {
            // 1. Sembunyikan semua konten dengan animasi pudar
            document.querySelectorAll('.layanan-content').forEach(content => {
                content.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => {
                    content.classList.add('hidden');
                }, 300);
            });

            // 2. Reset semua status tombol di sidebar
            document.querySelectorAll('.ppid-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // 3. Aktifkan tombol yang diklik
            document.getElementById('btn-' + id).classList.add('active');

            // 4. Tampilkan konten yang dipilih
            setTimeout(() => {
                const target = document.getElementById(id);
                target.classList.remove('hidden');
                setTimeout(() => {
                    target.classList.remove('opacity-0', 'translate-y-4');
                }, 50);
            }, 350);
        }
        </script>

        {{-- modal berita --}}
     <script>
function openModalBerita(judul, isi, gambar) {

    document.getElementById('modal-title').innerText = judul;
    document.getElementById('modal-isi-full').innerHTML = isi;

    if (gambar) {
        document.getElementById('modal-lampiran').innerHTML =
            `<img src="${gambar}" class="rounded-xl shadow-xl w-full mt-6">`;
    } else {
        document.getElementById('modal-lampiran').innerHTML = '';
    }

    document.getElementById('modalLayanan').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModalLayanan() {
    document.getElementById('modalLayanan').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>

</body>

</html>