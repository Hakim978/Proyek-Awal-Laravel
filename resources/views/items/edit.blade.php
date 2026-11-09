@extends('layouts.app')

@section('title', 'Ubah Barang')

@section('content')
    <div class="mb-4">
        <a href="{{ route('items.index') }}" class="small text-success text-decoration-none">← Kembali ke daftar barang</a>
        <h1 class="h2 fw-bold mt-3 mb-1">Ubah barang</h1>
        <p class="text-muted mb-0">Perbarui informasi {{ $item->name }}.</p>
    </div>
    <section class="card"><div class="card-body p-4 p-lg-5">
        <form method="POST" action="{{ route('items.update', $item) }}">
            @csrf
            @method('PUT')
            @include('items._form', ['submitLabel' => 'Simpan perubahan'])
        </form>
    </div></section>
@endsection