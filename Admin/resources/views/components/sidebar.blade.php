<aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 min-h-screen">
    <div>
        <!-- Brand Logo -->
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full bg-rose-500 flex items-center justify-center p-2 text-white shadow-md shadow-rose-200">
                <svg class="w-full h-full text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                    <path d="M12 5 9.04 7.96a2.17 2.17 0 0 0 0 3.08v0c.82.82 2.13.85 3 .07l2.07-1.9"/>
                    <path d="m14 10 1.5 1.5"/>
                </svg>
            </div>
            <div>
                <h1 class="font-extrabold text-rose-600 text-lg leading-none">SAPA</h1>
                <p class="text-xs text-gray-400">Sistem Pelaporan Aman</p>
            </div>
        </div>

        <!-- Navigation Menu (Hanya 3 Menu Utama) -->
        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('dashboard') ? 'bg-rose-500 text-white shadow-md shadow-rose-200' : 'text-gray-600 hover:bg-gray-50' }}">
                <span>🏠</span> Dashboard
            </a>

            <a href="{{ route('laporan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('laporan.*') ? 'bg-rose-500 text-white shadow-md shadow-rose-200' : 'text-gray-600 hover:bg-gray-50' }}">
                <span>📄</span> Laporan Masuk
            </a>

            <a href="{{ route('pengguna.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition {{ request()->routeIs('pengguna.*') ? 'bg-rose-500 text-white shadow-md shadow-rose-200' : 'text-gray-600 hover:bg-gray-50' }}">
                <span>👤</span> Manajemen Pengguna
            </a>
        </nav>
    </div>

    <!-- Tombol Logout Langsung di Profil Bawah -->
    <div class="pt-4 border-t border-gray-100">
        <a href="{{ route('logout') }}" 
           onclick="return confirm('Apakah Anda yakin ingin keluar dari sistem?')"
           title="Klik untuk Keluar" 
           class="flex items-center justify-between p-2 rounded-2xl hover:bg-rose-50 transition group cursor-pointer">
            <div class="flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name=Revita&background=f43f5e&color=fff" class="w-10 h-10 rounded-full object-cover shadow-sm" alt="Revita Profile">
                <div>
                    <h4 class="font-bold text-sm text-gray-800 leading-tight group-hover:text-rose-600 transition">Revita</h4>
                    <p class="text-xs text-gray-400">Super Admin</p>
                </div>
            </div>

            <!-- Ikon Pintu Keluar / Logout -->
            <div class="w-8 h-8 rounded-xl flex items-center justify-center text-gray-400 group-hover:text-rose-600 group-hover:bg-rose-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
        </a>
    </div>
</aside>