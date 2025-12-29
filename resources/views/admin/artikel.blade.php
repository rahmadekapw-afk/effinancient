@extends('material/temp_admin')

@section('content')
<script src="https://unpkg.com/lucide@latest"></script>

<div class="w-full min-h-screen bg-gray-50 p-4 md:p-8">
   <div class="max-w-5xl mx-auto mb-6 bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-5 shadow flex items-center gap-4">
    
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

            <form action="{{ url('/admin/artikel/simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Judul Artikel</label>
                        <input name="judul" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition-all">
                    </div>
                    <div>
                                 <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">External URL (opsional)</label>
                        <input name="external_url" placeholder="https://... (jika sumber eksternal)" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Kategori</label>
                        <input name="kategori" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Isi Berita</label>
                    <textarea name="isi" rows="6" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-4 focus:border-emerald-500 outline-none transition-all resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Gambar Cover</label>
                    <div class="relative group h-44 w-full border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 hover:bg-emerald-50 hover:border-emerald-300 transition-all flex flex-col items-center justify-center overflow-hidden">
                        <img id="pvBerita" class="absolute inset-0 w-full h-full object-cover hidden z-10 pointer-events-none">
                        
                        <div class="flex flex-col items-center z-0">
                            <i data-lucide="image-plus" class="w-8 h-8 text-emerald-500 mb-2"></i>
                            <span class="text-xs font-bold text-slate-400 uppercase">Pilih Gambar</span>
                        </div>

                        <input type="file" name="gambar" accept="image/*" 
                            onchange="previewImg(this, 'pvBerita')"
                            class="absolute inset-0 opacity-0 cursor-pointer z-20">
                    </div>
                </div>

                <button class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-xl shadow-lg shadow-emerald-200 transition-all active:scale-95">
                    PUBLIKASIKAN BERITA
                </button>
            </form>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <div class="flex items-center gap-3 mb-8 border-b border-gray-50 pb-5">
                <i data-lucide="briefcase" class="w-6 h-6 text-blue-600"></i>
                <h3 class="text-xl font-bold text-slate-800 tracking-tight">Layanan Kami</h3>
            </div>

            <form action="{{ url('/admin/jenis_layanan/simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Layanan</label>
                    <input name="jenis_layanan" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Link Eskternal</label>
                    <input name="link" placeholder="https://..." class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-blue-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Uraian Singkat</label>
                    <textarea name="isi" rows="4" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-4 focus:border-blue-500 outline-none transition-all resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Ikon Layanan</label>
                    <div class="relative group h-32 w-full border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 hover:bg-blue-50 hover:border-blue-300 transition-all flex flex-col items-center justify-center overflow-hidden">
                        <img id="pvLayanan" class="absolute inset-0 w-full h-full object-cover hidden z-10 pointer-events-none">
                        <div class="flex flex-col items-center z-0">
                            <i data-lucide="plus-circle" class="w-6 h-6 text-blue-500 mb-2"></i>
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Upload Ikon</span>
                        </div>
                        <input type="file" name="gambar" accept="image/*" 
                            onchange="previewImg(this, 'pvLayanan')"
                            class="absolute inset-0 opacity-0 cursor-pointer z-20">
                    </div>
                </div>

                <button class="w-full py-4 bg-slate-900 hover:bg-black text-white font-black rounded-xl shadow-lg transition-all active:scale-95">
                    SIMPAN LAYANAN
                </button>
            </form>
        </div>

    </div>
</div>

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
                        <th class="px-4 py-3">created_at</th>
                        <th class="px-4 py-3">updated_at</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700">
                    @foreach($artikels as $a)
                        <tr class="bg-white border-b hover:bg-slate-50">
                            <td class="px-4 py-3 align-top">{{ $a->id }}</td>
                            <td class="px-4 py-3 align-top">{{ $a->kategori }}</td>
                            <td class="px-4 py-3 font-semibold align-top">{{ \Illuminate\Support\Str::limit($a->judul, 60) }}</td>
                            <td class="px-4 py-3 align-top">{{ $a->slug }}</td>
                            <td class="px-4 py-3 align-top">
                                @if($a->gambar)
                                    <img src="/{{ $a->gambar }}" alt="cover" class="h-20 w-28 object-cover rounded">
                                @else
                                    <div class="h-20 w-28 bg-slate-100 flex items-center justify-center text-slate-400 text-xs">No Image</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 align-top">{{ \Illuminate\Support\Str::limit(strip_tags($a->isi), 80) }}</td>
                            <td class="px-4 py-3 align-top">{{ $a->tanggal }}</td>
                            <td class="px-4 py-3 align-top">{{ $a->views }}</td>
                            <td class="px-4 py-3 align-top">{{ $a->status }}</td>
                            <td class="px-4 py-3 align-top">{{ $a->created_at }}</td>
                            <td class="px-4 py-3 align-top">{{ $a->updated_at }}</td>
                            <td class="px-4 py-3 align-top">
                                <div class="flex gap-3">
                                    <a href="#" class="text-emerald-600 font-semibold">Edit</a>
                                    <a href="#" class="text-slate-600">Copy</a>
                                    <a href="#" class="text-red-600">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
            reader.onload = function(e) {
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
    document.addEventListener('DOMContentLoaded', function() {
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
@endsection
