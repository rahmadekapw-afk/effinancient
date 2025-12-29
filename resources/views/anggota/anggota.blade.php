@extends('material/temp')

@section('content')
    <div class="p-4 md:p-6 grid grid-cols-1 gap-4 md:gap-6">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <section id="welcome-section" class="relative overflow-hidden bg-[#0A192F] text-white rounded-2xl shadow-2xl p-8 opacity-0">
    <canvas id="fireworksCanvas" class="absolute inset-0 pointer-events-none z-0"></canvas>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h3 id="welcome-text" class="text-2xl font-bold tracking-tight mb-1">
                Selamat Datang, <span class="text-[#E2B13C]">{{ session('username') }}</span>
            </h3>
            <p id="sub-text" class="text-blue-200/70 font-medium">Berikut ringkasan keuangan Anda di koperasi</p>
        </div>
        
        <div id="saldo-box" class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 min-w-[300px] shadow-[0_0_30px_rgba(226,177,60,0.1)] group">
            <p class="text-[10px] uppercase tracking-[0.3em] font-black text-[#E2B13C] mb-2">Total Saldo </p>
            <div class="flex items-baseline gap-2">
                <span class="text-xl font-light text-white/50">Rp</span>
                <p class="text-4xl font-black tracking-tighter text-white">
                    <span id="saldo-counter" data-target="{{ $total_saldo }}">0</span>
                </p>
            </div>
            <div class="w-full h-1 bg-white/10 rounded-full mt-4 overflow-hidden">
                <div id="saldo-progress" class="h-full bg-[#E2B13C] w-0"></div>
            </div>
        </div>
    </div>
