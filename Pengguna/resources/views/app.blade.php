<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sahabat PPA')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="wavy-header">
        <div class="header-top">
            @if(View::hasSection('back_url'))
                <a href="@yield('back_url')" class="btn-back-circle"><i class="bi bi-chevron-left"></i></a>
            @else
                <div style="width: 34px;"></div>
            @endif
            <div style="display: flex; gap: 14px; align-items: center;">
                <i class="bi bi-bell" style="font-size: 20px;"></i>
                <div style="width: 30px; height: 30px; background: #fff; border-radius: 50%;"></div>
            </div>
        </div>

        @hasSection('header_title')
        <div class="header-title-box">
            <h1>@yield('header_title')</h1>
            @yield('header_action')
        </div>
        @endif
    </header>

    <svg class="wavy-svg" viewBox="0 0 1440 60" preserveAspectRatio="none">
        <path fill="#FF4B72" d="M0,0 L1440,0 L1440,20 C1080,55 720,10 360,40 L0,20 Z"></path>
    </svg>

    <main class="app-container">
        @yield('content')
    </main>

    <nav class="bottom-nav">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="bi bi-house-door-fill"></i></a>
        <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat*') ? 'active' : '' }}"><i class="bi bi-file-earmark-text"></i></a>
        <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}"><i class="bi bi-person"></i></a>
    </nav>
</body>
</html>