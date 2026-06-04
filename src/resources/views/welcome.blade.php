<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Resep Roti</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
</head>
<body class="bg-bakery">

    <!-- Loader -->
    <div class="loader">
        <div class="text-6xl animate-bounce">
            🍞
        </div>
    </div>

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 backdrop-blur bg-white/80 border-b transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-amber-700">
                🍞 Sistem Resep Roti
            </h1>

            <a href="{{ route('filament.admin.auth.login') }}"
               class="btn-bakery px-6 py-3 rounded-xl font-semibold pulse-soft">
                Login Admin
            </a>

        </div>
    </nav>

    <!-- Hero -->
    <section class="max-w-7xl mx-auto px-6 py-24 relative overflow-hidden">

        <div class="absolute -top-40 -left-40 w-96 h-96 bg-amber-200 rounded-full blur-3xl opacity-30"></div>

        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-orange-300 rounded-full blur-3xl opacity-30"></div>

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div>

                <span class="glass px-4 py-2 rounded-full text-sm font-semibold text-amber-800">
                    Sistem Manajemen Resep Bakery
                </span>

                <h1 class="hero-title mt-6 text-5xl lg:text-7xl font-extrabold leading-tight">
                    Kelola Resep Roti
                    <span class="gradient-text">
                        Lebih Mudah
                    </span>
                    dan Profesional
                </h1>

                <p class="mt-8 text-lg text-gray-600 leading-relaxed">
                    Simpan resep, kelola bahan baku, dan hitung kebutuhan produksi
                    dengan cepat dan akurat melalui satu sistem yang terintegrasi.
                </p>

                <div class="mt-10 flex gap-4">

                    <a href="{{ route('filament.admin.auth.login') }}"
                       class="btn-bakery px-8 py-4 rounded-xl font-semibold">
                        Masuk Dashboard
                    </a>

                </div>

            </div>

            <div>

                <img
                    src="https://images.unsplash.com/photo-1608198093002-ad4e005484ec?w=1200"
                    alt="Bakery"
                    class="hero-image float rounded-3xl shadow-2xl w-full h-[550px] object-cover">

            </div>

        </div>

    </section>

    <!-- Statistik -->
    <section class="reveal max-w-6xl mx-auto px-6 pb-20">

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <h3 class="counter text-5xl" data-target="50">
                    0
                </h3>

                <p class="mt-3 text-gray-600">
                    Resep Roti
                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <h3 class="counter text-5xl" data-target="200">
                    0
                </h3>

                <p class="mt-3 text-gray-600">
                    Data Bahan
                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 text-center">

                <h3 class="counter text-5xl" data-target="1000">
                    0
                </h3>

                <p class="mt-3 text-gray-600">
                    Produksi Tercatat
                </p>

            </div>

        </div>

    </section>

    <!-- Fitur -->
    <section class="reveal bg-white py-24">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">

                <h2 class="text-5xl font-bold">
                    Fitur Utama
                </h2>

                <p class="text-gray-600 mt-4">
                    Solusi lengkap untuk pengelolaan resep dan produksi roti.
                </p>

            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="feature-card p-8 rounded-3xl border bg-white">

                    <div class="text-5xl mb-4">
                        📖
                    </div>

                    <h3 class="font-bold text-xl mb-3">
                        Manajemen Resep
                    </h3>

                    <p class="text-gray-600">
                        Simpan berbagai resep roti secara terstruktur dan mudah dicari.
                    </p>

                </div>

                <div class="feature-card p-8 rounded-3xl border bg-white">

                    <div class="text-5xl mb-4">
                        🥖
                    </div>

                    <h3 class="font-bold text-xl mb-3">
                        Data Bahan
                    </h3>

                    <p class="text-gray-600">
                        Kelola bahan baku, satuan, dan kebutuhan produksi.
                    </p>

                </div>

                <div class="feature-card p-8 rounded-3xl border bg-white">

                    <div class="text-5xl mb-4">
                        📊
                    </div>

                    <h3 class="font-bold text-xl mb-3">
                        Perhitungan Produksi
                    </h3>

                    <p class="text-gray-600">
                        Hitung kebutuhan bahan berdasarkan jumlah produksi.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- Resep -->
    <section class="reveal py-24">

        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <div class="bg-amber-600 text-white p-8">

                    <h2 class="text-3xl font-bold">
                        Resep Unggulan
                    </h2>

                    <p class="text-amber-100 mt-2">
                        Roti Manis Premium
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- Manfaat -->
    <section class="reveal bg-white py-24">

        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-16">

                <h2 class="text-5xl font-bold">
                    Mengapa Menggunakan Sistem Ini?
                </h2>

            </div>

            <div class="grid md:grid-cols-2 gap-8">

                <div class="feature-card p-8 rounded-3xl border bg-amber-50">
                    <h3 class="font-bold text-xl mb-3">
                        ✅ Resep Lebih Terorganisir
                    </h3>

                    <p class="text-gray-600">
                        Semua resep tersimpan dalam satu sistem dan mudah ditemukan.
                    </p>
                </div>

                <div class="feature-card p-8 rounded-3xl border bg-amber-50">
                    <h3 class="font-bold text-xl mb-3">
                        ✅ Mengurangi Kesalahan Produksi
                    </h3>

                    <p class="text-gray-600">
                        Takaran bahan dapat dihitung otomatis sesuai kebutuhan.
                    </p>
                </div>

                <div class="feature-card p-8 rounded-3xl border bg-amber-50">
                    <h3 class="font-bold text-xl mb-3">
                        ✅ Pengelolaan Bahan Baku
                    </h3>

                    <p class="text-gray-600">
                        Memudahkan pemantauan penggunaan bahan pada setiap resep.
                    </p>
                </div>

                <div class="feature-card p-8 rounded-3xl border bg-amber-50">
                    <h3 class="font-bold text-xl mb-3">
                        ✅ Cocok Untuk UMKM
                    </h3>

                    <p class="text-gray-600">
                        Membantu usaha bakery mengelola produksi secara profesional.
                    </p>
                </div>

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="reveal py-24">

        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-amber-700 rounded-3xl p-12 text-center text-white">

                <h2 class="text-5xl font-bold mb-4">
                    Siap Mengelola Resep Roti?
                </h2>

                <p class="text-amber-100 mb-8">
                    Mulai kelola resep dan bahan baku dengan lebih mudah.
                </p>

                <a href="{{ route('filament.admin.auth.login') }}"
                   class="bg-white text-amber-700 px-8 py-4 rounded-xl font-bold inline-block">
                    Login Sekarang
                </a>

            </div>

        </div>

    </section>

    <!-- Mouse Glow -->
    <div class="mouse-glow fixed w-40 h-40 rounded-full blur-3xl opacity-20 bg-amber-400 pointer-events-none">
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8">

        <div class="text-center">
            © {{ date('Y') }} Sistem Resep Roti | Laravel + Filament V3
        </div>

    </footer>

    <script src="{{ asset('front/js/app.js') }}"></script>

</body>
</html> s