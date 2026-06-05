@extends('frontend.layout.app')
@section('content')

{{-- PAGE HEADER --}}
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 60%,#0f3460 100%);padding:80px 0 40px;">
  <div class="container text-center">
    <h1 style="color:#fff;font-family:'Playfair Display',serif;font-size:2.5rem;font-weight:700;">
      Koleksi <span style="color:var(--secondary);">Batik</span>
    </h1>
    <p style="color:rgba(255,255,255,.7);margin-top:8px;">Temukan koleksi batik premium pilihan kami</p>
  </div>
</section>

<section id="shop" style="padding:50px 0;background:#fafafa;">
  <div class="container">

    {{-- ALERT --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="row g-4">

      {{-- SIDEBAR FILTER --}}
      <div class="col-lg-3">
        <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 16px rgba(0,0,0,.07);position:sticky;top:120px;">
          <h6 style="font-weight:700;margin-bottom:16px;"><i class="fas fa-filter me-2 text-primary"></i>Filter Produk</h6>

          <form method="GET" action="{{ route('shop.index') }}" id="filterForm">
            {{-- Search --}}
            <div class="mb-3">
              <label class="form-label small fw-semibold">Cari Produk</label>
              <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Nama produk..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
              </div>
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
              <label class="form-label small fw-semibold">Kategori</label>
              <div class="d-flex flex-column gap-1">
                <a href="{{ route('shop.index') }}"
                   class="btn btn-sm {{ !request('category') ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                  Semua Kategori
                </a>
                @foreach($categories as $cat)
                  <a href="{{ route('shop.index', ['category' => $cat->id, 'search' => request('search')]) }}"
                     class="btn btn-sm {{ request('category') == $cat->id ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                    {{ $cat->name }}
                    <span class="badge bg-light text-dark ms-1">{{ $cat->products_count }}</span>
                  </a>
                @endforeach
              </div>
            </div>
          </form>
        </div>
      </div>

      {{-- PRODUCT GRID --}}
      <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <p class="mb-0 text-muted small">Menampilkan <strong>{{ $products->count() }}</strong> produk</p>
          @auth
            <a href="{{ route('cart.index') }}" class="btn btn-outline-primary btn-sm position-relative">
              <i class="fas fa-shopping-cart me-1"></i>Keranjang
              @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
              @if($cartCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $cartCount }}</span>
              @endif
            </a>
          @endauth
        </div>

        @if($products->isEmpty())
          <div class="text-center py-5">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Produk tidak ditemukan</h5>
            <a href="{{ route('shop.index') }}" class="btn btn-primary mt-2">Lihat Semua</a>
          </div>
        @else
          <div class="row g-4">
            @foreach($products as $product)
              <div class="col-sm-6 col-xl-4" data-aos="fade-up">
                <div class="mcard" style="cursor:pointer;" onclick="openDetail({{ $product->id }})">
                  <div class="mimg">
                    @if($product->image)
                      <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    @else
                      <div style="height:200px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                      </div>
                    @endif
                    @if($product->stock <= 3)
                      <div class="mbdg" style="background:#ff6b6b;">Stok Terbatas</div>
                    @endif
                  </div>
                  <div class="mbody">
                    <div class="mcat">{{ $product->category->name ?? '-' }}</div>
                    <div class="mtit">{{ $product->name }}</div>
                    @if($product->size)
                      <div style="font-size:.78rem;color:#888;margin-bottom:4px;"><i class="fas fa-ruler-combined me-1"></i>{{ $product->size }}</div>
                    @endif
                    <div class="mfoot">
                      <div>
                        <div class="mprice">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div style="font-size:.75rem;color:#aaa;"><i class="fas fa-box me-1"></i>Stok: {{ $product->stock }}</div>
                      </div>
                      <button class="madd" title="Lihat Detail" onclick="event.stopPropagation(); openDetail({{ $product->id }})">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>

    </div>
  </div>
</section>

{{-- ===== MODAL DETAIL PRODUK ===== --}}
@foreach($products as $product)
@php
  $photos = array_values(array_filter([
    $product->image   ? asset('storage/'.$product->image)   : null,
    $product->image_2 ? asset('storage/'.$product->image_2) : null,
    $product->image_3 ? asset('storage/'.$product->image_3) : null,
  ]));
@endphp
<div class="modal fade" id="detail-{{ $product->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-body p-0">
        <button class="btn-close position-absolute top-0 end-0 m-3 z-1" data-bs-dismiss="modal" style="z-index:10;background-color:rgba(255,255,255,.8);border-radius:50%;padding:8px;"></button>

        <div class="row g-0">
          {{-- Foto --}}
          <div class="col-md-5">
            @if(count($photos) > 0)
              <div id="c-{{ $product->id }}" class="carousel slide h-100" data-bs-ride="false">
                <div class="carousel-inner" style="border-radius:16px 0 0 16px;overflow:hidden;">
                  @foreach($photos as $i => $ph)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                      <img src="{{ $ph }}" class="d-block w-100" style="height:350px;object-fit:cover;" alt="foto {{ $i+1 }}">
                    </div>
                  @endforeach
                </div>
                @if(count($photos) > 1)
                  <button class="carousel-control-prev" type="button" data-bs-target="#c-{{ $product->id }}" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                  <button class="carousel-control-next" type="button" data-bs-target="#c-{{ $product->id }}" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                  <div style="position:absolute;bottom:10px;left:50%;transform:translateX(-50%);display:flex;gap:6px;">
                    @foreach($photos as $i => $ph)
                      <img src="{{ $ph }}" style="width:42px;height:42px;object-fit:cover;border-radius:6px;border:2px solid {{ $i===0?'#e8281a':'#fff' }};cursor:pointer;opacity:{{ $i===0?1:.6 }};"
                           data-bs-target="#c-{{ $product->id }}" data-bs-slide-to="{{ $i }}">
                    @endforeach
                  </div>
                @endif
              </div>
            @else
              <div style="height:350px;background:#f5f5f5;border-radius:16px 0 0 16px;display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-image fa-4x text-muted"></i>
              </div>
            @endif
          </div>

          {{-- Info --}}
          <div class="col-md-7 p-4 d-flex flex-column">
            <span style="background:rgba(232,40,26,.1);color:var(--primary);font-size:.78rem;font-weight:600;padding:4px 12px;border-radius:20px;display:inline-block;width:fit-content;margin-bottom:10px;">
              {{ $product->category->name ?? '-' }}
            </span>
            <h3 style="font-family:'Playfair Display',serif;font-weight:700;margin-bottom:6px;">{{ $product->name }}</h3>

            <div style="font-size:1.6rem;font-weight:700;color:var(--primary);margin-bottom:12px;">
              Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>

            <div class="d-flex gap-3 mb-3">
              <div style="background:#f8f9fa;border-radius:10px;padding:10px 16px;text-align:center;">
                <div style="font-size:.72rem;color:#999;">Stok</div>
                <div style="font-weight:700;color:{{ $product->stock > 0 ? '#27ae60' : '#e74c3c' }};">{{ $product->stock }}</div>
              </div>
              @if($product->size)
              <div style="background:#f8f9fa;border-radius:10px;padding:10px 16px;text-align:center;">
                <div style="font-size:.72rem;color:#999;">Ukuran</div>
                <div style="font-weight:700;">{{ $product->size }}</div>
              </div>
              @endif
            </div>

            @if($product->description)
            <p style="color:#666;font-size:.88rem;line-height:1.6;flex:1;overflow-y:auto;max-height:100px;">{{ $product->description }}</p>
            @endif

            {{-- Form tambah ke keranjang --}}
            @auth
              @if($product->stock > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                  @csrf
                  <div class="d-flex align-items-center gap-2 mb-3">
                    <label class="mb-0 small fw-semibold">Qty:</label>
                    <div class="input-group" style="width:130px;">
                      <button type="button" class="btn btn-outline-secondary btn-sm" onclick="this.nextElementSibling.stepDown()">-</button>
                      <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}"
                             class="form-control form-control-sm text-center" style="border-left:0;border-right:0;">
                      <button type="button" class="btn btn-outline-secondary btn-sm" onclick="this.previousElementSibling.stepUp()">+</button>
                    </div>
                  </div>
                  <div class="d-flex gap-2">
                    <button type="submit" class="btn-red flex-grow-1" style="border:none;cursor:pointer;">
                      <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-sm">
                      <i class="fas fa-eye"></i>
                    </a>
                  </div>
                </form>
              @else
                <button class="btn btn-secondary w-100 mt-auto" disabled>Stok Habis</button>
              @endif
            @else
              <a href="{{ route('login') }}" class="btn-red d-block text-center mt-auto" style="text-decoration:none;">
                <i class="fas fa-sign-in-alt me-2"></i>Login untuk Beli
              </a>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

<script>
function openDetail(id) {
    var modal = new bootstrap.Modal(document.getElementById('detail-' + id));
    modal.show();
}
</script>

@endsection
