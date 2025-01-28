<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsistenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::get('users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('asisten', [AsistenController::class, 'index'])->name('asisten.index');
    Route::get('asisten/create', [AsistenController::class, 'create'])->name('asisten.create');
    Route::post('asisten', [AsistenController::class, 'store'])->name('asisten.store');
    Route::get('asisten/{asisten:npm}', [AsistenController::class, 'show'])->name('asisten.show');
    Route::get('asisten/{asisten:npm}/edit', [AsistenController::class, 'edit'])->name('asisten.edit');
    Route::put('asisten/{asisten:npm}', [AsistenController::class, 'update'])->name('asisten.update');
    Route::delete('asisten/{asisten:npm}', [AsistenController::class, 'destroy'])->name('asisten.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('mahasiswa/{mahasiswa:npm}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
    Route::get('mahasiswa/{mahasiswa:npm}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('mahasiswa/{mahasiswa:npm}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('mahasiswa/{mahasiswa:npm}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});