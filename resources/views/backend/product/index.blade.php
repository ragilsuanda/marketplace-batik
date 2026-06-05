@extends('backend.layout.app')
@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">
              <i class="bi bi-box-seam me-2 text-primary"></i>Daftar Produk
            </h5>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
              <i class="bi bi-plus-circle me-1"></i> Tambah Produk
            </a>
          </div>

          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($products as $key => $product)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>
                    @if($product->image)
                      <img src="{{ asset('storage/' . $product->image) }}"
                           alt="{{ $product->name }}"
                           class="rounded"
                           style="width:55px;height:55px;object-fit:cover;border:1px solid #dee2e6;">
                    @else
                      <div class="bg-light rounded d-flex align-items-center justify-content-center"
                           style="width:55px;height:55px;border:1px solid #dee2e6;">
                        <i class="bi bi-image text-muted"></i>
                      </div>
                    @endif
                  </td>
                  <td class="fw-semibold">{{ $product->name }}</td>
                  <td>
                    <span class="badge bg-info text-dark">
                      {{ $product->category->name ?? '-' }}
                    </span>
                  </td>
                  <td>{{ $product->size ?? '-' }}</td>
                  <td class="fw-semibold text-success">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                  </td>
                  <td>
                    <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                      {{ $product->stock }}
                    </span>
                  </td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      {{-- Tombol Detail --}}
                      <button type="button"
                              class="btn btn-info btn-sm"
                              data-bs-toggle="modal"
                              data-bs-target="#modal-detail-{{ $product->id }}">
                        <i class="bi bi-eye"></i> Detail
                      </button>
                      <a href="{{ route('products.edit', $product->id) }}"
                         class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                      </a>
                      <form action="{{ route('products.destroy', $product->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                          <i class="bi bi-trash"></i> Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center text-muted py-4">
                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                    Belum ada produk
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>

{{-- ===== MODAL DETAIL (per produk) ===== --}}
@foreach($products as $product)
@php
  $photos = array_filter([
    $product->image  ? asset('storage/' . $product->image)  : null,
    $product->image_2 ? asset('storage/' . $product->image_2) : null,
    $product->image_3 ? asset('storage/' . $product->image_3) : null,
  ]);
@endphp

<div class="modal fade" id="modal-detail-{{ $product->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow">

      {{-- Header --}}
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-box-seam me-2"></i>{{ $product->name }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      {{-- Body --}}
      <div class="modal-body p-4">
        <div class="row g-4">

          {{-- Kolom Kiri: Carousel Foto --}}
          <div class="col-md-5">
            @if(count($photos) > 0)
              <div id="carousel-{{ $product->id }}" class="carousel slide rounded overflow-hidden shadow-sm"
                   data-bs-ride="carousel" style="background:#f8f9fa;">
                <div class="carousel-inner">
                  @foreach(array_values($photos) as $i => $photo)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                      <img src="{{ $photo }}"
                           class="d-block w-100"
                           alt="Foto {{ $i + 1 }}"
                           style="height:260px;object-fit:contain;background:#f8f9fa;">
                    </div>
                  @endforeach
                </div>

                @if(count($photos) > 1)
                <button class="carousel-control-prev" type="button"
                        data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button"
                        data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </button>

                {{-- Thumbnail navigator --}}
                <div class="d-flex justify-content-center gap-2 p-2 bg-white">
                  @foreach(array_values($photos) as $i => $photo)
                    <img src="{{ $photo }}"
                         class="rounded border thumb-nav {{ $i === 0 ? 'border-primary' : '' }}"
                         style="width:50px;height:50px;object-fit:cover;cursor:pointer;opacity:{{ $i === 0 ? '1' : '0.5' }};"
                         data-bs-target="#carousel-{{ $product->id }}"
                         data-bs-slide-to="{{ $i }}"
                         onclick="setThumbActive(this, '{{ $product->id }}')">
                  @endforeach
                </div>
                @endif
              </div>

              {{-- Label jumlah foto --}}
              <p class="text-center text-muted small mt-1">
                <i class="bi bi-images me-1"></i>{{ count($photos) }} foto tersedia
              </p>
            @else
              <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center"
                   style="height:260px;">
                <i class="bi bi-image fs-1 text-muted"></i>
                <p class="text-muted mt-2 mb-0 small">Tidak ada foto</p>
              </div>
            @endif
          </div>

          {{-- Kolom Kanan: Info Produk --}}
          <div class="col-md-7">

            <h4 class="fw-bold mb-1">{{ $product->name }}</h4>
            <span class="badge bg-info text-dark mb-3">{{ $product->category->name ?? '-' }}</span>

            <div class="row g-2 mb-3">
              <div class="col-6">
                <div class="border rounded p-2 text-center bg-light">
                  <div class="text-muted small">Harga</div>
                  <div class="fw-bold text-success fs-5">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="border rounded p-2 text-center bg-light">
                  <div class="text-muted small">Stok</div>
                  <div class="fw-bold fs-5">
                    <span class="{{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                      {{ $product->stock }}
                    </span>
                  </div>
                </div>
              </div>
              @if($product->size)
              <div class="col-12">
                <div class="border rounded p-2 bg-light">
                  <span class="text-muted small">Ukuran / Size: </span>
                  <span class="fw-semibold">{{ $product->size }}</span>
                </div>
              </div>
              @endif
            </div>

            {{-- Deskripsi --}}
            <div>
              <p class="fw-semibold mb-1"><i class="bi bi-card-text me-1 text-secondary"></i>Deskripsi</p>
              <div class="border rounded p-3 bg-light" style="min-height:80px;max-height:150px;overflow-y:auto;line-height:1.6;">
                {{ $product->description ?? 'Tidak ada deskripsi.' }}
              </div>
            </div>

          </div>
        </div>
      </div>

      {{-- Footer --}}
      <div class="modal-footer bg-light">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
          <i class="bi bi-pencil-square me-1"></i>Edit Produk
        </a>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
          <i class="bi bi-x-lg me-1"></i>Tutup
        </button>
      </div>

    </div>
  </div>
</div>
@endforeach

<script>
function setThumbActive(el, productId) {
    // Reset semua thumbnail dalam carousel ini
    const carousel = document.getElementById('carousel-' + productId);
    carousel.querySelectorAll('.thumb-nav').forEach(t => {
        t.style.opacity = '0.5';
        t.classList.remove('border-primary');
    });
    el.style.opacity = '1';
    el.classList.add('border-primary');
}

// Sync thumbnail saat slide berubah otomatis
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[id^="carousel-"]').forEach(function(carousel) {
        carousel.addEventListener('slid.bs.carousel', function (e) {
            const thumbs = carousel.querySelectorAll('.thumb-nav');
            thumbs.forEach((t, i) => {
                t.style.opacity = i === e.to ? '1' : '0.5';
                t.classList.toggle('border-primary', i === e.to);
            });
        });
    });
});
</script>

@endsection
