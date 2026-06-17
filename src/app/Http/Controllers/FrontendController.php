<?php

namespace App\Http\Controllers;

use App\Models\PengaturanWebsite;
use App\Models\Resep;
use App\Models\Kategori;
use App\Models\Bahan;
class FrontendController extends Controller
{
    public function home()
    {
        $totalResep = Resep::count();
        $totalKategori = Kategori::count();
        $totalBahan = Bahan::count();

        $kategori = Kategori::latest()->get();

        $reseps = Resep::latest()
            ->take(6)
            ->get();

        return view('welcome', compact(
            'totalResep',
            'totalKategori',
            'totalBahan',
            'kategori',
            'reseps'
        ));
    }

   public function resep()
{
    $search = request('search');
    $kategoriId = request('kategori');

    $pengaturan = PengaturanWebsite::first();

    $reseps = Resep::with('kategori')

        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        })

        ->when($kategoriId, function ($query) use ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        })

        ->latest()
        ->paginate(6)
        ->withQueryString();

    $kategori = Kategori::orderBy('nama')->get();

    return view('frontend.resep', compact(
        'reseps',
        'pengaturan',
        'kategori'
    ));
}
    public function detailResep($slug)
{
    $resep = Resep::where('slug', $slug)
                ->with([
                    'kategori',
                    'detailReseps.bahan'
                ])
                ->firstOrFail();

    return view('frontend.detail-resep', compact('resep'));
}
    public function kategori($slug)
    {
        $kategori = Kategori::where('slug', $slug)
                        ->firstOrFail();

        $reseps = Resep::where('kategori_id', $kategori->id)
                    ->paginate(12);

        return view(
            'frontend.kategori',
            compact('kategori', 'reseps')
        );
    }
}