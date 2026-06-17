@php
    use App\Models\Kategori as KategoriModel;

    // Use passed $kategori if available, otherwise fetch a small set
    $_navKategori = $kategori ?? KategoriModel::orderBy('nama')->take(6)->get();
@endphp

<header class="sticky top-0 z-50 bg-white/60 backdrop-blur-sm border-b">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-400 flex items-center justify-center text-white font-bold shadow-md transition-transform group-hover:scale-105">🍞</div>
            <div>
                <div class="text-lg font-semibold text-amber-800">Sistem Resep Roti</div>
                <div class="text-xs text-gray-500">Manajemen resep & produksi</div>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-6">
            <a href="{{ route('resep.index') }}" class="nav-link">Semua Resep</a>
            @foreach($_navKategori as $k)
                <a href="{{ route('kategori.show', $k->slug) }}" class="nav-link">{{ $k->nama }}</a>
            @endforeach
            <a href="#newsletter" class="cta-button">Gabung</a>
        </nav>

        <div class="md:hidden flex items-center gap-2">
            <button id="mobileMenuBtn" aria-expanded="false" aria-controls="mobileMenu" class="p-2 rounded-md bg-white/40 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="md:hidden hidden bg-white/95 border-t">
        <div class="px-4 py-4 space-y-2">
            <a href="{{ route('resep.index') }}" class="block px-3 py-2 rounded-md nav-link">Semua Resep</a>
            @foreach($_navKategori as $k)
                <a href="{{ route('kategori.show', $k->slug) }}" class="block px-3 py-2 rounded-md nav-link">{{ $k->nama }}</a>
            @endforeach
            <a href="#newsletter" class="block mt-2 px-3 py-2 rounded-md cta-button text-center">Gabung</a>
        </div>
    </div>
</header>
