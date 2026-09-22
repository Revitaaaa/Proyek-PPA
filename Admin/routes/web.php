<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

// ========================================================
// Autentikasi Admin (Login & Logout)
// ========================================================
// ========================================================
// Autentikasi Admin (Login & Logout)
// ========================================================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    return redirect()->route('dashboard');
})->name('login.post');

Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// ========================================================
// Dashboard & Manajemen Laporan Web Admin
// ========================================================
Route::get('/', [LaporanController::class, 'dashboard'])->name('dashboard');
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
Route::put('/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('laporan.update-status');

// ========================================================
// Manajemen Pengguna
// ========================================================
Route::get('/pengguna', function () {
    $penggunas = User::latest()->get();
    return view('pengguna.index', compact('penggunas'));
})->name('pengguna.index');

Route::get('/pengguna/{id}', function ($id) {
    $user = User::findOrFail($id);
    $laporans = Laporan::where('id_pengguna', $id)->latest()->get();
    return view('pengguna.show', compact('user', 'laporans'));
})->name('pengguna.show');

// ========================================================
// Pengaturan Admin (Profil & Ganti Password)
// ========================================================
Route::get('/pengaturan', function () {
    $admin = User::first();
    return view('pengaturan.index', compact('admin'));
})->name('pengaturan.index');

Route::post('/pengaturan/profil', function (Request $request) {
    $admin = User::first();
    if ($admin) {
        $admin->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);
    }
    return back()->with('success_profil', 'Profil admin berhasil diperbarui!');
})->name('pengaturan.update-profil');

Route::post('/pengaturan/password', function (Request $request) {
    $admin = User::first();
    if ($admin && $request->filled('password_baru')) {
        $admin->update([
            'password' => bcrypt($request->password_baru),
        ]);
    }
    return back()->with('success_password', 'Kata sandi berhasil diperbarui!');
})->name('pengaturan.update-password');

// ========================================================
// API Endpoints untuk Flutter Mobile
// ========================================================
Route::post('/api/lapor', function (Request $request) {
    $tanggal = $request->tanggal_kejadian;
    if ($tanggal) {
        try {
            if (str_contains($tanggal, '-')) {
                $parts = explode('-', $tanggal);
                if (strlen($parts[0]) == 2) {
                    $tanggal = Carbon::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d');
                }
            }
        } catch (\Exception $e) {
            $tanggal = now()->format('Y-m-d');
        }
    } else {
        $tanggal = now()->format('Y-m-d');
    }

    $nomorLaporan = 'LAP-' . date('Ymd') . '-' . rand(100, 999);

    $laporan = Laporan::create([
        'nomor_laporan'     => $nomorLaporan,
        'id_pengguna'       => $request->id_pengguna ?? 1,
        'nama_pelapor'      => $request->nama_pelapor ?? $request->pelapor_nama ?? 'Revitaaa',
        'kategori'          => $request->kategori,
        'sebagai'           => $request->sebagai,
        'lokasi_kejadian'   => $request->lokasi_kejadian ?? $request->lokasi,
        'tanggal_kejadian'  => $tanggal,
        'kronologi'         => $request->kronologi,
        'bukti_lampiran'    => $request->bukti_lampiran,
        'status_penanganan' => 'Menunggu Verifikasi',
    ]);

    return response()->json([
        'status'  => 'success',
        'message' => 'Laporan berhasil terkirim ke Admin!',
        'data'    => $laporan,
    ], 201);
});

Route::get('/api/laporan-terakhir', function () {
    $laporan = Laporan::latest()->first();

    if (!$laporan) {
        return response()->json([
            'status'  => 'empty',
            'message' => 'Belum ada laporan aktif',
            'data'    => null,
        ], 404);
    }

    return response()->json([
        'status'  => 'success',
        'message' => 'Laporan ditemukan',
        'data'    => $laporan,
    ]);
});

Route::get('/api/riwayat', function () {
    $laporan = Laporan::latest()->get();

    return response()->json([
        'status'  => 'success',
        'message' => 'Daftar riwayat laporan berhasil diambil',
        'data'    => $laporan,
    ], 200);
});

Route::put('/api/laporan/{id}', function (Request $request, $id) {
    $laporan = Laporan::where('id_laporan', $id)->first();

    if (!$laporan) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Laporan tidak ditemukan',
        ], 404);
    }

    $tanggal = $request->tanggal_kejadian;
    if ($tanggal && str_contains($tanggal, '-')) {
        $parts = explode('-', $tanggal);
        if (strlen($parts[0]) == 2) {
            try {
                $tanggal = Carbon::createFromFormat('d-m-Y', $tanggal)->format('Y-m-d');
            } catch (\Exception $e) {}
        }
    }

    $laporan->update([
        'kategori'         => $request->kategori ?? $laporan->kategori,
        'lokasi_kejadian'  => $request->lokasi_kejadian ?? $request->lokasi ?? $laporan->lokasi_kejadian,
        'tanggal_kejadian' => $tanggal ?? $laporan->tanggal_kejadian,
        'kronologi'        => $request->kronologi ?? $laporan->kronologi,
    ]);

    return response()->json([
        'status'  => 'success',
        'message' => 'Laporan berhasil diperbarui!',
        'data'    => $laporan,
    ], 200);
});

Route::delete('/api/laporan/{id}', function ($id) {
    $laporan = Laporan::where('id_laporan', $id)->first();

    if ($laporan) {
        $laporan->delete();
        return response()->json([
            'status'  => 'success',
            'message' => 'Laporan berhasil dihapus',
        ]);
    }

    return response()->json([
        'status'  => 'error',
        'message' => 'Laporan tidak ditemukan',
    ], 404);
});