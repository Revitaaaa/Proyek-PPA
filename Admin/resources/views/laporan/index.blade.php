<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-rose-600">Laporan Masuk</h2>
        <span class="bg-rose-500 text-white text-xs font-bold px-4 py-2 rounded-xl">Total: {{ $laporans->total() }} Kasus</span>
    </div>

    <!-- Filter & Search Bar -->
    <form method="GET" action="{{ route('laporan.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="relative md:col-span-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID Laporan, Pelapor, atau Lokasi..." class="w-full pl-9 pr-4 py-2.5 bg-white border border-rose-100 rounded-xl text-xs focus:ring-rose-500 focus:border-rose-500">
            <span class="absolute left-3 top-2.5 text-gray-400 text-xs">🔍</span>
        </div>

        <select name="kategori" onchange="this.form.submit()" class="bg-white border border-rose-100 text-xs rounded-xl p-2.5 text-gray-600">
            <option value="">Semua Kategori</option>
            <option value="Kekerasan terhadap Perempuan" {{ request('kategori') == 'Kekerasan terhadap Perempuan' ? 'selected' : '' }}>Kekerasan Perempuan</option>
            <option value="KDRT" {{ request('kategori') == 'KDRT' ? 'selected' : '' }}>KDRT</option>
            <option value="Perundungan (Bullying)" {{ request('kategori') == 'Perundungan (Bullying)' ? 'selected' : '' }}>Bullying</option>
            <option value="Kekerasan Seksual" {{ request('kategori') == 'Kekerasan Seksual' ? 'selected' : '' }}>Kekerasan Seksual</option>
            <option value="Kekerasan Anak" {{ request('kategori') == 'Kekerasan Anak' ? 'selected' : '' }}>Kekerasan Anak</option>
        </select>

        <select name="status" onchange="this.form.submit()" class="bg-white border border-rose-100 text-xs rounded-xl p-2.5 text-gray-600">
            <option value="">Semua Status</option>
            <option value="Menunggu Verifikasi" {{ request('status') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
            <option value="Sedang Diproses" {{ request('status') == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <button type="submit" class="bg-rose-50 border border-rose-200 text-rose-600 text-xs font-bold py-2.5 rounded-xl hover:bg-rose-100">Filter Data</button>
    </form>

    <!-- Table Card -->
    <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-rose-50/50 text-gray-500 text-xs font-bold uppercase border-b border-rose-100">
                    <th class="py-3 px-4">No Laporan</th>
                    <th class="py-3 px-4">Kategori</th>
                    <th class="py-3 px-4">Sebagai</th>
                    <th class="py-3 px-4">Lokasi</th>
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-xs">
                @forelse($laporans as $item)
                <tr>
                    <td class="py-4 px-4 font-bold text-rose-600">{{ $item->nomor_laporan }}</td>
                    <td class="py-4 px-4 font-semibold text-gray-800">{{ $item->kategori }}</td>
                    <td class="py-4 px-4 text-gray-600">{{ $item->sebagai }}</td>
                    <td class="py-4 px-4 text-gray-600">{{ $item->lokasi }}</td>
                    <td class="py-4 px-4 text-gray-500">{{ $item->tanggal_kejadian->format('d Mei Y') }}</td>
                    <td class="py-4 px-4">
                        @if($item->status == 'Menunggu Verifikasi')
                            <span class="bg-amber-50 text-amber-600 px-3 py-1 rounded-full font-bold">Menunggu Verifikasi</span>
                        @elseif($item->status == 'Sedang Diproses')
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full font-bold">Sedang Diproses</span>
                        @else
                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full font-bold">Selesai</span>
                        @endif
                    </td>
                    <td class="py-4 px-4">
                        <a href="{{ route('laporan.show', $item->id) }}" class="bg-rose-500 text-white font-bold px-3 py-1.5 rounded-lg hover:bg-rose-600 transition">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-400">Belum ada data laporan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $laporans->links() }}
        </div>
    </div>
</x-app-layout>