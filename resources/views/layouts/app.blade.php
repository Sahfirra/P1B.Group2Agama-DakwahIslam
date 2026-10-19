<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'e-Masjid.id')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=3">

    @if (request()->routeIs('blog.*'))
        <link rel="stylesheet" href="{{ asset('css/dakwah.css') }}?v=3">
    @endif

    @if (request()->routeIs('jadwal.*'))
        <link rel="stylesheet" href="{{ asset('css/jadwal.css') }}?v=3">
    @endif

    @if (request()->routeIs('dashboard'))
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}?v=3">
    @endif

    @if (request()->routeIs('tentang'))
        <link rel="stylesheet" href="{{ asset('css/tentang.css') }}?v=3">
    @endif
</head>

<body>

    <header class="site-header">
        <div class="navbar">

            <a href="{{ route('dashboard') }}" class="brand">
                <span class="brand-name">e-Masjid.id</span>
                <small>Website Informasi Masjid</small>
            </a>

            <nav class="nav-menu">

                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('jadwal.index') }}"
                   class="{{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                    Jadwal Kegiatan
                </a>

                <a href="{{ route('blog.index') }}"
                   class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                    Dakwah Islam
                </a>

                <a href="{{ route('tentang') }}"
                   class="{{ request()->routeIs('tentang') ? 'active' : '' }}">
                    Tentang Kami
                </a>

            </nav>

        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="site-footer-inner">
            <div class="site-footer-brand">
                <h3>e-Masjid.id</h3>
                <p>
                    Memakmurkan masjid, menghubungkan umat,
                    dan bertumbuh bersama teknologi.
                </p>
            </div>
            <div class="site-footer-nav">
                <span>NAVIGASI</span>
                <div class="site-footer-links">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('jadwal.index') }}">Jadwal Kegiatan</a>
                    <a href="{{ route('blog.index') }}">Dakwah Islam</a>
                    <a href="{{ route('tentang') }}">Tentang Kami</a>
                </div>
            </div>
        </div>
        <div class="site-footer-bottom">
            <p>&copy; 2026 e-Masjid.id. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>
</html>
