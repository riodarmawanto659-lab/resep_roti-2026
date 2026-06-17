<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resep Roti</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    @php
        use Illuminate\Support\Str;
    @endphp
</head>

<body class="bg-amber-50 min-h-screen">

    @include('partials.navbar')

    <!-- Hero -->
    <section class="relative overflow-hidden">

        {{-- Background Hero dari Admin --}}
        @if(isset($pengaturan) && $pengaturan->gambar_hero)

            <div class="absolute inset-0">
                <img
                    src="{{ asset('storage/' . $pengaturan->gambar_hero) }}"
                    alt="Hero"
                    class="w-full h-full object-cover">
            </div>

        @else

            <div class="absolute inset-0 bg-gradient-to-r from-amber-700 via-orange-500 to-yellow-500"></div>

        @endif

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-white/10"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-24 text-white">

            <div class="max-w-2xl">
                <span class="stitch-accent">Sistem Manajemen Resep Roti</span>

                <h1 class="text-4xl lg:text-5xl font-extrabold mt-4 mb-4">
                    {{ $pengaturan?->judul_hero ?? '🍞 Daftar Resep Roti' }}
                </h1>

                <p class="text-lg text-amber-100 mb-6">
                    {{ $pengaturan?->subjudul_hero ?? 'Temukan berbagai resep roti terbaik dan inspirasi bakery modern.' }}
                </p>

                <div class="flex gap-4">
                    <a href="#list" class="btn-bakery px-5 py-3 rounded-full text-white">Jelajahi Resep</a>
                    <a href="#newsletter" class="px-5 py-3 rounded-full border border-white/20">Langganan</a>
                </div>
            </div>

        </div>

    </section>
<!-- Search -->
<section class="max-w-7xl mx-auto px-6 -mt-10 relative z-10">

    <div class="bg-white rounded-3xl shadow-2xl p-6">

        <form action="{{ route('resep.index') }}" method="GET">

            <div class="grid md:grid-cols-4 gap-4">

                {{-- Input Search --}}
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari resep roti..."
                    class="md:col-span-2 border-2 border-amber-100 rounded-2xl px-6 py-4 focus:ring-4 focus:ring-amber-200 focus:border-amber-500">

                {{-- Filter Kategori --}}
                <select
                    name="kategori"
                    class="border-2 border-amber-100 rounded-2xl px-6 py-4 focus:ring-4 focus:ring-amber-200 focus:border-amber-500">

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach($kategori as $item)

                        <option
                            value="{{ $item->id }}"
                            {{ request('kategori') == $item->id ? 'selected' : '' }}>

                            {{ $item->nama }}

                        </option>

                    @endforeach

                </select>

                {{-- Tombol --}}
                <div class="flex gap-3">

                    <button
                        type="submit"
                        class="flex-1 bg-gradient-to-r from-amber-600 to-orange-500 text-white px-6 py-4 rounded-2xl font-bold hover:scale-105 transition">

                        🔍 Cari

                    </button>

                    <a
                        href="{{ route('resep.index') }}"
                        class="bg-gray-100 px-6 py-4 rounded-2xl hover:bg-gray-200 flex items-center justify-center">

                        Reset

                    </a>

                </div>

            </div>

        </form>

        {{-- Info Filter --}}
        @if(request('search') || request('kategori'))

            <div class="mt-4 text-sm text-gray-600">

                Menampilkan hasil

                @if(request('search'))
                    untuk:
                    <span class="font-semibold text-amber-600">
                        "{{ request('search') }}"
                    </span>
                @endif

                @if(request('kategori'))
                    pada kategori yang dipilih
                @endif

            </div>

        @endif

    </div>

</section>

    <!-- Daftar Resep -->
    <section id="list" class="max-w-7xl mx-auto px-6 mt-12 pb-20">

        @if($reseps->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($reseps as $resep)

                    <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 card-tilt">

                        <div class="relative h-64 overflow-hidden">
                            @if($resep->gambar)
                                <img src="{{ asset('storage/' . $resep->gambar) }}" alt="{{ $resep->nama }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1200" alt="Default Roti" class="w-full h-full object-cover">
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                            <div class="absolute left-4 bottom-4 text-white">
                                <h3 class="text-xl font-bold">{{ $resep->nama }}</h3>
                                <div class="text-sm text-white/80">{{ Str::limit(strip_tags($resep->deskripsi), 80) }}</div>
                            </div>

                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 rounded-full text-xs bg-amber-100 text-amber-700">{{ $resep->kategori->nama ?? 'Umum' }}</span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-sm text-gray-500 flex items-center gap-3">
                                    @if($resep->waktu_pembuatan)
                                        <span class="flex items-center gap-2">⏱ <span>{{ $resep->waktu_pembuatan }} m</span></span>
                                    @endif
                                    @if($resep->porsi)
                                        <span class="flex items-center gap-2">🍽 <span>{{ $resep->porsi }} porsi</span></span>
                                    @endif
                                </div>
                                <a href="{{ route('resep.show', $resep->slug) }}" class="text-amber-600 font-semibold">Lihat →</a>
                            </div>

                            <p class="text-sm text-gray-600 mb-4">{{ Str::limit(strip_tags($resep->deskripsi), 120) }}</p>

                            <div class="flex items-center gap-3">
                                <a href="{{ route('resep.show', $resep->slug) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-amber-100 hover:bg-amber-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    Detail
                                </a>
                                <button class="ml-auto text-xs px-3 py-1 rounded-full bg-amber-100 text-amber-700">Simpan</button>
                            </div>
                        </div>

                    </article>

                @endforeach

            </div>

            <!-- Pagination -->
            <div class="mt-12 flex items-center justify-center">
                {{ $reseps->links() }}
            </div>

        @else

            <div class="bg-white p-12 rounded-3xl shadow-lg text-center">

                <div class="text-6xl mb-4">
                    🔍
                </div>

                <h2 class="text-3xl font-bold text-gray-700">
                    Resep Tidak Ditemukan
                </h2>

                <p class="text-gray-500 mt-3">
                    Tidak ada resep yang sesuai dengan pencarian Anda.
                </p>

            </div>

        @endif

    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">

        <div class="text-center">
            © {{ date('Y') }} Sistem Resep Roti - Laravel & Filament
        </div>

    </footer>

</body>
</html>