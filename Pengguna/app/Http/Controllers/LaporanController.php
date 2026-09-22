<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller {
    public function index() {
        $laporanTerakhir = Laporan::latest('id_laporan')->first();
        return view('home', compact('laporanTerakhir'));
    }

    public function formStep1() {
        return view('formstep1');
    }

    public function formStep2(Request $request) {
        $validated = $request->validate([
            'kategori' => 'required|string',
            'sebagai' => 'required|string',
            'lokasi_kejadian' => 'required|string',
            'tanggal_kejadian' => 'required|string',
            'kronologi' => 'required|string',
        ]);
        return view('formstep2', ['data' => $validated]);
    }

    public function konfirmasi(Request $request) {
        return view('confirmation', ['data' => $request->all()]);
    }

    public function store(Request $request) {
        $laporan = Laporan::create([
            'id_pengguna' => 1,
            'nama_pelapor' => 'Revitaaa',
            'kategori' => $request->kategori,
            'sebagai' => $request->sebagai ?? 'Korban',
            'judul_kasus' => $request->kategori,
            'kronologi' => $request->kronologi,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian ?? '12 Mei 2025',
            'bukti_file' => 'bukti.jpg',
            'status_penanganan' => 'Menunggu Verifikasi',
        ]);

        return redirect()->route('lapor.success', ['id' => $laporan->id_laporan]);
    }

    public function success($id) {
        $laporan = Laporan::findOrFail($id);
        return view('success', compact('laporan'));
    }

    public function progress($id) {
        $laporan = Laporan::findOrFail($id);
        return view('progress', compact('laporan'));
    }

    public function detail($id) {
        $laporan = Laporan::findOrFail($id);
        return view('detail', compact('laporan'));
    }

    public function riwayat() {
        $listLaporan = Laporan::orderByDesc('id_laporan')->get();
        return view('riwayat', compact('listLaporan'));
    }

    public function update(Request $request, $id) {
        $laporan = Laporan::findOrFail($id);
        $laporan->update($request->only(['kategori', 'lokasi_kejadian', 'kronologi']));
        return redirect()->route('riwayat')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy($id) {
        Laporan::findOrFail($id)->delete();
        return redirect()->route('riwayat')->with('success', 'Laporan berhasil dihapus!');
    }
}