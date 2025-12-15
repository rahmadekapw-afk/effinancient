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
                        <p class="text-lg font-bold text-gray-800">{{ $anggota->nama_lengkap }}</p>
                        <p class="text-sm text-gray-500">nomor Anggota: {{ $anggota->nomor_anggota }}</p>
                        <div class="flex gap-2 mt-1">
                            {{-- Badge Status Anggota --}}
                            @if ($anggota->status_anggota === 'aktif')
                                <span class="text-xs font-medium text-green-800 bg-green-100 px-2 py-0.5 rounded-full">
                                    {{ $anggota->status_anggota }}
                                </span>

                                {{-- Anggota Reguler --}}
                                <span class="text-xs font-medium text-blue-800 bg-blue-100 px-2 py-0.5 rounded-full">
                                    Anggota Reguler
                                </span>

                            @else
                                <span class="text-xs font-medium text-red-800 bg-red-100 px-2 py-0.5 rounded-full">
                                    {{ $anggota->status_anggota }}
                                </span>

                                {{-- Anggota Nonaktif --}}
                                <span class="text-xs font-medium text-red-800 bg-red-100 px-2 py-0.5 rounded-full">
                                    Anggota Nonaktif
                                </span>
                            @endif

                        </div>
                    </div>
                </div>
               <button 
                    onclick="confirmEditProfile()"
                    class="mt-4 md:mt-0 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition-colors text-sm shadow-md">
                    <i class="bi bi-pencil-square"></i> Edit Profil
                </button>

            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center mt-4">
                <div>
                    <p class="text-xs text-gray-500">Total Simpanan</p>
                    <p class="text-lg font-bold text-gray-900">Rp {{ number_format($anggota->saldo, 2, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Pinjaman Aktif</p>
                    <p class="text-lg font-bold text-gray-900">belum dikerjakan</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Transaksi</p>
                    <p class="text-lg font-bold text-gray-900">belum dikerjakan</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Poin Loyalitas</p>
                    <p class="text-lg font-bold text-gray-900">belum dikerjakan</p>
                </div>
            </div>
        </section>
        
        <section class="bg-white rounded-lg shadow p-5">
            
            <h3 class="text-base font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Pribadi</h3>
            
            <div class="flex items-center gap-3 py-3 border-b">
                <i class="bi bi-envelope text-lg text-gray-500 w-6"></i>
                <div>
                    <p class="text-sm font-medium text-gray-700">Email</p>
                    <p class="text-sm text-gray-900">{{ $anggota->email }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 py-3 border-b">
                <i class="bi bi-phone text-lg text-gray-500 w-6"></i>
                <div>
                    <p class="text-sm font-medium text-gray-700">Nomor Telepon</p>
                    <p class="text-sm text-gray-900">{{ $anggota->no_hp }}</p>
                </div>
            </div>

            <div class="flex items-start gap-3 py-3 border-b">
                <i class="bi bi-geo-alt text-lg text-gray-500 w-6 mt-1"></i>
                <div>
                    <p class="text-sm font-medium text-gray-700">Alamat</p>
                    <p class="text-sm text-gray-900">{{ $anggota->alamat }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 py-3">
                <i class="bi bi-calendar text-lg text-gray-500 w-6"></i>
                <div>
                   <p class="text-sm font-medium text-gray-700">Tanggal Bergabung</p>
                   <p class="text-sm text-gray-900">
                        {{ optional($anggota->created_at)->format('d-m-Y') ?? '-' }}
                   </p>
                </div>
            </div>
            
          <hr class="my-5">
    <div>
    <form action="{{ url('/anggota/profile/kritik') }}" method="post">
        <label class="text-sm font-medium text-gray-700">Kritik & Saran</label>
        <textarea name="kritik" rows="3"
            class="w-full border rounded p-2 mt-1 focus:ring focus:ring-red-200"
            placeholder="Masukkan kritik Anda"></textarea>
    </div>
    @csrf
    <button type="submit" 
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow text-sm"
        >
        Kirim
    </button>
</form>

</div>

    </div>

    {{-- MODAL EDIT PROFIL --}}
<div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Profil</h3>

        <form action="{{ url('/anggota/profile/update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama_lengkap"
                    value="{{ $anggota->nama_lengkap }}"
                    class="w-full border rounded p-2 mt-1 focus:ring focus:ring-green-200">
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email"
                    value="{{ $anggota->email }}"
                    class="w-full border rounded p-2 mt-1 focus:ring focus:ring-green-200">
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="text" name="no_hp"
                    value="{{ $anggota->no_hp }}"
                    class="w-full border rounded p-2 mt-1 focus:ring focus:ring-green-200">
            </div>

            <div class="mb-4">
                <label class="text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" rows="2"
                    class="w-full border rounded p-2 mt-1 focus:ring focus:ring-green-200">{{ $anggota->alamat }}</textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 rounded-lg border text-gray-600">
                    Batal
                </button>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection