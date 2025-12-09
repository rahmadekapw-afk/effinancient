@extends('material/temp_admin')

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-6">
        
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Manajemen Hak Akses</h2>
                <p class="text-sm text-gray-600">Kelola pengguna sistem dan hak akses</p>
            </div>
            <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition-colors shadow-md">
                <i class="bi bi-person-plus-fill"></i> Tambah User
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
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">U001</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm font-medium text-gray-900">Super Admin</p>
                                    <p class="text-xs text-gray-500">superadmin@koperasi.com</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">superadmin</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Super Admin</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-11-05<br>14:30</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-lg space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700"><i class="bi bi-pencil-square"></i></button>
                                    <button class="text-red-500 hover:text-red-700"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">U002</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm font-medium text-gray-900">Ahmad Kusuma</p>
                                    <p class="text-xs text-gray-500">ahmad@koperasi.com</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ahmad_admin</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Admin</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-11-05<br>13:15</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-lg space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700"><i class="bi bi-pencil-square"></i></button>
                                    <button class="text-red-500 hover:text-red-700"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">U003</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm font-medium text-gray-900">Siti Rahayu</p>
                                    <p class="text-xs text-gray-500">siti@koperasi.com</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">siti_finance</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800">Staff Keuangan</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-11-05<br>10:45</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-lg space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700"><i class="bi bi-pencil-square"></i></button>
                                    <button class="text-red-500 hover:text-red-700"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
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

    </div>
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
@endsection