@extends('material/temp_admin')

@section('content')
<script src="https://unpkg.com/lucide@latest"></script>

<div class="w-full min-h-screen bg-gray-50 p-4 md:p-8">
   <div class="max-w-5xl mx-auto mb-6 bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-5 shadow flex items-center gap-4">
    
    <div class="p-3 bg-emerald-500 rounded-xl">
        <i data-lucide="edit" class="w-6 h-6 text-white"></i>
    </div>

    <div>
        <h2 class="text-xl font-bold text-white">Edit Artikel</h2>
        <p class="text-slate-400 text-sm">Memperbarui data artikel</p>
    </div>

</div>

    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <form action="{{ url('/admin/artikel/'.$artikel->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Judul Artikel</label>
                <input name="judul" value="{{ old('judul', $artikel->judul) }}" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition-all">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Slug / Link</label>
                    <input name="slug" value="{{ old('slug', $artikel->slug) }}" id="slugBeritaEdit"  class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-slate-400 font-mono text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">External URL (opsional)</label>
                    <input name="external_url" value="{{ old('external_url', $artikel->external_url) }}" placeholder="https://... (jika sumber eksternal)" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Kategori</label>
                <input name="kategori" value="{{ old('kategori', $artikel->kategori) }}" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition-all">
            </div>

            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Isi Berita</label>
                <textarea name="isi" rows="8" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-4 focus:border-emerald-500 outline-none transition-all resize-none">{{ old('isi', $artikel->isi) }}</textarea>
            </div>

            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2">Gambar Cover (kosongkan untuk tetap menggunakan yang lama)</label>
                <div class="relative group h-44 w-full border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 hover:bg-emerald-50 hover:border-emerald-300 transition-all flex flex-col items-center justify-center overflow-hidden">
                    @if($artikel->gambar)
                        <img id="pvBeritaEdit" src="/{{ $artikel->gambar }}" class="absolute inset-0 w-full h-full object-cover z-10 pointer-events-none">
                    @else
                        <img id="pvBeritaEdit" class="absolute inset-0 w-full h-full object-cover hidden z-10 pointer-events-none">
                    @endif

                    <div class="flex flex-col items-center z-0">
                        <i data-lucide="image-plus" class="w-8 h-8 text-emerald-500 mb-2"></i>
                        <span class="text-xs font-bold text-slate-400 uppercase">Pilih Gambar</span>
                    </div>

                    <input type="file" name="gambar" accept="image/*" 
                        onchange="previewImg(this, 'pvBeritaEdit')"
                        class="absolute inset-0 opacity-0 cursor-pointer z-20">
                </div>
            </div>

            <div class="flex gap-3">
                <button class="py-3 px-6 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-xl shadow-lg shadow-emerald-200 transition-all active:scale-95">SIMPAN PERUBAHAN</button>
                <a href="{{ url('/admin/artikel') }}" class="py-3 px-6 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-xl font-semibold">BATAL</a>
            </div>
        </form>
    </div>
</div>

<script>
    lucide.createIcons();
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

@endsection
