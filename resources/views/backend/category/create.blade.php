@extends('backend.layout.app')
@section('content')

<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center gap-2 bg-primary text-white">
          <i class="bi bi-tags fs-5"></i>
          <h5 class="mb-0">Tambah Kategori</h5>
        </div>
        <div class="card-body">

          @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-triangle me-1"></i>
              <strong>Perhatian!</strong>
              <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label fw-semibold">
                <i class="bi bi-tag me-1 text-primary"></i>Nama Kategori
              </label>
              <input type="text"
                     id="name"
                     name="name"
                     value="{{ old('name') }}"
                     class="form-control @error('name') is-invalid @enderror"
                     placeholder="Masukkan nama kategori...">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan
              </button>
              <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
              </a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
