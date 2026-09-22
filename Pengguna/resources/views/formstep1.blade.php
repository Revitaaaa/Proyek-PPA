@extends('app')

@section('title', 'Form Pelaporan - Sahabat PPA')
@section('back_url', route('home'))
@section('header_title', 'Form Pelaporan')

@section('content')
<form action="{{ route('lapor.step2') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Kategori Laporan</label>
        <select name="kategori" class="form-input" required>
            <option value="Kekerasan terhadap Perempuan">Kekerasan terhadap Perempuan</option>
            <option value="Kekerasan terhadap Anak">Kekerasan terhadap Anak</option>
            <option value="Pelecehan Seksual">Pelecehan Seksual</option>
            <option value="Kekerasan Dalam Rumah Tangga (KDRT)">Kekerasan Dalam Rumah Tangga (KDRT)</option>
        </select>
    </div>

    <div class="form-group">
        <label>Sebagai</label>
        <select name="sebagai" class="form-input" required>
            <option value="Korban">Korban</option>
            <option value="Saksi">Saksi</option>
            <option value="Keluarga Korban">Keluarga Korban</option>
        </select>
    </div>

    <div class="form-group">
        <label>Lokasi Kejadian</label>
        <input type="text" name="lokasi_kejadian" class="form-input" value="Jember" required>
    </div>

    <div class="form-group">
    <label>Tanggal Kejadian</label>
    <input type="date" 
           name="tanggal_kejadian" 
           class="form-input" 
           value="{{ date('Y-m-d') }}" 
           max="{{ date('Y-m-d') }}" 
           required>
    </div>

    <div class="form-group">
        <label>Penjelasan Kejadian</label>
        <textarea name="kronologi" rows="4" class="form-input" placeholder="Ceritakan kronologi kejadian secara singkat..." required></textarea>
    </div>

    <button type="submit" class="btn-pink" style="margin-top: 14px;">Lanjut</button>
</form>
@endsection