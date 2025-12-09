@extends('material/temp')

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-4 md:gap-6">

        <section class="bg-green-800 text-white rounded-lg shadow-lg p-5">
            <h3 class="text-lg font-semibold">Selamat Datang, sfds!</h3>
            <p class="text-sm text-green-100">Berikut ringkasan keuangan Anda di koperasi</p>
            
            <div class="mt-4 bg-green-900 rounded-lg p-3">
                <p class="text-xs text-green-200">Total Saldo</p>
                <p class="text-2xl font-bold">Rp 5.500.000</p>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-start">
                <div>
                    <div class="flex items-center gap-2">
                        <div class="bg-green-100 text-green-800 p-1 rounded-lg">
                            <i class="bi bi-wallet-fill text-base"></i>
                        </div>
                        <h4 class="text-base font-semibold text-gray-800">Simpanan Wajib</h4>
                    </div>
                    <p class="text-xl font-bold text-gray-900 mt-3">Rp 2.400.000</p>
                </div>
                <span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded-full">Aktif</span>
            </div>

            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-start">
                <div>
                    <div class="flex items-center gap-2">
                        <div class="bg-blue-100 text-blue-600 p-1 rounded-lg">
                            <i class="bi bi-graph-up-arrow text-base"></i>
                        </div>
                        <h4 class="text-base font-semibold text-gray-800">Simpanan Sukarela</h4>
                    </div>
                    <p class="text-xl font-bold text-gray-900 mt-3">Rp 3.100.000</p>
                </div>
                <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">Aktif</span>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-5">
            <div class="flex items-center gap-2">
                <div class="bg-orange-100 text-orange-600 p-1 rounded-lg">
                    <i class="bi bi-journal-text text-base"></i>
                </div>
                <div>
                    <h4 class="text-base font-semibold text-gray-800">Pinjaman Aktif</h4>
                    <p class="text-xs text-gray-500">Status: <span class="text-yellow-600 font-medium">Berjalan</span></p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <p class="text-xs text-gray-500">Total Pinjaman</p>
                    <p class="text-lg font-bold text-gray-900">Rp 2.000.000</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Sisa Pinjaman</p>
                    <p class="text-lg font-bold text-orange-600">Rp 1.500.000</p>
                </div>
            </div>

            <div class="mt-3">
                <div class="flex justify-between items-center mb-1">
                    <p class="text-xs font-medium text-gray-700">Progress Pembayaran</p>
                    <p class="text-xs font-bold text-green-800">25%</p>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-800 h-2 rounded-full" style="width: 25%"></div>
                </div>
            </div>
        </section>

        <section class="bg-white rounded-lg shadow p-5">
            <h4 class="text-base font-semibold text-gray-800 mb-3">Aksi Cepat</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#" class="text-center p-3 bg-green-50 rounded-lg hover:shadow-md transition-shadow">
                    <div class="inline-block p-2 bg-green-800 text-white rounded-full">
                        <i class="bi bi-arrow-down-left text-base"></i>
                    </div>
                    <p class="mt-1 text-xs font-medium text-gray-700">Setor Simpanan</p>
                </a>
                <a href="#" class="text-center p-3 bg-blue-50 rounded-lg hover:shadow-md transition-shadow">
                    <div class="inline-block p-2 bg-blue-600 text-white rounded-full">
                        <i class="bi bi-arrow-up-right text-base"></i>
                    </div>
                    <p class="mt-1 text-xs font-medium text-gray-700">Tarik Simpanan</p>
                </a>
                <a href="#" class="text-center p-3 bg-orange-50 rounded-lg hover:shadow-md transition-shadow">
                    <div class="inline-block p-2 bg-orange-600 text-white rounded-full">
                        <i class="bi bi-cash-stack text-base"></i>
                    </div>
                    <p class="mt-1 text-xs font-medium text-gray-700">Ajukan Pinjaman</p>
                </a>
                <a href="#" class="text-center p-3 bg-purple-50 rounded-lg hover:shadow-md transition-shadow">
                    <div class="inline-block p-2 bg-purple-600 text-white rounded-full">
                        <i class="bi bi-file-earmark-text-fill text-base"></i>
                    </div>
                    <p class="mt-1 text-xs font-medium text-gray-700">Lihat Laporan</p>
                </a>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            
            <div class="bg-white rounded-lg shadow p-5 lg:col-span-2">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="text-base font-semibold text-gray-800">Transaksi Terakhir</h4>
                    <a href="#" class="text-xs font-medium text-green-800 hover:underline">Lihat Semua</a>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="bg-green-100 text-green-800 p-2 rounded-full">
                                <i class="bi bi-arrow-down-left text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-sm text-gray-900">Setor Simpanan</p>
                                <p class="text-xs text-gray-500">05 Nov 2024</p>
                            </div>
                        </div>
                        <p class="font-medium text-sm text-green-800">+Rp 100.000</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="bg-red-100 text-red-600 p-2 rounded-full">
                                <i class="bi bi-arrow-up-right text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-sm text-gray-900">Angsuran Pinjaman</p>
                                <p class="text-xs text-gray-500">01 Nov 2024</p>
                            </div>
                        </div>
                        <p class="font-medium text-sm text-red-600">-Rp 50.000</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center gap-2 mb-3">
                    <i class="bi bi-bell text-gray-600 text-base"></i>
                    <h4 class="text-base font-semibold text-gray-800">Notifikasi</h4>
                </div>
                
                <div class="space-y-3">
                    <div class="bg-orange-50 border-l-4 border-orange-500 p-2 rounded-r-lg">
                        <p class="text-xs text-gray-700">Jatuh tempo angsuran pinjaman 10 Nov 2024</p>
                    </div>
                    <div class="bg-green-50 border-l-4 border-green-500 p-2 rounded-r-lg">
                        <p class="text-xs text-gray-700">Simpanan wajib bulan ini sudah lunas</p>
                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection