<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Hapus atau komentari middleware 'auth' sementara waktu:
Route::get('/', [LaporanController::class, 'dashboard'])->name('dashboard');

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
Route::put('/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('laporan.update-status');

Route::get('/pengguna', function () {
    return view('pengguna.index');
})->name('pengguna.index');

Route::get('/pengaturan', function () {
    return view('pengaturan.index');
})->name('pengaturan.index');