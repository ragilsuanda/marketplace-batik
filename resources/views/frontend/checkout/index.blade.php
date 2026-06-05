@extends('frontend.layout.app')
@section('content')

<section style="background:linear-gradient(135deg,#1a1a2e,#0f3460);padding:80px 0 40px;">
  <div class="container text-center">
    <h1 style="color:#fff;font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:700;">
      <i class="fas fa-lock me-2" style="color:var(--secondary);"></i>Checkout
    </h1>
  </div>
</section>

<section style="padding:50px 0;background:#fafafa;">
  <div class="container">

    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
      @csrf
      <div class="row g-4">

        {{-- Form Pengiriman --}}
        <div class="col-lg-7">
          <div style="background:#fff;border-radius:16px;padding:28px;box-shadow:0 2px 16px rgba(0,0,0,.07);">
            <h5 style="font-weight:700;margin-bottom:24px;"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Informasi Pengiriman</h5>

            <div class="mb-3">
              <label class="form-label fw-semibold">Nama Penerima <span class="text-danger">*</span></label>
              <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                     class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap penerima">
              @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">No. HP / WhatsApp <span class="text-danger">*</span></label>
              <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}"
                     class="form-control @error('phone') is-invalid @enderror" placeholder="08xxxxxxxxxx">
              @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
              <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror"
                        placeholder="Jalan, nomor rumah, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos">{{ old('address') }}</textarea>
              @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Metode Pembayaran <span class="text-danger">*</span></label>
              <div class="d-flex gap-3">
                <label style="flex:1;border:2px solid #dee2e6;border-radius:10px;padding:14px;cursor:pointer;transition:.2s;" id="lbl-transfer">
                  <input type="radio" name="payment_method" value="transfer" class="form-check-input me-2" checked onchange="highlightPay()">
                  <i class="fas fa-university me-1 text-primary"></i>Transfer Bank
                </label>
                <label style="flex:1;border:2px solid #dee2e6;border-radius:10px;padding:14px;cursor:pointer;transition:.2s;" id="lbl-cod">
                  <input type="radio" name="payment_method" value="cod" class="form-check-input me-2" onchange="highlightPay()">
                  <i class="fas fa-money-bill-wave me-1 text-success"></i>COD (Bayar di Tempat)
                </label>
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label fw-semibold">Catatan Pesanan <span class="text-muted fw-normal">(opsional)</span></label>
              <textarea name="notes" rows="2" class="form-control" placeholder="Instruksi khusus untuk penjual...">{{ old('notes') }}</textarea>
            </div>
          </div>
        </div>

        {{-- Ringkasan Pesanan --}}
        <div class="col-lg-5">
          <div style="background:#fff;border-radius:16px;padding:28px;box-shadow:0 2px 16px rgba(0,0,0,.07);">
            <h5 style="font-weight:700;margin-bottom:20px;"><i class="fas fa-receipt me-2 text-primary"></i>Pesanan Anda</h5>

            @foreach($cart as $item)
              <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
                @if($item['image'])
                  <img src="{{ asset('storage/'.$item['image']) }}" style="width:52px;height:52px;object-fit:cover;border-radius:8px;">
                @else
                  <div style="width:52px;height:52px;background:#f5f5f5;border-radius:8px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image text-muted"></i></div>
                @endif
                <div style="flex:1;">
                  <div style="font-size:.88rem;font-weight:600;">{{ $item['name'] }}</div>
                  <div style="font-size:.78rem;color:#999;">{{ $item['qty'] }} × Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                </div>
                <div style="font-weight:600;font-size:.88rem;">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
              </div>
            @endforeach

            <hr>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:.9rem;">
              <span class="text-muted">Subtotal</span>
              <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:.9rem;">
              <span class="text-muted">Ongkos Kirim (Flat)</span>
              <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
            </div>
            <hr>
            <div style="display:flex;justify-content:space-between;font-size:1.1rem;font-weight:700;">
              <span>Total Bayar</span>
              <span style="color:var(--primary);">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <button type="submit"
                    style="display:block;width:100%;text-align:center;margin-top:20px;background:var(--primary);color:#fff;padding:14px;border-radius:10px;font-weight:700;font-size:1rem;border:none;cursor:pointer;">
              <i class="fas fa-check-circle me-2"></i>Konfirmasi Pesanan
            </button>

            <a href="{{ route('cart.index') }}" style="display:block;text-align:center;margin-top:10px;font-size:.85rem;color:#888;text-decoration:none;">
              <i class="fas fa-arrow-left me-1"></i>Kembali ke Keranjang
            </a>
          </div>
        </div>

      </div>
    </form>
  </div>
</section>

<script>
function highlightPay() {
    document.getElementById('lbl-transfer').style.borderColor = document.querySelector('[value=transfer]').checked ? 'var(--primary)' : '#dee2e6';
    document.getElementById('lbl-cod').style.borderColor = document.querySelector('[value=cod]').checked ? 'var(--primary)' : '#dee2e6';
}
document.addEventListener('DOMContentLoaded', highlightPay);
</script>

@endsection
