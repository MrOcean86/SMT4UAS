<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Warung Makan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/smt4uas/public/">Warung Makan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @if(session('user'))
                        @if(session('user')->role == 'admin')
                            <li class="nav-item"><a class="nav-link" href="/smt4uas/public/">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="/smt4uas/public/makanan">Makanan</a></li>
                            <li class="nav-item"><a class="nav-link" href="/smt4uas/public/minuman">Minuman</a></li>
                            <li class="nav-item"><a class="nav-link" href="/smt4uas/public/penjualan">Penjualan</a></li>
                            <li class="nav-item"><a class="nav-link" href="/smt4uas/public/historypenjualan">History Penjualan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Keranjang Belanja</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="/smt4uas/public/penjualan">Penjualan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Keranjang Belanja</a></li>
                        @endif
                    @else
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Keranjang Belanja</a></li>
                    @endif
                </ul>
                <ul class="navbar-nav ms-auto d-none d-lg-flex">
                    {{-- Dihapus: Username dan Logout di luar hamburger --}}
                </ul>
                <!-- Hamburger dropdown for account (visible on all screens, but especially mobile) -->
                <div class="dropdown ms-2">
                    <button class="btn btn-dark dropdown-toggle d-flex align-items-center" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        @if(session('user'))
                            <li class="dropdown-item-text">Halo, <strong>{{ session('user')->username }}</strong></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <div class="container">
            <small>&copy; {{ date('Y') }} Warung Makan. All rights reserved.</small>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
