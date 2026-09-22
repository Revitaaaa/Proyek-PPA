public function store(Request $request)
{
    $laporan = Laporan::create([
        'id_pengguna'      => $request->id_pengguna ?? 1,
        'nama_pelapor'     => $request->nama_pelapor,
        'kategori'         => $request->kategori,
        'sebagai'          => $request->sebagai,
        'lokasi_kejadian'  => $request->lokasi_kejadian,
        'tanggal_kejadian' => $request->tanggal_kejadian,
        'kronologi'        => $request->kronologi,
        'bukti_lampiran'   => $request->bukti_lampiran,
        'status'           => 'Menunggu Verifikasi',
    ]);

    return response()->json([
        'status'  => 'success',
        'message' => 'Laporan berhasil dibuat',
        'data'    => $laporan,
    ], 201);
}