use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/lapor', function (Request $request) {
    // Menyimpan data kiriman Flutter langsung ke tabel laporan di db_workshop
    $laporan = Laporan::create([
        'kategori'         => $request->kategori,
        'sebagai'          => $request->sebagai,
        'pelapor_nama'     => $request->pelapor_nama,
        'nama_pelapor'     => $request->pelapor_nama,
        'lokasi'           => $request->lokasi,
        'lokasi_kejadian'  => $request->lokasi,
        'tanggal_kejadian' => $request->tanggal_kejadian ?? now(),
        'kronologi'        => $request->kronologi,
        'status'           => 'Menunggu Verifikasi',
        'status_penanganan'=> 'Menunggu Verifikasi',
    ]);

    return response()->json([
        'status'  => 'success',
        'message' => 'Laporan berhasil terkirim ke Admin!',
        'data'    => $laporan,
    ], 201);
});