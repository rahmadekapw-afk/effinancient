<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Koperasi (Revisi)</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Menambahkan font default sans-serif (bawaan tailwind) */
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    </style>
</head>

<body class="bg-green-50 text-gray-800">
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

    <div class="min-h-screen flex flex-col justify-center items-center p-4">

        <main class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl w-full max-w-md">

            <div class="flex mb-6">
                <button id="tab-anggota"
                    class="tab-btn flex-1 py-3 px-4 rounded-lg font-semibold flex items-center justify-center gap-2 transition-all duration-300 bg-white text-green-600 shadow-md">
                    <i class="bi bi-person-fill"></i>
                    Anggota
                </button>

                <button id="tab-admin"
                    class="tab-btn flex-1 py-3 px-4 rounded-lg font-semibold flex items-center justify-center gap-2 transition-all duration-300 text-gray-500 hover:bg-gray-100">
                    <i class="bi bi-person-fill-gear"></i>
                    Admin
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
                        Belum punya akun? <a href="#" class="font-medium text-green-600 hover:underline">Daftar
                            sekarang</a>
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

        <footer class="mt-6 text-center text-gray-500 text-sm">
            © 2024 Koperasi Digital. Sistem koperasi modern dan terpercaya.
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function () {
            // Definisikan style untuk tab aktif dan tidakaktif
            const activeStyles = 'bg-white text-green-600 shadow-md';
            const inactiveStyles = 'text-gray-500 hover:bg-gray-100';

            // Kecepatan animasi (dalam milidetik)
            const animationSpeed = 200; // 200ms

            // Saat Tab Anggota diklik
            $('#tab-anggota').on('click', function () {
                // Jika sudah aktif, jangan lakukan apa-apa
                if ($(this).hasClass(activeStyles)) {
                    return;
                }

                // Atur style tab
                $(this).removeClass(inactiveStyles).addClass(activeStyles);
                $('#tab-admin').removeClass(activeStyles).addClass(inactiveStyles);

                // Animasikan konten (REVISI)
                $('#content-admin').fadeOut(animationSpeed, function () {
                    $('#content-anggota').fadeIn(animationSpeed);
                });
            });

            // Saat Tab Admin diklik
            $('#tab-admin').on('click', function () {
                // Jika sudah aktif, jangan lakukan apa-apa
                if ($(this).hasClass(activeStyles)) {
                    return;
                }

                // Atur style tab
                $(this).removeClass(inactiveStyles).addClass(activeStyles);
                $('#tab-anggota').removeClass(activeStyles).addClass(inactiveStyles);

                // Animasikan konten (REVISI)
                $('#content-anggota').fadeOut(animationSpeed, function () {
                    $('#content-admin').fadeIn(animationSpeed);
                });
            });
        });
    </script>

</body>

</html>