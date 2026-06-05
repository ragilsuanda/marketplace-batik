@extends('frontend.layout.app')
@section('content')

<section style="background:linear-gradient(135deg,#1a1a2e,#0f3460);padding:80px 0 40px;">
  <div class="container text-center">
    <h1 style="color:#fff;font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:700;">
      <i class="fas fa-history me-2" style="color:var(--secondary);"></i>Riwayat Pesanan
    </h1>
  </div>
</section>

<section style="padding:50px 0;background:#fafafa;">
  <div class="container">

    @if($orders->isEmpty())
      <div class="text-center py-5">
        <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
        <h5 class="text-muted">Belum ada pesanan</h5>
        <a href="{{ route('shop.index') }}" style="display:inline-block;margin-top:16px;background:var(--primary);color:#fff;padding:12px 28px;border-radius:10px;text-decoration:none;font-weight:600;">
          <i class="fas fa-store me-2"></i>Mulai Belanja
        </a>
      </div>
    @else
      <div class="d-flex flex-column gap-3">
        @foreach($orders as $order)
          <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,.07);">
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
              <div>
                <div style="font-weight:700;font-size:1rem;margin-bottom:4px;">{{ $order->order_code }}</div>
                <div style="font-size:.82rem;color:#888;">{{ $order->created_at->format('d M Y, H:i') }}</div>
              </div>
              <span class="badge bg-{{ $order->status_color }} fs-6">{{ $order->status_label }}</span>
            </div>

            <hr style="margin:16px 0 12px;">

            <div class="d-flex flex-wrap gap-2 mb-3">
              @foreach($order->items->take(3) as $item)
                <span style="background:#f8f9fa;border-radius:8px;padding:4px 10px;font-size:.82rem;">
                  {{ $item->product_name }} ×{{ $item->qty }}
                </span>
              @endforeach
              @if($order->items->count() > 3)
                <span style="background:#f0f0f0;border-radius:8px;padding:4px 10px;font-size:.82rem;color:#888;">
                  +{{ $order->items->count() - 3 }} lainnya
                </span>
              @endif
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <div>
                <span style="color:#888;font-size:.85rem;">Total: </span>
                <span style="font-weight:700;color:var(--primary);font-size:1rem;">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
              </div>
              <a href="{{ route('orders.show', $order->id) }}"
                 style="background:var(--primary);color:#fff;padding:8px 18px;border-radius:8px;text-decoration:none;font-size:.85rem;font-weight:600;">
                <i class="fas fa-eye me-1"></i>Detail
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @endif

  </div>
</section>

@endsection
