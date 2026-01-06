<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->paginate(10);
        return view('berita.index', compact('beritas'));
    }

    /**
     * Show a single berita by slug
     */
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        if (! $berita) {
            abort(404);
        }

        // increment views (non-blocking simple increment)
        try {
            $berita->increment('views');
        } catch (\Exception $e) {
            // ignore increment errors
        }

        return view('berita.show', compact('berita'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        // Log incoming request for debugging (excluding file binary)
        \Illuminate\Support\Facades\Log::info('Berita store request', $request->except(['gambar', '_token']));

        $validated = $request->validate([
            'kategori' => 'nullable|string|max:255',
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'external_url' => 'nullable|max:2048',
            'gambar' => 'nullable|image|max:2048',
            'isi' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'status' => 'nullable|string',
        ]);
        // sanitize slug (convert pasted URLs or unsafe strings to slug)
        $slugRaw = $validated['slug'] ?? $validated['judul'] ?? '';
        if (preg_match('#https?://#i', $slugRaw)) {
            $parts = parse_url($slugRaw);
            $slugPath = $parts['path'] ?? $slugRaw;
            $slugRaw = trim($slugPath, "\/ ");
        }
        $slug = \Illuminate\Support\Str::slug($slugRaw);
        if (empty($slug)) {
            $slug = 'artikel-' . time();
        }

        // pastikan slug unik secara manual jika kolom unique tidak cocok
        if (\App\Models\Berita::where('slug', $slug)->exists()) {
            return back()->withErrors(['slug' => 'Slug sudah digunakan'])->withInput();
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $destination = public_path('file/img/berita');
            if (! File::isDirectory($destination)) {
                File::makeDirectory($destination, 0755, true);
            }
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);
            $validated['gambar'] = 'file/img/berita/' . $filename;
        }

        $now = now();

        $insert = [
            // id: jangan set, biarkan auto-increment
            'kategori' => $validated['kategori'] ?? null,
            'judul' => $validated['judul'] ?? null,
            'slug' => $slug,
            'external_url' => $validated['external_url'] ?? null,
            'gambar' => $validated['gambar'] ?? null,
            'isi' => $validated['isi'] ?? null,
            'tanggal' => $validated['tanggal'] ?? $now->toDateString(),
            'views' => 0,
            'status' => isset($validated['status']) ? (int)$validated['status'] : 0,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        try {
            // gunakan query builder untuk menghindari perbedaan primaryKey/timestamps
            \Illuminate\Support\Facades\DB::table('berita')->insert($insert);
        } catch (\Exception $e) {
            // catat error dan kembalikan pesan yang jelas untuk debug
            \Illuminate\Support\Facades\Log::error('Berita store error: ' . $e->getMessage(), ['data' => $insert]);
            return back()->withErrors(['db' => 'Gagal menyimpan berita: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('berita.index')->with('success', 'Berita berhasil disimpan.');
    }
}
