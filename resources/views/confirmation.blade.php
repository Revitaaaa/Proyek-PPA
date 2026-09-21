@extends('app')

@section('title', 'Konfirmasi Laporan')
@section('header_title', 'Konfirmasi Laporan')

@section('content')
<div class="card-box" style="background: #F7F9FD; text-align: center; border: none; padding: 20px;">
    <div style="width: 48px; height: 48px; background: var(--primary-pink); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #fff; margin-bottom: 10px;">
        <i class="bi bi-file-earmark-check" style="font-size: 24px;"></i>
    </div>
    <h3 style="font-size: 14px; font-weight: 700;">Apakah Anda yakin ingin<br>mengirim laporan ini?</h3>
    <p style="font-size: 11px; color: var(--text-grey); margin-top: 4px;">Pastikan semua data sudah benar sebelum dikirim.</p>
</div>

<p style="font-size: 13px; font-weight: 700; margin-bottom: 8px;">Data Laporan</p>
<div class="card-box card-neutral">
    <div style="display: flex; margin-bottom: 8px; font-size: 12px;">
        <span style="width: 80px; color: var(--text-grey);">Kategori</span>
        <span style="font-weight: 600;">: {{ $data['kategori'] }}</span>
    </div>
    <div style="display: flex; margin-bottom: 8px; font-size: 12px;">
        <span style="width: 80px; color: var(--text-grey);">Lokasi</span>
        <span style="font-weight: 600;">: {{ $data['lokasi_kejadian'] }}</span>
    </div>
    <div style="display: flex; font-size: 12px;">
        <span style="width: 80px; color: var(--text-grey);">Tanggal</span>
        <span style="font-weight: 600;">: {{ $data['tanggal_kejadian'] }}</span>
    </div>
</div>

<form action="{{ route('lapor.store') }}" method="POST">
    @csrf
    @foreach($data as $key => $val)
        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
    @endforeach

    <div style="display: flex; gap: 10px; margin-top: 20px;">
        <a href="{{ route('lapor.step1') }}" class="btn-outline-pink" style="flex: 1;">Batal</a>
        <button type="submit" class="btn-pink" style="flex: 1;">Kirim</button>
    </div>
</form>
@endsection