@php
    use Illuminate\Support\Str;
    $image = $resep->gambar ? asset('storage/'.$resep->gambar) : asset('front/img/recipe-placeholder.svg');
@endphp

<article class="recipe-card reveal" data-reveal>
    <a href="{{ route('resep.show', $resep->slug) }}" class="block overflow-hidden rounded-[1.6rem]">
        <div class="relative h-60 overflow-hidden bg-bread-100">
            <img src="{{ $image }}" alt="{{ $resep->nama }}" class="h-full w-full object-cover transition duration-700 hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-bread-900/75 via-bread-900/10 to-transparent"></div>
            <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                <span class="chip-light">{{ $resep->kategori?->nama ?? 'Umum' }}</span>
            </div>
            <button type="button" class="js-save-recipe save-button" data-recipe="{{ $resep->id }}" aria-label="Simpan resep {{ $resep->nama }}">♡</button>
            <div class="absolute bottom-4 left-4 right-4 text-white">
                <h3 class="text-xl font-black leading-snug">{{ $resep->nama }}</h3>
                <p class="mt-1 line-clamp-2 text-sm text-white/80">{{ Str::limit(strip_tags($resep->deskripsi), 90) }}</p>
            </div>
        </div>
    </a>

    <div class="p-5">
        <div class="mb-4 flex flex-wrap gap-2 text-xs font-semibold text-bread-700">
            @if($resep->waktu_pembuatan)
                <span class="meta-pill">⏱ {{ $resep->waktu_pembuatan }} menit</span>
            @endif
            @if($resep->porsi)
                <span class="meta-pill">🍽 {{ $resep->porsi }} porsi</span>
            @endif
            <span class="meta-pill">📌 {{ $resep->created_at?->format('d M Y') }}</span>
        </div>
        <p class="line-clamp-3 text-sm leading-7 text-bread-800/70">{{ Str::limit(strip_tags($resep->deskripsi), 130) }}</p>
        <div class="mt-5 flex items-center justify-between gap-3">
            <a href="{{ route('resep.show', $resep->slug) }}" class="btn-outline-bakery px-4 py-2 text-sm">Lihat Detail</a>
            <span class="text-sm font-bold text-caramel">→</span>
        </div>
    </div>
</article>
