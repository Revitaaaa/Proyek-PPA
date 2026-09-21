<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model {
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    protected $fillable = [
        'id_pengguna',
        'nama_pelapor',
        'kategori',
        'sebagai',
        'judul_kasus',
        'kronologi',
        'lokasi_kejadian',
        'tanggal_kejadian',
        'bukti_file',
        'status_penanganan'
    ];
}