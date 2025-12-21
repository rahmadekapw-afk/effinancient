<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - Koperasi Digital</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- switcg alert --}}
    <script>
        function hapus(id) {
            const swalWithTailwindButtons = Swal.mixin({
                customClass: {
                    confirmButton: "bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded mx-2",
                    cancelButton: "bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded mx-2"
                },
                buttonsStyling: false
            });

            swalWithTailwindButtons.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithTailwindButtons.fire({
                        title: "Dibatalkan",
                        text: "Data batal dihapus",
                        icon: "error"
                    });
                }
            });
        }


    </script>
    <style>
        /* Menggunakan warna hijau yang lebih cerah untuk fokus */
        .sidebar-bg {
            background-color: #059669;
            /* emerald-600 */
        }

        .active-link {
            background-color: #065f46;
            /* emerald-800 */
            border-right: 4px solid #d1fae5;
            /* emerald-100 */
        }

        /* Default Desktop: Sidebar terbuka */
        #main-content-admin,
        #main-header-admin {
            margin-left: 16rem;
            /* 256px */
            width: calc(100% - 16rem);
            transition: all 0.3s ease-in-out;
        }

        /* Kelas untuk Sidebar Tertutup (Desktop) */
        .sidebar-closed #sidebar-admin {
            transform: translateX(-16rem);
        }

        .sidebar-closed #main-content-admin,
        .sidebar-closed #main-header-admin {
            margin-left: 0;
            width: 100%;
            /* Konten utama melebar 100% */
        }

        /* Mobile View: Sidebar selalu hidden awalnya */
        @media (max-width: 767px) {
            #sidebar-admin {
                transform: translateX(-16rem);
                z-index: 50;
            }

            #main-content-admin,
            #main-header-admin {
                margin-left: 0;
                width: 100%;
            }

            /* Saat dibuka di mobile, sidebar geser masuk */
            .sidebar-open-mobile #sidebar-admin {
                transform: translateX(0);
            }
        }

        /* Scrollbar styling */
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
    {{-- notif swich alert --}}
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
    <aside id="sidebar-admin" class="sidebar-bg text-white w-64 h-screen fixed top-0 left-0 z-40">
        <div class="p-4 text-center border-b border-emerald-700">
            <h2 class="text-xl font-bold">Koperasi Digital</h2>
            <p class="text-sm font-medium text-emerald-200">Admin Panel</p>
        </div>

        <div class="p-4 flex items-center gap-3 border-b border-emerald-700">
            <div class="bg-emerald-700 p-2 rounded-full">
                <i class="bi bi-person-fill text-xl"></i>
            </div>
            <div>
                <p class="font-semibold text-base">{{ session('username') }}</p>
                <p class="text-xs text-emerald-200">Administrator</p>
            </div>
        </div>

        <nav class="mt-2 overflow-y-auto h-[calc(100vh-14rem)]">

            {{-- Dashboard ('/admin') --}}
            <a href="{{ url('dashboard/admin') }}" class="flex items-center gap-3 px-6 py-3 transition-colors 
                    @if(Request::is('dashboard/admin') || Request::is('dashboard/admin'))
                        active-link
                    @else
                        hover:bg-emerald-700
                    @endif">
                <i class="bi bi-grid-fill text-lg"></i>
                <span class="font-medium text-sm">Dashboard</span>
            </a>

            {{-- Manajemen Anggota ('/admin/manajemen_anggota') --}}
            <a href="{{ url('/admin/manajemen_anggota') }}" class="flex items-center gap-3 px-6 py-3 transition-colors 
                    @if(Request::is('admin/manajemen_anggota'))
                        active-link
                    @else
                        hover:bg-emerald-700
                    @endif">
                <i class="bi bi-people-fill text-lg"></i>
                <span class="font-medium text-sm">Manajemen Anggota</span>
            </a>

            {{-- Transaksi ('/admin/transaksi') --}}
            <a href="{{ url('/admin/transaksi') }}" class="flex items-center gap-3 px-6 py-3 transition-colors 
                    @if(Request::is('admin/transaksi'))
                        active-link
                    @else
                        hover:bg-emerald-700
                    @endif">
                <i class="bi bi-arrow-down-up text-lg"></i>
                <span class="font-medium text-sm">Transaksi</span>
            </a>

            {{-- Laporan Keuangan ('/admin/laporan_keuangan') --}}
            <a href="{{ url('/admin/laporan_keuangan') }}" class="flex items-center gap-3 px-6 py-3 transition-colors 
                    @if(Request::is('admin/laporan_keuangan'))
                        active-link
                    @else
                        hover:bg-emerald-700
                    @endif">
                <i class="bi bi-file-earmark-bar-graph-fill text-lg"></i>
                <span class="font-medium text-sm">Laporan Keuangan</span>
            </a>

            @if (session()->has('superadmin_id'))
                {{-- Audit Trail --}}
                <a href="{{ url('/admin/audit_trail') }}" class="flex items-center gap-3 px-6 py-3 transition-colors 
                    @if(Request::is('admin/audit_trail'))
                        active-link
                    @else
                        hover:bg-emerald-700
                    @endif">
                    <i class="bi bi-search text-lg"></i>
                    <span class="font-medium text-sm">Audit Trail</span>
                </a>

                {{-- Manajemen Akses --}}
                <a href="{{ url('/admin/manajemen_akses') }}" class="flex items-center gap-3 px-6 py-3 transition-colors 
                    @if(Request::is('admin/manajemen_akses'))
                        active-link
                    @else
                        hover:bg-emerald-700
                    @endif">
                    <i class="bi bi-person-lock text-lg"></i>
                    <span class="font-medium text-sm">Manajemen Akses</span>
                </a>
            @endif

        </nav>

        <a href="{{ url('admin/logout') }}"
            class="absolute bottom-0 w-full flex items-center gap-3 px-6 py-4 bg-emerald-700 hover:bg-emerald-800 transition-colors">
            <i class="bi bi-box-arrow-left text-lg"></i>
            <span class="font-medium text-sm">Keluar</span>
        </a>

    </aside>
    <div id="sidebar-overlay-admin" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

    <div id="main-content-admin">

        <header id="main-header-admin"
            class="fixed top-0 left-0 bg-white h-14 flex items-center justify-between px-4 md:px-6 z-30 shadow-sm">
            <button id="hamburger-btn-admin" class="text-xl text-gray-700">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="text-lg font-semibold text-gray-800 hidden sm:block">Dashboard</h1>

            <div class="flex items-center gap-3">
                <button id="notif-btn" class="relative text-gray-700" title="Notifikasi Pinjaman">
                    <i class="bi bi-bell-fill text-xl"></i>
                    <span id="notif-badge" class="hidden absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full px-1.5">0</span>
                </button>

                <div class="flex items-center gap-2 text-green-600 font-medium text-sm">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Sistem Aktif</span>
                </div>
            </div>
        </header>

        <main class="pt-16 p-4 md:p-6 mt-10">
            @yield('content')

        </main>

        <footer class="p-3 text-center text-xs text-gray-500 border-t mt-4">
            &copy; 2025 Koperasi Digital. Admin Panel.
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Kode JQuery Sidebar 
        $(document).ready(function () {
            var $body = $('body');
            var $overlay = $('#sidebar-overlay-admin');

            function toggleSidebar() {
                if ($(window).width() < 768) {
                    $body.toggleClass('sidebar-open-mobile');
                    $overlay.toggleClass('hidden');
                } else {
                    $body.toggleClass('sidebar-closed');
                }
            }

            if ($(window).width() >= 768) {
                $body.removeClass('sidebar-closed');
            } else {
                $body.removeClass('sidebar-open-mobile');
            }

            $('#hamburger-btn-admin').on('click', toggleSidebar);

            $overlay.on('click', function () {
                if ($(window).width() < 768) {
                    toggleSidebar();
                }
            });

            $(window).on('resize', function () {
                if ($(window).width() >= 768) {
                    $body.removeClass('sidebar-open-mobile');
                    $overlay.addClass('hidden');
                } else {
                    $body.removeClass('sidebar-closed');
                }
            }).trigger('resize');
        });

        // Polling untuk notifikasi pinjaman (lonceng)
        $(document).ready(function () {
            function updateNotifBadge() {
                $.getJSON('/admin/pinjaman/notifications')
                    .done(function (res) {
                        var count = res.count || 0;
                        var $badge = $('#notif-badge');
                        if (count > 0) {
                            $badge.text(count > 99 ? '99+' : count);
                            $badge.removeClass('hidden');
                            $badge.addClass('animate-pulse');
                        } else {
                            $badge.addClass('hidden');
                            $badge.removeClass('animate-pulse');
                        }
                    })
                    .fail(function () {
                        // ignore errors silently
                    });
            }

            // update immediately and every 8 seconds
            updateNotifBadge();
            setInterval(updateNotifBadge, 8000);

            // klik bell: buka halaman transaksi admin
            $('#notif-btn').on('click', function () {
                window.location.href = '/admin/transaksi';
            });
        });

    </script>

    @yield('scripts')

</body>

</html>