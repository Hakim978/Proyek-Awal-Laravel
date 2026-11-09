<h1>{{ $judul }}</h1>
@if ($ringkasan['barang'] > 0)
<p>Ada {{ $ringkasan['barang'] }} barang.</p>
@else
<p>Belum ada barang.</p>
@endif