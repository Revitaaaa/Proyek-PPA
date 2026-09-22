<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-rose-600">Selamat datang, Admin</h2>
            <p class="text-xs text-gray-400">Berikut adalah rangkuman aktivitas laporan hari ini.</p>
        </div>
        <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-xl border border-gray-100 text-xs font-semibold text-gray-600 shadow-sm">
            <span>🗓️</span>
            <span>{{ date('d M Y') }}</span>
        </div>
    </div>

    <!-- 4 Kartu Statistik Dinamis -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Total Laporan -->
        <div class="bg-white p-5 rounded-2xl border border-rose-50 shadow-sm">
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs font-semibold text-gray-500">Total Laporan</span>
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
            </div>
            <h3 class="text-2xl font-black text-gray-800">{{ $totalLaporan }}</h3>
            <p class="text-[11px] text-rose-500 font-medium mt-1">Keseluruhan data</p>
        </div>

        <!-- Menunggu Verifikasi -->
        <div class="bg-white p-5 rounded-2xl border border-rose-50 shadow-sm">
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs font-semibold text-gray-500">Menunggu Verifikasi</span>
                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
            </div>
            <h3 class="text-2xl font-black text-gray-800">{{ $menungguVerifikasi }}</h3>
            <p class="text-[11px] text-amber-500 font-medium mt-1">Butuh tindakan segera</p>
        </div>

        <!-- Sedang Diproses -->
        <div class="bg-white p-5 rounded-2xl border border-rose-50 shadow-sm">
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs font-semibold text-gray-500">Sedang Diproses</span>
                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
            </div>
            <h3 class="text-2xl font-black text-gray-800">{{ $sedangDiproses }}</h3>
            <p class="text-[11px] text-blue-500 font-medium mt-1">Tindak lanjut petugas</p>
        </div>

        <!-- Selesai -->
        <div class="bg-white p-5 rounded-2xl border border-rose-50 shadow-sm">
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs font-semibold text-gray-500">Selesai</span>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
            </div>
            <h3 class="text-2xl font-black text-gray-800">{{ $selesai }}</h3>
            <p class="text-[11px] text-emerald-500 font-medium mt-1">Kasus berhasil ditangani</p>
        </div>
    </div>

    <!-- Tabel Laporan Masuk Terbaru -->
    <div class="bg-white p-6 rounded-2xl border border-rose-50 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-rose-600 text-sm">Laporan Masuk Terbaru</h3>
            <a href="{{ route('laporan.index') }}" class="text-xs font-bold text-rose-500 bg-rose-50 px-3 py-1.5 rounded-xl hover:bg-rose-100 transition">
                Lihat Semua Laporan
            </a>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-gray-400 text-xs uppercase font-bold border-b border-gray-100">
                    <th class="py-3 px-2">No Laporan</th>
                    <th class="py-3 px-2">Kategori</th>
                    <th class="py-3 px-2">Pelapor</th>
                    <th class="py-3 px-2">Tanggal</th>
                    <th class="py-3 px-2 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-xs">
                @forelse($laporanTerbaru as $item)
                <tr>
                    <td class="py-4 px-2 font-bold text-rose-600">{{ $item->nomor_laporan }}</td>
                    <td class="py-4 px-2 text-gray-700 font-medium">{{ $item->kategori }}</td>
                    <td class="py-4 px-2 text-gray-600">{{ $item->nama_pelapor ?? 'Revitaaa' }}</td>
                    <td class="py-4 px-2 text-gray-500">{{ optional($item->tanggal_kejadian)->format('d M Y') ?? date('d M Y') }}</td>
                    <td class="py-4 px-2 text-center">
                        @if($item->status_penanganan == 'Menunggu Verifikasi')
                            <span class="bg-amber-50 text-amber-600 px-3 py-1 rounded-full font-bold">Menunggu Verifikasi</span>
                        @elseif($item->status_penanganan == 'Sedang Diproses' || $item->status_penanganan == 'Diproses')
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-bold">Sedang Diproses</span>
                        @else
                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full font-bold">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-6 text-center text-gray-400">Belum ada laporan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>