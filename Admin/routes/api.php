<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Laporan;
use Carbon\Carbon;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute untuk Login & Register Pengguna (Flutter)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rute untuk Pengiriman Laporan
Route::post('/lapor', function (Request $request) {
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
        'kategori'          => $request->kategori,
        'sebagai'           => $request->sebagai,
        'nama_pelapor'      => $request->nama_pelapor ?? $request->pelapor_nama ?? 'Revitaaa',
        'pelapor_nama'      => $request->nama_pelapor ?? $request->pelapor_nama ?? 'Revitaaa',
        'lokasi'            => $request->lokasi_kejadian ?? $request->lokasi,
        'lokasi_kejadian'   => $request->lokasi_kejadian ?? $request->lokasi,
        'tanggal_kejadian'  => $tanggal,
        'kronologi'         => $request->kronologi,
        'bukti_lampiran'    => $request->bukti_lampiran,
        'status'            => 'Menunggu Verifikasi',
        'status_penanganan' => 'Menunggu Verifikasi',
    ]);

    return response()->json([
        'status'  => 'success',
        'message' => 'Laporan berhasil terkirim ke Admin!',
        'data'    => $laporan,
    ], 201);
});