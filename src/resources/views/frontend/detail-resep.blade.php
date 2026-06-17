@extends('layouts.frontend')

@section('title', $resep->nama)
@section('description', \Illuminate\Support\Str::limit(strip_tags((string) $resep->deskripsi), 150))

@section('content')
@php
    use Illuminate\Support\Str;

    $image = $resep->gambar ? asset('storage/'.$resep->gambar) : asset('front/img/recipe-placeholder.svg');
    $caraPlain = trim(strip_tags((string) $resep->cara_pembuatan));
    $steps = collect(preg_split('/\r\n|\r|\n/', $caraPlain))
        ->map(fn ($step) => trim(preg_replace('/^\d+[\.)\-\s]+/', '', $step)))
        ->filter()
        ->values();
@endphp

<section class="relative overflow-hidden px-5 py-10 lg:px-8 lg:py-16">
    <div class="mx-auto max-w-7xl">
        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('resep.index') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-bold text-caramel hover:text-bread-700">← Kembali</a>

        <div class="grid gap-8 lg:grid-cols-[1.05fr_.95fr] lg:items-center">
            <div class="reveal" data-reveal>
                @if($resep->kategori)
                    <a href="{{ route('kategori.show', $resep->kategori->slug) }}" class="eyebrow">{{ $resep->kategori->nama }}</a>
                @else
                    <span class="eyebrow">Resep Roti</span>
                @endif
                <h1 class="mt-5 font-display text-5xl font-black leading-tight text-bread-900 md:text-6xl">{{ $resep->nama }}</h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-bread-800/70">{{ $resep->deskripsi ?: 'Resep roti dengan bahan dan cara pembuatan yang mudah diikuti.' }}</p>

                <div class="mt-7 flex flex-wrap gap-3">
                    @if($resep->waktu_pembuatan)
                        <span class="meta-pill">⏱ {{ $resep->waktu_pembuatan }} menit</span>
                    @endif
                    @if($resep->porsi)
                        <span class="meta-pill">🍽 {{ $resep->porsi }} porsi</span>
                    @endif
                    <span class="meta-pill">📌 Dipublikasikan</span>
                </div>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <button type="button" class="btn-bakery js-save-recipe px-6 py-3" data-recipe="{{ $resep->id }}">♡ Simpan Resep</button>
                    <button type="button" class="btn-outline-bakery js-copy-link px-6 py-3">Salin Link</button>
                    <button type="button" onclick="window.print()" class="btn-outline-bakery px-6 py-3">Cetak</button>
                </div>
            </div>

            <div class="relative reveal" data-reveal data-parallax="0.04">
                <div class="detail-image-wrap">
                    <img src="{{ $image }}" alt="{{ $resep->nama }}" class="h-[28rem] w-full rounded-[2rem] object-cover shadow-bakery">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="px-5 pb-16 lg:px-8">
    <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-[1fr_22rem]">
        <article class="space-y-8">
            <div class="content-card reveal" data-reveal>
                <div class="mb-6 flex items-center gap-3">
                    <span class="section-icon">👨‍🍳</span>
                    <div>
                        <span class="eyebrow">Step by Step</span>
                        <h2 class="mt-1 font-display text-3xl font-black text-bread-900">Cara Pembuatan</h2>
                    </div>
                </div>

                @if($steps->count() > 1)
                    <ol class="space-y-4">
                        @foreach($steps as $index => $step)
                            <li class="step-item">
                                <span>{{ $index + 1 }}</span>
                                <p>{{ $step }}</p>
                            </li>
                        @endforeach
                    </ol>
                @elseif($steps->count() === 1)
                    <p class="leading-8 text-bread-800/75">{{ $steps->first() }}</p>
                @else
                    <p class="leading-8 text-bread-800/60">Cara pembuatan belum tersedia.</p>
                @endif
            </div>

            <div class="content-card reveal" data-reveal>
                <div class="mb-6 flex items-center gap-3">
                    <span class="section-icon">💡</span>
                    <div>
                        <span class="eyebrow">Catatan Produksi</span>
                        <h2 class="mt-1 font-display text-3xl font-black text-bread-900">Tips Membaca Resep</h2>
                    </div>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    <div class="tip-card"><strong>Siapkan bahan</strong><p>Timbang bahan sebelum mulai agar proses lebih cepat.</p></div>
                    <div class="tip-card"><strong>Ikuti urutan</strong><p>Jangan melewati proses fermentasi atau resting adonan.</p></div>
                    <div class="tip-card"><strong>Catat hasil</strong><p>Simpan perubahan takaran untuk produksi berikutnya.</p></div>
                </div>
            </div>

            @if(isset($related) && $related->count())
                <div class="reveal" data-reveal>
                    <div class="mb-6 flex items-end justify-between gap-4">
                        <div>
                            <span class="eyebrow">Resep Serupa</span>
                            <h2 class="mt-2 font-display text-3xl font-black text-bread-900">Masih dalam kategori yang sama</h2>
                        </div>
                    </div>
                    <div class="grid gap-6 md:grid-cols-3">
                        @foreach($related as $item)
                            @include('partials.recipe-card', ['resep' => $item])
                        @endforeach
                    </div>
                </div>
            @endif
        </article>

        <aside class="space-y-6 lg:sticky lg:top-28 lg:self-start">
            <div class="content-card reveal" data-reveal>
                <div class="mb-5 flex items-center justify-between gap-3">
                    <h3 class="font-display text-2xl font-black text-bread-900">Bahan</h3>
                    <span class="chip-light">{{ $resep->detailReseps->count() }} item</span>
                </div>

                @if($resep->detailReseps->count())
                    <ul class="space-y-3">
                        @foreach($resep->detailReseps as $detail)
                            <li class="ingredient-item">
                                <span>{{ $detail->bahan?->nama ?? '-' }}</span>
                                <strong>{{ $detail->jumlah }} {{ $detail->bahan?->satuan ?? '' }}</strong>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm leading-6 text-bread-800/60">Belum ada bahan terdaftar untuk resep ini.</p>
                @endif
            </div>

            <div class="content-card reveal" data-reveal>
                <h3 class="font-display text-2xl font-black text-bread-900">Info Resep</h3>
                <dl class="mt-5 space-y-3 text-sm">
                    <div class="info-row"><dt>Waktu</dt><dd>{{ $resep->waktu_pembuatan ? $resep->waktu_pembuatan.' menit' : '-' }}</dd></div>
                    <div class="info-row"><dt>Porsi</dt><dd>{{ $resep->porsi ?: '-' }}</dd></div>
                    <div class="info-row"><dt>Kategori</dt><dd>{{ $resep->kategori?->nama ?? '-' }}</dd></div>
                    <div class="info-row"><dt>Status</dt><dd>{{ $resep->status ? 'Publik' : 'Draft' }}</dd></div>
                </dl>
            </div>
        </aside>
    </div>
</section>
@endsection
