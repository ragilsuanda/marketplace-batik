@extends('frontend.layout.app')
@section('content')

<section style="background:linear-gradient(135deg,#1a1a2e,#0f3460);padding:80px 0 40px;">
  <div class="container text-center">
    <h1 style="color:#fff;font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:700;">
      <i class="fas fa-shopping-cart me-2" style="color:var(--secondary);"></i>Keranjang Belanja
    </h1>
  </div>
</section>

<section style="padding:50px 0;background:#fafafa;">
  <div class="container">

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    @if(empty($cart))
      <div class="text-center py-5">
        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
        <h4 class="text-muted">Keranjang Anda kosong</h4>
        <p class="text-muted">Belum ada produk yang ditambahkan.</p>
        <a href="{{ route('shop.index') }}" class="btn-red mt-3 d-inline-block" style="text-decoration:none;">
          <i class="fas fa-store me-2"></i>Mulai Belanja
        </a>
      </div>
    @else
      <div class="row g-4">

        {{-- Tabel Keranjang --}}
        <div class="col-lg-8">
          <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 16px rgba(0,0,0,.07);">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 style="font-weight:700;margin:0;"><i class="fas fa-list me-2 text-primary"></i>Item Keranjang</h5>
              <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan semua keranjang?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-1"></i>Kosongkan</button>
              </form>
            </div>

            @foreach($cart as $id => $item)
              <div style="display:flex;align-items:center;gap:16px;padding:16px 0;border-bottom:1px solid #f0f0f0;">
                {{-- Foto --}}
                <div style="width:80px;height:80px;flex-shrink:0;">
                  @if($item['image'])
                    <img src="{{ asset('storage/'.$item['image']) }}" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                  @else
                    <div style="width:100%;height:100%;background:#f5f5f5;border-radius:10px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image text-muted"></i></div>
                  @endif
                </div>

                {{-- Info --}}
                <div style="flex:1;">
                  <div style="font-weight:700;font-size:.95rem;">{{ $item['name'] }}</div>
                  @if(!empty($item['size']))
                    <div style="font-size:.78rem;color:#888;margin-top:2px;"><i class="fas fa-ruler-combined me-1"></i>{{ $item['size'] }}</div>
                  @endif
                  <div style="color:var(--primary);font-weight:600;margin-top:4px;">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                </div>

                {{-- Qty --}}
                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center gap-1">
                  @csrf
                  <div class="input-group" style="width:110px;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="let i=this.nextElementSibling;if(i.value>1){i.value--;}">-</button>
                    <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="{{ $item['stock'] }}"
                           class="form-control form-control-sm text-center" style="border-left:0;border-right:0;"
                           onchange="this.form.submit()">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="let i=this.previousElementSibling;if(i.value<{{ $item['stock'] }}){i.value++;i.form.submit();}">+</button>
                  </div>
                </form>

                {{-- Subtotal --}}
                <div style="font-weight:700;font-size:.95rem;min-width:100px;text-align:right;">
                  Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                </div>

                {{-- Hapus --}}
                <form action="{{ route('cart.remove', $id) }}" method="POST">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus produk ini?')">
                    <i class="fas fa-times"></i>
                  </button>
                </form>
              </div>
            @endforeach

          </div>

          <div class="mt-3">
            <a href="{{ route('shop.index') }}" style="color:var(--primary);font-size:.88rem;text-decoration:none;">
              <i class="fas fa-arrow-left me-1"></i>Lanjutkan Belanja
            </a>
          </div>
        </div>

        {{-- Ringkasan Order --}}
        <div class="col-lg-4">
          <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 16px rgba(0,0,0,.07);position:sticky;top:120px;">
            <h5 style="font-weight:700;margin-bottom:20px;"><i class="fas fa-receipt me-2 text-primary"></i>Ringkasan</h5>

            <div style="display:flex;justify-content:space-between;margin-bottom:10px;font-size:.9rem;">
              <span class="text-muted">Subtotal ({{ collect($cart)->sum('qty') }} item)</span>
              <span class="fw-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:10px;font-size:.9rem;">
              <span class="text-muted">Ongkos Kirim</span>
              <span class="fw-semibold">Rp 15.000</span>
            </div>
            <hr>
            <div style="display:flex;justify-content:space-between;font-size:1.05rem;font-weight:700;">
              <span>Total</span>
              <span style="color:var(--primary);">Rp {{ number_format($total + 15000, 0, ',', '.') }}</span>
            </div>

            <a href="{{ route('checkout.index') }}"
               style="display:block;text-align:center;margin-top:20px;background:var(--primary);color:#fff;padding:14px;border-radius:10px;font-weight:700;font-size:1rem;text-decoration:none;transition:.2s;">
              <i class="fas fa-lock me-2"></i>Lanjut ke Checkout
            </a>
          </div>
        </div>

      </div>
    @endif
  </div>
</section>

@endsection
