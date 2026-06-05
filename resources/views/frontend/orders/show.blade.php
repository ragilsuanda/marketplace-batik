@extends('frontend.layout.app')
@section('content')

<section style="background:linear-gradient(135deg,#1a1a2e,#0f3460);padding:80px 0 40px;">
  <div class="container text-center">
    <h1 style="color:#fff;font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;">
      Detail Pesanan
    </h1>
    <p style="color:rgba(255,255,255,.7);">{{ $order->order_code }}</p>
  </div>
</section>

<section style="padding:50px 0;background:#fafafa;">
  <div class="container" style="max-width:820px;">

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show mb-4">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show mb-4">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show mb-4">
        @foreach($errors->all() as $e) <div><i class="fas fa-times-circle me-1"></i>{{ $e }}</div> @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- STATUS & PROGRESS --}}
    <div style="background:#fff;border-radius:16px;padding:28px;box-shadow:0 2px 12px rgba(0,0,0,.07);margin-bottom:20px;">
      <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-4">
        <div>
          <h5 style="font-weight:700;margin:0;">{{ $order->order_code }}</h5>
          <p style="color:#888;font-size:.82rem;margin:4px 0 0;">{{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <span class="badge bg-{{ $order->status_color }}" style="font-size:.9rem;padding:8px 16px;">{{ $order->status_label }}</span>
      </div>

      {{-- Progress Bar --}}
      @php $steps = ['pending'=>0,'diproses'=>1,'dikirim'=>2,'selesai'=>3]; $cur = $steps[$order->status] ?? 0; @endphp
      <div class="d-flex justify-content-between position-relative" style="margin-bottom:8px;">
        <div style="position:absolute;top:16px;left:0;right:0;height:4px;background:#e0e0e0;z-index:0;"></div>
        <div style="position:absolute;top:16px;left:0;height:4px;background:var(--primary);z-index:1;width:{{ $cur >= 3 ? 100 : ($cur * 33.3) }}%;transition:.4s;"></div>
        @foreach(['Pending','Diproses','Dikirim','Selesai'] as $i => $s)
          <div style="text-align:center;position:relative;z-index:2;flex:1;">
            <div style="width:36px;height:36px;border-radius:50%;background:{{ $cur >= $i ? 'var(--primary)' : '#e0e0e0' }};color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 6px;font-size:.85rem;font-weight:700;">
              @if($cur > $i)<i class="fas fa-check"></i>@else{{ $i+1 }}@endif
            </div>
            <div style="font-size:.75rem;color:{{ $cur >= $i ? 'var(--primary)' : '#aaa' }};font-weight:{{ $cur >= $i ? '600' : '400' }};">{{ $s }}</div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- UPLOAD BUKTI TRANSFER --}}
    @if($order->payment_method === 'transfer')
    <div style="background:#fff;border-radius:16px;padding:28px;box-shadow:0 2px 12px rgba(0,0,0,.07);margin-bottom:20px;border-left:4px solid {{ $order->payment_proof ? '#27ae60' : '#f39c12' }};">
      <h6 style="font-weight:700;margin-bottom:16px;">
        <i class="fas fa-university me-2 {{ $order->payment_proof ? 'text-success' : 'text-warning' }}"></i>
        Bukti Pembayaran Transfer
      </h6>

      {{-- Info rekening --}}
      <div style="background:#fff8e1;border:1px solid #ffc107;border-radius:10px;padding:14px;margin-bottom:18px;font-size:.88rem;">
        <p style="font-weight:700;margin-bottom:6px;"><i class="fas fa-info-circle me-1 text-warning"></i>Transfer ke rekening:</p>
        <p style="margin:0;line-height:1.8;">
          🏦 <strong>BCA — 1234567890</strong><br>
          a/n <strong>Rumah Batik Serunai</strong><br>
          Nominal: <strong style="color:#e8281a;">Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
        </p>
      </div>

      @if($order->payment_proof)
        {{-- Sudah upload --}}
        <div style="text-align:center;margin-bottom:16px;">
          <p style="font-size:.85rem;color:#27ae60;font-weight:600;margin-bottom:8px;"><i class="fas fa-check-circle me-1"></i>Bukti transfer sudah diupload</p>
          <img src="{{ asset('storage/'.$order->payment_proof) }}"
               alt="Bukti Transfer"
               style="max-width:100%;max-height:300px;object-fit:contain;border-radius:10px;border:2px solid #27ae60;cursor:pointer;"
               onclick="document.getElementById('proofModal').style.display='flex'">
          <p style="font-size:.75rem;color:#888;margin-top:6px;">Klik gambar untuk memperbesar</p>
        </div>
        {{-- Ganti bukti --}}
        @if(in_array($order->status, ['pending']))
          <p style="font-size:.82rem;color:#888;margin-bottom:10px;">Belum sesuai? Anda bisa upload ulang:</p>
        @endif
      @endif

      @if(in_array($order->status, ['pending', 'diproses']))
        <form action="{{ route('orders.payment-proof', $order->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label fw-semibold" style="font-size:.88rem;">
              {{ $order->payment_proof ? 'Upload Ulang Bukti Transfer' : 'Upload Bukti Transfer' }}
              <span class="text-danger">*</span>
            </label>

            {{-- Drop Zone --}}
            <div id="dropzone"
                 style="border:2px dashed #dee2e6;border-radius:12px;padding:30px;text-align:center;cursor:pointer;transition:.2s;background:#fafafa;"
                 onclick="document.getElementById('proofFile').click()"
                 ondragover="event.preventDefault();this.style.borderColor='var(--primary)'"
                 ondragleave="this.style.borderColor='#dee2e6'"
                 ondrop="handleDrop(event)">
              <div id="dropPlaceholder">
                <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                <p style="margin:0;color:#888;font-size:.85rem;">Klik atau drag & drop foto bukti transfer</p>
                <p style="margin:4px 0 0;color:#aaa;font-size:.78rem;">JPG / PNG — Maks. 2MB</p>
              </div>
              <div id="dropPreview" style="display:none;">
                <img id="previewImg" src="#" alt="Preview" style="max-height:200px;max-width:100%;object-fit:contain;border-radius:8px;">
                <p id="fileName" style="margin:8px 0 0;font-size:.82rem;color:#555;"></p>
              </div>
            </div>

            <input type="file" id="proofFile" name="payment_proof" accept="image/jpg,image/jpeg,image/png"
                   class="d-none" onchange="previewProof(this)">
          </div>

          <button type="submit"
                  style="background:var(--primary);color:#fff;border:none;padding:12px 28px;border-radius:10px;font-weight:700;cursor:pointer;font-size:.9rem;">
            <i class="fas fa-paper-plane me-2"></i>Kirim Bukti Transfer
          </button>
        </form>
      @endif

      @if(!in_array($order->status, ['pending', 'diproses']) && $order->payment_proof)
        <p style="font-size:.82rem;color:#888;margin-top:8px;">
          <i class="fas fa-lock me-1"></i>Bukti transfer tidak dapat diubah setelah pesanan diproses.
        </p>
      @endif
    </div>
    @endif

    {{-- PRODUK --}}
    <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.07);margin-bottom:20px;">
      <h6 style="font-weight:700;margin-bottom:16px;"><i class="fas fa-box me-2 text-primary"></i>Produk yang Dipesan</h6>

      @foreach($order->items as $item)
        <div style="display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid #f5f5f5;">
          @if($item->product && $item->product->image)
            <img src="{{ asset('storage/'.$item->product->image) }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
          @else
            <div style="width:60px;height:60px;background:#f5f5f5;border-radius:8px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image text-muted"></i></div>
          @endif
          <div style="flex:1;">
            <div style="font-weight:600;">{{ $item->product_name }}</div>
            <div style="font-size:.8rem;color:#888;">{{ $item->qty }} × Rp {{ number_format($item->price, 0, ',', '.') }}</div>
          </div>
          <div style="font-weight:700;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
        </div>
      @endforeach

      <div class="mt-3">
        <div style="display:flex;justify-content:space-between;font-size:.9rem;margin-bottom:6px;"><span class="text-muted">Subtotal</span><span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span></div>
        <div style="display:flex;justify-content:space-between;font-size:.9rem;margin-bottom:6px;"><span class="text-muted">Ongkos Kirim</span><span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span></div>
        <hr>
        <div style="display:flex;justify-content:space-between;font-weight:700;font-size:1.05rem;">
          <span>Total</span>
          <span style="color:var(--primary);">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>
      </div>
    </div>

    {{-- INFO PENGIRIMAN --}}
    <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.07);margin-bottom:20px;">
      <h6 style="font-weight:700;margin-bottom:16px;"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Informasi Pengiriman</h6>
      <p style="margin:0;font-size:.9rem;line-height:1.8;">
        <strong>{{ $order->name }}</strong><br>{{ $order->phone }}<br>{{ $order->address }}
      </p>
      @if($order->notes)
        <p style="margin-top:8px;font-size:.85rem;color:#888;"><i class="fas fa-sticky-note me-1"></i><em>{{ $order->notes }}</em></p>
      @endif
    </div>

    <a href="{{ route('orders.index') }}" style="color:var(--primary);font-size:.88rem;text-decoration:none;">
      <i class="fas fa-arrow-left me-1"></i>Kembali ke Riwayat Pesanan
    </a>

  </div>
</section>

{{-- Modal zoom bukti transfer --}}
@if($order->payment_proof)
<div id="proofModal"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.85);z-index:9999;align-items:center;justify-content:center;"
     onclick="this.style.display='none'">
  <img src="{{ asset('storage/'.$order->payment_proof) }}"
       style="max-width:90vw;max-height:90vh;object-fit:contain;border-radius:12px;">
</div>
@endif

<script>
function previewProof(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('fileName').textContent = input.files[0].name;
            document.getElementById('dropPlaceholder').style.display = 'none';
            document.getElementById('dropPreview').style.display = 'block';
            document.getElementById('dropzone').style.borderColor = 'var(--primary)';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function handleDrop(e) {
    e.preventDefault();
    document.getElementById('dropzone').style.borderColor = '#dee2e6';
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const dt = new DataTransfer();
        dt.items.add(file);
        const inp = document.getElementById('proofFile');
        inp.files = dt.files;
        previewProof(inp);
    }
}
</script>

@endsection
