<div class="row g-3">
    <div class="col-md-6">
        <label for="code" class="form-label fw-semibold">Kode barang <span class="text-danger">*</span></label>
        <input id="code" name="code" value="{{ old('code', $item->code ?? '') }}" class="form-control @error('code') is-invalid @enderror" maxlength="50" required>
        @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="name" class="form-label fw-semibold">Nama barang <span class="text-danger">*</span></label>
        <input id="name" name="name" value="{{ old('name', $item->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" maxlength="150" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="category" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
        <input id="category" name="category" value="{{ old('category', $item->category ?? '') }}" class="form-control @error('category') is-invalid @enderror" maxlength="100" placeholder="Contoh: Elektronik" required>
        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label for="stock" class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
        <input id="stock" name="stock" type="number" min="0" step="1" value="{{ old('stock', $item->stock ?? 0) }}" class="form-control @error('stock') is-invalid @enderror" required>
        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label for="unit" class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
        <input id="unit" name="unit" value="{{ old('unit', $item->unit ?? 'pcs') }}" class="form-control @error('unit') is-invalid @enderror" maxlength="30" required>
        @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="price" class="form-label fw-semibold">Harga satuan (Rp) <span class="text-danger">*</span></label>
        <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $item->price ?? '') }}" class="form-control @error('price') is-invalid @enderror" placeholder="0" required>
        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="d-flex flex-wrap justify-content-end gap-2 border-top mt-4 pt-4">
    <a href="{{ route('items.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
    <button type="submit" class="btn btn-success rounded-pill px-4">{{ $submitLabel }}</button>
</div>
