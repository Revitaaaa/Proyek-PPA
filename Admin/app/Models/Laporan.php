<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_laporan',
        'kategori',
        'sebagai',
        'pelapor_nama',
        'lokasi',
        'tanggal_kejadian',
        'kronologi',
        'bukti_lampiran',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'datetime',
    ];
}