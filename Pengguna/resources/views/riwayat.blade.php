@extends('app')

@section('title', 'Daftar Riwayat Laporan')
@section('header_title', 'Daftar Riwayat Laporan')

@section('content')
@forelse($listLaporan as $item)
<div class="card-box card-neutral" style="display: flex; justify-content: space-between; align-items: center;">
    <a href="{{ route('lapor.detail', $item->id_laporan) }}" style="flex: 1; text-decoration: none; color: inherit;">
        <strong style="color: var(--primary-pink); font-size: 13px;">LAP-{{ $item->id_laporan }}</strong>
        <p style="font-size: 12px; font-weight: 600; margin: 2px 0;">{{ $item->kategori }}</p>
        <span style="font-size: 10px; color: var(--text-grey);">{{ $item->created_at ? $item->created_at->format('d M Y') : $item->tanggal_kejadian }}</span>
    </a>

    <div style="display: flex; align-items: center; gap: 8px;">
        <span class="badge {{ $item->status_penanganan == 'Diproses' ? 'badge-blue' : ($item->status_penanganan == 'Selesai' ? 'badge-green' : 'badge-yellow') }}">
            {{ $item->status_penanganan }}
        </span>
        
        <!-- UPDATE (EDIT) -->
        <button onclick="openEditModal({{ $item->id_laporan }}, '{{ $item->kategori }}', '{{ $item->lokasi_kejadian }}', '{{ addslashes($item->kronologi) }}', '{{ $item->tanggal_kejadian }}')" style="border: none; background: none; color: #D97706; cursor: pointer; font-size: 18px;">
            <i class="bi bi-pencil-square"></i>
        </button>

        <!-- DELETE (HAPUS) -->
        <form action="{{ route('riwayat.destroy', $item->id_laporan) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="border: none; background: none; color: #EF4444; cursor: pointer; font-size: 18px;">
                <i class="bi bi-trash"></i>
            </button>
        </form>
        <i class="bi bi-chevron-right" style="color: var(--text-grey);"></i>
    </div>
</div>
@empty
<div style="text-align: center; color: var(--text-grey); padding: 40px 0;">
    <i class="bi bi-file-earmark-text" style="font-size: 40px;"></i>
    <p style="margin-top: 10px; font-size: 13px;">Belum ada riwayat laporan.</p>
</div>
@endforelse

<!-- Modal Dialog Edit -->
<div id="editModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; align-items: center; justify-content: center;">
    <div style="background: #fff; border-radius: 16px; padding: 20px; width: 90%; max-width: 450px;">
        <h3 style="font-size: 16px; margin-bottom: 14px;">Edit Data Laporan</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" id="editKategori" class="form-input">
                    <option value="Kekerasan terhadap Perempuan">Kekerasan terhadap Perempuan</option>
                    <option value="Kekerasan terhadap Anak">Kekerasan terhadap Anak</option>
                    <option value="Pelecehan Seksual">Pelecehan Seksual</option>
                    <option value="Kekerasan Dalam Rumah Tangga (KDRT)">Kekerasan Dalam Rumah Tangga (KDRT)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Kejadian</label>
                <input type="date" name="tanggal_kejadian" id="editTanggal" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Lokasi Kejadian</label>
                <input type="text" name="lokasi_kejadian" id="editLokasi" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Kronologi Kejadian</label>
                <textarea name="kronologi" id="editKronologi" rows="3" class="form-input" required></textarea>
            </div>
            <div style="display: flex; gap: 10px; margin-top: 14px;">
                <button type="button" onclick="closeEditModal()" class="btn-outline-pink">Batal</button>
                <button type="submit" class="btn-pink">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, kategori, lokasi, kronologi, tanggal) {
    document.getElementById('editForm').action = '/riwayat/' + id;
    document.getElementById('editKategori').value = kategori;
    document.getElementById('editLokasi').value = lokasi;
    document.getElementById('editKronologi').value = kronologi;
    document.getElementById('editTanggal').value = tanggal;
    document.getElementById('editModal').style.display = 'flex';
}
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>
@endsection