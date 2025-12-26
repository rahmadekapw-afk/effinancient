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
            color: #d4a100; /* turunan kuning agar lebih lembut */
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
            /* MENGGUNAKAN GAMBAR UNGGAHAN ANDA */
            background-image: url('/img/image.png');
            background-size: cover;
            background-position: center;
        }

        .image-overlay {
            /* Overlay hijau tua dengan transparansi 85% */
            background-color: rgba(4, 120, 87, 0.66);
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

    <header class="sticky top-0 z-50 bg-white shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4 transition duration-300">
                
        <!-- BRAND WRAPPER -->
        <div class="flex items-center gap-4">
        
            <!-- LOGO -->
            <div class="flex items-center gap-2">
                <img src="{{ asset('img/kemenag.png') }}" alt="Logo Kemenag" class="h-11 w-auto object-contain">
        
                <img src="{{ asset('img/koperasi.png') }}" alt="Logo Koperasi" class="h-11 w-auto object-contain">
            </div>
        
            <!-- TEXT BRAND -->
            <div class="leading-tight border-l border-gray-300 pl-3 hidden sm:block">
                <p class="text-lg font-bold text-gray-800 tracking-wide">
                    KPRI Bakti Mulia
                </p>
                <p class="text-sm text-gray-600 font-medium">
                    Kementerian Agama Kota Yogyakarta
                </p>
            </div>
        </div>
        

                <nav class="hidden md:flex items-center space-x-8 text-gray-700 font-medium">
                
                    <a href="#layanan" class="hover:text-kemenag-green transition">
                        Layanan
                    </a>
                
                   
                    <a href="#berita" class="hover:text-kemenag-green transition">
                        Berita
                    </a>
                
                    <a href="#kontak" class="hover:text-kemenag-green transition">
                        Kontak
                    </a>
                 <!-- DROPDOWN DATA & INFORMASI (CLICK) -->
                    <div class="relative">
                
                        <button aria-haspopup="true" aria-expanded="false" id="dataInfoBtn" type="button" class="flex items-center gap-2 px-3 py-2 rounded-lg
                                   hover:bg-kemenag-bg hover:text-kemenag-green transition
                                   focus:outline-none">
                            Data & Informasi
                            <i id="dataInfoIcon" class="fas fa-chevron-down text-xs text-kemenag-orange transition-transform"></i>
                        </button>
                
                        <!-- DROPDOWN MENU -->
                        <div id="dataInfoMenu" class="hidden absolute left-0 mt-3 w-64 bg-white rounded-xl shadow-xl
                                   border border-gray-100 z-50">
                
                            <ul class="py-2 text-sm">
                
                                <li>
                                    <a href="#ppid-title" class="block px-5 py-3 hover:bg-kemenag-bg hover:text-kemenag-green transition">
                                        Standar Layanan Informasi
                                    </a>
                                </li>
                
                                <li>
                                    <a href="#" class="block px-5 py-3 hover:bg-kemenag-bg hover:text-kemenag-green transition">
                                        Neraca Koperasi
                                    </a>
                                </li>
                
                                <li>
                                    <a href="#" class="block px-5 py-3 hover:bg-kemenag-bg hover:text-kemenag-green transition">
                                        Laporan & Statistik
                                    </a>
                                </li>
                
                            </ul>
                        </div>
                    </div>
                
                </nav>

                
                <a href="/login"
                    class="bg-kemenag-green text-white font-semibold py-2 px-4 rounded-full shadow-kemenag transition duration-300 hover:bg-kemenag-dark transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i>  Anggota
                </a>
                </div>
                </div>
    </header>

    <section class="hero-bg-image relative py-20 lg:py-32 overflow-hidden">
        <div class="absolute inset-0 image-overlay"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 text-white" data-aos="fade-up">
            <h4 class="text-xl sm:text-5xl lg:text-7xl font-extrabold text-kemenag-orange leading-tight mb-4 tracking-tighter">
                KPRI BAKTI MULIA <br class="hidden sm:block"> KUAT ANGGOTA SEJATERA
            </h4>
            <p class="text-xl sm:text-4xl font-light mb-10 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Kementerian Agama Kota Yogyakarta
            </p>
            <a href="/login"
                class="inline-block bg-white text-kemenag-green font-bold py-4 px-10 rounded-full text-xl shadow-2xl transition duration-500 hover:bg-gray-100 transform hover:-translate-y-1 animate-pulse-once"
                data-aos="zoom-in" data-aos-delay="400">
                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
            </a>
        </div>
    </section>

    <section id="layanan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <h2 class="text-sm font-semibold uppercase text-kemenag-green tracking-wider mb-2 text-center"
            data-aos="fade-down">Pilar Utama Effinancient</h2>
        <p class="text-4xl font-extrabold text-gray-800 mb-16 text-center" data-aos="fade-down" data-aos-delay="100">
            Layanan Terbaik Berbasis Syariah
        </p>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="card-pokok p-8 rounded-2xl shadow-xl transition duration-500 transform hover:scale-[1.02] hover:shadow-2xl"
                data-aos="fade-right">
                <div class="text-5xl icon-pokok mb-4">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gray-800">Simpanan Pokok</h3>
                <p class="text-gray-700 mb-4 leading-relaxed">
                    Simpanan awal keanggotaan sebagai dasar kepesertaan koperasi yang dikelola secara aman dan transparan.
                </p>
                <a href="#" class="btn-soft font-semibold text-lg px-4 py-2 rounded-full inline-flex items-center">
                    Lihat Detail <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>


            <div class="card-wajib p-8 rounded-2xl shadow-xl transition duration-500 transform hover:scale-[1.02] hover:shadow-2xl"
                data-aos="fade-up" data-aos-delay="200">
                <div class="text-5xl icon-wajib mb-4">
                    <i class="fas fa-coins"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gray-800">Simpanan Wajib</h3>
                <p class="text-gray-700 mb-4 leading-relaxed">
                    Setoran rutin bulanan anggota sebagai bentuk komitmen bersama untuk memperkuat koperasi.
                </p>
                <a href="#" class="btn-soft font-semibold text-lg px-4 py-2 rounded-full inline-flex items-center">
                    Cek Informasi <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>


            <div class="card-qurban p-8 rounded-2xl shadow-xl transition duration-500 transform hover:scale-[1.02] hover:shadow-2xl"
                data-aos="fade-left">
                <div class="text-5xl icon-qurban mb-4">
                    <i class="fas fa-mosque"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gray-800">Simpanan Qurban</h3>
                <p class="text-gray-700 mb-4 leading-relaxed">
                    Tabungan khusus untuk persiapan ibadah qurban yang terencana, ringan, dan sesuai prinsip syariah.
                </p>
                <a href="#" class="btn-soft font-semibold text-lg px-4 py-2 rounded-full inline-flex items-center">
                    Mulai Menabung <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>
        </div>
    </section>

    <section id="angka" class="bg-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-sm font-semibold uppercase text-kemenag-green tracking-wider mb-2 text-center"
                data-aos="zoom-in">Dampak Nyata</h2>
            <p class="text-4xl font-extrabold text-gray-800 mb-12 text-center" data-aos="zoom-in" data-aos-delay="100">
                Effinancient Tumbuh Bersama Anggota
            </p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                <div data-aos="flip-up">
                    <p class="text-6xl font-extrabold text-kemenag-green mb-2">1.200<span class="text-3xl">+</span></p>
                    <p class="text-gray-600 font-medium border-t pt-2 border-kemenag-green/50">Anggota Aktif Terdaftar
                    </p>
                </div>
                <div data-aos="flip-up" data-aos-delay="100">
                    <p class="text-6xl font-extrabold text-kemenag-green mb-2">95<span class="text-3xl">%</span></p>
                    <p class="text-gray-600 font-medium border-t pt-2 border-kemenag-green/50">Tingkat Kepuasan Layanan
                    </p>
                </div>
                <div data-aos="flip-up" data-aos-delay="200">
                    <p class="text-6xl font-extrabold text-kemenag-green mb-2">12<span class="text-3xl">M+</span></p>
                    <p class="text-gray-600 font-medium border-t pt-2 border-kemenag-green/50">Total Aset Koperasi
                        (Rupiah)</p>
                </div>
                <div data-aos="flip-up" data-aos-delay="300">
                    <p class="text-6xl font-extrabold text-kemenag-green mb-2">100<span class="text-3xl">%</span></p>
                    <p class="text-gray-600 font-medium border-t pt-2 border-kemenag-green/50">RAT Diselenggarakan Tepat
                        Waktu</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 kemenag-bg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in-up">
            <i class="fas fa-quote-left text-5xl text-kemenag-green opacity-70 mb-6"></i>
            <blockquote class="text-2xl italic text-gray-700 font-serif">
                "Koperasi Effinancient sangat membantu dalam pengelolaan keuangan kami. Proses pembiayaan yang syariah
                memberikan ketenangan hati, dan aplikasinya sangat mudah digunakan."
            </blockquote>
            <p class="mt-6 text-lg font-semibold text-gray-800">- ....., M.S.I. -</p>
            <p class="text-kemenag-green font-medium">Anggota Aktif KPRI BAKTI MULIA Kemenag Kota Yogyakarta</p>
        </div>
    </section>

    <section id="berita" class="bg-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-down">
                <h2 class="text-sm font-semibold uppercase text-kemenag-green tracking-wider mb-2">Informasi Terbaru
                </h2>
                <p class="text-4xl font-extrabold text-gray-800">
                    Pusat Berita dan Kegiatan KPRI BAKTI MULIA
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl transform hover:-translate-y-1"
                    data-aos="fade-up">
                    <div class="h-48 bg-kemenag-green flex items-center justify-center text-white text-3xl font-bold">
                        [Gambar RAT]
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-semibold uppercase tracking-wider text-kemenag-green">RAT</span>
                        <h3 class="text-xl font-bold text-gray-800 my-2 hover:text-kemenag-dark transition">
                            Suksesnya Pelaksanaan RAT Tahun Buku 2024
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Rapat Anggota Tahunan Kopinag telah dilaksanakan dengan lancar, menghasilkan keputusan
                            strategis untuk peningkatan SHU anggota.
                        </p>
                        <div class="flex justify-between items-center text-xs text-gray-500">
                            <span><i class="far fa-calendar-alt mr-1"></i> 10 Desember 2024</span>
                            <a href="#" class="font-semibold text-kemenag-green hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl transform hover:-translate-y-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="h-48 bg-gray-300 flex items-center justify-center text-kemenag-dark text-3xl font-bold">
                        [Gambar Bantuan]
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-semibold uppercase tracking-wider text-kemenag-green">Sosial</span>
                        <h3 class="text-xl font-bold text-gray-800 my-2 hover:text-kemenag-dark transition">
                            Penyaluran Bantuan Dana Duka Cita Anggota
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Komitmen KPRI BAKTI MULIA melalui dana sosial, memberikan santunan kepada keluarga anggota
                            yang
                            sedang berduka.
                        </p>
                        <div class="flex justify-between items-center text-xs text-gray-500">
                            <span><i class="far fa-calendar-alt mr-1"></i> 25 November 2024</span>
                            <a href="#" class="font-semibold text-kemenag-green hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl transform hover:-translate-y-1"
                    data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="h-48 bg-kemenag-green/70 flex items-center justify-center text-white text-3xl font-bold">
                        [Gambar Pelatihan]
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-semibold uppercase tracking-wider text-kemenag-green">Edukasi</span>
                        <h3 class="text-xl font-bold text-gray-800 my-2 hover:text-kemenag-dark transition">
                            Pelatihan Pengelolaan Keuangan Syariah Dasar
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Mengikuti acara edukasi untuk meningkatkan literasi keuangan anggota Kemenag di Aula
                            Serbaguna.
                        </p>
                        <div class="flex justify-between items-center text-xs text-gray-500">
                            <span><i class="far fa-calendar-alt mr-1"></i> 05 November 2024</span>
                            <a href="#" class="font-semibold text-kemenag-green hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12" data-aos="zoom-in" data-aos-delay="600">
                <a href="#"
                    class="inline-block bg-kemenag-green text-white font-bold py-3 px-8 rounded-full shadow-kemenag transition duration-300 hover:bg-kemenag-dark transform hover:scale-105">
                    Lihat Semua Berita dan Kegiatan <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="bg-kemenag-green rounded-2xl px-8 py-10 text-white mb-12 shadow-xl" data-aos="fade-down">
                <h2 class="text-4xl font-extrabold mb-3">Standar Layanan</h2>
                <p class="text-sm opacity-90 max-w-3xl">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.
                </p>
            </div>

            <!-- Content -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Sidebar -->
                <aside class="lg:col-span-1 bg-white rounded-2xl shadow-lg p-6 h-fit" data-aos="fade-right">
                    <ul class="space-y-2 text-sm font-medium">
                        <li>
                            <a href="#" class="block px-4 py-3 rounded-lg bg-kemenag-green text-white">
                                Ketentuan Umum
                            </a>
                        </li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Standar Layanan &
                                Maklumat</a></li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Hak & Kewajiban Pemohon</a>
                        </li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Hak & Kewajiban Badan
                                Publik</a></li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Jalur & Waktu Layanan</a>
                        </li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Standar Biaya</a></li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Permohonan Informasi</a>
                        </li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Keberatan & Sengketa</a>
                        </li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Pengelolaan Website</a>
                        </li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Pengajuan Konsekuensi</a>
                        </li>
                        <li><a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-100">Pelayanan Khusus</a></li>
                    </ul>
                </aside>

                <!-- Main Content -->
                <div class="lg:col-span-3 bg-white rounded-2xl shadow-lg p-8" data-aos="fade-left">
                    <h3 class="text-2xl font-extrabold text-kemenag-green mb-6">
                        Ketentuan Umum
                    </h3>

                    <div class="space-y-5 text-sm text-gray-700 leading-relaxed text-justify">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste
                            natus error sit voluptatem accusantium doloremque laudantium.
                        </p>

                        <p>
                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi.
                        </p>

                        <p>
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                        </p>

                        <p>
                            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                            velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
                            quaerat voluptatem.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Standar Layanan -->
=======
<!-- ================== STANDAR LAYANAN (DI ATAS FOOTER) ================== -->
 <section class="kemenag-bg py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="bg-kemenag-green rounded-2xl px-8 py-10">
            <h2 id="ppid-title" class="text-4xl font-extrabold mb-3">
                <span class="text-kemenag-orange">Informasi Kelembagaan</span>
            </h2>

            <p class="text-sm opacity-90 max-w-4xl text-white">
                informasi kelembagaan yang wajib disediakan dan diumumkan secara berkala oleh KPRI Bakti Mulia
                Kementerian Agama Kota Yogyakarta sesuai dengan Undang-Undang No. 14 Tahun 2008 tentang Keterbukaan
                Informasi Publik dan Peraturan Komisi Informasi No. 1 Tahun 2010 tentang Standar Layanan Informasi Publik.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- SIDEBAR -->
            <aside class="lg:col-span-1 bg-white rounded-2xl shadow-lg p-6 h-fit ppid-sidebar">
                <ul class="space-y-1 text-sm font-medium">

                    <li><button class="ppid-btn active" data-target="ketentuan">Ketentuan Umum</button></li>
                    <li><button class="ppid-btn" data-target="anggaran-kpri">Anggaran Rumah Tangga KPRI Bakti Mulia</button></li>
                    <li><button class="ppid-btn" data-target="hak-pemohon">Hak dan Kewajiban Pemohon</button></li>
                    <li><button class="ppid-btn" data-target="hak-badan">Hak dan Kewajiban Badan Publik</button></li>
                    <li><button class="ppid-btn" data-target="jalur-waktu">Jalur dan Waktu Layanan</button></li>
                    <li><button class="ppid-btn" data-target="standar-biaya">Standar Biaya</button></li>
                    <li><button class="ppid-btn" data-target="permohonan">Prosedur Permohonan Informasi Publik</button></li>
                    <li><button class="ppid-btn" data-target="keberatan">Prosedur Pengajuan Keberatan atau Sengketa Informasi Publik</button></li>
                    <li><button class="ppid-btn" data-target="pengelolaan">Prosedur Pengelolaan Website dan Medsos</button></li>
                    <li><button class="ppid-btn" data-target="konsekuensi">Pengajuan Konsekuensi</button></li>
                    <li><button class="ppid-btn" data-target="khusus">Pelayanan Berkebutuhan Khusus</button></li>
                    <li><button class="ppid-btn" data-target="sarana">Sarana dan Prasarana Pelayanan</button></li>
                    <li><button class="ppid-btn" data-target="rentan">Pelayanan Ramah Kelompok Rentan</button></li>
                    <li><button class="ppid-btn" data-target="mpp">Standar Pelayanan Mall Pelayanan Publik Kantor Kementerian Kota Yogyakarta</button></li>
                    <li><button class="ppid-btn" data-target="kua">Standar Pelayanan Kantor Urusan Agama (KUA) se-Kota Yogyakarta</button></li>

                </ul>
            </aside>

            <!-- CONTENT -->
            <div class="lg:col-span-3 rounded-2xl shadow-lg p-10 ppid-content-wrapper">

                <!-- TEMPLATE CONTENT -->
                <div id="ketentuan" class="ppid-content">
                    <h3>Ketentuan Umum</h3>
                
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.
                        Praesent libero. Sed cursus ante dapibus diam.
                    </p>
                
                    <p>
                        Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.
                    </p>
                
                    <ol>
                        <li>Lorem ipsum dolor sit amet.</li>
                        <li>Consectetur adipiscing elit.</li>
                        <li>Sed do eiusmod tempor incididunt.</li>
                    </ol>
                </div>


                <div id="anggaran-kpri" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Standar layanan menjelaskan komitmen dan maklumat pelayanan informasi publik.</p>
                </div>

                <div id="hak-pemohon" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Pemohon informasi memiliki hak memperoleh informasi publik secara benar.</p>
                </div>

                <div id="hak-badan" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Badan publik berkewajiban menyediakan layanan informasi.</p>
                </div>

                <div id="jalur-waktu" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Jalur dan waktu layanan ditetapkan sesuai peraturan.</p>
                </div>

                <div id="standar-biaya" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Pelayanan informasi publik tidak dipungut biaya kecuali penggandaan.</p>
                </div>

                <div id="permohonan" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Permohonan informasi dilakukan secara tertulis maupun elektronik.</p>
                </div>

                <div id="keberatan" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Keberatan diajukan apabila permohonan tidak ditanggapi.</p>
                </div>

                <div id="pengelolaan" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Pengelolaan website dan media sosial mengikuti prinsip keterbukaan.</p>
                </div>

                <div id="konsekuensi" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Konsekuensi informasi ditetapkan berdasarkan uji konsekuensi.</p>
                </div>

                <div id="khusus" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Pelayanan khusus diberikan bagi pemohon berkebutuhan khusus.</p>
                </div>

                <div id="sarana" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Sarana dan prasarana mendukung pelayanan informasi publik.</p>
                </div>

                <div id="rentan" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Pelayanan ramah kelompok rentan bersifat inklusif.</p>
                </div>

                <div id="mpp" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Standar pelayanan MPP diterapkan sesuai kebijakan Kemenag.</p>
                </div>

                <div id="kua" class="ppid-content hidden">
                    <p>Lorem ipsum dolor sit amet. Standar pelayanan KUA berlaku di seluruh Kota Yogyakarta.</p>
                </div>
                
            </div>
        </div>
    </div>
</section>




    <footer id="kontak" class="bg-gray-800 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-extrabold mb-3 text-kemenag-green">Effinancient</h3>
                    <p class="text-gray-400 text-sm">
                        Koperasi Pegawai Kemenag Kota Yogyakarta. Berkah untuk Anggota, Maju Bersama.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 border-b border-kemenag-green pb-1">Navigasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-kemenag-green transition duration-150">Tentang
                                Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-kemenag-green transition duration-150">Laporan
                                SHU</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-kemenag-green transition duration-150">Kebijakan
                                Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 border-b border-kemenag-green pb-1">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2 text-kemenag-green"></i> Jl.
                            Jawa No. 1, Kota Yogyakarta</li>
                        <li class="flex items-center"><i class="fas fa-phone mr-2 text-kemenag-green"></i> (0274) 123456
                        </li>
                        <li class="flex items-center"><i class="fas fa-envelope mr-2 text-kemenag-green"></i>
                            admin@effinancient.com</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 border-b border-kemenag-green pb-1">Ikuti Kami</h4>
                    <div class="flex space-x-4 text-2xl">
                        <a href="#" class="text-gray-400 hover:text-kemenag-green transition duration-150"><i
                                class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-kemenag-green transition duration-150"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-kemenag-green transition duration-150"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-10 pt-6 border-t border-gray-700 text-center text-gray-500 text-sm">
                &copy; 2024 Effinancient. All rights reserved. Crafted with <span
                    class="text-kemenag-green">&hearts;</span> for Effinancient
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

        // Klik tombol dropdown
        if (btn.contains(e.target)) {
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
            return;
        }

        // Klik di luar dropdown
        if (!menu.contains(e.target)) {
            menu.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    });
    </script>


</body>

</html>