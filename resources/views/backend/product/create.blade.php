@extends('backend.layout.app')
@section('content')

<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center gap-2 bg-primary text-white py-3">
          <i class="bi bi-box-seam fs-5"></i>
          <h5 class="mb-0">Tambah Produk Baru</h5>
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

          <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

              {{-- Nama Produk --}}
              <div class="col-md-6">
                <label class="form-label fw-semibold">
                  <i class="bi bi-tag me-1 text-primary"></i>Nama Produk <span class="text-danger">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Contoh: Kain Batik Tulis">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Kategori --}}
              <div class="col-md-6">
                <label class="form-label fw-semibold">
                  <i class="bi bi-tags me-1 text-primary"></i>Kategori <span class="text-danger">*</span>
                </label>
                <select name="category_id"
                        class="form-select @error('category_id') is-invalid @enderror">
                  <option value="">-- Pilih Kategori --</option>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                      {{ $cat->name }}
                    </option>
                  @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Harga --}}
              <div class="col-md-4">
                <label class="form-label fw-semibold">
                  <i class="bi bi-cash-coin me-1 text-success"></i>Harga (Rp) <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="number" name="price" value="{{ old('price') }}"
                         class="form-control @error('price') is-invalid @enderror"
                         placeholder="0" min="0" step="100">
                  @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              {{-- Stok --}}
              <div class="col-md-4">
                <label class="form-label fw-semibold">
                  <i class="bi bi-archive me-1 text-warning"></i>Stok <span class="text-danger">*</span>
                </label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}"
                       class="form-control @error('stock') is-invalid @enderror"
                       placeholder="0" min="0">
                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- Ukuran --}}
              <div class="col-md-4">
                <label class="form-label fw-semibold">
                  <i class="bi bi-rulers me-1 text-info"></i>Ukuran / Size
                </label>
                <input type="text" name="size" value="{{ old('size') }}"
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
                          placeholder="Tuliskan deskripsi produk...">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              {{-- FOTO PRODUK (3 slot) --}}
              <div class="col-12">
                <label class="form-label fw-semibold">
                  <i class="bi bi-images me-1 text-danger"></i>Foto Produk
                  <small class="text-muted fw-normal">(Maks. 3 foto — JPG, PNG, WEBP, maks. 2MB per foto)</small>
                </label>

                <div class="row g-3 mt-1">
                  @foreach([['image','Foto Utama','danger'], ['image_2','Foto 2','secondary'], ['image_3','Foto 3','secondary']] as [$field, $label, $color])
                  <div class="col-md-4">
                    <div class="border rounded p-2 text-center bg-light" style="min-height:160px;">
                      <p class="fw-semibold mb-2 text-{{ $color }} small">{{ $label }}</p>

                      {{-- Preview area --}}
                      <div id="preview_{{ $field }}" class="mb-2 d-none">
                        <img id="img_{{ $field }}" src="#" alt="Preview"
                             class="rounded img-fluid"
                             style="max-height:110px;object-fit:contain;">
                      </div>
                      <div id="placeholder_{{ $field }}" class="mb-2">
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
              <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-save me-1"></i> Simpan Produk
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
    const placeholder = document.getElementById('placeholder_' + field);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            preview.classList.remove('d-none');
            placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('d-none');
        placeholder.classList.remove('d-none');
    }
}
</script>

@endsection
