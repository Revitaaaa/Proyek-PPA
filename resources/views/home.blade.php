@extends('app')

@section('title', 'Beranda - Sahabat PPA')

@section('content')
<div class="card-box" style="display: flex; align-items: center; gap: 14px;">
    <div style="width: 48px; height: 48px; background: #F1F3F6; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-person-fill" style="color: var(--primary-pink); font-size: 26px;"></i>
    </div>
    <div>
        <p style="font-size: 12px; color: var(--text-grey);">Selamat datang,</p>
        <h3 style="font-size: 17px; font-weight: 700;">Revitaaa</h3>
        <p style="font-size: 11px; color: var(--text-grey);">Pengguna</p>
    </div>
</div>

<a href="{{ route('lapor.step1') }}" style="text-decoration: none;">
    <div class="card-box" style="display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 14px;">
            <div style="background: #FFEEF2; padding: 8px 10px; border-radius: 10px; color: var(--primary-pink);">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div>
                <h4 style="font-size: 14px; font-weight: 700; color: var(--text-dark);">Buat Laporan</h4>
                <p style="font-size: 11px; color: var(--text-grey);">Laporkan kejadian dengan aman</p>
            </div>
        </div>
        <i class="bi bi-chevron-right" style="color: var(--text-grey);"></i>
    </div>
</a>

<div style="display: flex; justify-content: space-between; align-items: center; margin: 20px 0 10px;">
    <h4 style="font-size: 14px; font-weight: 700;">Status Laporan Terakhir</h4>
</div>

@if($laporanTerakhir)
<a href="{{ route('lapor.progress', $laporanTerakhir->id_laporan) }}" style="text-decoration: none;">
    <div class="card-box card-neutral">
        <div style="display: flex; justify-content: space-between;">
            <strong style="color: var(--primary-pink);">LAP-{{ $laporanTerakhir->id_laporan }}</strong>
            <span style="font-size: 11px; color: var(--text-grey);">{{ $laporanTerakhir->created_at ? $laporanTerakhir->created_at->format('d M Y') : '12 Mei 2025' }}</span>
        </div>
        <p style="font-size: 12px; font-weight: 600; margin: 6px 0 10px; color: var(--text-dark);">{{ $laporanTerakhir->kategori }}</p>
        <span class="badge badge-yellow">{{ $laporanTerakhir->status_penanganan }}</span>
    </div>
</a>
@else
<div class="card-box card-neutral" style="text-align: center; color: var(--text-grey); padding: 24px;">
    <i class="bi bi-inbox" style="font-size: 32px;"></i>
    <p style="font-size: 12px; margin-top: 6px;">Belum ada laporan aktif</p>
</div>
@endif

<div style="display: flex; gap: 14px; margin-top: 10px;">
    <a href="{{ route('riwayat') }}" class="card-box card-neutral" style="flex: 1; text-align: center; text-decoration: none; color: inherit;">
        <i class="bi bi-clock-history" style="color: var(--primary-pink); font-size: 24px;"></i>
        <p style="font-size: 12px; font-weight: 600; margin-top: 6px;">Riwayat Laporan</p>
    </a>
    <a href="{{ route('edukasi') }}" class="card-box card-neutral" style="flex: 1; text-align: center; text-decoration: none; color: inherit;">
        <i class="bi bi-book" style="color: var(--primary-pink); font-size: 24px;"></i>
        <p style="font-size: 12px; font-weight: 600; margin-top: 6px;">Informasi & Edukasi</p>
    </a>
</div>
@endsection