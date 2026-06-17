@php
    $site = $pengaturan ?? null;
    $siteName = $site?->nama_website ?: 'Roti Mix';
    $defaultDescription = 'Kumpulan resep roti, bahan, takaran, dan langkah pembuatan yang rapi untuk kebutuhan bakery rumahan maupun UMKM.';
@endphp
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', $defaultDescription)">
    <title>@hasSection('title') @yield('title') · {{ $siteName }} @else {{ $siteName }} @endif</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Fraunces:wght@600;700;800;900&display=swap" rel="stylesheet">

    <script>
        window.tailwind = window.tailwind || {};
        window.tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bread: {
                            50: '#fff8ed',
                            100: '#ffeed2',
                            200: '#f8d49a',
                            300: '#efb765',
                            400: '#d98a36',
                            500: '#b96123',
                            600: '#8d3f18',
                            700: '#5f2815',
                            800: '#3d1a10',
                            900: '#25110b',
                        },
                        cream: '#fffaf1',
                        chocolate: '#3d2415',
                        caramel: '#c76b2a',
                    },
                    boxShadow: {
                        bakery: '0 24px 70px rgba(99, 54, 18, .16)',
                        soft: '0 18px 50px rgba(90, 46, 13, .10)',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui'],
                        display: ['Fraunces', 'serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    @stack('styles')
</head>
<body class="min-h-screen bg-bakery text-bread-900 antialiased selection:bg-bread-200 selection:text-bread-900">
    <div class="mouse-glow" aria-hidden="true"></div>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <button type="button" id="backToTop" class="back-to-top" aria-label="Kembali ke atas">↑</button>
    <script src="{{ asset('front/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
