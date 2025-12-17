<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effinancient - Koperasi Kemenag Kota Yogyakarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        /* Custom colors untuk tema Kemenag Hijau */
        :root {
            --kemenag-green: #059669;
            /* Hijau Emerald */
            --kemenag-dark: #047857;
            /* Hijau Tua */
        }

        .bg-kemenag-green {
            background-color: var(--kemenag-green);
        }

        .text-kemenag-green {
            color: var(--kemenag-green);
        }

        .border-kemenag-green {
            border-color: var(--kemenag-green);
        }

        .hover\:bg-kemenag-dark:hover {
            background-color: var(--kemenag-dark);
        }

        .shadow-kemenag {
            box-shadow: 0 10px 30px -10px rgba(5, 150, 105, 0.4);
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
            background-color: rgba(4, 120, 87, 0.85);
        }

        /* ------------------------------- */
    </style>
</head>

<body class="font-sans bg-gray-50">

    <header class="sticky top-0 z-50 bg-white shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4 transition duration-300">
                <a href="#" class="flex items-center space-x-2">
                    <span class="text-3xl font-extrabold text-kemenag-green">KPRI BAKTI MULIA</span>
                    <span
                        class="hidden sm:inline text-xl text-gray-700 font-light border-l border-gray-300 pl-2">Kementerian
                        Agama Kota Yogyakarta</span>
                </a>

                <nav class="hidden md:flex space-x-8 text-gray-600 font-medium">
                    <a href="#layanan"
                        class="hover:text-kemenag-green transition duration-150 relative group">Layanan</a>
                    <a href="#angka"
                        class="hover:text-kemenag-green transition duration-150 relative group">Statistik</a>
                    <a href="#berita" class="hover:text-kemenag-green transition duration-150 relative group">Berita</a>
                    <a href="#kontak" class="hover:text-kemenag-green transition duration-150 relative group">Kontak</a>
                </nav>

                <a href="/login"
                    class="bg-kemenag-green text-white font-semibold py-2 px-4 rounded-full shadow-kemenag transition duration-300 hover:bg-kemenag-dark transform hover:scale-105">
                    <i class="fas fa-sign-in-alt mr-2"></i> Area Anggota
                </a>
            </div>
        </div>
    </header>

    <section class="hero-bg-image relative py-20 lg:py-32 overflow-hidden">
        <div class="absolute inset-0 image-overlay"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 text-white" data-aos="fade-up">
            <h4 class="text-xl sm:text-5xl lg:text-7xl font-extrabold leading-tight mb-4 tracking-tighter">
                KPRI BAKTI MULIA KUAT<br class="hidden sm:block"> ANGGOTA SEJATERA
            </h4>
            <p class="text-xl font-light mb-10 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="200">
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
            data-aos="fade-down">Pilar Utama Kopinag</h2>
        <p class="text-4xl font-extrabold text-gray-800 mb-16 text-center" data-aos="fade-down" data-aos-delay="100">
            Layanan Terbaik Berbasis Syariah
        </p>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-xl border-t-8 border-kemenag-green transition duration-500 transform hover:scale-[1.02] hover:shadow-2xl"
                data-aos="fade-right">
                <div class="text-5xl text-kemenag-green mb-4">
                    <i class="fas fa-wallet"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gray-800">Simpanan Berjenjang</h3>
                <p class="text-gray-600 mb-4">
                    Kelola dana wajib dan pokok Anda dengan sistem yang transparan, mudah diakses melalui aplikasi
                    Effinancient.
                </p>
                <a href="#"
                    class="text-kemenag-green font-bold text-lg hover:text-kemenag-dark transition duration-150 flex items-center">Lihat
                    Transaksi <i class="fas fa-arrow-right ml-2 text-sm"></i></a>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-xl border-t-8 border-kemenag-green transition duration-500 transform hover:scale-[1.02] hover:shadow-2xl"
                data-aos="fade-up" data-aos-delay="200">
                <div class="text-5xl text-kemenag-green mb-4">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gray-800">Pembiayaan Berkah</h3>
                <p class="text-gray-600 mb-4">
                    Dukungan finansial untuk berbagai kebutuhan dengan prinsip tanpa riba (Syariah). Cepat, Aman, dan
                    Berkah.
                </p>
                <a href="#"
                    class="text-kemenag-green font-bold text-lg hover:text-kemenag-dark transition duration-150 flex items-center">Ajukan
                    Sekarang <i class="fas fa-arrow-right ml-2 text-sm"></i></a>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-xl border-t-8 border-kemenag-green transition duration-500 transform hover:scale-[1.02] hover:shadow-2xl"
                data-aos="fade-left">
                <div class="text-5xl text-kemenag-green mb-4">
                    <i class="fas fa-tablet-alt"></i>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gray-800">Layanan Digital Koperasi</h3>
                <p class="text-gray-600 mb-4">
                    Akses informasi SHU, cek saldo, dan ajukan pembiayaan langsung dari smartphone Anda melalui
                    Effinancient.
                </p>
                <a href="#"
                    class="text-kemenag-green font-bold text-lg hover:text-kemenag-dark transition duration-150 flex items-center">Unduh
                    Aplikasi <i class="fas fa-arrow-right ml-2 text-sm"></i></a>
            </div>
        </div>
    </section>

    <section id="angka" class="bg-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-sm font-semibold uppercase text-kemenag-green tracking-wider mb-2 text-center"
                data-aos="zoom-in">Dampak Nyata</h2>
            <p class="text-4xl font-extrabold text-gray-800 mb-12 text-center" data-aos="zoom-in" data-aos-delay="100">
                Kopinag Tumbuh Bersama Anggota
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

    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in-up">
            <i class="fas fa-quote-left text-5xl text-kemenag-green opacity-70 mb-6"></i>
            <blockquote class="text-2xl italic text-gray-700 font-serif">
                "Koperasi Effinancient sangat membantu dalam pengelolaan keuangan kami. Proses pembiayaan yang syariah
                memberikan ketenangan hati, dan aplikasinya sangat mudah digunakan."
            </blockquote>
            <p class="mt-6 text-lg font-semibold text-gray-800">- Bapak H. M. Fauzi, S.Ag., M.S.I. -</p>
            <p class="text-kemenag-green font-medium">Anggota Aktif Kopinag Kemenag Kota Yogyakarta</p>
        </div>
    </section>

    <section id="berita" class="bg-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-down">
                <h2 class="text-sm font-semibold uppercase text-kemenag-green tracking-wider mb-2">Informasi Terbaru
                </h2>
                <p class="text-4xl font-extrabold text-gray-800">
                    Pusat Berita dan Kegiatan Kopinag
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
                            Komitmen Kopinag melalui dana sosial, memberikan santunan kepada keluarga anggota yang
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
                    class="text-kemenag-green">&hearts;</span> for Kopinag Kemenag.
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
</body>

</html>