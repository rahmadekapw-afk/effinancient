@extends('material/temp_admin')

@section('content')
    <script src="https://unpkg.com/lucide@latest"></script>

    <div class="w-full min-h-screen bg-gray-50 p-4 md:p-8">
        <div
            class="max-w-5xl mx-auto mb-6 bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-5 shadow flex items-center gap-4">

            <div class="p-3 bg-emerald-500 rounded-xl">
                <i data-lucide="layout-grid" class="w-6 h-6 text-white"></i>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white">Manajemen Konten</h2>
                <p class="text-slate-400 text-sm">Buat berita atau tambahkan layanan publik</p>
            </div>

        </div>


        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-8 border-b border-gray-50 pb-5">
                    <i data-lucide="file-text" class="w-6 h-6 text-emerald-600"></i>
                    <h3 class="text-xl font-bold text-slate-800 tracking-tight">Post Berita Utama</h3>
                </div>

                <form action="{{ url('/admin/artikel/simpan') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Judul
                                Artikel</label>
                            <input name="judul" required
                                class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition-all">
                        </div>
                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">External
                                URL (opsional)</label>
                            <input name="external_url" placeholder="https://... (jika sumber eksternal)"
                                class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition-all">
                        </div>
                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Kategori</label>
                            <input name="kategori" required
                                class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Isi
                            Berita</label>
                        <textarea name="isi" rows="6"
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-4 focus:border-emerald-500 outline-none transition-all resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Gambar
                            Cover</label>
                        <div
                            class="relative group h-44 w-full border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 hover:bg-emerald-50 hover:border-emerald-300 transition-all flex flex-col items-center justify-center overflow-hidden">
                            <img id="pvBerita"
                                class="absolute inset-0 w-full h-full object-cover hidden z-10 pointer-events-none">

                            <div class="flex flex-col items-center z-0">
                                <i data-lucide="image-plus" class="w-8 h-8 text-emerald-500 mb-2"></i>
                                <span class="text-xs font-bold text-slate-400 uppercase">Pilih Gambar</span>
                            </div>

                            <input type="file" name="gambar" accept="image/*" onchange="previewImg(this, 'pvBerita')"
                                class="absolute inset-0 opacity-0 cursor-pointer z-20">
                        </div>
                    </div>

                    <button
                        class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-xl shadow-lg shadow-emerald-200 transition-all active:scale-95">
                        PUBLIKASIKAN BERITA
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-3 mb-8 border-b border-gray-50 pb-5">
                    <i data-lucide="briefcase" class="w-6 h-6 text-blue-600"></i>
                    <h3 class="text-xl font-bold text-slate-800 tracking-tight">Layanan Kami</h3>
                </div>

                <form action="{{ url('/admin/jenis_layanan/simpan') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama
                            Layanan</label>
                        <input name="jenis_layanan" required
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Link
                            Eskternal</label>
                        <input name="link" placeholder="https://..."
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Uraian
                            Singkat</label>
                        <textarea name="isi" rows="4"
                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-4 focus:border-blue-500 outline-none transition-all resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Ikon
                            Layanan</label>
                        <div
                            class="relative group h-32 w-full border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 hover:bg-blue-50 hover:border-blue-300 transition-all flex flex-col items-center justify-center overflow-hidden">
                            <div id="pvLayanan"
                                class="absolute inset-0 hidden z-10 bg-white flex items-center justify-center">
                            </div>

                            <div class="flex flex-col items-center z-0">
                                <i data-lucide="plus-circle" class="w-6 h-6 text-blue-500 mb-2"></i>
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Upload Ikon</span>
                            </div>
                            <input type="file" name="gambar" accept="image/*,.pdf,.doc,.docx"
                                onchange="previewFile(this, 'pvLayanan')"
                                class="absolute inset-0 opacity-0 cursor-pointer z-20">


                        </div>
                    </div>

                    <button
                        class="w-full py-4 bg-slate-900 hover:bg-black text-white font-black rounded-xl shadow-lg transition-all active:scale-95">
                        SIMPAN LAYANAN
                    </button>
                </form>
            </div>

        </div>
    </div>
   {{-- tombol --}}
   <div class="max-w-7xl mx-auto mt-10 mb-2">
    <div class="inline-flex p-1.5 bg-slate-200/60 backdrop-blur-sm rounded-2xl border border-slate-200">
        
        <button onclick="switchTab('artikel')" id="btn-artikel" 
            class="tab-btn flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 bg-white text-blue-600 shadow-md ring-1 ring-black/5">
            <i data-lucide="list" class="w-4 h-4"></i>
            <span>Daftar Artikel</span>
            <span id="badge-artikel" class="ml-1 px-2 py-0.5 bg-blue-100 text-blue-600 rounded-md text-[10px]">
                {{ $artikels->count() }}
            </span>
        </button>
        
        <button onclick="switchTab('layanan')" id="btn-layanan" 
            class="tab-btn flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-slate-500 hover:text-slate-700">
            <i data-lucide="briefcase" class="w-4 h-4"></i>
            <span>Daftar Layanan</span>
            <span id="badge-layanan" class="ml-1 px-2 py-0.5 bg-slate-300 text-slate-600 rounded-md text-[10px]">
                {{ $layanans->count() }}
            </span>
        </button>

    </div>
