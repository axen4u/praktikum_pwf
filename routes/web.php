<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product routes (semua user yang login bisa akses)
    Route::resource('products', ProductController::class);

    // Kategori routes (diamankan dengan Gate manage-product di controller)
    Route::resource('kategoris', KategoriController::class);
});

require __DIR__.'/auth.php';
