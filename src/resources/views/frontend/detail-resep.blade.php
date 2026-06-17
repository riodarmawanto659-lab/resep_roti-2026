<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resep->nama }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
</head>

<body class="bg-amber-50 min-h-screen">

    @include('partials.navbar')

    <!-- Main content -->
    <main class="max-w-7xl mx-auto px-6 py-12">

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Left: main article -->
            <article class="lg:col-span-2">
                <div class="bg-white rounded-2xl overflow-hidden shadow-xl">
                    @if($resep->gambar)
                        <img src="{{ asset('storage/'.$resep->gambar) }}" alt="{{ $resep->nama }}" class="w-full h-[520px] object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1600" alt="{{ $resep->nama }}" class="w-full h-[520px] object-cover">
                    @endif

                    <div class="p-10">
                        <div class="flex items-start justify-between gap-6">
                            <div>
                                @if($resep->kategori)
                                    <a href="{{ route('kategori.show', $resep->kategori->slug) }}" class="inline-block bg-amber-100 text-amber-700 px-4 py-2 rounded-full">{{ $resep->kategori->nama }}</a>
                                @endif

                                <h1 class="text-4xl lg:text-5xl font-extrabold mt-4">{{ $resep->nama }}</h1>

                                <div class="mt-4 flex flex-wrap gap-4 text-gray-600">
                                    @if($resep->waktu_pembuatan)
                                        <div class="flex items-center gap-2">⏱ <span class="font-medium">{{ $resep->waktu_pembuatan }} menit</span></div>
                                    @endif
                                    @if($resep->porsi)
                                        <div class="flex items-center gap-2">🍽 <span class="font-medium">{{ $resep->porsi }} porsi</span></div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col items-end gap-3">
                                <button class="btn-bakery px-5 py-2 rounded-full text-white">Simpan Resep</button>
                                <div class="flex gap-2">
                                    <button onclick="navigator.clipboard.writeText(window.location.href)" class="px-3 py-2 rounded-lg bg-gray-100">Salin Link</button>
                                    <a href="javascript:window.print()" class="px-3 py-2 rounded-lg bg-gray-100">Cetak</a>
                                </div>
                            </div>
                        </div>

                        @if($resep->deskripsi)
                            <div class="mt-8 prose max-w-none text-gray-700">{{ $resep->deskripsi }}</div>
                        @endif
                    </div>
                </div>

                <!-- Steps / Cara Pembuatan -->
                <div class="bg-white rounded-2xl shadow-xl mt-8 p-10">
                    <h2 class="text-2xl font-bold mb-6">👨‍🍳 Cara Pembuatan</h2>
                    @if($resep->cara_pembuatan)
                        <div class="prose max-w-none">{!! $resep->cara_pembuatan !!}</div>
                    @else
                        <p class="text-gray-500">Cara pembuatan belum tersedia.</p>
                    @endif
                </div>

                <!-- Related recipes -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">Resep Serupa</h3>
                    <div class="grid md:grid-cols-3 gap-4">
                        @php
                            use App\Models\Resep as ResepModel;
                            $related = ResepModel::where('kategori_id', $resep->kategori_id)->where('id','!=',$resep->id)->take(3)->get();
                        @endphp

                        @foreach($related as $r)
                            <a href="{{ route('resep.show', $r->slug) }}" class="block bg-white rounded-xl shadow p-3 hover:shadow-md transition">
                                <div class="h-36 overflow-hidden rounded-md mb-3">
                                    @if($r->gambar)
                                        <img src="{{ asset('storage/'.$r->gambar) }}" alt="{{ $r->nama }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=900" alt="{{ $r->nama }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="font-semibold">{{ $r->nama }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit(strip_tags($r->deskripsi), 60) }}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </article>

            <!-- Right: sidebar -->
            <aside class="space-y-6">
                <div class="glass-card rounded-2xl p-6">
                    <h4 class="font-semibold mb-3">Bahan</h4>
                    @if($resep->detailReseps->count())
                        <ul class="space-y-2 text-sm">
                            @foreach($resep->detailReseps as $d)
                                <li class="flex justify-between">
                                    <div>{{ $d->bahan?->nama ?? '-' }}</div>
                                    <div class="text-gray-600">{{ $d->jumlah }} {{ $d->bahan?->satuan ?? '' }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-sm">Belum ada bahan terdaftar.</p>
                    @endif
                </div>

                <div class="glass-card rounded-2xl p-6">
                    <h4 class="font-semibold mb-3">Info Resep</h4>
                    <dl class="text-sm text-gray-600 space-y-2">
                        <div class="flex justify-between"><dt>Waktu</dt><dd>{{ $resep->waktu_pembuatan ?? '-' }} menit</dd></div>
                        <div class="flex justify-between"><dt>Porsi</dt><dd>{{ $resep->porsi ?? '-' }}</dd></div>
                        <div class="flex justify-between"><dt>Status</dt><dd>{{ $resep->status ? 'Publik' : 'Draft' }}</dd></div>
                    </dl>
                </div>

                <div class="bg-white rounded-2xl shadow p-4">
                    <h4 class="font-semibold mb-3">Bagikan</h4>
                    <div class="flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="px-3 py-2 rounded-md bg-blue-600 text-white">Facebook</a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="px-3 py-2 rounded-md bg-sky-500 text-white">Twitter</a>
                    </div>
                </div>
            </aside>

        </div>

    </main>

    <!-- (Removed duplicated bottom ingredient and steps sections — content now in main article and sidebar) -->

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">

        <div class="text-center">
            © {{ date('Y') }} Sistem Resep Roti
        </div>

    </footer>

</body>
</html>