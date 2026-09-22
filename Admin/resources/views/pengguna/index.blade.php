<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-rose-600">Manajemen Pengguna</h2>
        <div class="relative w-72">
            <input type="text" placeholder="Cari nama, email, NIK..." class="w-full pl-9 pr-4 py-2 bg-white border border-rose-100 rounded-xl text-xs focus:ring-rose-500 focus:border-rose-500">
            <span class="absolute left-3 top-2 text-gray-400 text-xs">🔍</span>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-rose-50/50 text-gray-500 text-xs font-bold uppercase border-b border-rose-100">
                    <th class="py-3 px-4">Nama Lengkap</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Nomor HP</th>
                    <th class="py-3 px-4">Tanggal Daftar</th>
                    <th class="py-3 px-4">Total Laporan</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-xs">
                <tr class="hover:bg-rose-50/20">
                    <td class="py-4 px-4 font-bold text-gray-800 flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Revita+Sari&background=f43f5e&color=fff" class="w-8 h-8 rounded-full object-cover">
                        Revita Sari
                    </td>
                    <td class="py-4 px-4 text-gray-600">revita.sari@gmail.com</td>
                    <td class="py-4 px-4 text-gray-600">0812-3456-7890</td>
                    <td class="py-4 px-4 text-gray-500">12 Apr 2025</td>
                    <td class="py-4 px-4 font-bold text-rose-600">1 Laporan</td>
                    <td class="py-4 px-4"><a href="#" class="text-rose-600 font-bold hover:underline">Detail</a></td>
                </tr>
                <tr class="hover:bg-rose-50/20">
                    <td class="py-4 px-4 font-bold text-gray-800 flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Daffa+Pratama&background=3b82f6&color=fff" class="w-8 h-8 rounded-full object-cover">
                        Daffa Pratama
                    </td>
                    <td class="py-4 px-4 text-gray-600">daffa.pratama@yahoo.com</td>
                    <td class="py-4 px-4 text-gray-600">0823-4567-8901</td>
                    <td class="py-4 px-4 text-gray-500">08 Mar 2025</td>
                    <td class="py-4 px-4 font-bold text-rose-600">2 Laporan</td>
                    <td class="py-4 px-4"><a href="#" class="text-rose-600 font-bold hover:underline">Detail</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>