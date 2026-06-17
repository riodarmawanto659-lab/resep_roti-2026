@extends('layouts.frontend')

@section('title', 'Daftar Resep')
@section('description', 'Cari daftar resep roti berdasarkan nama resep, deskripsi, dan kategori.')

@section('content')
<section class="relative overflow-hidden px-5 py-16 lg:px-8 lg:py-20">
    <div class="hero-blob left-[-8rem] top-10 bg-bread-200/60"></div>
    <div class="mx-auto max-w-7xl">
        <div class="max-w-3xl reveal" data-reveal>
            <span class="eyebrow">Katalog Resep</span>
            <h1 class="mt-5 font-display text-5xl font-black leading-tight text-bread-900 md:text-6xl">
                Temukan resep roti yang paling pas untuk dibuat.
            </h1>
            <p class="mt-5 text-lg leading-8 text-bread-800/70">
                Cari berdasarkan nama resep, deskripsi, atau pilih kategori agar proses menemukan resep menjadi lebih cepat dan jelas.
            </p>
        </div>
    </div>
</section>

<section class="relative z-10 -mt-6 px-5 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <form action="{{ route('resep.index') }}" method="GET" class="search-panel reveal" data-reveal>
            <div class="grid gap-4 lg:grid-cols-[1.4fr_.8fr_auto_auto]">
                <label class="sr-only" for="search">Cari resep</label>
                <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="Cari contoh: roti sobek, donat, pastry..." class="bakery-input">

                <label class="sr-only" for="kategori">Kategori</label>
                <select id="kategori" name="kategori" class="bakery-input">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}" @selected((string) request('kategori') === (string) $item->id)>{{ $item->nama }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn-bakery px-6 py-3">Cari</button>
                <a href="{{ route('resep.index') }}" class="btn-outline-bakery px-6 py-3 text-center">Reset</a>
            </div>

            @if(request('search') || request('kategori'))
                <div class="mt-5 flex flex-wrap gap-2 text-sm text-bread-700/80">
                    <span class="meta-pill">Menampilkan hasil filter</span>
                    @if(request('search'))
                        <span class="meta-pill">Keyword: “{{ request('search') }}”</span>
                    @endif
                    @if(isset($selectedKategori) && $selectedKategori)
                        <span class="meta-pill">Kategori: {{ $selectedKategori->nama }}</span>
                    @endif
                </div>
            @endif
        </form>
    </div>
</section>

<section id="list" class="px-5 py-14 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <span class="eyebrow">Hasil Resep</span>
                <h2 class="mt-3 font-display text-4xl font-black text-bread-900">
                    {{ $reseps->total() }} resep ditemukan
                </h2>
            </div>
            <p class="max-w-md text-sm leading-6 text-bread-700/70">Klik kartu resep untuk melihat bahan, porsi, waktu, dan langkah pembuatan lengkap.</p>
        </div>

        @if($reseps->count())
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($reseps as $resep)
                    @include('partials.recipe-card', ['resep' => $resep])
                @endforeach
            </div>

            <div class="pagination-wrap mt-12">
                {{ $reseps->links() }}
            </div>
        @else
            <div class="empty-state reveal" data-reveal>
                <div class="text-6xl">🔍</div>
                <h3 class="mt-4 text-2xl font-black text-bread-900">Resep tidak ditemukan</h3>
                <p class="mt-3 text-bread-700/70">Coba gunakan kata kunci yang lebih umum atau hapus filter kategori.</p>
                <a href="{{ route('resep.index') }}" class="btn-bakery mt-6 inline-block px-6 py-3">Lihat Semua Resep</a>
            </div>
        @endif
    </div>
</section>
@endsection
