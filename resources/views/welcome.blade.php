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
    background-image: url('/img/image.png');
    background-size: cover;
    background-position: center;
    filter: saturate(1.1) contrast(1.05);
}


        .image-overlay {
    background: linear-gradient(
        to bottom,
        rgba(6, 78, 50, 0.55),
        rgba(6, 78, 50, 0.32),
        rgba(6, 78, 50, 0.55)
    );
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

                <div class="relative">
                    <button
                        id="dataInfoBtn"
                        aria-expanded="false"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/10 hover:text-[#FCB53B] transition duration-300"
                    >
                        Data & Informasi
                        <i
                            id="dataInfoIcon"
                            class="fas fa-chevron-down text-xs transition-transform duration-300"
                        ></i>
                    </button>

                    <div
                        id="dataInfoMenu"
                        aria-labelledby="dataInfoBtn"
                        class="absolute left-0 mt-3 w-64 bg-[#064E32] rounded-lg shadow-2xl overflow-hidden ring-1 ring-black ring-opacity-5 transform origin-top-left transition-all duration-200 hidden opacity-0 scale-95 -translate-y-2 pointer-events-none"
                    >
                        <a
                            href="#"
                            class="block px-5 py-3 text-white hover:bg-white/10 hover:pl-7 transition-all duration-200"
                        >
                            Standar Layanan Informasi
                        </a>

                        <a
                            href="#"
                            class="block px-5 py-3 text-white hover:bg-white/10 hover:pl-7 transition-all duration-200"
                        >
                            Neraca Koperasi
                        </a>

                        <a
                            href="#"
                            class="block px-5 py-3 text-white hover:bg-white/10 hover:pl-7 transition-all duration-200"
                        >
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




    <section class="hero-bg-image relative py-20 lg:py-32 overflow-hidden">
        <div class="absolute inset-0 image-overlay"></div>

                    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8
                                text-center relative z-10"
                        data-aos="fade-up">
                        <h1 class="font-extrabold
                                text-5xl sm:text-6xl lg:text-7xl
                                tracking-wide
                                text-kemenag-orange
                                drop-shadow-[0_4px_12px_rgba(0,0,0,0.6)]">
                            KPRI BAKTI MULIA
                        </h1>



                                                <!-- SLOGAN -->
                                            <p class="mt-4
                                text-xl sm:text-2xl lg:text-3xl
                                font-semibold
                                text-white
                                drop-shadow-[0_3px_8px_rgba(0,0,0,0.6)]">
                            Kuat Anggota Sejahtera
                        </p>



                                                <!-- DESKRIPSI -->
                                            <p class="mt-6
                                text-base sm:text-lg lg:text-xl
                                font-medium
                                text-gray-100">
                            Kementerian Agama Kota Yogyakarta
                        </p>



                        <!-- TOMBOL -->
                        <a href="/login"
                        class="inline-block mt-12
                                bg-white text-kemenag-green
                                font-bold py-4 px-12
                                rounded-full text-xl
                                shadow-2xl
                                transition-all duration-500
                                hover:bg-gray-100
                                hover:-translate-y-1"
                        data-aos="zoom-in"
                        data-aos-delay="400">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Masuk
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

   <section class="py-20 bg-kemenag-gl">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">

        <!-- JUDUL -->
        <div class="text-center mb-14">
            <h2 class="text-sm font-semibold uppercase tracking-widest text-kemenag-green mb-2">
                Visi dan Misi
            </h2>
            <p class="text-4xl font-extrabold text-gray-800">
                Kementerian Agama Republik Indonesia
            </p>
        </div>

        <!-- VISI -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-10 border-l-8 border-kemenag-green"
             data-aos="fade-right">
            <div class="flex items-center mb-4">
                <i class="fas fa-eye text-3xl text-kemenag-green mr-3"></i>
                <h3 class="text-2xl font-extrabold text-kemenag-green">Visi</h3>
            </div>
            <p class="text-gray-700 text-lg leading-relaxed text-justify">
                <span class="font-semibold">“Kementerian Agama yang profesional dan andal</span>
                dalam membangun masyarakat yang saleh, moderat, cerdas dan unggul untuk mewujudkan
                Indonesia maju yang berdaulat, mandiri, dan berkepribadian berdasarkan gotong royong.”
            </p>
        </div>

        <!-- MISI -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border-l-8 border-kemenag-orange"
             data-aos="fade-left">
            <div class="flex items-center mb-6">
                <i class="fas fa-bullseye text-3xl text-kemenag-orange mr-3"></i>
                <h3 class="text-2xl font-extrabold text-kemenag-orange">Misi</h3>
            </div>

            <ol class="space-y-4 text-gray-700 text-lg list-decimal list-inside">
                <li>Meningkatkan kualitas kesalehan umat beragama.</li>
                <li>Memperkuat moderasi beragama dan kerukunan umat beragama.</li>
                <li>Meningkatkan layanan keagamaan yang adil, mudah, dan merata.</li>
                <li>Meningkatkan layanan pendidikan yang merata dan bermutu.</li>
                <li>Meningkatkan produktivitas dan daya saing pendidikan.</li>
                <li>Memantapkan tata kelola pemerintahan yang baik (<em>Good Governance</em>).</li>
            </ol>
        </div>

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
                @if(isset($artikels) && $artikels->count())
                    @foreach($artikels as $a)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl transform hover:-translate-y-1"
                            data-aos="fade-up">
                            @if($a->gambar)
                                <img src="/{{ $a->gambar }}" alt="{{ $a->judul }}" class="h-48 w-full object-cover">
                            @else
                                <div class="h-48 bg-kemenag-green flex items-center justify-center text-white text-3xl font-bold">
                                    [Gambar]
                                </div>
                            @endif
                            <div class="p-6">
                                <span class="text-xs font-semibold uppercase tracking-wider text-kemenag-green">{{ strtoupper($a->kategori ?? 'Berita') }}</span>
                                <h3 class="text-xl font-bold text-gray-800 my-2 hover:text-kemenag-dark transition">
                                    {{ $a->judul }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($a->isi ?? ''), 150) }}
                                </p>
                                <div class="flex justify-between items-center text-xs text-gray-500">
                                    <span><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d F Y') }}</span>
                                    @php
                                        $targetLink = $a->external_url ?? null;
                                        if (! $targetLink && preg_match('#https?://#i', $a->slug ?? '')) {
                                            $targetLink = $a->slug;
                                        }
                                    @endphp
                                    @if($targetLink)
                                        <a href="{{ $targetLink }}" target="_blank" rel="noopener" class="font-semibold text-kemenag-green hover:underline">Baca Selengkapnya</a>
                                    @else
                                        <a href="{{ url('/berita/'.$a->slug) }}" class="font-semibold text-kemenag-green hover:underline">Baca Selengkapnya</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-1 md:col-span-3 text-center text-gray-500">Belum ada berita</div>
                @endif
            </div>

            <div class="text-center mt-12" data-aos="zoom-in" data-aos-delay="600">
                <a href="{{ route('berita.index') }}"
                    class="inline-block bg-kemenag-green text-white font-bold py-3 px-8 rounded-full shadow-kemenag transition duration-300 hover:bg-kemenag-dark transform hover:scale-105">
                    Lihat Semua Berita dan Kegiatan <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

   

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




    <footer id="kontak" class="footer-custom pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 text-left">
            
            <div class="space-y-6">
                <h3 class="text-3xl font-black tracking-tighter text-white">
                    Effin<span class="text-emerald-500">ancient</span>
                </h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Koperasi Pegawai Kemenag Kota Yogyakarta. Berkah untuk Anggota, Maju Bersama melalui layanan digital terpercaya.
                </p>
            </div>

            <div>
                <h4 class="footer-title">Navigasi</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="footer-link">Tentang Kami</a></li>
                    <li><a href="#" class="footer-link">Laporan SHU</a></li>
                    <li><a href="#" class="footer-link">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-title">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li class="contact-item">
                        <i class="fas fa-map-marker-alt text-emerald-500"></i>
                        <span>Jl. Jawa No. 1, Yogyakarta</span>
                    </li>
                    <li class="contact-item">
                        <i class="fas fa-phone text-emerald-500"></i>
                        <span>(0274) 123456</span>
                    </li>
                    <li class="contact-item">
                        <i class="fas fa-envelope text-emerald-500"></i>
                        <span>admin@effinancient.com</span>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="footer-title">Ikuti Kami</h4>
                <div class="flex space-x-3">
                    <a href="#" class="social-box"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-box"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-box"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="mt-16 pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-500 text-xs tracking-widest uppercase">
                &copy; 2024 <span class="text-white font-bold">Effinancient</span>. All rights reserved.
            </p>
            <p class="text-slate-600 text-[11px]">
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
        background-attachment: fixed; /* Membuat efek parallax lebih terasa */
    }

    /* Modifikasi drop shadow agar lebih dramatis saat animasi */
    h1.font-extrabold {
        text-shadow: 0 10px 20px rgba(0,0,0,0.4);
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
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.4));
    }

    @keyframes shine-gold {
        to { background-position: 200% center; }
    }

    /* 2. Efek Glassmorphism & Glow pada Tombol */
    .hero-bg-image a[href="/login"] {
        backdrop-filter: blur(8px);
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 0 20px rgba(5, 150, 105, 0.3), inset 0 0 10px rgba(255,255,255,0.5);
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
        background: linear-gradient(to right, transparent, rgba(255,255,255,0.8), transparent);
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
document.addEventListener('mousemove', function(e) {
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
document.querySelector('.hero-bg-image').addEventListener('mouseleave', function() {
    const elements = this.querySelectorAll('h1, p, a');
    elements.forEach(el => {
        el.style.transform = `translateX(0) translateY(0)`;
        el.style.transition = 'transform 0.5s ease-out';
    });
});
</script>
<style>
    /* Pewarnaan Ikon yang lebih hidup */
    .icon-pokok i { color: #059669; filter: drop-shadow(0 4px 6px rgba(5,150,105,0.2)); }
    .icon-wajib i { color: #FCB53B; filter: drop-shadow(0 4px 6px rgba(252,181,59,0.2)); }
    .icon-qurban i { color: #A72703; filter: drop-shadow(0 4px 6px rgba(167,39,3,0.2)); }

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
    .grid > div:hover i {
        animation: floatingIcon 2s ease-in-out infinite;
    }

    @keyframes floatingIcon {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Background Card saat Hover */
    .grid > div {
        background: white;
        border: 1px solid transparent;
        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .grid > div:hover {
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
        to { background-position: 200% center; }
    }

    /* 2. Animasi Denyut pada Card saat Hover */
    .bg-white.rounded-2xl:hover {
        animation: hypePulse 2s infinite;
        border-color: #FCB53B !important;
    }

    @keyframes hypePulse {
        0% { box-shadow: 0 0 0 0 rgba(252, 181, 59, 0.4); }
        70% { box-shadow: 0 0 0 20px rgba(252, 181, 59, 0); }
        100% { box-shadow: 0 0 0 0 rgba(252, 181, 59, 0); }
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
        color: #94a3b8; /* slate-400 */
        transition: all 0.3s ease;
        display: inline-block;
        position: relative;
    }

    .footer-link:hover {
        color: #10b981; /* kemenag-green */
        transform: translateX(5px);
    }

    /* Ikon Sosial Media */
    .social-icon {
        width: 40px;
        height: 40px;
        background: #1e293b; /* slate-800 */
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
    #kontak .grid > div {
        background: transparent !important;
        box-shadow: none !important;
        border-color: transparent !important;
    }

    /* Remove boxed look for the angka (counters) section */
    #angka .grid > div {
        background: transparent !important;
        box-shadow: none !important;
        border-color: transparent !important;
    }

    /* Ensure footer text remains readable on dark background */
    #kontak .footer-title, #kontak .contact-item, #kontak p, #kontak ul li, #kontak .social-box {
        color: #e6f7ef !important;
    }
</style>
<!-- Berita section animations: stagger reveal + hover effects -->
<style>
    /* initial state for berita cards */
    #berita .grid > div {
        opacity: 0;
        transform: translateY(20px) scale(0.995);
        transition: transform 600ms cubic-bezier(.2,.9,.2,1), opacity 600ms ease, box-shadow 300ms ease;
        will-change: transform, opacity;
    }

    /* visible state after observer */
    #berita .grid > div.entered {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* hover / focus interactions */
    #berita .grid > div:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 45px -12px rgba(5,150,105,0.18);
        z-index: 5;
    }

    /* subtle image zoom on hover */
    #berita .grid > div img {
        transition: transform 600ms cubic-bezier(.2,.9,.2,1);
        will-change: transform;
    }

    #berita .grid > div:hover img {
        transform: scale(1.06) translateZ(0);
    }

    /* small responsive tweak for smaller screens */
    @media (max-width: 640px) {
        #berita .grid > div { transform: translateY(8px) scale(0.998); }
        #berita .grid > div:hover { transform: translateY(-6px) scale(1.01); }
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
            const x = (e.clientX - rect.left) - rect.width/2;
            const y = (e.clientY - rect.top) - rect.height/2;
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
</body>

</html>