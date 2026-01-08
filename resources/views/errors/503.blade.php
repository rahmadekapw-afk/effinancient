<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle, #ecfdf5 0%, #d1fae5 100%);
        }

        .error-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(16, 185, 129, 0.2);
            box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.25);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-18px); }
            100% { transform: translateY(0px); }
        }

        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.45);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen p-4">

    <div class="error-card max-w-lg w-full p-10 rounded-3xl text-center">
        <div class="relative inline-block">
            <h1 class="text-9xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-green-600 floating">
                503
            </h1>
            <div class="absolute -bottom-2 left-0 right-0 h-2 bg-emerald-200 rounded-full blur-xl opacity-60"></div>
        </div>

        <h2 class="text-2xl font-bold text-emerald-800 mt-8">
            Oops! Halaman Tidak Ditemukan
        </h2>

        <p class="text-emerald-700/70 mt-3 leading-relaxed">
            Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau URL yang dimasukkan tidak valid.
        </p>

        <div class="mt-10">
            <a href="{{ url('/') }}"
               class="btn-hover inline-block px-8 py-4 bg-emerald-600 text-white font-semibold rounded-2xl transition-all duration-300 hover:bg-emerald-700">
               Kembali ke Beranda
            </a>
        </div>
        
        <p class="mt-8 text-sm text-emerald-700/60">
            Perlu bantuan?
            <a href="#" class="text-emerald-600 underline hover:text-emerald-700">
                Hubungi Support
            </a>
        </p>
    </div>

</body>
</html>
