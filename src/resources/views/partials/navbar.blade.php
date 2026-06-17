@php
    use App\Models\Kategori as KategoriModel;

    $site = $pengaturan ?? null;
    $siteName = $site?->nama_website ?: 'Roti Mix';
    $navKategori = $navKategori ?? KategoriModel::orderBy('nama')->take(5)->get();
@endphp

<header id="siteHeader" class="site-header">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
        <a href="{{ url('/') }}" class="brand-link" aria-label="Beranda {{ $siteName }}">
            <span class="brand-mark">🍞</span>
            <span class="leading-tight">
                <span class="block text-base font-black tracking-tight text-bread-900 md:text-lg">{{ $siteName }}</span>
                <span class="hidden text-xs font-medium text-bread-600 sm:block">Resep, bahan, dan proses bakery</span>
            </span>
        </a>

        <nav class="hidden items-center gap-1 lg:flex" aria-label="Navigasi utama">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('resep.index') }}" class="nav-link {{ request()->routeIs('resep.*') ? 'active' : '' }}">Semua Resep</a>
            @foreach($navKategori as $k)
                <a href="{{ route('kategori.show', $k->slug) }}" class="nav-link {{ request()->is('kategori/'.$k->slug) ? 'active' : '' }}">{{ $k->nama }}</a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <a href="{{ route('resep.index') }}?search=" class="btn-outline-bakery px-4 py-2 text-sm">Cari Resep</a>
            <a href="#kontak" class="btn-bakery px-4 py-2 text-sm">Kontak</a>
        </div>

        <button id="mobileMenuBtn" type="button" class="mobile-menu-button lg:hidden" aria-expanded="false" aria-controls="mobileMenu" aria-label="Buka menu navigasi">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div id="mobileMenu" class="mobile-menu hidden lg:hidden">
        <div class="mx-auto max-w-7xl space-y-2 px-5 pb-5">
            <a href="{{ url('/') }}" class="mobile-nav-link">Beranda</a>
            <a href="{{ route('resep.index') }}" class="mobile-nav-link">Semua Resep</a>
            @foreach($navKategori as $k)
                <a href="{{ route('kategori.show', $k->slug) }}" class="mobile-nav-link">{{ $k->nama }}</a>
            @endforeach
            <a href="#kontak" class="btn-bakery mt-3 block px-5 py-3 text-center">Kontak Bakery</a>
        </div>
    </div>
</header>
