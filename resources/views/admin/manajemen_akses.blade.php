@extends('material/temp_admin')

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-6">
        
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Manajemen Hak Akses</h2>
                <p class="text-sm text-gray-600">Kelola pengguna sistem dan hak akses</p>
            </div>
            <button id="openAdminModal"
    class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition-colors shadow-md">
    <i class="bi bi-person-plus-fill"></i> Tambah Admin
</button>

        </div>

        <section class="grid grid-cols-3 gap-6">
            
            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center border-l-4 border-blue-500">
                <div>
                    <p class="text-sm text-gray-500">Total Pengguna</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">12</p>
                </div>
                <i class="bi bi-people-fill text-3xl text-blue-500 opacity-60"></i>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center border-l-4 border-green-500">
                <div>
                    <p class="text-sm text-gray-500">Pengguna Aktif</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">10</p>
                </div>
                <i class="bi bi-shield-fill-check text-3xl text-green-500 opacity-60"></i>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-center border-l-4 border-purple-500">
                <div>
                    <p class="text-sm text-gray-500">Total Role</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">5</p>
                </div>
                <i class="bi bi-person-lines-fill text-3xl text-purple-500 opacity-60"></i>
            </div>
        </section>

        <div class="bg-white rounded-lg shadow p-5">
            
            <div class="flex border-b border-gray-200 mb-6">
                <button id="tab-pengguna" class="tab-button flex items-center gap-2 px-4 py-2 border-b-2 border-green-600 text-green-600 font-semibold transition-colors">
                    <i class="bi bi-people-fill"></i> Pengguna Sistem
                </button>
                <button id="tab-role" class="tab-button flex items-center gap-2 px-4 py-2 border-b-2 border-transparent text-gray-500 hover:text-green-600 transition-colors">
                    <i class="bi bi-shield-lock-fill"></i> Role & Permission
                </button>
            </div>

            <div id="content-pengguna" class="tab-content">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($admins as $admin)
                                <tr>
                                    {{-- ID Admin --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                                        {{ $admin->admin_id }}
                                    </td>

                                    {{-- Nama + Username --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="text-sm font-medium text-gray-900">{{ $admin->nama_admin }}</p>
                                        <p class="text-xs text-gray-500">{{ $admin->username }}</p>
                                    </td>

                                    {{-- Username --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $admin->username }}
                                    </td>

                                    {{-- Role (jika mau tambah manual) --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                            Admin
                                        </span>
                                    </td>

                                    {{-- Tanggal dibuat --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $admin->created_at ? $admin->created_at->format('Y-m-d') : '-' }}
                                        <br>
                                        {{ $admin->created_at ? $admin->created_at->format('H:i') : '-' }}
                                    </td>

                                    {{-- Status default Aktif (jika belum ada field status) --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Aktif
                                        </span>
                                    </td>

                                    {{-- Tombol Aksi --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-lg space-x-2">
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="javascript:void(0);"
                                            onclick="hapus({{ $admin->admin_id }})"
                                            class="text-red-500 hover:text-red-700">
                                                <i class="bi bi-trash"></i>
                                        </a>
                                        <form id="form-hapus-{{ $admin->admin_id }}"
                                        action="{{ url('admin/manajemen_akses/hapus/' . $admin->admin_id) }}"
                                        method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                         </tbody>
                    </table>
                </div>
            </div>

            <div id="content-role" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <div class="bg-gray-50 rounded-lg shadow p-5 border-t-4 border-purple-500 relative">
                        <div class="flex justify-between items-start mb-3">
                            <div class="p-2 rounded-full bg-purple-200 text-purple-600">
                                <i class="bi bi-shield-fill text-xl"></i>
                            </div>
                            <div class="text-lg space-x-1">
                                <button class="text-blue-500 hover:text-blue-700"><i class="bi bi-pencil-square"></i></button>
                                <button class="text-red-500 hover:text-red-700"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">Super Admin</h4>
                        <p class="text-sm text-gray-600 mb-3">Akses penuh ke semua fitur sistem</p>
                        <p class="text-xs text-gray-500">Jumlah Pengguna:</p>
                        <p class="font-bold text-base mb-3">1</p>
                        <p class="text-sm font-semibold text-gray-700 mb-2">Hak Akses:</p>
                        <ul class="text-sm space-y-1">
                            <li class="flex items-center gap-2 text-green-600"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Semua Hak Akses</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 rounded-lg shadow p-5 border-t-4 border-indigo-500 relative">
                        <div class="flex justify-between items-start mb-3">
                            <div class="p-2 rounded-full bg-indigo-200 text-indigo-600">
                                <i class="bi bi-shield-fill text-xl"></i>
                            </div>
                            <div class="text-lg space-x-1">
                                <button class="text-blue-500 hover:text-blue-700"><i class="bi bi-pencil-square"></i></button>
                                <button class="text-red-500 hover:text-red-700"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">Admin</h4>
                        <p class="text-sm text-gray-600 mb-3">Akses ke manajemen anggota, transaksi, dan laporan</p>
                        <p class="text-xs text-gray-500">Jumlah Pengguna:</p>
                        <p class="font-bold text-base mb-3">3</p>
                        <p class="text-sm font-semibold text-gray-700 mb-2">Hak Akses:</p>
                        <ul class="text-sm space-y-1">
                            <li class="flex items-center gap-2 text-green-600"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Manajemen Anggota</li>
                            <li class="flex items-center gap-2 text-green-600"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Manajemen Transaksi</li>
                            <li class="flex items-center gap-2 text-green-600"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Laporan Keuangan</li>
                            <li class="flex items-center gap-2 text-green-600"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Audit Trail</li>
                        </ul>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg shadow p-5 border-t-4 border-pink-500 relative">
                        <div class="flex justify-between items-start mb-3">
                            <div class="p-2 rounded-full bg-pink-200 text-pink-600">
                                <i class="bi bi-shield-fill text-xl"></i>
                            </div>
                            <div class="text-lg space-x-1">
                                <button class="text-blue-500 hover:text-blue-700"><i class="bi bi-pencil-square"></i></button>
                                <button class="text-red-500 hover:text-red-700"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">Staff Keuangan</h4>
                        <p class="text-sm text-gray-600 mb-3">Akses khusus untuk pengelolaan keuangan</p>
                        <p class="text-xs text-gray-500">Jumlah Pengguna:</p>
                        <p class="font-bold text-base mb-3">2</p>
                        <p class="text-sm font-semibold text-gray-700 mb-2">Hak Akses:</p>
                        <ul class="text-sm space-y-1">
                            <li class="flex items-center gap-2 text-green-600"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Transaksi</li>
                            <li class="flex items-center gap-2 text-green-600"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Laporan Keuangan</li>
                            <li class="flex items-center gap-2 text-green-600"><span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> View Anggota</li>
                        </ul>
                    </div>

                    </div>
            </div>

        </div>

        {{-- moda/ --}}

    {{-- Modal Tambah Admin --}}
<<div id="adminModal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex justify-center items-center z-50">

    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl p-6 m-4 transform transition-all duration-300 scale-95 opacity-0"
        id="modalAdminContent">
        
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-bold text-gray-800">Tambah Admin Baru</h3>
            <button id="closeAdminModalButton" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ url('admin/manajemen_admin/tambah') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <h4 class="text-lg font-semibold text-green-700 mb-3 border-b pb-1">Data Login Admin</h4>

                    <div class="mb-4 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ID Admin</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 bg-gray-50 rounded-lg"
                            value="(Otomatis)" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="username" name="username" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="contoh: admin_joko">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Minimal 6 karakter">
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold text-green-700 mb-3 border-b pb-1">Identitas Admin</h4>

                    <div class="mb-4">
                        <label for="nama_admin" class="block text-sm font-medium text-gray-700 mb-1">Nama Admin</label>
                        <input type="text" id="nama_admin" name="nama_admin" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Nama lengkap admin">
                    </div>

                    {{-- Jika ingin menambahkan email admin nanti, tinggal aktifkan --}}
                    {{-- 
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Admin</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="email admin (opsional)">
                    </div>
                    --}}
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t mt-6">
                <button type="button" id="cancelAdminButton"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors shadow-md">
                    Simpan Admin
                </button>
            </div>
        </form>
    </div>
</div>
        


    </div>
    {{-- Modal Tambah Admin --}}


@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.tab-button');
            const contents = document.querySelectorAll('.tab-content');

            // Fungsi untuk mengganti tab
            function switchTab(targetId) {
                tabs.forEach(tab => {
                    tab.classList.remove('border-green-600', 'text-green-600', 'font-semibold');
                    tab.classList.add('border-transparent', 'text-gray-500');
                });

                contents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Aktifkan tab yang diklik
                const activeTab = document.getElementById('tab-' + targetId);
                const activeContent = document.getElementById('content-' + targetId);

                if (activeTab && activeContent) {
                    activeTab.classList.add('border-green-600', 'text-green-600', 'font-semibold');
                    activeTab.classList.remove('border-transparent', 'text-gray-500');
                    activeContent.classList.remove('hidden');
                }
            }

            // Tambahkan event listener ke setiap tombol tab
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetId = this.id.replace('tab-', '');
                    switchTab(targetId);
                });
            });
            
            // Set tab default saat halaman dimuat (Pengguna Sistem)
            switchTab('pengguna');
        });
    </script>
    <script>
    const adminModal = document.getElementById('adminModal');
    const modalAdminContent = document.getElementById('modalAdminContent');

    document.getElementById('openAdminModal').addEventListener('click', () => {
        adminModal.classList.remove('hidden');
        setTimeout(() => {
            modalAdminContent.classList.remove('scale-95', 'opacity-0');
        }, 10);
    });

    document.getElementById('closeAdminModalButton').addEventListener('click', closeAdminModal);
    document.getElementById('cancelAdminButton').addEventListener('click', closeAdminModal);

    function closeAdminModal() {
        modalAdminContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            adminModal.classList.add('hidden');
        }, 200);
    }
</script>
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


@endsection