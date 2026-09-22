<x-app-layout>
    <h2 class="text-2xl font-bold text-rose-600 mb-6">Pengaturan Admin</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Informasi Profil Card -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
            <h3 class="font-bold text-rose-600 mb-4">Informasi Profil Admin</h3>
            <form class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" value="Revita Sari, S.Kom." class="w-full border-gray-200 bg-gray-50 rounded-xl text-xs p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" value="revita.sari@sapaindonesia.go.id" class="w-full border-gray-200 bg-gray-50 rounded-xl text-xs p-3">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Peran Hak Akses</label>
                        <input type="text" value="Super Admin" readonly class="w-full border-gray-200 bg-rose-50 text-rose-600 font-bold rounded-xl text-xs p-3">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">ID Admin</label>
                        <input type="text" value="SAPA-ADM-010" readonly class="w-full border-gray-200 bg-gray-50 rounded-xl text-xs p-3">
                    </div>
                </div>
                <div class="text-right pt-2">
                    <button type="button" class="bg-rose-500 text-white text-xs font-bold px-6 py-2.5 rounded-xl hover:bg-rose-600">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <!-- Ganti Password Card -->
        <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
            <h3 class="font-bold text-rose-600 mb-4">Ganti Password</h3>
            <form class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Password Lama</label>
                    <input type="password" placeholder="Masukkan password lama" class="w-full border-gray-200 rounded-xl text-xs p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Password Baru</label>
                    <input type="password" placeholder="Masukkan password baru" class="w-full border-gray-200 rounded-xl text-xs p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" placeholder="Konfirmasi password baru" class="w-full border-gray-200 rounded-xl text-xs p-3">
                </div>
                <button type="button" class="w-full bg-rose-500 text-white text-xs font-bold py-2.5 rounded-xl hover:bg-rose-600">Perbarui Password</button>
            </form>
        </div>
    </div>
</x-app-layout>