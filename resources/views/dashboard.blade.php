@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
        <div>
            <p class="text-success fw-semibold small text-uppercase mb-2">Ringkasan inventaris</p>
            <h1 class="h2 fw-bold mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Pantau kondisi stok barang Anda hari ini.</p>
        </div>
        <a href="{{ route('items.create') }}" class="btn btn-success rounded-pill px-4">+ Tambah barang</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card h-100"><div class="card-body p-3 p-lg-4">
                <div class="stat-icon mb-3">#</div>
                <p class="small text-muted mb-1">Jenis barang</p>
                <p class="h3 fw-bold mb-0">{{ number_format($summary['items'], 0, ',', '.') }}</p>
            </div></div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card h-100"><div class="card-body p-3 p-lg-4">
                <div class="stat-icon mb-3">+</div>
                <p class="small text-muted mb-1">Total stok</p>
                <p class="h3 fw-bold mb-0">{{ number_format($summary['stock'], 0, ',', '.') }} <span class="fs-6 fw-normal text-muted">unit</span></p>
            </div></div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card h-100"><div class="card-body p-3 p-lg-4">
                <div class="stat-icon mb-3">C</div>
                <p class="small text-muted mb-1">Kategori</p>
                <p class="h3 fw-bold mb-0">{{ number_format($summary['categories'], 0, ',', '.') }}</p>
            </div></div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card h-100"><div class="card-body p-3 p-lg-4">
                <div class="stat-icon mb-3">!</div>
                <p class="small text-muted mb-1">Stok menipis (≤ 5)</p>
                <p class="h3 fw-bold mb-0 {{ $summary['low_stock'] > 0 ? 'text-warning' : '' }}">{{ number_format($summary['low_stock'], 0, ',', '.') }}</p>
            </div></div>
        </div>
    </div>

    <section class="card">
        <div class="card-body p-0">
            <div class="d-flex justify-content-between align-items-center p-3 p-lg-4 border-bottom">
                <div>
                    <h2 class="h5 fw-bold mb-1">Barang terbaru</h2>
                    <p class="small text-muted mb-0">Data barang yang terakhir ditambahkan.</p>
                </div>
                <a href="{{ route('items.index') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">Lihat semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light"><tr><th class="ps-4">Barang</th><th>Kategori</th><th>Stok</th><th class="text-end pe-4">Harga</th></tr></thead>
                    <tbody>
                        @forelse ($recentItems as $item)
                            <tr>
                                <td class="ps-4"><div class="fw-semibold">{{ $item->name }}</div><div class="small text-muted">{{ $item->code }}</div></td>
                                <td>{{ $item->category }}</td>
                                <td>{{ number_format($item->stock, 0, ',', '.') }} {{ $item->unit }}</td>
                                <td class="text-end pe-4">Rp{{ number_format((float) $item->price, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-5"><p class="fw-semibold mb-1">Belum ada barang</p><p class="small text-muted mb-3">Mulai dengan menambahkan barang pertama Anda.</p><a href="{{ route('items.create') }}" class="btn btn-success btn-sm rounded-pill px-3">Tambah barang</a></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
