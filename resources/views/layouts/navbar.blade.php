<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container page-wrap">
        <a class="navbar-brand d-flex align-items-center gap-2 me-4" href="{{ route('dashboard') }}">
            <span class="brand-mark">I</span>
            <span class="brand-name fw-bold">Inventaris<span class="text-success">Ku</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavigation">
            <div class="navbar-nav me-auto gap-lg-2">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}" href="{{ route('items.index') }}">Daftar Barang</a>
            </div>
            <div class="d-flex align-items-center gap-3 py-3 py-lg-0">
                <span class="small text-muted">Halo, <strong class="text-dark">{{ auth()->user()->name }}</strong></span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" type="submit">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</nav>