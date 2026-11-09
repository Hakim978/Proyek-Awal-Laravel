# InventarisKu

Aplikasi Laravel untuk mencatat barang, mengelola stok, dan melihat ringkasan inventaris. Fitur yang tersedia mencakup login, dashboard, pencarian, serta tambah, ubah, dan hapus barang.

## Persyaratan

- PHP 8.3 atau lebih baru
- Composer
- Database yang didukung Laravel (default proyek menggunakan SQLite)
- Node.js dan npm hanya jika ingin membangun aset frontend

## Instalasi lokal

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
```

Atur koneksi database di `.env` sebelum menjalankan migrasi. Untuk login, buat administrator dengan mengisi `INVENTORY_ADMIN_PASSWORD` di `.env`, lalu jalankan:

```powershell
php artisan db:seed
```

Akun administrator menggunakan email `admin@gmail.com` dan password dari `INVENTORY_ADMIN_PASSWORD`. Tanpa nilai tersebut, seeder tidak membuat akun administrator. Jangan gunakan password lokal pada lingkungan produksi.

Jalankan server pengembangan dengan:

```powershell
php artisan serve
```

## Pengujian dan format kode

```powershell
php artisan test --compact
vendor/bin/pint --test
```
