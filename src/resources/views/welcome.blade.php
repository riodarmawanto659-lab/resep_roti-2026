@extends('layouts.frontend')

@section('title', 'Beranda')
@section('description', 'Roti Mix membantu menyimpan resep roti, bahan, kategori, dan langkah pembuatan secara rapi dengan tampilan bakery modern.')

@section('content')
<section class="relative isolate overflow-hidden px-5 pb-16 pt-16 lg:px-8 lg:pb-24 lg:pt-20">
    <div class="hero-blob left-[-10rem] top-12 bg-bread-200/60"></div>
    <div class="hero-blob right-[-9rem] top-36 bg-caramel/20"></div>

    <div class="mx-auto grid max-w-7xl items-center gap-12 lg:grid-cols-[1.05fr_.95fr]">
        <div class="reveal" data-reveal>
            <span class="eyebrow">Sistem Manajemen Bakery</span>
            <h1 class="mt-6 max-w-4xl font-display text-5xl font-black leading-[1.02] tracking-tight text-bread-900 md:text-6xl xl:text-7xl">
                Racik resep roti dengan alur yang lebih <span class="gradient-text">rapi, hangat, dan modern.</span>
            </h1>
            <p class="mt-6 max-w-2xl text-base leading-8 text-bread-800/75 md:text-lg">
                Kelola resep, bahan, kategori, takaran, porsi, dan waktu pembuatan dalam satu website. Tema warna cream, karamel, dan cokelat dibuat agar terasa sesuai dengan karakter roti mix yang hangat.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('resep.index') }}" class="btn-bakery px-6 py-3 text-center">Jelajahi Resep</a>
                <a href="#stats" class="btn-outline-bakery px-6 py-3 text-center">Lihat Statistik</a>
            </div>

            <div class="mt-10 grid max-w-xl grid-cols-3 gap-3" id="stats">
                <div class="stat-card">
                    <div class="counter text-3xl font-black" data-target="{{ $totalResep ?? 0 }}">0</div>
                    <div class="mt-1 text-xs font-semibold uppercase tracking-[.2em] text-bread-700/60">Resep</div>
                </div>
                <div class="stat-card">
                    <div class="counter text-3xl font-black" data-target="{{ $totalKategori ?? 0 }}">0</div>
                    <div class="mt-1 text-xs font-semibold uppercase tracking-[.2em] text-bread-700/60">Kategori</div>
                </div>
                <div class="stat-card">
                    <div class="counter text-3xl font-black" data-target="{{ $totalBahan ?? 0 }}">0</div>
                    <div class="mt-1 text-xs font-semibold uppercase tracking-[.2em] text-bread-700/60">Bahan</div>
                </div>
            </div>
        </div>

        <div class="relative reveal" data-reveal data-parallax="0.06">
            <div class="hero-card">
                <img src="{{ asset('front/img/bakery-hero.svg') }}" alt="Ilustrasi roti mix" class="h-full w-full rounded-[2rem] object-cover">
                <div class="absolute left-5 top-5 rounded-2xl bg-white/85 px-4 py-3 shadow-soft backdrop-blur">
                    <div class="text-xs font-bold uppercase tracking-[.18em] text-bread-600">Fresh Recipe</div>
                    <div class="mt-1 text-2xl font-black text-bread-900">{{ $totalResep ?? 0 }}+</div>
                </div>
                <div class="absolute bottom-5 right-5 max-w-[13rem] rounded-2xl bg-bread-900/90 px-4 py-3 text-white shadow-bakery backdrop-blur">
                    <div class="text-sm font-bold">Workflow lebih jelas</div>
                    <div class="mt-1 text-xs leading-5 text-white/70">Cari resep → lihat bahan → ikuti langkah → simpan favorit.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="px-5 py-14 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <span class="eyebrow">Kategori Resep</span>
                <h2 class="mt-3 font-display text-4xl font-black text-bread-900">Pilih resep sesuai kebutuhan produksi</h2>
            </div>
            <a href="{{ route('resep.index') }}" class="text-sm font-bold text-caramel hover:text-bread-700">Lihat semua resep →</a>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @forelse($kategori as $item)
                <a href="{{ route('kategori.show', $item->slug) }}" class="category-card reveal" data-reveal>
                    <span class="category-icon">🥐</span>
                    <h3 class="mt-4 text-xl font-black text-bread-900">{{ $item->nama }}</h3>
                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-bread-700/70">{{ $item->deskripsi ?: 'Kumpulan resep bakery yang mudah diikuti.' }}</p>
                    <div class="mt-5 text-sm font-bold text-caramel">{{ $item->reseps_count ?? 0 }} resep →</div>
                </a>
            @empty
                <div class="empty-state sm:col-span-2 lg:col-span-4">Belum ada kategori resep.</div>
            @endforelse
        </div>
    </div>
