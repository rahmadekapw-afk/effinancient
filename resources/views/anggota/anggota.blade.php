@extends('material/temp')

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-4 md:gap-6">

        <section class="bg-green-800 text-white rounded-lg shadow-lg p-5">
            <h3 class="text-lg font-semibold">Selamat Datang, {{ session('username') }}</h3>
            <p class="text-sm text-green-100">Berikut ringkasan keuangan Anda di koperasi</p>



            <div class="mt-4 bg-green-900 rounded-lg p-3">
                <p class="text-xs text-green-200">Total Saldo</p>
                <p class="text-2xl font-bold">{{ number_format(session('saldo'), 0, ',', '.') }}</p>
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
            <div class="bg-orange-100 text-orange-600 p-1 rounded-lg">
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
                <a id="btnBayarPinjaman"
                    class="cursor-pointer text-center p-3 bg-blue-50 rounded-lg hover:shadow-md transition-shadow w-full">
                        <div class="inline-block p-2 bg-blue-600 text-white rounded-full">
                            <i class="bi bi-arrow-up-right text-base"></i>
                        </div>
                        <p class="mt-1 text-xs font-medium text-gray-700">Bayar Pinjaman</p>
                    </a>

                <a href="#" id="btnPinjaman"
                    class="text-center p-3 bg-orange-50 rounded-lg hover:shadow-md transition-shadow">
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

    
        <!-- Modal Bayar Pinjaman -->
        <div id="modalBayarPinjaman" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">

            <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-5 relative">

                <!-- Tombol Close -->
                <button id="closeModalBayar" class="absolute top-3 right-3 text-gray-600 hover:text-black text-xl">✕</button>

                <h2 class="text-lg font-semibold mb-4">Pembayaran Pinjaman</h2>

                <!-- List Pinjaman -->
                <div id="listPinjaman">
                    @forelse($pinjaman as $item)
                        <div class="border p-3 rounded-lg mb-3">
                            <p class="text-sm">
                                <b>Nominal:</b>  
                                Rp {{ number_format($item->nominal, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-gray-600">
                                Tanggal Pinjam: {{ $item->created_at->format('d M Y') }}
                            </p>

                            <a href="{{ url('dashboard/anggota/pinjaman/bayar/'.$item->id) }}"
                            class="mt-2 inline-block bg-green-600 hover:bg-green-700 text-white 
                                    text-xs px-3 py-1 rounded">
                                Bayar Sekarang
                            </a>
                        </div>

                    @empty
                        <p class="text-center text-gray-500 text-sm">Tidak ada pembayaran.</p>
                    @endforelse
                </div>

            </div>
        </div>

    </div>
    {{-- modal --}}

    <!-- Modal Ajukan Pinjaman (TANPA BOOTSTRAP) -->
    <div id="modalPinjaman" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">

        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-5 relative">
            <!-- Tombol Close -->
            <button id="closeModal" class="absolute top-3 right-3 text-gray-600 hover:text-black text-xl">
                ✕
            </button>

            <h2 class="text-lg font-semibold mb-3">Ajukan Pinjaman</h2>

            <form method="POST" action="{{ url('dashboard/anggota/pinjaman/store') }}" id="formPinjaman">
                @csrf
                <input type="hidden" name="anggota_id" value="{{ session('anggota_id') }}">

                <div class="mb-3">
                    <label class="text-sm font-medium">Nominal Pinjaman</label>
                    <input type="number" id="nominal" name="nominal" class="w-full border rounded p-2 mt-1" required>

                    <p id="errorNominal" class="text-red-500 text-xs mt-1 hidden"></p>

                    <p class="text-xs text-gray-700 mt-1">
                        Batas maksimal: <span id="batasNominal"></span>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="text-sm font-medium">Tanggal Pengajuan</label>
                    <input type="date" id="tgl_pinjam" name="tanggal_pengajuan" class="w-full border rounded p-2 mt-1"
                        required>
                </div>

                <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 rounded mt-3">
                    Ajukan
                </button>
            </form>

        </div>
    </div>

    {{-- modal pembayaran --}}
    

    <script>
        $(document).ready(function () {

            let gaji = 3000000;
            let faktor = 2;
            let pinjamanAktif = 1000000;

            let limitPinjaman = (gaji * faktor) - pinjamanAktif;

            $("#batasNominal").text("Rp " + Number(limitPinjaman).toLocaleString());

            // Buka modal
            $(document).on("click", "#btnPinjaman", function (e) {
                e.preventDefault();
                $("#modalPinjaman").removeClass("hidden").addClass("flex");
            });

            // Tutup modal
            $("#closeModal").on("click", function () {
                $("#modalPinjaman").removeClass("flex").addClass("hidden");
            });

            // Validasi nominal
            $("#nominal").on("keyup change", function () {
                let nominal = Number($(this).val());

                if (nominal > limitPinjaman) {
                    $("#errorNominal")
                        .removeClass("hidden")
                        .text("Nominal tidak boleh melebihi Rp " + limitPinjaman.toLocaleString());
                } else {
                    $("#errorNominal").addClass("hidden");
                }
            });

            // Submit form
            $("#formPinjaman").on("submit", function (e) {

                let nominal = Number($("#nominal").val());

                if (nominal > limitPinjaman) {
                    e.preventDefault();
                    $("#errorNominal")
                        .removeClass("hidden")
                        .text("Nominal tidak boleh melebihi Rp " + limitPinjaman.toLocaleString());
                    return false;
                }

                return true;  // sangat penting
            });

        });
    </script>
    {{-- jquery pembayaran --}}
    <script>
    $(document).ready(function () {

        // Buka modal bayar pinjaman
        $("#btnBayarPinjaman").on("click", function (e) {
            e.preventDefault();
            $("#modalBayarPinjaman").removeClass("hidden").addClass("flex");
        });

        // Tutup modal
        $("#closeModalBayar").on("click", function () {
            $("#modalBayarPinjaman").removeClass("flex").addClass("hidden");
        });

        // Klik luar modal = tutup
        $("#modalBayarPinjaman").on("click", function (e) {
            if (e.target === this) {
                $("#modalBayarPinjaman").removeClass("flex").addClass("hidden");
            }
        });

    });
    </script>



@endsection