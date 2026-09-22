<x-app-layout>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-rose-600">Selamat datang, Admin</h2>
            <p class="text-gray-500 text-sm">Berikut adalah rangkuman aktivitas laporan hari ini.</p>
        </div>
        <div class="bg-white border border-gray-200 px-4 py-2 rounded-xl text-xs font-semibold text-gray-600 flex items-center gap-2">
            <span>📅</span> 12 Mei 2025
        </div>
    </div>

    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm relative">
            <span class="w-2.5 h-2.5 bg-rose-500 rounded-full absolute top-6 right-6"></span>
            <p class="text-sm text-gray-500 font-medium">Total Laporan</p>
            <h3 class="text-3xl font-bold text-gray-800 my-2">{{ $totalLaporan }}</h3>
            <p class="text-xs text-rose-500 font-semibold">+12% minggu ini</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm relative">
            <span class="w-2.5 h-2.5 bg-amber-500 rounded-full absolute top-6 right-6"></span>
            <p class="text-sm text-gray-500 font-medium">Menunggu Verifikasi</p>
            <h3 class="text-3xl font-bold text-gray-800 my-2">{{ $menungguVerifikasi }}</h3>
            <p class="text-xs text-amber-600 font-semibold">Butuh tindakan segera</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm relative">
            <span class="w-2.5 h-2.5 bg-blue-500 rounded-full absolute top-6 right-6"></span>
            <p class="text-sm text-gray-500 font-medium">Sedang Diproses</p>
            <h3 class="text-3xl font-bold text-gray-800 my-2">{{ $sedangDiproses }}</h3>
            <p class="text-xs text-blue-500 font-semibold">Tindak lanjut petugas</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm relative">
            <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full absolute top-6 right-6"></span>
            <p class="text-sm text-gray-500 font-medium">Selesai</p>
            <h3 class="text-3xl font-bold text-gray-800 my-2">{{ $selesai }}</h3>
            <p class="text-xs text-emerald-600 font-semibold">Kasus berhasil ditangani</p>
        </div>
    </div>

    <!-- Latest Reports Table Container -->
    <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-rose-600">Laporan Masuk Terbaru</h3>
            <a href="{{ route('laporan.index') }}" class="text-xs font-semibold text-rose-500 bg-rose-50 px-3 py-2 rounded-lg hover:bg-rose-100 transition">Lihat Semua Laporan</a>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-rose-50/50 text-gray-500 text-xs font-bold uppercase border-b border-rose-100">
                    <th class="py-3 px-4">No Laporan</th>
                    <th class="py-3 px-4">Kategori</th>
                    <th class="py-3 px-4">Pelapor</th>
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @foreach($laporanTerbaru as $item)
                <tr>
                    <td class="py-4 px-4 font-bold text-rose-600">{{ $item->nomor_laporan }}</td>
                    <td class="py-4 px-4 font-semibold text-gray-800">{{ $item->kategori }}</td>
                    <td class="py-4 px-4 text-gray-600">{{ $item->pelapor_nama }} ({{ $item->sebagai }})</td>
                    <td class="py-4 px-4 text-gray-500">{{ $item->tanggal_kejadian->format('d M Y') }}</td>
                    <td class="py-4 px-4">
                        @if($item->status == 'Menunggu Verifikasi')
                            <span class="bg-amber-50 text-amber-600 px-3 py-1 rounded-full text-xs font-bold">Menunggu Verifikasi</span>
                        @elseif($item->status == 'Sedang Diproses')
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">Sedang Diproses</span>
                        @else
                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold">Selesai</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>