<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function index()
    {     
        $layanans = JenisLayanan::latest()->get();
        $artikels = Berita::orderBy('created_at', 'desc')->get();

        return view('admin.artikel', compact('artikels', 'layanans'));
    }




     public function simpan(Request $request)
    {
        // ✅ Validasi
        $request->validate([
            'judul'   => 'required|string|max:255',
            'kategori'=> 'required|string|max:255',
            'isi'     => 'required',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        // ✅ Generate slug otomatis jika kosong
        $slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->judul);

        // ✅ Upload gambar
        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '-' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/berita'), $namaGambar);
        }

        // ✅ Simpan ke database
        Berita::create([
            'kategori'      => $request->kategori,
            'judul'         => $request->judul,
            'slug'          => $slug,
            'external_url'  => null,
            'gambar'        => $namaGambar,
            'ringkasan'     => Str::limit(strip_tags($request->isi), 160),
            'isi'           => $request->isi,
            'tanggal'       => now()->toDateString(),
            'views'         => 0,
            'status'        => 1,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil dipublikasikan.');
    }
    /**
     * Show a single berita by slug
     */

    public function destroy($id)
    {
        $artikel = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($artikel->gambar && File::exists(public_path('img/berita/' . $artikel->gambar))) {
            File::delete(public_path('img/berita/' . $artikel->gambar));
        }

        $artikel->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus');
    }
 
     public function store(Request $request)
    {
        $request->validate([
            'jenis_layanan' => 'required|string|max:255',
            'link'          => 'nullable',
            'isi'           => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png,svg,pdf,doc,docx|max:10240'
        ]);

        $data = $request->only('jenis_layanan', 'link', 'isi');

        // Upload ikon
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = 'layanan_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/layanan'), $namaFile);

            $data['gambar'] = $namaFile;
        }

        JenisLayanan::create($data);

        return redirect()->back()->with('success', 'Layanan berhasil disimpan');
    }

    public function destroy_jenis($id)
        {
            $layanan = JenisLayanan::findOrFail($id);

            // Hapus ikon jika ada
            if ($layanan->gambar && File::exists(public_path('img/layanan/' . $layanan->gambar))) {
                File::delete(public_path('img/layanan/' . $layanan->gambar));
            }

            $layanan->delete();

            return redirect()->back()->with('success', 'Layanan berhasil dihapus');
        }

            public function selengkapnya(){

        

            $artikels = Berita::orderBy('created_at', 'desc')->get();
            return view('berita_layanan', compact('artikels'));
      
    }
}