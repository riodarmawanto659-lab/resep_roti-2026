<!doctype html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Sistem Resep Roti</title>

	<!-- Tailwind (CDN) -->
	<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

	<!-- Fonts & Icons -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Literata:wght@400;600;700;800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">

	<!-- Local styles created earlier -->
	<link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

	<style>
		:root{--accent:#d97706}
		body{font-family: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial}
	</style>
</head>
<body class="bg-bakery text-gray-800">

@include('partials.navbar')

<!-- Hero -->
<section class="relative overflow-hidden">
	<div class="absolute inset-0">
		<img src="https://images.unsplash.com/photo-1542272605-8e8f44f2703e?w=1600&q=80&auto=format&fit=crop" alt="Bakery background" class="w-full h-full object-cover opacity-80">
		<div class="absolute inset-0 bg-gradient-to-b from-transparent to-white/80"></div>
	</div>

	<div class="relative max-w-7xl mx-auto px-6 py-28 grid lg:grid-cols-2 gap-12 items-center">

		<div>
			<span class="stitch-accent">Sistem Manajemen Bakery</span>

			<h1 class="mt-6 text-4xl lg:text-6xl font-extrabold hero-title leading-tight">
				Kelola Resep & Produksi
				<span class="gradient-text">Lebih Mudah & Akurat</span>
			</h1>

			<p class="mt-6 text-lg text-gray-700 max-w-xl">Simpan resep, kelola bahan baku, hitung kebutuhan produksi dan pantau stok secara realtime. Cocok untuk UMKM dan usaha bakery profesional.</p>

			<div class="mt-8 flex gap-4">
				<a href="{{ route('resep.index') }}" class="btn-bakery px-6 py-3 rounded-xl font-semibold">Jelajahi Resep</a>
				<a href="#stats" class="px-6 py-3 rounded-xl border border-amber-200">Lihat Statistik</a>
			</div>

			<div class="mt-10 flex gap-6">
				<div class="text-center">
					<div class="text-3xl font-bold counter" data-target="{{ $totalResep }}">0</div>
					<div class="text-sm text-gray-600">Resep</div>
				</div>
				<div class="text-center">
					<div class="text-3xl font-bold counter" data-target="{{ $totalKategori }}">0</div>
					<div class="text-sm text-gray-600">Kategori</div>
				</div>
				<div class="text-center">
					<div class="text-3xl font-bold counter" data-target="{{ $totalBahan }}">0</div>
					<div class="text-sm text-gray-600">Bahan</div>
				</div>
			</div>
		</div>

		<div class="stitch-wrap">
			<div class="stitch-frame w-full max-w-md relative">
				<img src="https://images.unsplash.com/photo-1546549036-4b6f5b4cae9a?w=900&q=80&auto=format&fit=crop" alt="Bakery" class="hero-image float w-full h-[420px] object-cover rounded-2xl">
				<div class="absolute -top-6 -left-6">
					<div class="badge-pulse">120+ Resep</div>
				</div>
			</div>
		</div>

	</div>
</section>

<!-- Categories -->
<section class="py-16 bg-white">
	<div class="max-w-7xl mx-auto px-6">
		<h2 class="text-3xl font-bold text-center mb-6">Kategori Resep</h2>
		<div class="flex flex-wrap justify-center gap-4">
			@foreach($kategori as $item)
				<a href="{{ route('kategori.show', $item->slug) }}" class="px-5 py-2 rounded-full bg-amber-50 hover:bg-amber-200 transition">{{ $item->nama }}</a>
			@endforeach
		</div>
	</div>
</section>

<!-- Featured Recipes -->
<section class="py-16">
	<div class="max-w-7xl mx-auto px-6">
		<div class="flex items-center justify-between mb-8">
			<h2 class="text-3xl font-bold">Resep Terbaru</h2>
			<a href="{{ route('resep.index') }}" class="text-amber-600">Lihat Semua →</a>
		</div>

		<div class="grid md:grid-cols-3 gap-8">
			@forelse($reseps as $resep)
				<article class="bg-white rounded-2xl overflow-hidden shadow-lg card-tilt">
					<div class="relative h-64 overflow-hidden">
						@if($resep->gambar)
							<img src="{{ asset('storage/'.$resep->gambar) }}" alt="{{ $resep->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
						@else
							<img src="https://images.unsplash.com/photo-1511689660979-1b9a6b3a2f8b?w=900&q=80&auto=format&fit=crop" alt="{{ $resep->nama }}" class="w-full h-full object-cover">
						@endif
						<div class="absolute top-4 left-4">
							<span class="px-3 py-1 rounded-full text-xs bg-amber-100 text-amber-700">{{ $resep->kategori->nama ?? '' }}</span>
						</div>
					</div>
					<div class="p-6">
						<h3 class="font-semibold text-lg mb-2">{{ $resep->nama }}</h3>
						<p class="text-sm text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($resep->deskripsi, 100) }}</p>
						<div class="flex items-center justify-between">
							<div class="text-sm text-gray-500">⏱ {{ $resep->waktu_pembuatan }} menit</div>
							<a href="{{ route('resep.show', $resep->slug) }}" class="text-amber-600 font-semibold">Lihat →</a>
						</div>
					</div>
				</article>
			@empty
				<div class="col-span-3 text-center text-gray-500">Belum ada resep tersedia.</div>
			@endforelse
		</div>
	</div>
</section>

<!-- CTA / Newsletter -->
<section id="newsletter" class="py-16 bg-amber-50">
	<div class="max-w-4xl mx-auto px-6 text-center glass-card">
		<h3 class="text-2xl font-bold mb-4">Dapatkan Resep & Tips Langsung ke Email</h3>
		<p class="text-gray-700 mb-6">Langganan newsletter kami untuk mendapatkan resep eksklusif dan tips produksi.</p>
		<form action="#" method="POST" class="flex flex-col sm:flex-row gap-3 items-center justify-center">
			<input name="email" type="email" placeholder="Email anda" class="px-4 py-3 rounded-full w-full sm:w-2/3 border">
			<button class="btn-bakery px-6 py-3 rounded-full text-white">Langganan</button>
		</form>
	</div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 py-12">
	<div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">
		<div>
			<div class="text-2xl font-bold text-amber-300">Sistem Resep Roti</div>
			<p class="mt-3 text-sm">© {{ date('Y') }} — Dibuat untuk manajemen resep dan produksi bakery.</p>
		</div>
		<div>
			<h4 class="font-semibold mb-3">Navigasi</h4>
			<ul class="space-y-2 text-sm">
				<li><a href="{{ route('resep.index') }}">Resep</a></li>
				@foreach($kategori->take(5) as $k)
					<li><a href="{{ route('kategori.show', $k->slug) }}">{{ $k->nama }}</a></li>
				@endforeach
			</ul>
		</div>
		<div>
			<h4 class="font-semibold mb-3">Hubungi</h4>
			<p class="text-sm">Email: hello@example.com</p>
			<p class="text-sm">Telepon: +62 812-3456-7890</p>
		</div>
	</div>
</footer>

<!-- Scripts -->
<script src="{{ asset('front/js/app.js') }}"></script>
<script>
	// Counter animation
	document.querySelectorAll('.counter').forEach(counter => {
		const update = () => {
			const target = +counter.dataset.target;
			const current = +counter.innerText;
			const inc = Math.max(1, Math.floor(target / 80));
			if(current < target){
				counter.innerText = Math.min(target, current + inc);
				requestAnimationFrame(update);
			} else {
				counter.innerText = target;
			}
		};
		update();
	});
</script>

</body>
</html>

