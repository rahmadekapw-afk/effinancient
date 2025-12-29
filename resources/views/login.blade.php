<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Login Koperasi (Revisi)</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --kemenag-green: #059669;
            --kemenag-dark: #047857;
            --kemenag-yellow: #FFE797;
            --kemenag-orange: #FCB53B;
            --kemenag-red: #A72703;
            --kemenag-bg: #F1F3E0;
            --bg-kemenag-gl: #ECF4E8;
        }

        /* Konfigurasi Dark Mode Tailwind */
        body.dark {
            background-color: var(--kemenag-bg-dark);
            color: #e2e8f0;
        }

        /* Menambahkan font default sans-serif (bawaan tailwind) */
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
             transition: background-color 0.8s ease;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

       /* Set Background Dasar Siang */
        body.light-mode {
            background-color: var(--kemenag-yellow);
        }

       /* Set Background Dasar Malam */
        body.dark-mode {
            background-color: #0c1221; /* Biru Kehitaman */
        }

        /* Layer Background Gambar */
        .bg-image-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: background-image 0.8s ease, opacity 0.8s ease;
            z-index: -1;
        }

        /* Mode Siang */
        body.light-mode .bg-image-overlay {
            /* Path diarahkan ke folder img dan ekstensi diubah ke .png */
            background-image: url("{{ asset('img/siang.png') }}");
            opacity: 0.7;
        }

        /* Mode Malam */
        body.dark-mode .bg-image-overlay {
            /* Pastikan file malam juga ada di folder img dengan ekstensi .png */
            background-image: url("{{ asset('img/malam.png') }}");
            opacity: 0.5;
        }

        /* Card Login dengan Efek Kaca (Glassmorphism) */
        .login-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-radius: 3rem;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 4px solid transparent;
        }

        body.dark-mode .login-card {
            background: rgba(15, 23, 42, 0.9);
            border-color: var(--kemenag-dark);
            color: black;
        }

        .login-card:hover {
            transform: scale(1.02);
            border-color: var(--kemenag-green);
        }

        /* Tombol Toggle yang Mengambang */
        .theme-toggle {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 100;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            transition: all 0.3s;
            border: 3px solid white;
        }

        body.light-mode .theme-toggle { background: var(--kemenag-orange); color: white; }
        body.dark-mode .theme-toggle { background: #1e293b; color: var(--kemenag-yellow); }

        .theme-toggle:hover { transform: rotate(360deg) scale(1.1); }

        .tab-active {
            background-color: var(--kemenag-green) !important;
            color: white !important;
            box-shadow: 0 8px 15px rgba(5, 150, 105, 0.4);
        }

        /* Input yang ramah lansia */
        input::placeholder { font-size: 1.1rem; opacity: 0.6; }
    </style>
</head>

<body class="light-mode"> <div class="bg-image-overlay"></div>
    {{-- alert --}}
    @if(session('pesan_sukses'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session("pesan_sukses") }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if(session('pesan_error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session("pesan_error") }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <div id="btn-toggle" class="theme-toggle">
        <i id="theme-icon" class="bi bi-sun-fill text-3xl"></i>
    </div>

    <div class="w-full max-w-lg p-4 relative">

        <main class="login-card bg-white rounded-[3rem] p-8 md:p-12 shadow-2xl overflow-hidden">

            <div class="flex mb-10 p-2 bg-gray-100 dark:bg-gray-900 rounded-2xl border-2 border-transparent focus-within:border-[var(--kemenag-yellow)]">
                <button id="tab-anggota" class="tab-btn flex-1 py-4 rounded-xl font-bold flex items-center justify-center gap-2 transition-all duration-300 tab-active text-xl">
                    <i class="bi bi-person-circle"></i> Anggota
                </button>
                <button id="tab-admin" class="tab-btn flex-1 py-4 rounded-xl font-bold flex items-center justify-center gap-2 transition-all duration-300 text-gray-500 dark:text-gray-400 hover:text-[var(--kemenag-green)] text-xl">
                    <i class="bi bi-shield-lock"></i> Admin
                </button>
            </div>

            <div id="content-anggota" class="tab-content">
                <div class="text-center mb-6">
                    <div class="inline-block p-3 bg-green-100 text-green-600 rounded-full mb-4">
                        <i class="bi bi-person-fill text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Login Anggota</h2>
                    <p class="text-gray-500 text-sm mt-1">Masuk sebagai anggota koperasi</p>
                </div>

                <form action="{{ url('login_anggota') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="username-anggota"
                            class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="bi bi-person text-gray-400"></i>
                            </span>
                            <input type="text" id="username-anggota" placeholder="Masukkan username" name="username"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password-anggota"
                            class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="bi bi-lock text-gray-400"></i>
                            </span>
                            <input type="password" id="password-anggota" placeholder="Masukkan password" name="password"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center">
                            <input id="remember-anggota" name="remember" type="checkbox"
                                class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-600">
                            <label for="remember-anggota" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
                        </div>
                        <button class="text-sm text-green-600 hover:underline font-medium">Lupa password?</button>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg mt-6 hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
                        Masuk ke Dashboard
                        <i class="bi bi-arrow-right-short text-xl"></i>
                    </button>

                    <p class="text-center text-sm text-gray-600 mt-6">
                        Kembali ke <a href="{{ url('/') }}"
                            class="font-medium text-green-600 hover:underline">Halaman Utama</a>
                    </p>
                </form>
            </div>

            <div id="content-admin" class="tab-content" style="display: none;">
                <div class="text-center mb-6">
                    <div class="inline-block p-3 bg-green-100 text-green-600 rounded-full mb-4">
                        <i class="bi bi-person-fill-gear text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Login Admin</h2>
                    <p class="text-gray-500 text-sm mt-1">Masuk sebagai admin koperasi</p>
                </div>
                <form action="{{ url('login_admin') }}">
                    @csrf
                    <form action="#">
                        <div class="mb-4">
                            <label for="username-admin" class="block text-sm font-medium text-gray-700 mb-1">Username
                                Admin</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="bi bi-person text-gray-400"></i>
                                </span>
                                <input name="username" type="text" id="username-admin" placeholder="Masukkan username"
                                    name="username"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password-admin"
                                class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="bi bi-lock text-gray-400"></i>
                                </span>
                                <input type="password" id="password-admin" placeholder="Masukkan password"
                                    name="password"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center">
                                <input id="remember-admin" name="remember" type="checkbox"
                                    class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-600">
                                <label for="remember-admin" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg mt-6 hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
                            Masuk ke Dashboard
                            <i class="bi bi-arrow-right-short text-xl"></i>
                        </button>
                    </form>
            </div>

        </main>

        <footer class="mt-6 text-center">
            <p class="text-gray-700 font-bold text-lg italic">
                <span class="text-[var(--kemenag-green)]">Koperasi</span> Digital Modern & Terpercaya
            </p>
            <p class="text-gray-500 mt-1">&copy; 2024 - Kementerian Agama Yogyakarta</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function () {
            // Logic Ganti Tema
            $('#btn-toggle').on('click', function () {
                const body = $('body');
                const icon = $('#theme-icon');
                const welcomeText = $('#content-anggota p');

                if (body.hasClass('light-mode')) {
                    body.removeClass('light-mode').addClass('dark-mode');
                    icon.removeClass('bi-sun-fill').addClass('bi-moon-stars-fill');
                    welcomeText.text('Selamat malam, Bapak/Ibu Anggota.');
                } else {
                    body.removeClass('dark-mode').addClass('light-mode');
                    icon.removeClass('bi-moon-stars-fill').addClass('bi-sun-fill');
                    welcomeText.text('Selamat siang, Bapak/Ibu Anggota.');
                }
            });

            // Logic Tab
            $('.tab-btn').on('click', function () {
                $('.tab-btn').removeClass('tab-active text-gray-500 dark:text-gray-400');
                $(this).addClass('tab-active');

                if ($(this).attr('id') === 'tab-anggota') {
                    $('#content-admin').hide();
                    $('#content-anggota').fadeIn();
                } else {
                    $('#content-anggota').hide();
                    $('#content-admin').fadeIn();
                }
            });
        });
    </script>

</body>

</html>