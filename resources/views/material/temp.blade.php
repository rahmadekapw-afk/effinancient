<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anggota - Koperasi Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        /* Custom class untuk link aktif Anggota */
        .active-link-anggota {
            background-color: #065f46; /* green-900 */
            border-right: 4px solid #d1fae5; /* green-100 */
        }

        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gray-100">

    <aside id="sidebar" class="bg-green-800 text-white w-64 h-screen fixed top-0 left-0 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out">
        
        <div class="p-4 text-center">
            <h2 class="text-xl font-bold">Koperasi Digital</h2>
        </div>

        <div class="p-4 flex items-center gap-3 border-b border-t border-green-700">
            <div class="bg-green-700 p-2 rounded-full">
                <i class="bi bi-person-fill text-xl"></i>
            </div>
            <div>
                <p class="font-semibold text-base">sfds</p>
                <p class="text-xs text-green-200">Anggota Koperasi</p>
            </div>
        </div>

        <nav class="mt-2">
            
            {{-- Beranda ('/anggota') --}}
            <a href="{{ url('/anggota') }}" 
               class="flex items-center gap-3 px-6 py-3 transition-colors 
                      @if(Request::is('anggota') || Request::is('anggota/'))
                          active-link-anggota
                      @else
                          hover:bg-green-900
                      @endif">
                <i class="bi bi-grid-fill text-lg"></i>
                <span class="font-medium text-sm">Beranda</span>
            </a>
            
            {{-- Simpanan ('/anggota/simpanan') --}}
            <a href="{{ url('/anggota/simpanan') }}" 
               class="flex items-center gap-3 px-6 py-3 transition-colors 
                      @if(Request::is('anggota/simpanan'))
                          active-link-anggota
                      @else
                          hover:bg-green-900
                      @endif">
                <i class="bi bi-wallet2 text-lg"></i>
                <span class="font-medium text-sm">Simpanan</span>
            </a>
            
            {{-- Transaksi ('/anggota/transaksi') --}}
            <a href="{{ url('/anggota/transaksi') }}" 
               class="flex items-center gap-3 px-6 py-3 hover:bg-green-900 transition-colors
                       @if(Request::is('anggota/transaksi'))
                          active-link-anggota
                       @else
                          hover:bg-green-900
                       @endif">
                <i class="bi bi-arrow-down-up text-lg"></i>
                <span class="font-medium text-sm">Transaksi</span>
            </a>
            
            {{-- Profil ('/anggota/profile') --}}
            <a href="{{ url('/anggota/profile') }}" 
               class="flex items-center gap-3 px-6 py-3 hover:bg-green-900 transition-colors
                       @if(Request::is('anggota/profile'))
                          active-link-anggota
                       @else
                          hover:bg-green-900
                       @endif">
                <i class="bi bi-person-fill text-lg"></i>
                <span class="font-medium text-sm">Profil</span>
            </a>
            
            {{-- Keluar --}}
            <a href="{{ url('/logout') }}" class="flex items-center gap-3 px-6 py-3 mt-4 text-green-200 hover:text-white hover:bg-green-900 transition-colors">
                <i class="bi bi-box-arrow-right text-lg"></i>
                <span class="font-medium text-sm">Keluar</span>
            </a>
        </nav>
    </aside>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>

    <div id="main-content-wrapper" class="relative transition-all duration-300">
        
        <header id="main-header" class="fixed top-0 left-0 right-0 bg-green-800 text-white h-14 flex items-center justify-between px-4 md:px-6 z-20 shadow-md transition-all duration-300">
            <button id="hamburger-btn" class="text-xl">
                <i class="bi bi-list"></i>
            </button>
            
            <button class="text-xl">
                <i class="bi bi-bell-fill"></i>
            </button>
        </header>

        <main class="pt-14">
            {{-- CONTENT INJEKSI --}}
            @yield('content')
        </main>
        
        <footer class="bg-white p-3 text-center text-xs text-gray-500 border-t mt-4 md:mt-0 md:ml-64 transition-all duration-300">
            &copy; 2025 Koperasi Digital. Hak Cipta Dilindungi.
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            var $sidebar = $('#sidebar');
            var $overlay = $('#sidebar-overlay');
            var $hamburgerBtn = $('#hamburger-btn');
            var $mainWrapper = $('#main-content-wrapper');
            var $mainHeader = $('#main-header');
            const MD_BREAKPOINT = 768;

            function isDesktop() {
                return $(window).width() >= MD_BREAKPOINT;
            }

            function openSidebar() {
                $sidebar.removeClass('-translate-x-full');
                if (isDesktop()) {
                    // Hanya tambahkan padding saat di desktop
                    $mainWrapper.addClass('md:pl-64');
                    $mainHeader.css('left', '16rem');
                    $mainHeader.css('width', 'calc(100% - 16rem)');
                    $overlay.addClass('hidden');
                } else {
                    $overlay.removeClass('hidden');
                }
            }

            function closeSidebar() {
                $sidebar.addClass('-translate-x-full');
                $mainWrapper.removeClass('md:pl-64');
                $mainHeader.css('left', '0');
                $mainHeader.css('width', '100%');
                $overlay.addClass('hidden');
            }

            $hamburgerBtn.on('click', function() {
                if ($sidebar.hasClass('-translate-x-full')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });

            $overlay.on('click', function() {
                if (!isDesktop()) { 
                    closeSidebar();
                }
            });

            $(window).on('resize', function() {
                if (isDesktop()) {
                    $overlay.addClass('hidden'); 
                    if (!$sidebar.hasClass('-translate-x-full')) {
                        openSidebar(); // Memastikan posisi konten benar saat resize ke desktop
                    } else {
                        closeSidebar();
                    }
                } else {
                    $mainWrapper.removeClass('md:pl-64');
                    $mainHeader.css('left', '0');
                    $mainHeader.css('width', '100%');
                    if (!$sidebar.hasClass('-translate-x-full')) {
                        $overlay.removeClass('hidden');
                    }
                }
            }).trigger('resize');

            // Default state on load
            if (isDesktop()) {
                openSidebar();
            } else {
                closeSidebar();
            }

        });
    </script>
    
    {{-- SCRIPTS INJEKSI --}}
    @yield('scripts') 
</body>
</html>