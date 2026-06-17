@extends('layouts.frontend')

@section('title', 'Kategori ' . $kategori->nama)
@section('description', 'Daftar resep roti dalam kategori ' . $kategori->nama . '.')

@section('content')
<section class="relative overflow-hidden px-5 py-16 lg:px-8 lg:py-20">
    <div class="hero-blob right-[-8rem] top-10 bg-bread-200/60"></div>
    <div class="mx-auto max-w-7xl">
        <div class="max-w-3xl reveal" data-reveal>
            <span class="eyebrow">Kategori Resep</span>
            <h1 class="mt-5 font-display text-5xl font-black leading-tight text-bread-900 md:text-6xl">{{ $kategori->nama }}</h1>
            <p class="mt-5 text-lg leading-8 text-bread-800/70">
                {{ $kategori->deskripsi ?: 'Menampilkan semua resep yang termasuk dalam kategori ini.' }}
            </p>
            <div class="mt-7 flex flex-wrap gap-3">
                <a href="{{ route('resep.index') }}" class="btn-outline-bakery px-5 py-3">Semua Resep</a>
                <a href="{{ route('resep.index', ['kategori' => $kategori->id]) }}" class="btn-bakery px-5 py-3">Filter di Katalog</a>
            </div>
        </div>
    </div>
</section>

<section class="px-5 pb-20 lg:px-8">
    <div class="mx-auto max-w-7xl">
        @if($reseps->count())
            <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <span class="eyebrow">Daftar Resep</span>
                    <h2 class="mt-3 font-display text-4xl font-black text-bread-900">{{ $reseps->total() }} resep tersedia</h2>
                </div>
            </div>

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
                <div class="text-6xl">📂</div>
                <h3 class="mt-4 text-2xl font-black text-bread-900">Belum ada resep</h3>
                <p class="mt-3 text-bread-700/70">Kategori ini belum memiliki resep yang dipublikasikan.</p>
                <a href="{{ route('resep.index') }}" class="btn-bakery mt-6 inline-block px-6 py-3">Kembali ke Katalog</a>
            </div>
        @endif
    </div>
</section>
@endsection
