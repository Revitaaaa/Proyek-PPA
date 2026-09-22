<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('laporan.index') }}" class="w-9 h-9 border border-gray-200 bg-white rounded-full flex items-center justify-center text-gray-600 hover:bg-gray-50">←</a>
            <h2 class="text-xl font-bold text-rose-600">Detail Laporan {{ $laporan->nomor_laporan }}</h2>
        </div>
        <span class="bg-amber-50 text-amber-600 border border-amber-200 px-4 py-1.5 rounded-full text-xs font-bold">
            {{ $laporan->status }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form & Content (2 Columns) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
                <h3 class="font-bold text-rose-600 mb-4 border-b pb-2">Data Utama Laporan</h3>
                <div class="grid grid-cols-2 gap-y-4 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs">Nomor Laporan</p>
                        <p class="font-bold text-rose-600">{{ $laporan->nomor_laporan }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Kategori Kejadian</p>
                        <p class="font-semibold text-gray-800">{{ $laporan->kategori }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Melapor Sebagai</p>
                        <p class="font-semibold text-gray-800">{{ $laporan->sebagai }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Lokasi Kejadian</p>
                        <p class="font-semibold text-gray-800">{{ $laporan->lokasi }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Tanggal Kejadian</p>
                        <p class="font-semibold text-gray-800">{{ $laporan->tanggal_kejadian->format('d M Y, \J\a\m H:i \W\I\B') }}</p>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100">
                    <p class="font-bold text-gray-800 text-sm mb-2">Penjelasan Kronologi Kejadian</p>
                    <p class="text-gray-600 text-sm leading-relaxed bg-gray-50 p-4 rounded-xl">
                        {{ $laporan->kronologi }}
                    </p>
                </div>
            </div>

            <!-- Attachment Card -->
            <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
                <h3 class="font-bold text-rose-600 mb-4">Bukti Lampiran</h3>
                <div class="flex items-center justify-between border border-gray-200 p-3 rounded-xl bg-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-rose-100 rounded-lg flex items-center justify-center text-rose-600 font-bold text-xs">JPG</div>
                        <div>
                            <p class="font-semibold text-sm text-gray-800">bukti-intimidasi.jpg</p>
                            <p class="text-xs text-gray-400">Gambar JPG • 2.4 MB</p>
                        </div>
                    </div>
                    <a href="#" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg">📥</a>
                </div>
            </div>
        </div>

        <!-- Sidebar Timeline & Form (1 Column) -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
                <h3 class="font-bold text-rose-600 mb-4">Status & Riwayat Laporan</h3>
                <!-- Timeline items -->
                <ul class="space-y-4 text-xs">
                    <li class="flex gap-3">
                        <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold">✓</div>
                        <div>
                            <p class="font-bold text-gray-800">Laporan Dikirim</p>
                            <p class="text-gray-400">Diterima sistem • 12 Mei, 10:30</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Action Form -->
            <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
                <h3 class="font-bold text-rose-600 mb-4">Tindak Lanjut Laporan</h3>
                <form action="{{ route('laporan.update-status', $laporan->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Ubah Status</label>
                        <select name="status" class="w-full border-gray-200 rounded-xl text-xs p-3 focus:ring-rose-500 focus:border-rose-500">
                            <option value="Menunggu Verifikasi" {{ $laporan->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="Sedang Diproses" {{ $laporan->status == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Catatan Admin / Petugas</label>
                        <textarea name="catatan_admin" rows="3" class="w-full border-gray-200 rounded-xl text-xs p-3 focus:ring-rose-500 focus:border-rose-500" placeholder="Tuliskan instruksi penugasan atau catatan internal..."></textarea>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="reset" class="w-1/2 py-2.5 border border-rose-500 text-rose-500 rounded-xl text-xs font-bold hover:bg-rose-50">Batal</button>
                        <button type="submit" class="w-1/2 py-2.5 bg-rose-500 text-white rounded-xl text-xs font-bold hover:bg-rose-600 shadow-md shadow-rose-200">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>