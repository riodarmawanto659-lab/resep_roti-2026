<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori {{ $kategori->nama }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-50 min-h-screen">

    @include('partials.navbar')

    <!-- Header -->
    <section class="max-w-7xl mx-auto px-6 py-12">

        <span class="bg-amber-100 text-amber-700 px-4 py-2 rounded-full">
            Kategori
        </span>

        <h1 class="text-5xl font-bold mt-4">
            {{ $kategori->nama }}
        </h1>

        <p class="text-gray-600 mt-3">
            Menampilkan semua resep dalam kategori ini.
        </p>

    </section>

    <!-- List Resep -->
    <section class="max-w-7xl mx-auto px-6 pb-20">

        @if($reseps->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($reseps as $resep)

                    <a href="{{ route('resep.show', $resep->slug) }}"
                       class="block bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition duration-300">

                        {{-- Gambar --}}
                        @if($resep->gambar)

                            <img
                                src="{{ asset('storage/'.$resep->gambar) }}"
                                alt="{{ $resep->nama }}"
                                class="w-full h-56 object-cover">

                        @else

                            <img
                                src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1200"
                                alt="{{ $resep->nama }}"
                                class="w-full h-56 object-cover">

                        @endif

                        <div class="p-6">

                            <h2 class="text-2xl font-bold">
                                {{ $resep->nama }}
                            </h2>

                            <p class="text-gray-600 mt-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($resep->deskripsi), 100) }}
                            </p>

                            <div class="mt-4 flex gap-4 text-sm text-gray-500">

                                @if($resep->waktu_pembuatan)
                                    <span>
                                        ⏱ {{ $resep->waktu_pembuatan }} menit
                                    </span>
                                @endif

                                @if($resep->porsi)
                                    <span>
                                        🍽 {{ $resep->porsi }} porsi
                                    </span>
                                @endif

                            </div>

                            <div class="mt-6 text-amber-600 font-semibold">
                                Klik untuk melihat detail →
                            </div>

                        </div>

                    </a>

                @endforeach

            </div>

            <div class="mt-10">
                {{ $reseps->links() }}
            </div>

        @else

            <div class="bg-white rounded-3xl shadow p-12 text-center">

                <div class="text-6xl mb-4">
                    📂
                </div>

                <h2 class="text-3xl font-bold">
                    Belum Ada Resep
                </h2>

                <p class="text-gray-500 mt-3">
                    Tidak ada resep dalam kategori ini.
                </p>

            </div>

        @endif

    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">

        <div class="text-center">
            © {{ date('Y') }} Sistem Resep Roti
        </div>

    </footer>

</body>
</html>