</div>
    
{{-- berita --}}
    <div id="section-artikel" class="tab-content transition-all duration-500">
        <div class="max-w-7xl mx-auto mt-8 bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center gap-3 mb-6">
            <i data-lucide="list" class="w-6 h-6 text-slate-700"></i>
            <h3 class="text-lg font-bold text-slate-800 tracking-tight">Daftar Artikel</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="text-slate-500 uppercase text-xs">
                        <th class="px-4 py-3">id</th>
                        <th class="px-4 py-3">kategori</th>
                        <th class="px-4 py-3">judul</th>
                        <th class="px-4 py-3">slug</th>
                        <th class="px-4 py-3">gambar</th>
                        <th class="px-4 py-3">isi</th>
                        <th class="px-4 py-3">tanggal</th>
                        <th class="px-4 py-3">views</th>
                        <th class="px-4 py-3">status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700">
                    @foreach($artikels as $a)
                        <tr class="bg-white border-b hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-sm text-slate-500">{{ $a->id }}</td>

                            <td class="px-4 py-3 text-sm font-semibold text-slate-700">
                                {{ $a->kategori }}
                            </td>

                            <td class="px-4 py-3 font-semibold text-slate-800 max-w-xs">
                                {{ \Illuminate\Support\Str::limit($a->judul, 60) }}
                            </td>

                            <td class="px-4 py-3 text-xs font-mono text-slate-500">
                                {{ $a->slug }}
                            </td>

                            <td class="px-4 py-3">
                                @if($a->gambar)
                                    <img src="{{ asset('img/berita/' . $a->gambar) }}" alt="Cover Berita"
                                        class="h-20 w-28 object-cover rounded-xl border">
                                @else
                                    <div
                                        class="h-20 w-28 bg-slate-100 flex items-center justify-center text-slate-400 text-xs rounded-xl">
                                        No Image
                                    </div>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-sm text-slate-600 max-w-sm">
                                {{ \Illuminate\Support\Str::limit(strip_tags($a->isi), 80) }}
                            </td>

                            <td class="px-4 py-3 text-sm text-slate-600 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3 text-sm text-center font-semibold text-slate-700">
                                {{ number_format($a->views) }}
                            </td>

                            <td class="px-4 py-3">
                                @if($a->status == 1)
                                    <span class="px-3 py-1 text-xs font-bold text-emerald-700 bg-emerald-100 rounded-full">
                                        Publish
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-bold text-slate-600 bg-slate-200 rounded-full">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-4 text-sm font-semibold">
                                    <button onclick="hapusArtikel({{ $a->id }})" class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    

    {{-- jenis_layanan --}}
    <div id="section-layanan" class="tab-content hidden opacity-0 transition-all duration-500">
          <div class="max-w-7xl mx-auto mt-8 bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center gap-3 mb-6">
            <i data-lucide="briefcase" class="w-6 h-6 text-blue-600"></i>
            <h3 class="text-lg font-bold text-slate-800 tracking-tight">Daftar Layanan</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead>
                    <tr class="text-xs uppercase text-slate-500">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Ikon</th>
                        <th class="px-4 py-3">Nama Layanan</th>
                        <th class="px-4 py-3">Link</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700">
                    @foreach($layanans as $l)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>

                         <td class="px-4 py-3">
                            @php
                                $file = $l->gambar;
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                $filePath = asset('img/layanan/' . $file);
                            @endphp

                            <div class="flex items-center">
                                @if(!$file)
                                    <div class="flex items-center gap-2 text-slate-400 italic text-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>Kosong</span>
                                    </div>

                                @elseif(in_array($ext, ['jpg','jpeg','png','webp','gif']))
                                    <a href="{{ $filePath }}" target="_blank" class="group relative">
                                        <img src="{{ $filePath }}" class="h-12 w-12 object-cover rounded-lg border-2 border-slate-100 group-hover:border-blue-400 transition-all shadow-sm">
                                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 rounded-lg flex items-center justify-center transition-opacity">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </div>
                                    </a>

                                @else
                                    @php
                                        // Tentukan warna dan icon berdasarkan ekstensi
                                        $config = [
                                            'pdf'  => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'label' => 'PDF Document'],
                                            'doc'  => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'label' => 'Word Doc'],
                                            'docx' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'label' => 'Word Doc'],
                                            'xls'  => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'label' => 'Excel File'],
                                            'xlsx' => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'label' => 'Excel File'],
                                        ][$ext] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'label' => 'Other File'];
                                    @endphp

                                    <a href="{{ $filePath }}" target="_blank" 
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg {{ $config['bg'] }} {{ $config['text'] }} hover:ring-1 ring-current transition-all group">
                                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                        </svg>
                                        <div class="flex flex-col leading-tight">
                                            <span class="text-xs font-bold uppercase tracking-wider">{{ $ext }}</span>
                                            <span class="text-[10px] opacity-70 truncate max-w-[80px]">Buka Dokumen</span>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </td>


                            <td class="px-4 py-3 font-semibold">
                                {{ $l->jenis_layanan }}
                            </td>

                            <td class="px-4 py-3 text-blue-600">
                                @if($l->link)
                                    <a href="{{ $l->link }}" target="_blank" class="hover:underline">
                                        Kunjungi
                                    </a>
                                @else
                                    <span class="text-slate-400 text-xs">-</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 max-w-sm">
                                {{ \Illuminate\Support\Str::limit($l->isi, 60) }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex gap-4 font-semibold">
                                    <button onclick="hapusLayanan({{ $l->id }})" class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
  


    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();

        // Fungsi Preview Gambar (Vanilla JS)
        function previewImg(input, targetID) {
            const preview = document.getElementById(targetID);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>
    <!-- SweetAlert2 feedback -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#059669'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ $errors->first() }}'
                });
            @endif
            });
    </script>

    <script>
        function hapusArtikel(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data berita akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/artikel/hapus/${id}`;

                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';

                    form.appendChild(csrf);
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

    {{-- jenis layanan --}}
    <script>
        function hapusLayanan(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Layanan akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/jenis_layanan/hapus/${id}`;

                    form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

    {{-- priview pdf --}}
    <script>
        function previewFile(input, targetId) {
            const file = input.files[0];
            if (!file) return;

            const preview = document.getElementById(targetId);
            preview.innerHTML = '';
            preview.classList.remove('hidden');

            const fileType = file.type;
            const fileURL = URL.createObjectURL(file);

            // IMAGE
            if (fileType.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = fileURL;
                img.className = 'w-full h-full object-cover rounded';
                preview.appendChild(img);
            }
            // PDF
            else if (fileType === 'application/pdf') {
                const iframe = document.createElement('iframe');
                iframe.src = fileURL;
                iframe.className = 'w-full h-full rounded';
                preview.appendChild(iframe);
            }
            // WORD
            else if (
                fileType === 'application/msword' ||
                fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ) {
                preview.innerHTML = `
                <div class="text-center p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                    </svg>
                    <p class="mt-2 text-xs font-semibold text-slate-600 break-all">
                        ${file.name}
                    </p>
                </div>
            `;
            }
            else {
                preview.innerHTML = `<p class="text-red-500 text-sm">File tidak didukung</p>`;
            }
        }
    </script>
    <script>
    function switchTab(tabName) {
        const sectionArtikel = document.getElementById('section-artikel');
        const sectionLayanan = document.getElementById('section-layanan');
        const btnArtikel = document.getElementById('btn-artikel');
        const btnLayanan = document.getElementById('btn-layanan');

        // Reset Semua Tombol ke gaya Inactive
        [btnArtikel, btnLayanan].forEach(btn => {
            btn.classList.remove('bg-white', 'text-blue-600', 'shadow-md', 'ring-1', 'ring-black/5');
            btn.classList.add('text-slate-500');
        });

        // Sembunyikan semua konten dengan efek pudar
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden', 'opacity-0');
        });

        // Aktifkan tab yang dipilih
        if (tabName === 'artikel') {
            // Style Tombol
            btnArtikel.classList.add('bg-white', 'text-blue-600', 'shadow-md', 'ring-1', 'ring-black/5');
            btnArtikel.classList.remove('text-slate-500');
            
            // Tampilkan Konten
            sectionArtikel.classList.remove('hidden');
            setTimeout(() => sectionArtikel.classList.remove('opacity-0'), 10);
        } else {
            // Style Tombol
            btnLayanan.classList.add('bg-white', 'text-blue-600', 'shadow-md', 'ring-1', 'ring-black/5');
            btnLayanan.classList.remove('text-slate-500');
            
            // Tampilkan Konten
            sectionLayanan.classList.remove('hidden');
            setTimeout(() => sectionLayanan.classList.remove('opacity-0'), 10);
        }
    }
    </script>




@endsection