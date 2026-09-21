<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

Route::get('/', [LaporanController::class, 'index'])->name('home');

// Form Pelaporan
Route::get('/lapor/step-1', [LaporanController::class, 'formStep1'])->name('lapor.step1');
Route::post('/lapor/step-2', [LaporanController::class, 'formStep2'])->name('lapor.step2');
Route::post('/lapor/konfirmasi', [LaporanController::class, 'konfirmasi'])->name('lapor.konfirmasi');
Route::post('/lapor/store', [LaporanController::class, 'store'])->name('lapor.store');

// Status & Detail
Route::get('/lapor/sukses/{id}', [LaporanController::class, 'success'])->name('lapor.success');
Route::get('/lapor/progres/{id}', [LaporanController::class, 'progress'])->name('lapor.progress');
Route::get('/lapor/detail/{id}', [LaporanController::class, 'detail'])->name('lapor.detail');

// CRUD Riwayat
Route::get('/riwayat', [LaporanController::class, 'riwayat'])->name('riwayat');
Route::put('/riwayat/{id}', [LaporanController::class, 'update'])->name('riwayat.update');
Route::delete('/riwayat/{id}', [LaporanController::class, 'destroy'])->name('riwayat.destroy');

// Menu Lain
Route::get('/edukasi', fn() => view('edukasi'))->name('edukasi');
Route::get('/profil', fn() => view('profil'))->name('profil');