@extends('material/temp_admin')

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-6">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Manajemen Anggota</h2>
                <p class="text-sm text-gray-600">Kelola data anggota koperasi</p>
            </div>
         <button id="openModalButton"
            class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition-colors shadow-md">
            <i class="bi bi-plus-circle-fill text-lg"></i> Tambah Anggota
        </button>
        </div>

        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex flex-col md:flex-row gap-4 mb-5 items-center">

                <div class="relative w-full">
                    <input type="text" id="search-input" placeholder="Cari nama, ID, atau email anggota..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>

               <div>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>

            <div class="flex justify-end mb-4">
                <a href="#" class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center gap-1">
                    <i class="bi bi-box-arrow-down"></i> Export Excel
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                <div class="bg-white border border-green-300 p-4 rounded-lg flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-xs text-gray-500">Total Anggota</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $total_anggota }}</p>
                    </div>
                    <div class="text-green-600 text-3xl p-2 bg-green-50 rounded-full">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                </div>

                <div class="bg-white border-l-4 border-blue-500 p-4 rounded-lg flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-xs text-gray-500">Anggota Aktif</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $anggota_aktif }}</p>
                    </div>
                    <div class="text-blue-500 text-3xl p-2 bg-blue-50 rounded-full">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                </div>

                <div
                    class="bg-white border-l-4 border-orange-500 p-4 rounded-lg flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-xs text-gray-500">Anggota Pasif</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $anggota_nonaktif }}</p>
                    </div>
                    <div class="text-orange-500 text-3xl p-2 bg-orange-50 rounded-full">
                        <i class="bi bi-person-x-fill"></i>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="anggota-table" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                KONTAK</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TOTAL
                                SIMPANAN</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                STATUS</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $value)
                            <tr id="row-display-{{ $value['anggota_id'] }}">
                                <td class="px-3 py-4 text-sm font-medium text-green-600">{{ $value['nomor_anggota'] }}</td>
                                <td class="px-3 py-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $value['nama_lengkap'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $value['email'] }}</p>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-900">{{ $value['no_hp'] }}</td>
                                <td class="px-3 py-4 text-sm text-gray-900">
                                    <p>{{ $value['saldo'] }}</p>
                                    <p class="text-xs text-gray-500">Pinjaman: - </p>
                                </td>

                                <td class="px-3 py-4">
                                    <span
                                        class="px-2 inline-flex text-xs font-semibold rounded-full 
                                                {{ $value['status_anggota'] == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $value['status_anggota'] }}
                                    </span>
                                </td>

                                <td class="px-3 py-4 text-sm font-medium">
                                    <div class="flex items-center gap-2 text-lg">
                                        {{-- Ubah tombol edit --}}

                                        {{-- Tombol View --}}
                                        <button onclick="openDetail({{ $value['anggota_id'] }})"
                                            class="text-blue-500 hover:text-blue-700" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                        {{-- Tombol Edit --}}
                                        <button onclick="toggleEdit({{ $value['anggota_id'] }})"
                                            class="text-green-500 hover:text-green-700" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <a href="#" onclick="hapus({{ $value['anggota_id'] }})"
                                            class="text-red-500 hover:text-red-700" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                        <form id="form-hapus-{{ $value['anggota_id'] }}"
                                            action="{{ url('admin/manajemen_anggota/hapus/' . $value['anggota_id']) }}"
                                            method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>


                            {{-- FORM EDIT MODE --}}
                            <tr id="row-edit-{{ $value['anggota_id'] }}" class="hidden bg-gray-50">
                                <form action="{{ url('admin/manajemen_anggota/update/' . $value['anggota_id']) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <td class="px-3 py-4">
                                        <input type="text" name="nomor_anggota" value="{{ $value['nomor_anggota'] }}"
                                            class="w-full border rounded px-2 py-1 text-sm">
                                    </td>

                                    <td class="px-3 py-4">
                                        <input type="text" name="nama_lengkap" value="{{ $value['nama_lengkap'] }}"
                                            class="w-full border rounded px-2 py-1 text-sm mb-1">
                                        <input type="email" name="email" value="{{ $value['email'] }}"
                                            class="w-full border rounded px-2 py-1 text-xs">
                                    </td>

                                    <td class="px-3 py-4">
                                        <input type="text" name="no_hp" value="{{ $value['no_hp'] }}"
                                            class="w-full border rounded px-2 py-1 text-sm">
                                    </td>

                                    <td class="px-3 py-4">
                                        <input hidden type="number" name="saldo" value="{{ $value['saldo'] }}"
                                            class="w-full border rounded px-2 py-1 text-sm">
                                        <input readonly disabled type="number" name="saldo" value="{{ $value['saldo'] }}"
                                            class="w-full border rounded px-2 py-1 text-sm">
                                    </td>

                                    <td class="px-3 py-4">
                                        <select name="status_anggota" class="border rounded px-2 py-1 text-sm w-full">
                                            <option value="aktif" {{ $value['status_anggota'] == 'aktif' ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="nonaktif" {{ $value['status_anggota'] == 'nonaktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </td>

                                    <td class="px-3 py-4">
                                        <div class="flex items-center gap-2">
                                            <button type="submit"
                                                class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                                Simpan
                                            </button>

                                            <button type="button" onclick="toggleEdit({{ $value['anggota_id'] }})"
                                                class="bg-gray-400 text-white px-3 py-1 rounded text-sm hover:bg-gray-500">
                                                Batal
                                            </button>
                                        </div>
                                    </td>
                                </form>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

            <div id="datatables-info" class="mt-4 flex justify-between items-center text-sm text-gray-600">
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/2.0.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // Inisialisasi Datatables
            var table = $('#anggota-table').DataTable({
                "dom": 'rtip', // Hanya tampilkan Tabel, Processing, Info, dan Pagination
                "pagingType": "simple_numbers",
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/2.0.2/i18n/id.json" // Bahasa Indonesia
                },
                "columnDefs": [
                    { "orderable": false, "targets": [2, 6] }, // Kolom Kontak dan Aksi tidak bisa diurutkan
                    { "searchable": false, "targets": [4, 6] } // Kolom Simpanan dan Aksi tidak bisa dicari
                ],
                "order": [[0, "asc"]] // Default urutkan berdasarkan ID
            });

            // 1. Kustomisasi Pencarian Global
            $('#search-input').on('keyup', function () {
                table.search(this.value).draw();
            });

            // 2. Kustomisasi Filter Status (Kolom ke-5 adalah Status)
            $('#status-filter').on('change', function () {
                table.column(5).search(this.value).draw();
            });

            // Pindahkan elemen Datatables ke wrapper yang lebih cocok
            $('#anggota-table_info').appendTo('#datatables-info');
            $('#anggota-table_paginate').appendTo('#datatables-info');
        });
    </script>
    <script>
        function toggleEdit(id) {
            const rowDisplay = document.getElementById('row-display-' + id);
            const rowEdit = document.getElementById('row-edit-' + id);

            rowDisplay.classList.toggle('hidden');
            rowEdit.classList.toggle('hidden');
        }
    </script>

    {{-- Modal Tambah Anggota --}}
   <div id="anggotaModal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl p-6 m-4 transform transition-all duration-300 scale-95 opacity-0"
        id="modalContent">
        
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-bold text-gray-800">Tambah Anggota Baru</h3>
            <button id="closeModalButton" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ url('admin/manajemen_anggota/tambah') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <h4 class="text-lg font-semibold text-green-700 mb-3 border-b pb-1">Data Akun & Identitas</h4>
                    
                    <div class="mb-4 hidden">
                        <label for="anggota_id" class="block text-sm font-medium text-gray-700 mb-1">ID Anggota</label>
                        <input type="text" id="anggota_id" name="anggota_id" 
                            class="w-full px-3 py-2 border border-gray-300 bg-gray-50 rounded-lg" value="(Otomatis)">
                    </div>

                    <div class="mb-4">
                        <label for="nomor_anggota" class="block text-sm font-medium text-gray-700 mb-1">Nomor Anggota</label>
                        <input type="text" id="nomor_anggota" name="nomor_anggota" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Contoh: 2025001">
                    </div>

                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username (Login)</label>
                        <input type="text" id="username" name="username" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Contoh: joko_s">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Minimal 6 karakter">
                    </div>

                    <div class="mb-4">
                        <label for="status_anggota" class="block text-sm font-medium text-gray-700 mb-1">Status Anggota</label>
                        <select id="status_anggota" name="status_anggota" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold text-green-700 mb-3 border-b pb-1">Data Kontak & Lainnya</h4>
                    
                    <div class="mb-4">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Nama sesuai KTP">
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="alamat@email.com">
                    </div>

                    <div class="mb-4">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                        <input type="tel" id="no_hp" name="no_hp"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Contoh: 0812xxxxxx">
                    </div>

                    <div class="mb-4">
                        <label for="saldo" class="block text-sm font-medium text-gray-700 mb-1">Saldo Awal</label>
                        <input type="number" id="saldo" name="saldo" min="0" step="1000" value="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Masukkan saldo awal (opsional)">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-green-500 focus:border-green-500"
                    placeholder="Jalan, RT/RW, Kelurahan, Kecamatan..."></textarea>
            </div>
            
            <div class="flex justify-end space-x-3 pt-4 border-t mt-6">
                <button type="button" id="cancelButton"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors shadow-md">
                    Simpan Anggota
                </button>
            </div>
        </form>
        </div>
</div>
2. Script JavaScript
Tambahkan kode JavaScript ini di bagian bawah halaman Anda (sebelum tag penutup </body>) untuk menangani fungsi buka/tutup modal.

JavaScript

<script>
    const modal = document.getElementById('anggotaModal');
    const modalContent = document.getElementById('modalContent');
    const openButton = document.getElementById('openModalButton');
    const closeButton = document.getElementById('closeModalButton');
    const cancelButton = document.getElementById('cancelButton'); // Tombol Batal

    // Fungsi untuk membuka modal
    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        // Tambahkan transisi masuk
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10); // Jeda kecil untuk memastikan 'display: flex' diterapkan
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        // Mulai transisi keluar
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        // Sembunyikan modal setelah transisi selesai (300ms)
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300); 
    }

    // Event Listeners
    openButton.addEventListener('click', openModal);
    closeButton.addEventListener('click', closeModal);
    cancelButton.addEventListener('click', closeModal);

    // Menutup modal ketika mengklik di luar konten modal
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Menutup modal ketika menekan tombol ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('flex')) {
            closeModal();
        }
    });

</script>

@endsection