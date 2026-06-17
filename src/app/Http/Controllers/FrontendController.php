<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Kategori;
use App\Models\PengaturanWebsite;
use App\Models\Resep;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $pengaturan = PengaturanWebsite::query()->first();

        $totalResep = Resep::published()->count();
        $totalKategori = Kategori::count();
        $totalBahan = Bahan::count();

        $kategori = Kategori::query()
            ->withCount(['reseps' => fn ($query) => $query->published()])
            ->orderBy('nama')
            ->get();

        $reseps = Resep::query()
            ->published()
            ->with('kategori')
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact(
            'pengaturan',
            'totalResep',
            'totalKategori',
            'totalBahan',
            'kategori',
            'reseps'
        ));
    }

    public function resep(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $kategoriId = $request->query('kategori');
        $pengaturan = PengaturanWebsite::query()->first();

        $kategori = Kategori::query()
            ->withCount(['reseps' => fn ($query) => $query->published()])
            ->orderBy('nama')
            ->get();

        $selectedKategori = $kategoriId
            ? Kategori::query()->whereKey($kategoriId)->first()
            : null;

        $reseps = Resep::query()
            ->published()
            ->with('kategori')
            ->search($search)
            ->byKategori($kategoriId)
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('frontend.resep', compact(
            'reseps',
            'pengaturan',
            'kategori',
            'selectedKategori',
            'search'
        ));
    }

    public function detailResep(string $slug)
    {
        $pengaturan = PengaturanWebsite::query()->first();

        $resep = Resep::query()
            ->published()
            ->where('slug', $slug)
            ->with(['kategori', 'detailReseps.bahan'])
            ->firstOrFail();

        $related = Resep::query()
            ->published()
            ->with('kategori')
            ->where('kategori_id', $resep->kategori_id)
            ->whereKeyNot($resep->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.detail-resep', compact('pengaturan', 'resep', 'related'));
    }

    public function kategori(string $slug)
    {
        $pengaturan = PengaturanWebsite::query()->first();

        $kategori = Kategori::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $reseps = $kategori->reseps()
            ->published()
            ->with('kategori')
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('frontend.kategori', compact('pengaturan', 'kategori', 'reseps'));
    }
}
