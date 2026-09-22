<x-app-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-rose-600">Pengaturan Admin</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kartu 1: Informasi Profil Admin -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
            <h3 class="font-bold text-rose-600 text-sm mb-4">Informasi Profil Admin</h3>

            @if(session('success_profil'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-xs font-semibold">
                    ✓ {{ session('success_profil') }}
                </div>
            @endif

            <form action="{{ route('pengaturan.update-profil') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" 
                        value="{{ $admin->name ?? 'Revita' }}" required
                        class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs text-gray-800 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>

                <!-- Alamat Email -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" 
                        value="{{ $admin->email ?? 'revita@gmail.com' }}" required
                        class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs text-gray-800 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>

                <!-- Peran & ID Admin -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-1">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Peran Hak Akses</label>
                        <div class="px-4 py-2.5 bg-rose-50 border border-rose-100 rounded-xl text-xs font-bold text-rose-600">
                            Super Admin
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">ID Admin</label>
                        <div class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-semibold text-gray-700">
                            SAPA-ADM-{{ str_pad($admin->id ?? 1, 3, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-rose-500 text-white text-xs font-bold px-6 py-2.5 rounded-xl hover:bg-rose-600 active:scale-95 transition shadow-sm cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Kartu 2: Ganti Password -->
        <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm h-fit">
            <h3 class="font-bold text-rose-600 text-sm mb-4">Ganti Password</h3>

            @if(session('success_password'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-xs font-semibold">
                    ✓ {{ session('success_password') }}
                </div>
            @endif

            <form action="{{ route('pengaturan.update-password') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Password Lama</label>
                    <input type="password" name="password_lama" placeholder="Masukkan password lama" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs text-gray-700 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password_baru" placeholder="Masukkan password baru" required class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs text-gray-700 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="konfirmasi_password" placeholder="Konfirmasi password baru" required class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs text-gray-700 focus:ring-rose-500 focus:border-rose-500 transition">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-rose-500 text-white text-xs font-bold py-2.5 rounded-xl hover:bg-rose-600 active:scale-95 transition shadow-sm cursor-pointer">
                        Perbarui Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>