<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAPA - Masuk Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-rose-50/40 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl shadow-rose-100 overflow-hidden border border-rose-50">
       <!-- Card Header -->
<div class="bg-rose-500 py-8 px-6 text-center text-white">
    <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 p-3">
        <!-- SVG Logo Gambar 2 -->
        <svg class="w-full h-full text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
            <path d="M12 5 9.04 7.96a2.17 2.17 0 0 0 0 3.08v0c.82.82 2.13.85 3 .07l2.07-1.9"/>
            <path d="m14 10 1.5 1.5"/>
        </svg>
    </div>
    <h1 class="font-extrabold text-lg tracking-wider">SAPA INDONESIA</h1>
</div>

        <!-- Card Body -->
        <div class="p-8">
            <h2 class="text-xl font-bold text-rose-600 mb-1">Masuk sebagai Admin</h2>
            <p class="text-xs text-gray-400 mb-6">Silakan masuk untuk mengelola pengaduan</p>

            <form action="{{ route('dashboard') }}" method="GET" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-rose-600 mb-1">Email atau ID Admin</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-rose-400">✉</span>
                        <input type="email" value="admin@sapaindonesia.go.id" class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-xs focus:ring-rose-500 focus:border-rose-500 text-gray-700" placeholder="admin@sapaindonesia.go.id" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-rose-600 mb-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-rose-400">🔒</span>
                        <input type="password" value="••••••••••••" class="w-full pl-9 pr-10 py-2.5 border border-gray-200 rounded-xl text-xs focus:ring-rose-500 focus:border-rose-500 text-gray-700" required>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 cursor-pointer">👁</span>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 bg-rose-500 hover:bg-rose-600 text-white font-bold text-xs rounded-xl shadow-md shadow-rose-200 transition mt-2">
                    MASUK KE DASHBOARD
                </button>
            </form>
        </div>
    </div>

</body>
</html>