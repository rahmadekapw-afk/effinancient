@extends('material/temp')

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-6">

        <h2 class="text-xl font-bold text-gray-800">Profil Saya</h2>
        <p class="text-sm text-gray-600 -mt-3">Kelola informasi profil dan keamanan akun Anda</p>

        <section class="bg-white rounded-lg shadow p-5">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-4 mb-4">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-100 rounded-full text-green-700">
                        <i class="bi bi-person-fill text-3xl"></i>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-gray-800">sss</p>
                        <p class="text-sm text-gray-500">ID Anggota: A001</p>
                        <div class="flex gap-2 mt-1">
                            <span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded-full">Aktif</span>
                            <span class="text-xs font-medium text-blue-800 bg-blue-100 px-2 py-0.5 rounded-full">Anggota Reguler</span>
                        </div>
                    </div>
                </div>
                <button class="mt-4 md:mt-0 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition-colors text-sm shadow-md">
                    <i class="bi bi-pencil-square"></i> Edit Profil
                </button>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center mt-4">
                <div>
                    <p class="text-xs text-gray-500">Total Simpanan</p>
                    <p class="text-lg font-bold text-gray-900">Rp 6.500.000</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Pinjaman Aktif</p>
                    <p class="text-lg font-bold text-gray-900">Rp 2.000.000</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Transaksi</p>
                    <p class="text-lg font-bold text-gray-900">45</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Poin Loyalitas</p>
                    <p class="text-lg font-bold text-gray-900">1250</p>
                </div>
            </div>
        </section>
        
        <section class="bg-white rounded-lg shadow p-5">
            
            <h3 class="text-base font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Pribadi</h3>
            
            <div class="flex items-center gap-3 py-3 border-b">
                <i class="bi bi-envelope text-lg text-gray-500 w-6"></i>
                <div>
                    <p class="text-sm font-medium text-gray-700">Email</p>
                    <p class="text-sm text-gray-900">ahmad.wijaya@email.com</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 py-3 border-b">
                <i class="bi bi-phone text-lg text-gray-500 w-6"></i>
                <div>
                    <p class="text-sm font-medium text-gray-700">Nomor Telepon</p>
                    <p class="text-sm text-gray-900">0812-3456-7890</p>
                </div>
            </div>

            <div class="flex items-start gap-3 py-3 border-b">
                <i class="bi bi-geo-alt text-lg text-gray-500 w-6 mt-1"></i>
                <div>
                    <p class="text-sm font-medium text-gray-700">Alamat</p>
                    <p class="text-sm text-gray-900">Jl. Merdeka No. 123, Jakarta Pusat</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 py-3">
                <i class="bi bi-calendar text-lg text-gray-500 w-6"></i>
                <div>
                    <p class="text-sm font-medium text-gray-700">Tanggal Bergabung</p>
                    <p class="text-sm text-gray-900">15 Jan 2023</p>
                </div>
            </div>
            
            <h3 class="text-base font-semibold text-gray-800 mt-6 mb-4 border-b pb-2">Keamanan Akun</h3>

            <div class="flex justify-between items-center py-3 border-b">
                <div class="flex items-center gap-3">
                    <i class="bi bi-lock text-lg text-gray-500 w-6"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Password</p>
                        <p class="text-xs text-gray-500">Terakhir diubah 3 bulan lalu</p>
                    </div>
                </div>
                <a href="#" class="text-sm font-medium text-green-600 hover:text-green-700">Ubah Password</a>
            </div>

            <div class="flex justify-between items-center py-3">
                <div class="flex items-center gap-3">
                    <i class="bi bi-shield-lock text-lg text-gray-500 w-6"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Autentikasi Dua Faktor</p>
                        <p class="text-xs text-gray-500">Tingkatkan keamanan akun Anda</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                </label>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-5">
            <h3 class="text-base font-semibold text-gray-800 mb-4">Dokumen</h3>

            <div class="flex justify-between items-center py-3 border-b">
                <div>
                    <p class="font-medium text-gray-900">KTP</p>
                    <p class="text-xs text-gray-500">Diupload: 15 Jan 2023</p>
                </div>
                <span class="text-xs font-medium text-green-800 bg-green-100 px-3 py-1 rounded-full">Verified</span>
            </div>
            
            <div class="flex justify-between items-center py-3 border-b">
                <div>
                    <p class="font-medium text-gray-900">Kartu Keluarga</p>
                    <p class="text-xs text-gray-500">Diupload: 15 Jan 2023</p>
                </div>
                <span class="text-xs font-medium text-green-800 bg-green-100 px-3 py-1 rounded-full">Verified</span>
            </div>

            <div class="flex justify-between items-center py-3 border-b">
                <div>
                    <p class="font-medium text-gray-900">NPWP</p>
                    <p class="text-xs text-gray-500">Diupload: 20 Okt 2024</p>
                </div>
                <span class="text-xs font-medium text-orange-800 bg-orange-100 px-3 py-1 rounded-full">Pending</span>
            </div>
            
            <a href="#" class="text-sm font-medium text-green-600 hover:text-green-700 mt-4 block">Upload Dokumen Baru</a>
        </section>

    </div>
@endsection