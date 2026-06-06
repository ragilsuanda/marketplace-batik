@extends('backend.layout.app')
@section('content')

<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center gap-2 bg-warning text-dark py-3">
          <i class="bi bi-pencil-square fs-5"></i>
          <h5 class="mb-0">Edit Produk</h5>
        </div>
        <div class="card-body p-4">

          @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
              <i class="bi bi-exclamation-triangle me-1"></i> <strong>Ada kesalahan input:</strong>
              <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">

              {{-- Nama Produk --}}
              <div class="col-md-6">
                <label class="form-label fw-semibold">
                  <i class="bi bi-tag me-1 text-warning"></i>Nama Produk <span class="text-danger">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Contoh: Kain Batik Tulis">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Kategori --}}
              <div class="col-md-6">
                <label class="form-label fw-semibold">
                  <i class="bi bi-tags me-1 text-warning"></i>Kategori <span class="text-danger">*</span>
                </label>
                <select name="category_id"
                        class="form-select @error('category_id') is-invalid @enderror">
                  <option value="">-- Pilih Kategori --</option>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                      {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                      {{ $cat->name }}
                    </option>
                  @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Harga --}}
              <div class="col-md-6">
                <label class="form-label fw-semibold">
                  <i class="bi bi-cash-coin me-1 text-success"></i>Harga (Rp) <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="number" name="price" value="{{ old('price', $product->price) }}"
                         class="form-control @error('price') is-invalid @enderror"
                         placeholder="0" min="0" step="100">
                  @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              {{-- Stok saat ini (read-only) --}}
              <div class="col-md-3">
                <label class="form-label fw-semibold">
                  <i class="bi bi-archive me-1 text-secondary"></i>Stok Saat Ini
                </label>
                <input type="text"
                       value="{{ $product->stock }} pcs"
                       class="form-control bg-light text-muted fw-bold"
                       readonly>
                <div class="form-text">Berkurang otomatis saat checkout.</div>
              </div>

              {{-- Tambah Stok --}}
              <div class="col-md-3">
                <label class="form-label fw-semibold">
                  <i class="bi bi-plus-circle me-1 text-success"></i>Tambah Stok
                </label>
                <input type="number" name="restock"
                       value="{{ old('restock', 0) }}"
                       class="form-control @error('restock') is-invalid @enderror"
                       placeholder="0" min="0">
                @error('restock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="form-text">Isi jika ada stok baru masuk.</div>
              </div>

              {{-- Ukuran --}}
              <div class="col-md-4">
                <label class="form-label fw-semibold">
                  <i class="bi bi-rulers me-1 text-info"></i>Ukuran / Size
                </label>
                <input type="text" name="size" value="{{ old('size', $product->size) }}"
                       class="form-control @error('size') is-invalid @enderror"
                       placeholder="S, M, L, XL / 38, 40, 42">
                @error('size') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Deskripsi --}}
              <div class="col-12">
                <label class="form-label fw-semibold">
                  <i class="bi bi-card-text me-1 text-secondary"></i>Deskripsi Produk
                </label>
                <textarea name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Tuliskan deskripsi produk...">{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- FOTO PRODUK (3 slot) --}}
              <div class="col-12">
                <label class="form-label fw-semibold">
                  <i class="bi bi-images me-1 text-danger"></i>Foto Produk
                  <small class="text-muted fw-normal">(Kosongkan jika tidak ingin mengubah foto)</small>
                </label>

                <div class="row g-3 mt-1">
                  @foreach([
                    ['image',   'Foto Utama', 'danger'],
                    ['image_2', 'Foto 2',     'secondary'],
                    ['image_3', 'Foto 3',     'secondary'],
                  ] as [$field, $label, $color])
                  <div class="col-md-4">
                    <div class="border rounded p-2 text-center bg-light" style="min-height:190px;">
                      <p class="fw-semibold mb-2 text-{{ $color }} small">{{ $label }}</p>

                      {{-- Foto saat ini --}}
                      <div id="current_{{ $field }}" class="{{ $product->$field ? '' : 'd-none' }} mb-2">
                        @if($product->$field)
                          <img src="{{ asset('storage/' . $product->$field) }}"
                               alt="{{ $label }}"
                               class="rounded img-fluid"
                               style="max-height:110px;object-fit:contain;">
                        @endif
                      </div>

                      {{-- Preview foto baru --}}
                      <div id="preview_{{ $field }}" class="mb-2 d-none">
                        <img id="img_{{ $field }}" src="#" alt="Preview"
                             class="rounded img-fluid"
                             style="max-height:110px;object-fit:contain;">
                      </div>

                      {{-- Placeholder jika tidak ada foto --}}
                      <div id="placeholder_{{ $field }}" class="{{ $product->$field ? 'd-none' : '' }} mb-2">
                        <i class="bi bi-camera fs-1 text-muted"></i>
                      </div>

                      <input type="file" name="{{ $field }}" id="{{ $field }}"
                             class="form-control form-control-sm @error($field) is-invalid @enderror"
                             accept="image/*"
                             onchange="previewImg('{{ $field }}')">
                      @error($field) <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>

            </div>{{-- end row --}}

            <hr class="my-4">

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-warning px-4">
                <i class="bi bi-arrow-repeat me-1"></i> Update Produk
              </button>
              <a href="{{ route('products.index') }}" class="btn btn-secondary px-4">
                <i class="bi bi-arrow-left me-1"></i> Kembali
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function previewImg(field) {
    const input = document.getElementById(field);
    const preview = document.getElementById('preview_' + field);
    const img = document.getElementById('img_' + field);
    const current = document.getElementById('current_' + field);
    const placeholder = document.getElementById('placeholder_' + field);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            preview.classList.remove('d-none');
            if (current) current.classList.add('d-none');
            if (placeholder) placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('d-none');
        // Kembalikan tampilan semula
        if (current && '{{ $product->$field ?? "" }}') current.classList.remove('d-none');
        else if (placeholder) placeholder.classList.remove('d-none');
    }
}
</script>

@endsection
