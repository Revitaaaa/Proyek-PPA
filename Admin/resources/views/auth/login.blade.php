<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SAPA (Sistem Pelaporan Aman)</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-rose-50 via-white to-rose-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Kartu Login -->
        <div class="bg-white rounded-3xl shadow-xl shadow-rose-100/50 border border-rose-100 p-8 sm:p-10">
            
            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-rose-500 rounded-2xl shadow-lg shadow-rose-500/30 mb-4">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-black text-gray-800 tracking-tight">SAPA</h1>
                <p class="text-xs font-semibold text-rose-500 tracking-widest uppercase mt-0.5">Sistem Pelaporan Aman</p>
                <div class="mt-4 inline-block bg-rose-50 text-rose-600 text-xs font-bold px-3 py-1 rounded-full border border-rose-100">
                    Portal Masuk Admin
                </div>
            </div>

            <!-- Notifikasi Error (Jika ada) -->
            @if(session('error'))
                <div class="mb-5 p-3.5 bg-rose-50 border border-rose-200 text-rose-600 rounded-xl text-xs font-semibold flex items-center gap-2">
                    <span>⚠️</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
                
                <!-- Input Email -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Email Admin</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 text-sm">✉️</span>
                        <input type="email" name="email" value="Revita@sapa.id" required
                            placeholder="nama@sapa.id"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-400 focus:border-transparent transition">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-xs font-bold text-gray-700">Kata Sandi</label>
                        <a href="#" class="text-[11px] font-semibold text-rose-500 hover:underline">Lupa sandi?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 text-sm">🔒</span>
                        <input type="password" name="password" value="123456" required
                            placeholder="Masukkan kata sandi"
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-400 focus:border-transparent transition">
                    </div>
                </div>

                <!-- Ingat Saya -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" checked class="w-4 h-4 rounded text-rose-500 focus:ring-rose-400 border-gray-300">
                        <span class="text-xs text-gray-600 font-medium">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Tombol Masuk -->
                <div class="pt-3">
                    <button type="submit"
                        class="w-full py-3 px-4 bg-rose-500 hover:bg-rose-600 active:scale-[0.99] text-white font-bold text-xs rounded-xl shadow-lg shadow-rose-500/25 transition duration-200 flex items-center justify-center gap-2">
                        <span>Masuk ke Dashboard</span>
                        <span>→</span>
                    </button>
                </div>
            </form>

            <!-- Footer Hak Cipta -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-gray-400 text-[11px]">
                &copy; {{ date('Y') }} SAPA - Sahabat Perlindungan Perempuan & Anak.
            </div>
        </div>
    </div>

</body>
</html>