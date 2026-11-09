@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
        <div>
            <p class="text-success fw-semibold small text-uppercase mb-2">Inventaris</p>
            <h1 class="h2 fw-bold mb-1">Daftar barang</h1>
            <p class="text-muted mb-0">Kelola informasi dan jumlah stok barang.</p>
        </div>
        <a href="{{ route('items.create') }}" class="btn btn-success rounded-pill px-4">+ Tambah barang</a>
    </div>

    <section class="card">
        <div class="card-body p-3 p-lg-4">
            <form method="GET" action="{{ route('items.index') }}" class="row g-2 align-items-center mb-3">
                <div class="col-12 col-md">
                    <label class="visually-hidden" for="search">Cari barang</label>
                    <input id="search" name="search" type="search" value="{{ $search }}" class="form-control" placeholder="Cari nama, kode, atau kategori barang...">
                </div>
                <div class="col-6 col-md-auto"><button class="btn btn-outline-success w-100 rounded-pill px-4" type="submit">Cari</button></div>
                @if ($search !== '')
                    <div class="col-6 col-md-auto"><a href="{{ route('items.index') }}" class="btn btn-light w-100 rounded-pill px-3">Reset</a></div>
                @endif
            </form>
            <div class="d-flex justify-content-between small text-muted mb-2">
                <span>{{ $items->total() }} barang ditemukan</span>
                @if ($search !== '')<span>Hasil untuk “{{ $search }}”</span>@endif
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light"><tr><th>Kode</th><th>Nama barang</th><th>Kategori</th><th>Stok</th><th>Harga</th><th class="text-end">Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td><span class="badge text-bg-light border fw-medium">{{ $item->code }}</span></td>
                                <td class="fw-semibold">{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td><span class="badge rounded-pill {{ $item->stock <= 5 ? 'text-bg-warning' : 'text-bg-success' }}">{{ number_format($item->stock, 0, ',', '.') }} {{ $item->unit }}</span></td>
                                <td>Rp{{ number_format((float) $item->price, 0, ',', '.') }}</td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Ubah</a>
                                    <form method="POST" action="{{ route('items.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center py-5"><p class="fw-semibold mb-1">{{ $search !== '' ? 'Barang tidak ditemukan' : 'Belum ada data barang' }}</p><p class="small text-muted mb-3">{{ $search !== '' ? 'Coba kata kunci yang berbeda.' : 'Tambahkan barang agar stok dapat mulai dikelola.' }}</p>@if ($search === '')<a href="{{ route('items.create') }}" class="btn btn-success btn-sm rounded-pill px-3">Tambah barang</a>@endif</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($items->hasPages())
                <div class="pt-3">{{ $items->links('pagination::bootstrap-5') }}</div>
            @endif
        </div>
    </section>
@endsection