</section>
        <section class="bg-white rounded-lg shadow p-5">
            <h4 class="text-base font-semibold text-gray-800 mb-3">Aksi Cepat</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#" id="openModal"
                    class="text-center p-3 bg-green-50 rounded-lg hover:shadow-md transition-shadow block">
                    <div class="inline-block p-2 bg-green-800 text-white rounded-full">
                        <i class="bi bi-arrow-down-left text-base"></i>
                    </div>
                    <p class="mt-1 text-xs font-medium text-gray-700">Ajukan Simpanan</p>
                </a>


                @if(isset($pinjaman) && count($pinjaman) > 0)
                    <a id="btnBayarPinjaman" href="#"
                        class="cursor-pointer text-center p-3 bg-blue-50 rounded-lg hover:shadow-md transition-shadow w-full">
                        <div class="inline-block p-2 bg-blue-600 text-white rounded-full">
                            <i class="bi bi-arrow-up-right text-base"></i>
                        </div>
                        <p class="mt-1 text-xs font-medium text-gray-700">Bayar Pinjaman</p>
                    </a>
                @else
                    <div class="text-center p-3 bg-gray-100 rounded-lg w-full">
                        <div class="inline-block p-2 bg-gray-300 text-white rounded-full">
                            <i class="bi bi-check2-all text-base"></i>
                        </div>
                        <p class="mt-1 text-xs font-medium text-gray-500">Tidak ada tagihan</p>
                    </div>
                @endif


                <a href="#" id="btnPinjaman"
                    class="text-center p-3 bg-orange-50 rounded-lg hover:shadow-md transition-shadow">
                    <div class="inline-block p-2 bg-orange-600 text-white rounded-full">
                        <i class="bi bi-cash-stack text-base"></i>
                    </div>
                    <p class="mt-1 text-xs font-medium text-gray-700">Ajukan Pinjaman</p>
                </a>


                <a href="{{ url('anggota/transaksi') }}" class="text-center p-3 bg-purple-50 rounded-lg hover:shadow-md transition-shadow">
                    <div class="inline-block p-2 bg-purple-600 text-white rounded-full">
                        <i class="bi bi-file-earmark-text-fill text-base"></i>
                    </div>
                    <p class="mt-1 text-xs font-medium text-gray-700">Lihat Laporan</p>
                </a>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Simpanan Wajib -->
            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-start">
                <div>
                    <div class="flex items-center gap-2">
                        <div class="bg-green-100 text-green-800 p-1 rounded-lg">
                            <i class="bi bi-wallet-fill text-base"></i>
                        </div>
                        <h4 class="text-base font-semibold text-gray-800">Simpanan Sehat</h4>
                    </div>
                    <p class="text-xl font-bold text-gray-900 mt-3">Rp {{ number_format($saldo, 0, ',', '.') }}
                    </p>
                </div>
                <span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded-full">
                    Aktif
                </span>
            </div>

            <!-- Simpanan Hari Raya -->
            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-start">
                <div>
                    <div class="flex items-center gap-2">
                        <div class="bg-blue-100 text-blue-600 p-1 rounded-lg">
                            <i class="bi bi-graph-up-arrow text-base"></i>
                        </div>
                        <h4 class="text-base font-semibold text-gray-800">Simpanan Hari Raya</h4>
                    </div>
                    <p class="text-xl font-bold text-gray-900 mt-3">Rp {{ number_format($hari_raya, 0, ',', '.') }}</p>
                </div>
                <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">
                    Aktif
                </span>
            </div>

            <!-- Simpanan Pendidikan -->
            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-start">
                <div>
                    <div class="flex items-center gap-2">
                        <div class="bg-purple-100 text-purple-700 p-1 rounded-lg">
                            <i class="bi bi-mortarboard-fill text-base"></i>
                        </div>
                        <h4 class="text-base font-semibold text-gray-800">Simpanan wajib</h4>
                    </div>
                    <p class="text-xl font-bold text-gray-900 mt-3">Rp {{ number_format($wajib, 0, ',', '.') }}</p>
                </div>
                <span class="text-xs font-medium text-purple-700 bg-purple-100 px-2 py-0.5 rounded-full">
                    Aktif
                </span>
            </div>

            <!-- Simpanan Pokok -->
            <div class="bg-white rounded-lg shadow p-5 flex justify-between items-start">
                <div>
                    <div class="flex items-center gap-2">
                        <div class="bg-orange-100 text-orange-700 p-1 rounded-lg">
                            <i class="bi bi-piggy-bank-fill text-base"></i>
                        </div>
                        <h4 class="text-base font-semibold text-gray-800">Simpanan Pokok</h4>
                    </div>
                    <p class="text-xl font-bold text-gray-900 mt-3">Rp {{ number_format($pokok, 0, ',', '.') }}</p>
                </div>
                <span class="text-xs font-medium text-orange-700 bg-orange-100 px-2 py-0.5 rounded-full">
                    Aktif
                </span>
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
                    <p class="text-lg font-bold text-gray-900">Rp {{ number_format($total_nominal) }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Sisa Pinjaman</p>
                    <p class="text-lg font-bold text-orange-600">Rp {{ number_format($sisa_pinjaman) }}</p>
                </div>
            </div>
            <div class="bg-orange-100 text-orange-600 p-1 rounded-lg">
                <div class="mt-3">
                    <div class="flex justify-between items-center mb-1">
                        <p class="text-xs font-medium text-gray-700">Progress Pembayaran</p>
                        <p class="text-xs font-bold text-green-800">{{ $progres_pinjaman }} % </p>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-800 h-2 rounded-full" style="width: {{ $progres_pinjaman }}% "></div>
                    </div>
                </div>
        </section>



        <!-- Modal Bayar Pinjaman -->
        <div id="modalBayarPinjaman" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">

            <div class="bg-white w-full max-w-md rounded-lg shadow-lg relative flex flex-col">

                <!-- HEADER (STICKY) -->
                <div class="sticky top-0 bg-white z-10 border-b px-5 py-3 flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Pembayaran Pinjaman</h2>
                    <button id="closeModalBayar" class="text-gray-600 hover:text-black text-xl font-bold">
                        ✕
                    </button>
                </div>

                <!-- BODY (SCROLLABLE) -->
                <div class="p-5 overflow-y-auto max-h-[70vh]">

                    <!-- List Pinjaman -->
                    <div id="listPinjaman">
                        @php
                            $unpaid = collect($pinjaman)->filter(function ($p) {
                                $paidAmount = (float) ($p->pembayaran ?? 0);
                                $total = (float) ($p->nominal ?? 0);
                                return ($p->status_pinjaman ?? '') !== 'lunas' && $paidAmount < $total;
                            });
                        @endphp

                        @forelse($unpaid as $item)
                            <div id="pinjaman-{{ $item->pinjaman_id }}" class="border p-3 rounded-lg mb-3">
                                <p class="text-sm">
                                    <b>Nominal:</b>
                                    Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-600">
                                    Tanggal Pinjam: {{ $item->created_at->format('d M Y') }}
                                </p>


                                <div class="mt-2">
                                    <button onclick="bayarPinjaman(this)" data-pinjaman="{{ $item->pinjaman_id }}"
                                        data-angsuran="{{ $item->angsuran_per_bulan }}" data-jangka="{{ $item->jangka_waktu }}"
                                        data-dibayar="{{ $item->jumlah_dibayar }}"
                                        class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1 rounded">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 text-sm">
                                Tidak ada pembayaran.
                            </p>
                        @endforelse
                    </div>

                    <!-- DETAIL ANGSURAN -->
                    <div id="detailAngsuran" class="hidden mt-5">
                        <h3 class="text-sm font-semibold mb-2">Sisa Angsuran</h3>
                        <div id="listAngsuran" class="space-y-2"></div>
                    </div>

                </div>
            </div>
        </div>


    </div>
    {{-- modal --}}

    <!-- Modal Ajukan Pinjaman  -->
    <!-- MODAL PINJAMAN -->
    <div id="modalPinjaman" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">

        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-5 relative">

            <button id="closeModal" class="absolute top-3 right-3 text-gray-600 hover:text-black text-xl">
                ✕
            </button>

            <h2 class="text-lg font-semibold mb-4">Ajukan Pinjaman</h2>

            <form method="POST" action="{{ url('dashboard/anggota/pinjaman/store') }}" id="formPinjaman">
                @csrf

                <input type="hidden" name="anggota_id" value="{{ session('anggota_id') }}">
                <input type="hidden" name="angsuran_bulanan" id="angsuranHidden">

                <!-- Nominal -->
             <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Nominal Pinjaman
                    </label>

                    <div class="relative">
                        <input type="number" id="nominal" name="nominal"
                            class="w-full border rounded-xl p-2.5 mt-1 pr-4
                                focus:ring-2 focus:ring-green-500 focus:border-green-500
                                transition duration-150"
                            placeholder="Maksimal {{ number_format($batasan_pinjaman,0,',','.') }}" required>

                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs">
                            Rupiah
                        </span>
                    </div>

                    <p id="errorNominal" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
                <!-- Jangka Waktu -->
                <div class="mb-3">
                    <label class="text-sm font-medium">Jangka Waktu (Bulan)</label>
                    <input type="number" id="jangka_waktu" name="jangka_waktu" class="w-full border rounded p-2 mt-1"
                        placeholder="Maksimal 180 bulan" required>

                    <p id="errorTenor" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <label class="text-sm font-medium">Metode Pembayaran</label>
                    <select name="pembayaran" class="w-full border rounded p-2 mt-1" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="potong gaji">Potong Gaji</option>
                        <option value="pembayaran online">Pembayaran Online</option>
                    </select>
                </div>

                <!-- INFO ANGSURAN -->
                <div id="boxAngsuran" class="hidden bg-gray-50 border rounded p-3 text-sm mt-3">

                    <div class="flex justify-between mb-1">
                        <span>Total Bunga</span>
                        <span id="totalBunga" class="font-medium"></span>
                    </div>

                    <div class="flex justify-between mb-1">
                        <span>Total Pinjaman</span>
                        <span id="totalPinjaman" class="font-medium"></span>
                    </div>

                    <hr class="my-2">

                    <div class="flex justify-between font-semibold text-green-700">
                        <span>Angsuran / Bulan</span>
                        <span id="angsuranBulanan"></span>
                    </div>

                    <p class="text-xs text-gray-500 mt-1">
                        * Bunga tetap 0,7% per bulan
                    </p>
                </div>

                <!-- Tanggal -->
                <div class="mt-3">
                    <label class="text-sm font-medium">Tanggal Pengajuan</label>
                    <input type="date" name="tanggal_pengajuan" class="w-full border rounded p-2 mt-1" required>
                </div>

                <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 rounded mt-4">
                    Ajukan Pinjaman
                </button>

            </form>
        </div>
    </div>


    {{-- modal setor --}}

    <div id="modalSetor" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">

        <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">
                Form Transaksi
            </h2>

            <form action="{{ url('anggota/setor') }}" method="POST">
                @csrf

                <!-- Jenis -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-600">Jenis</label>
                    <select id="jenis" name="jenis"
                        class="w-full mt-1 rounded-lg border-gray-300 focus:ring-green-500 focus:border-green-500">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="hari_raya">Simpanan Hari Raya</option>
                        <option value="sehat">Simpanan Sehat </option>
                        <option value="wajib">Simpanan Wajib</option>
                        <option value="pokok">Simpanan Pokok</option>
                    </select>
                </div>

                <!-- Nominal -->
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-semibold text-gray-700">
                        Nominal Pinjaman
                    </label>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            Rp
                        </span>

                        <input type="number" name="nominal" id="nominal"
                            class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-300 
                                focus:ring-2 focus:ring-green-500 focus:border-green-500
                                transition duration-150 ease-in-out"
                            placeholder="Contoh: 10000000">
                    </div>

                    <small id="errorNominal" class="hidden text-red-500 mt-1 text-xs"></small>
                </div>

                <!-- Action -->
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeModal"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>



    {{-- peminjaman --}}
    <script>
        $(document).ready(function () {

            const MAX_PINJAMAN = {{ $batasan_pinjaman }};
            const MAX_TENOR = 180;          // 180 bulan
            const BUNGA = 0.007;            // 0.7%

            // buka modal
            $("#btnPinjaman").on("click", function (e) {
                e.preventDefault();
                $("#modalPinjaman").removeClass("hidden").addClass("flex");
            });

            // tutup modal
            $("#closeModal").on("click", function () {
                $("#modalPinjaman").addClass("hidden").removeClass("flex");
            });

            function hitungAngsuran() {
                let nominal = Number($("#nominal").val());
                let bulan = Number($("#jangka_waktu").val());

                if (nominal > 0 && bulan > 0 && nominal <= MAX_PINJAMAN && bulan <= MAX_TENOR) {

                    let totalBunga = nominal * BUNGA * bulan;
                    let totalPinjaman = nominal + totalBunga;
                    let angsuran = totalPinjaman / bulan;

                    $("#totalBunga").text("Rp " + Math.round(totalBunga).toLocaleString());
                    $("#totalPinjaman").text("Rp " + Math.round(totalPinjaman).toLocaleString());
                    $("#angsuranBulanan").text("Rp " + Math.round(angsuran).toLocaleString());

                    $("#angsuranHidden").val(Math.round(angsuran));

                    $("#boxAngsuran").removeClass("hidden");
                } else {
                    $("#boxAngsuran").addClass("hidden");
                }
            }

            $("#nominal").on("keyup change", function () {
                let nominal = Number($(this).val());

                if (nominal > MAX_PINJAMAN) {
                    $("#errorNominal").removeClass("hidden")
                     .text("Pinjaman maksimal Rp " + MAX_PINJAMAN.toLocaleString("id-ID"));
                } else {
                    $("#errorNominal").addClass("hidden");
                }

                hitungAngsuran();
            });

            $("#jangka_waktu").on("keyup change", function () {
                let bulan = Number($(this).val());

                if (bulan < 1 || bulan > MAX_TENOR) {
                    $("#errorTenor").removeClass("hidden")
                        .text("Jangka waktu 1 – 180 bulan");
                } else {
                    $("#errorTenor").addClass("hidden");
                }

                hitungAngsuran();
            });

            $("#formPinjaman").on("submit", function (e) {
                let nominal = Number($("#nominal").val());
                let bulan = Number($("#jangka_waktu").val());

                if (nominal > MAX_PINJAMAN || bulan < 1 || bulan > MAX_TENOR) {
                    e.preventDefault();
                    alert("Periksa kembali nominal atau jangka waktu pinjaman");
                    return false;
                }
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(function () {

            // =====================
            // BUKA MODAL
            // =====================
            $(document).on('click', '#openModal', function (e) {
                e.preventDefault();
                $('#modalSetor')
                    .removeClass('hidden')
                    .addClass('flex');
            });

            // =====================
            // TUTUP MODAL (BATAL)
            // =====================
            $(document).on('click', '#closeModal', function () {
                $('#modalSetor')
                    .addClass('hidden')
                    .removeClass('flex');
            });

            // =====================
            // KLIK BACKDROP
            // =====================
            $(document).on('click', '#modalSetor', function (e) {
                if ($(e.target).is('#modalSetor')) {
                    $(this)
                        .addClass('hidden')
                        .removeClass('flex');
                }
            });
            $(document).ready(function () {

                $('#jenis').on('change', function () {
                    let jenis = $(this).val();

                    if (jenis === 'simpanan') {
                        // sembunyikan metode
                        $('#metode-wrapper').slideUp();
                        $('#metode').val('').prop('required', false);
                    } else {
                        // tampilkan metode
                        $('#metode-wrapper').slideDown();
                        $('#metode').prop('required', true);
                    }
                });

            });

        });

    </script>


    </script>

    <script>
        function bayarPinjaman(btn) {
            const angsuran = parseInt(btn.dataset.angsuran);
            const jangka = parseInt(btn.dataset.jangka);
            const dibayar = parseInt(btn.dataset.dibayar);
            const sisa = jangka - dibayar;

            const modalBox = document.querySelector('#modalBayarPinjaman > div');
            modalBox.classList.remove('max-w-md');
            modalBox.classList.add('max-w-2xl');

            const detail = document.getElementById('detailAngsuran');
            const list = document.getElementById('listAngsuran');

            list.innerHTML = '';
            detail.classList.remove('hidden');

            for (let i = 1; i <= sisa; i++) {
                // buat tombol bayar yang langsung redirect ke alur full-page (sama tab)
                list.innerHTML += `
                                <div class="border rounded p-3 flex justify-between items-center gap-4">
                                    <div>
                                        <span class="text-sm">Angsuran ke-${dibayar + i}</span>
                                        <div class="text-sm text-gray-500">Rp ${angsuran.toLocaleString('id-ID')}</div>
                                    </div>
                                    <div>
                                        <a href="/dashboard/anggota/pinjaman/bayar-now-angsuran/${btn.dataset.pinjaman}/${dibayar + i}/${angsuran}" class="bg-blue-600 text-white text-xs px-3 py-1 rounded">Bayar</a>
                                    </div>
                                </div>
                            `;
            }
        }

        document.getElementById('closeModalBayar').addEventListener('click', () => {
            const modal = document.getElementById('modalBayarPinjaman');
            const modalBox = modal.querySelector('div');

            modal.classList.add('hidden');
            modalBox.classList.remove('max-w-2xl');
            modalBox.classList.add('max-w-md');

            document.getElementById('detailAngsuran').classList.add('hidden');
        });
    </script>

    <script>
        // sisipkan anggota id dari session
        const ANGGOTA_ID = {!! json_encode(session('anggota_id')) !!};

        function payAngsuran(pinjamanId, angsuranKe, nominal) {
            fetch('/midtrans/bayar-angsuran', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    anggota_id: ANGGOTA_ID,
                    pinjaman_id: pinjamanId,
                    angsuran_ke: angsuranKe,
                    metode: 'pembayaran online',
                    jenis: 'angsuran',
                    nominal: nominal,
                    tanggal_bayar: new Date().toISOString(),
                    status: 'pending'
                })
            })
                .then(res => {
                    if (!res.ok) return res.text().then(t => { throw new Error(t); });
                    return res.json();
                })
                .then(data => {
                    if (data.token && window.snap && typeof window.snap.pay === 'function') {
                        window.snap.pay(data.token, {
                            onSuccess: function (result) {
                                // refresh atau redirect sesuai kebutuhan
                                window.location.reload();
                            },
                            onError: function (err) {
                                console.error(err);
                                alert('Terjadi kesalahan saat pembayaran.');
                            },
                            onClose: function () {
                                // pengguna menutup popup pembayaran
                            }
                        });
                    } else {
                        console.error('Token tidak diterima:', data);
                        alert('Gagal memulai proses pembayaran.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Gagal terhubung ke server.');
                });
        }

        // penutup modal sederhana
        const closeBtn = document.getElementById('closeModalBayar');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                const modal = document.getElementById('modalBayarPinjaman');
                if (modal) modal.classList.add('hidden');
                const detail = document.getElementById('detailAngsuran');
                if (detail) detail.classList.add('hidden');
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('fireworksCanvas');
    const ctx = canvas.getContext('2d');
    let particles = [];

    // Set ukuran canvas
    function resize() {
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    // Partikel Kembang Api
    class Particle {
        constructor(x, y, color) {
            this.x = x;
            this.y = y;
            this.color = color;
            this.velocity = {
                x: (Math.random() - 0.5) * 8,
                y: (Math.random() - 0.5) * 8
            };
            this.alpha = 1;
            this.friction = 0.95;
        }

        draw() {
            ctx.save();
            ctx.globalAlpha = this.alpha;
            ctx.beginPath();
            ctx.arc(this.x, this.y, 2, 0, Math.PI * 2);
            ctx.fillStyle = this.color;
            ctx.fill();
            ctx.restore();
        }

        update() {
            this.velocity.x *= this.friction;
            this.velocity.y *= this.friction;
            this.x += this.velocity.x;
            this.y += this.velocity.y;
            this.alpha -= 0.01;
        }
    }

    function createFirework(x, y) {
        const colors = ['#E2B13C', '#FFFFFF', '#4CC9F0', '#F72585'];
        const color = colors[Math.floor(Math.random() * colors.length)];
        for (let i = 0; i < 40; i++) {
            particles.push(new Particle(x, y, color));
        }
    }

    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach((p, i) => {
            if (p.alpha <= 0) {
                particles.splice(i, 1);
            } else {
                p.update();
                p.draw();
            }
        });
        requestAnimationFrame(animateParticles);
    }
    animateParticles();

    // Jalankan Animasi GSAP
    const tl = gsap.timeline();

    tl.to("#welcome-section", { 
        opacity: 1, 
        duration: 1.5, 
        ease: "power4.out",
        onStart: () => {
            // Ledakan kembang api saat muncul
            setTimeout(() => createFirework(canvas.width/4, canvas.height/2), 200);
            setTimeout(() => createFirework(canvas.width/2, canvas.height/3), 600);
            setTimeout(() => createFirework(canvas.width/1.2, canvas.height/2), 1000);
        }
    })
    .from("#welcome-text", { y: 20, opacity: 0, duration: 1 }, "-=1")
    .from("#saldo-box", { scale: 0.9, opacity: 0, duration: 1, ease: "back.out(1.7)" }, "-=0.8");

    // Counter Angka
    const counterEl = document.getElementById('saldo-counter');
    const targetValue = parseFloat(counterEl.getAttribute('data-target'));
    const countObj = { val: 0 };

    gsap.to(countObj, {
        val: targetValue,
        duration: 3,
        ease: "expo.out",
        onUpdate: () => {
            counterEl.innerText = new Intl.NumberFormat('id-ID').format(Math.floor(countObj.val));
        }
    });

    // Animasi Progress Bar
    gsap.to("#saldo-progress", { width: "100%", duration: 2.5, ease: "power2.inOut", delay: 1 });
});
document.addEventListener('DOMContentLoaded', () => {
    // 1. ANIMASI MASUK (ENTRANCE)
    const tl = gsap.timeline({ defaults: { ease: "power4.out" } });

    tl.to("#welcome-section", {
        opacity: 1,
        duration: 1.2,
        y: 0,
        startAt: { y: 30 }
    })
    .from("#welcome-text", {
        x: -50,
        opacity: 0,
        duration: 0.8
    }, "-=0.8")
    .from("#saldo-box", {
        scale: 0.9,
        opacity: 0,
        duration: 1
    }, "-=0.6");

    // 2. ANIMASI PENGHITUNG SALDO (COUNTER)
    const saldoElement = document.getElementById('saldo-counter');
    const targetSaldo = parseFloat(saldoElement.getAttribute('data-target'));

    gsap.to(saldoElement, {
        innerText: targetSaldo,
        duration: 2.5,
        snap: { innerText: 1 }, // Memastikan angka bulat
        ease: "expo.out",
        onUpdate: function() {
            // Format angka ke Rupiah saat update
            const value = Math.ceil(this.targets()[0].innerText);
            saldoElement.innerHTML = value.toLocaleString('id-ID');
        }
    });

    // 3. ANIMASI PROGRESS BAR
    gsap.to("#saldo-progress", {
        width: "100%",
        duration: 2,
        ease: "power2.inOut",
        delay: 0.5
    });

    // 4. ANIMASI FIREWORKS (CANVAS)
    initFireworks();
});

function initFireworks() {
    const canvas = document.getElementById('fireworksCanvas');
    const ctx = canvas.getContext('2d');
    let particles = [];

    function resize() {
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    }

    window.addEventListener('resize', resize);
    resize();

    class Particle {
        constructor() {
            this.reset();
        }
        reset() {
            this.x = Math.random() * canvas.width;
            this.y = canvas.height + 10;
            this.sx = Math.random() * 3 - 1.5;
            this.sy = Math.random() * -3 - 2;
            this.size = Math.random() * 2 + 1;
            this.life = Math.random() * 100 + 50;
            this.opacity = 1;
            this.color = `hsl(${Math.random() * 40 + 30}, 100%, 60%)`; // Warna emas/kuning
        }
        update() {
            this.x += this.sx;
            this.y += this.sy;
            this.life--;
            if (this.life < 0) this.reset();
        }
        draw() {
            ctx.globalAlpha = this.life / 150;
            ctx.fillStyle = this.color;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    for (let i = 0; i < 50; i++) particles.push(new Particle());

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            p.update();
            p.draw();
        });
        requestAnimationFrame(animate);
    }
    animate();
}
</script>
    

@endsection