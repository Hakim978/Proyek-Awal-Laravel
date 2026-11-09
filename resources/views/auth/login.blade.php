<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk | InventarisKu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background: #f5f7f5; color: #17231d; font-family: 'DM Sans', sans-serif; }
        h1, .brand-name { font-family: 'Manrope', sans-serif; }
        .login-shell { min-height: 100vh; background: radial-gradient(circle at 15% 20%, #e8f4ec, transparent 34%), #f5f7f5; }
        .brand-mark { display: grid; width: 42px; height: 42px; place-items: center; border-radius: 14px; background: #e7f5ee; color: #16835d; font-weight: 800; }
        .login-card { border: 1px solid #e9ede9; border-radius: 20px; box-shadow: 0 16px 48px rgba(27, 49, 37, .08); }
        .form-control { border-color: #e0e6e1; border-radius: 10px; padding: .75rem .85rem; }
        .form-control:focus { border-color: #75b99a; box-shadow: 0 0 0 .2rem rgba(22, 131, 93, .12); }
        .btn-success { --bs-btn-bg: #16835d; --bs-btn-border-color: #16835d; --bs-btn-hover-bg: #116c4d; --bs-btn-hover-border-color: #116c4d; }
    </style>
</head>
<body class="login-shell d-flex align-items-center py-5">
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
                <div class="text-center mb-4">
                    <div class="brand-mark mx-auto mb-3">I</div>
                    <div class="brand-name fw-bold fs-4">Inventaris<span class="text-success">Ku</span></div>
                    <p class="text-secondary mt-2 mb-0">Kelola stok barang dengan lebih mudah.</p>
                </div>
                <div class="card login-card">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h4 fw-bold mb-1">Selamat datang</h1>
                        <p class="text-secondary mb-4">Masuk ke akun inventaris Anda.</p>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
                        @endif
                        <form method="POST" action="{{ route('login.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" autocomplete="username" required autofocus>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Kata sandi</label>
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-check mb-4">
                                <input id="remember" name="remember" type="checkbox" class="form-check-input" value="1">
                                <label for="remember" class="form-check-label text-secondary">Ingat saya</label>
                            </div>
                            <button class="btn btn-success w-100 py-2 fw-semibold" type="submit">Masuk</button>
                        </form>
                    </div>
                </div>
                <p class="small text-secondary text-center mt-4 mb-0">Sistem pengelolaan inventaris barang</p>
            </div>
        </div>
    </main>
</body>
</html>
