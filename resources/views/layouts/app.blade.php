<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'InventarisKu') | InventarisKu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --ink: #17231d; --muted: #77827b; --green: #16835d; --canvas: #f5f7f5; }
        body { background: var(--canvas); color: var(--ink); font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, .brand-name { font-family: 'Manrope', sans-serif; }
        .navbar { background: #fff; border-bottom: 1px solid #e8ece8; }
        .brand-mark { display: grid; width: 38px; height: 38px; place-items: center; border-radius: 12px; background: #e7f5ee; color: var(--green); font-weight: 800; }
        .nav-link { color: #647169; font-weight: 600; }
        .nav-link.active, .nav-link:hover { color: var(--green); }
        .page-wrap { max-width: 1180px; }
        .card { border: 1px solid #e9ede9; border-radius: 16px; box-shadow: 0 5px 22px rgba(27, 49, 37, .035); }
        .btn-success { --bs-btn-bg: var(--green); --bs-btn-border-color: var(--green); --bs-btn-hover-bg: #116c4d; --bs-btn-hover-border-color: #116c4d; }
        .text-muted { color: var(--muted) !important; }
        .form-control, .form-select { border-color: #e0e6e1; border-radius: 10px; padding: .7rem .85rem; }
        .form-control:focus, .form-select:focus { border-color: #75b99a; box-shadow: 0 0 0 .2rem rgba(22, 131, 93, .12); }
        .table > :not(caption) > * > * { padding: .9rem .75rem; vertical-align: middle; }
        .stat-icon { display: grid; width: 44px; height: 44px; place-items: center; border-radius: 14px; background: #eaf5ee; color: var(--green); font-size: 1.15rem; }
        @media (max-width: 575px) { .table > :not(caption) > * > * { padding: .7rem .5rem; } }
    </style>
</head>
<body>
    @include('layouts.navbar')
    <main class="container page-wrap py-4 py-lg-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>