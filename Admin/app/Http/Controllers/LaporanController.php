<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    // ==========================================
    // 1. API: Menerima & Menyimpan Laporan dari Flutter
    // ==========================================
    public function store(Request $request)
    {
        $tanggal = $request->tanggal_kejadian;
        try {
            if ($tanggal && str_contains($tanggal, '-')) {
                $parts = explode('-', $tanggal);
                if (strlen($parts[0]) == 2) {
                    $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal_kejadian)->format('Y-m-d');
                }
            }
        } catch (\Exception $e) {
            $tanggal = date('Y-m-d');
        }

        $nomorLaporan = 'LAP-' . date('Ymd') . '-' . rand(100, 999);

        $laporan = Laporan::create([
            'nomor_laporan'     => $nomorLaporan,
            'id_pengguna'       => $request->id_pengguna ?? 1,
            'nama_pelapor'      => $request->nama_pelapor ?? 'Revitaaa',
            'kategori'          => $request->kategori,
            'sebagai'           => $request->sebagai,
            'lokasi_kejadian'   => $request->lokasi_kejadian,
            'tanggal_kejadian'  => $tanggal,
            'kronologi'         => $request->kronologi,
            'bukti_lampiran'    => $request->bukti_lampiran,
            'status_penanganan' => 'Menunggu Verifikasi',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Laporan berhasil dibuat',
            'data'    => $laporan,
        ], 201);
    }

    // ==========================================
    // 2. Dashboard Admin
    // ==========================================
    public function dashboard()
    {
        $totalLaporan       = Laporan::count();
        $menungguVerifikasi = Laporan::where('status_penanganan', 'Menunggu Verifikasi')->count();
        $sedangDiproses     = Laporan::where('status_penanganan', 'Sedang Diproses')->count();
        $selesai            = Laporan::where('status_penanganan', 'Selesai')->count();
        $laporanTerbaru     = Laporan::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalLaporan',
            'menungguVerifikasi',
            'sedangDiproses',
            'selesai',
            'laporanTerbaru'
        ));
    }

    // ==========================================
    // 3. WEB: Daftar Seluruh Laporan (Sudah Mendukung Filter & Cari)
    // ==========================================
    public function index(Request $request)
    {
        $query = Laporan::query();

        // Cari berdasarkan teks (Nomor Laporan, Nama Pelapor, atau Lokasi)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_laporan', 'like', "%{$search}%")
                  ->orWhere('nama_pelapor', 'like', "%{$search}%")
                  ->orWhere('lokasi_kejadian', 'like', "%{$search}%");
            });
        }

        // Filter Dropdown Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter Dropdown Status Penanganan
        if ($request->filled('status')) {
            $query->where('status_penanganan', $request->status);
        }

        // Paginasi 10 baris & pertahankan query filter di URL
        $laporans = $query->latest()->paginate(10)->withQueryString();

        return view('laporan.index', compact('laporans'));
    }

    // ==========================================
    // 4. Detail Satu Laporan
    // ==========================================
    public function show($id)
    {
        $laporan = Laporan::where('id_laporan', $id)->firstOrFail();
        return view('laporan.show', compact('laporan'));
    }

    // ==========================================
    // 5. Update Status Laporan dari Admin Web
    // ==========================================
    public function updateStatus(Request $request, $id)
    {
        $laporan = Laporan::where('id_laporan', $id)->firstOrFail();

        $statusBaru = $request->input('status_penanganan') 
                   ?? $request->input('status') 
                   ?? $laporan->status_penanganan;

        $catatanBaru = $request->input('catatan_admin') 
                    ?? $laporan->catatan_admin;

        $laporan->status_penanganan = $statusBaru;
        $laporan->catatan_admin     = $catatanBaru;
        $laporan->save();

        return redirect()->route('laporan.index')
            ->with('success', 'Status laporan berhasil diperbarui!');
    }
}