@extends('app')

@section('title', 'Upload Bukti')
@section('back_url', route('lapor.step1'))
@section('header_title', 'Upload Bukti')

@section('content')
<form action="{{ route('lapor.konfirmasi') }}" method="POST">
    @csrf
    @foreach($data as $key => $val)
        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
    @endforeach

    <div class="card-box" style="border: 1.5px dashed var(--primary-pink); text-align: center; padding: 30px;">
        <i class="bi bi-cloud-arrow-up" style="font-size: 40px; color: var(--primary-pink);"></i>
        <p style="font-size: 13px; font-weight: 700; margin-top: 8px;">Pilih gambar atau dokumen</p>
        <p style="font-size: 11px; color: var(--text-grey);">(JPG, PNG, PDF) Maks. 10 MB</p>
    </div>

    <p style="font-size: 13px; font-weight: 700; margin-bottom: 8px;">File yang diunggah</p>
    <div class="card-box card-neutral" style="display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="bi bi-file-earmark-image" style="font-size: 22px;"></i>
            <div>
                <p style="font-size: 12px; font-weight: 700;">bukti.jpg</p>
                <p style="font-size: 10px; color: var(--text-grey);">2.4 MB</p>
            </div>
        </div>
        <i class="bi bi-x" style="font-size: 18px; color: var(--text-grey);"></i>
    </div>

    <button type="submit" class="btn-pink" style="margin-top: 20px;">Lanjut</button>
</form>
@endsection