</section>

<section class="px-5 py-14 lg:px-8">
    <div class="mx-auto max-w-7xl rounded-[2rem] bg-bread-900 p-6 text-white shadow-bakery md:p-10">
        <div class="grid gap-8 lg:grid-cols-[.9fr_1.1fr] lg:items-center">
            <div class="reveal" data-reveal>
                <span class="eyebrow-dark">Alur Sistem</span>
                <h2 class="mt-3 font-display text-4xl font-black">Dari ide resep sampai siap dipanggang.</h2>
                <p class="mt-4 leading-8 text-bread-100/75">Website dirapikan agar pengguna tidak bingung: mulai dari mencari resep, memilih kategori, membaca bahan, lalu mengikuti langkah pembuatan dengan urutan yang jelas.</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="workflow-card reveal" data-reveal><span>01</span><strong>Cari Resep</strong><p>Gunakan keyword dan filter kategori.</p></div>
                <div class="workflow-card reveal" data-reveal><span>02</span><strong>Cek Takaran</strong><p>Bahan tampil di sidebar detail resep.</p></div>
                <div class="workflow-card reveal" data-reveal><span>03</span><strong>Ikuti Langkah</strong><p>Cara pembuatan dibuat lebih mudah dibaca.</p></div>
                <div class="workflow-card reveal" data-reveal><span>04</span><strong>Simpan Favorit</strong><p>Resep bisa disimpan di browser pengguna.</p></div>
            </div>
        </div>
    </div>
</section>

<section class="px-5 py-14 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <span class="eyebrow">Resep Terbaru</span>
                <h2 class="mt-3 font-display text-4xl font-black text-bread-900">Inspirasi roti pilihan</h2>
            </div>
            <a href="{{ route('resep.index') }}" class="btn-outline-bakery px-5 py-3 text-sm">Buka katalog resep</a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($reseps as $resep)
                @include('partials.recipe-card', ['resep' => $resep])
            @empty
                <div class="empty-state md:col-span-2 lg:col-span-3">Belum ada resep yang dipublikasikan.</div>
            @endforelse
        </div>
    </div>
</section>

<section class="px-5 pb-20 pt-8 lg:px-8">
    <div class="mx-auto max-w-5xl overflow-hidden rounded-[2rem] bg-gradient-to-br from-bread-100 via-cream to-bread-200 p-8 shadow-soft md:p-12 reveal" data-reveal>
        <div class="grid gap-6 md:grid-cols-[1fr_auto] md:items-center">
            <div>
                <span class="eyebrow">Mulai Baking</span>
                <h2 class="mt-3 font-display text-4xl font-black text-bread-900">Siap menemukan resep roti yang cocok?</h2>
                <p class="mt-4 leading-8 text-bread-800/70">Gunakan pencarian untuk menemukan resep berdasarkan nama, deskripsi, atau kategori. Tampilan baru dibuat lebih cepat dipahami dan nyaman digunakan.</p>
            </div>
            <a href="{{ route('resep.index') }}" class="btn-bakery px-7 py-4 text-center">Cari Sekarang</a>
        </div>
    </div>
</section>
@endsection
