<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\FrontendController;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});



Route::get('/', [FrontendController::class, 'home']);

Route::get('/resep', [FrontendController::class, 'resep'])->name('resep.index');

Route::get('/resep/{slug}', [FrontendController::class, 'detailResep'])
    ->name('resep.show');

Route::get('/kategori/{slug}', [FrontendController::class, 'kategori'])
    ->name('kategori.show');