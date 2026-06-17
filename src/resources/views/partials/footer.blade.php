@php
    $site = $pengaturan ?? null;
    $siteName = $site?->nama_website ?: 'Roti Mix';
    $navKategori = $navKategori ?? collect();
@endphp

<footer id="kontak" class="footer-bakery">
    <div class="mx-auto grid max-w-7xl gap-10 px-5 py-14 md:grid-cols-2 lg:grid-cols-4 lg:px-8">
        <div class="lg:col-span-2">
            <div class="flex items-center gap-3">
                <span class="brand-mark">🍞</span>
                <div>
                    <div class="text-xl font-black text-white">{{ $siteName }}</div>
                    <div class="text-sm text-bread-100/70">Recipe management for better baking</div>
                </div>
            </div>
            <p class="mt-5 max-w-xl text-sm leading-7 text-bread-100/75">
                {{ $site?->tentang_kami ?: 'Website resep roti dengan tampilan hangat, data resep yang terstruktur, bahan yang mudah dibaca, dan alur pencarian yang sederhana.' }}
            </p>
        </div>

        <div>
            <h3 class="footer-title">Navigasi</h3>
            <ul class="mt-4 space-y-3 text-sm text-bread-100/75">
                <li><a href="{{ url('/') }}" class="footer-link">Beranda</a></li>
                <li><a href="{{ route('resep.index') }}" class="footer-link">Semua Resep</a></li>
                @foreach($navKategori->take(4) as $kategori)
                    <li><a href="{{ route('kategori.show', $kategori->slug) }}" class="footer-link">{{ $kategori->nama }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="footer-title">Kontak</h3>
            <ul class="mt-4 space-y-3 text-sm text-bread-100/75">
                <li>{{ $site?->email ?: 'admin@rotimix.local' }}</li>
                <li>{{ $site?->telepon ?: '+62 812-3456-7890' }}</li>
                <li>{{ $site?->alamat ?: 'Indonesia' }}</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10 px-5 py-5 text-center text-xs text-bread-100/60">
        © {{ date('Y') }} {{ $siteName }}. Dibuat untuk manajemen resep roti yang rapi dan modern.
    </div>
</footer>
