@extends('frontend.layout.app')
@section('content')

<section style="padding:100px 0;background:#fafafa;min-height:70vh;">
  <div class="container">
    <div style="max-width:600px;margin:auto;background:#fff;border-radius:20px;padding:40px;box-shadow:0 4px 30px rgba(0,0,0,.1);text-align:center;">

      <div style="width:80px;height:80px;background:#27ae60;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
        <i class="fas fa-check fa-2x" style="color:#fff;"></i>
      </div>

      <h2 style="font-family:'Playfair Display',serif;font-weight:700;margin-bottom:8px;">Pesanan Berhasil!</h2>
      <p style="color:#888;margin-bottom:24px;">Terima kasih telah berbelanja. Pesanan Anda sedang kami proses.</p>

      <div style="background:#f8f9fa;border-radius:12px;padding:20px;text-align:left;margin-bottom:24px;">
        <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
          <span style="color:#888;font-size:.88rem;">Kode Pesanan</span>
          <span style="font-weight:700;color:var(--primary);">{{ $order->order_code }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
          <span style="color:#888;font-size:.88rem;">Nama</span>
          <span style="font-weight:600;">{{ $order->name }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
          <span style="color:#888;font-size:.88rem;">Metode Bayar</span>
          <span style="font-weight:600;">{{ strtoupper($order->payment_method) }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
          <span style="color:#888;font-size:.88rem;">Total</span>
          <span style="font-weight:700;font-size:1.1rem;color:var(--primary);">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;">
          <span style="color:#888;font-size:.88rem;">Status</span>
          <span class="badge bg-warning text-dark">Pending</span>
        </div>
      </div>

      @if($order->payment_method === 'transfer')
        <div style="background:#fff3cd;border-radius:12px;padding:16px;text-align:left;margin-bottom:24px;border:1px solid #ffc107;">
          <p style="font-weight:700;margin-bottom:8px;"><i class="fas fa-university me-2"></i>Info Transfer</p>
          <p style="font-size:.88rem;margin:0;color:#666;">Transfer ke rekening: <strong>BCA 1234567890 a/n Rumah Batik Serunai</strong><br>
          Nominal: <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong><br>
          Konfirmasi via WhatsApp setelah transfer.</p>
        </div>
      @endif

      <div class="d-flex gap-3 justify-content-center">
        <a href="{{ route('orders.show', $order->id) }}"
           style="background:var(--primary);color:#fff;padding:12px 24px;border-radius:10px;font-weight:600;text-decoration:none;">
          <i class="fas fa-receipt me-2"></i>Detail Pesanan
        </a>
        <a href="{{ route('shop.index') }}"
           style="background:#f5f5f5;color:#333;padding:12px 24px;border-radius:10px;font-weight:600;text-decoration:none;">
          <i class="fas fa-store me-2"></i>Lanjut Belanja
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
