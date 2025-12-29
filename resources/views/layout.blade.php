<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Effinancient')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root{--kemenag-green:#059669;--kemenag-dark:#047857}
        .bg-kemenag-green{background-color:var(--kemenag-green)}
        .text-kemenag-green{color:var(--kemenag-green)}
        .shadow-kemenag{box-shadow:0 10px 30px -10px rgba(5,150,105,0.6)}
    </style>
</head>
<body class="font-sans bg-gray-50 text-gray-800">
<header class="sticky top-0 bg-[#0B5E3C] text-white">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/kemenag.png') }}" class="h-8" alt="logo">
            <span class="font-bold">KPRI Bakti Mulia</span>
        </div>
        <nav class="space-x-4">
            <a href="/" class="hover:text-kemenag-green">Home</a>
            <a href="{{ route('berita.index') }}" class="hover:text-kemenag-green">Berita</a>
            <a href="/login" class="bg-white text-[#0B5E3C] px-3 py-1 rounded-full">Masuk</a>
        </nav>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-8">
    @yield('content')
</main>

<footer class="bg-gray-800 text-white mt-12">
    <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-300">
        &copy; {{ date('Y') }} Effinancient. All rights reserved.
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration:800,once:true});</script>
</body>
</html>