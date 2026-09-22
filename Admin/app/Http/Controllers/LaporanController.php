<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Dashboard Admin
    public function dashboard()
    {
        $totalLaporan = Laporan::count();
        $menungguVerifikasi = Laporan::where('status', 'Menunggu Verifikasi')->count();
        $sedangDiproses = Laporan::where('status', 'Sedang Diproses')->count();
        $selesai = Laporan::where('status', 'Selesai')->count();

        $laporanTerbaru = Laporan::latest()->take(5)->get();

        return view('dashboard', compact('totalLaporan', 'menungguVerifikasi', 'sedangDiproses', 'selesai', 'laporanTerbaru'));
    }

    // Index Laporan Masuk
    public function index(Request $request)
    {
        $query = Laporan::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nomor_laporan', 'like', '%' . $request->search . '%')
                  ->orWhere('pelapor_nama', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $laporans = $query->latest()->paginate(8);

        return view('laporan.index', compact('laporans'));
    }

    // Detail Laporan
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }

    // Update Status & Catatan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Verifikasi,Sedang Diproses,Selesai',
            'catatan_admin' => 'nullable|string',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}