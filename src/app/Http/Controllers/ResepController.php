public function index()
{
    $search = request('search');

    $reseps = Resep::with('kategori')
        ->when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(6)
        ->withQueryString();

    return view('resep.index', compact('reseps'));
}