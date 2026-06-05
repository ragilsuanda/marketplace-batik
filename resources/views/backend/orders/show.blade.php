@extends('backend.layout.app')
@section('content')

<section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-9">

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
          <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      {{-- Header Card --}}
      <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0"><i class="bi bi-bag-check me-2"></i>Detail Pesanan — {{ $order->order_code }}</h5>
          <span class="badge bg-{{ $order->status_color }} fs-6">{{ $order->status_label }}</span>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <p class="mb-1 small text-muted">Pelanggan</p>
              <p class="fw-semibold mb-0">{{ $order->user->name }} <small class="text-muted">({{ $order->user->email }})</small></p>
            </div>
            <div class="col-md-6">
              <p class="mb-1 small text-muted">No. HP</p>
              <p class="fw-semibold mb-0">{{ $order->phone }}</p>
            </div>
            <div class="col-md-6">
              <p class="mb-1 small text-muted">Alamat Pengiriman</p>
              <p class="fw-semibold mb-0">{{ $order->address }}</p>
            </div>
            <div class="col-md-6">
              <p class="mb-1 small text-muted">Metode Bayar</p>
              <p class="fw-semibold mb-0"><span class="badge bg-secondary">{{ strtoupper($order->payment_method) }}</span></p>
            </div>
            @if($order->notes)
            <div class="col-12">
              <p class="mb-1 small text-muted">Catatan</p>
              <p class="fw-semibold mb-0 fst-italic">{{ $order->notes }}</p>
            </div>
            @endif
            <div class="col-md-6">
              <p class="mb-1 small text-muted">Tanggal Pesanan</p>
              <p class="fw-semibold mb-0">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Bukti Transfer --}}
      @if($order->payment_method === 'transfer')
      <div class="card mb-4 shadow-sm border-{{ $order->payment_proof ? 'success' : 'warning' }}">
        <div class="card-header bg-{{ $order->payment_proof ? 'success' : 'warning' }} {{ $order->payment_proof ? 'text-white' : 'text-dark' }}">
          <h6 class="mb-0">
            <i class="bi bi-receipt me-2"></i>Bukti Pembayaran Transfer
            @if(!$order->payment_proof)
              <span class="badge bg-danger ms-2">Belum Upload</span>
            @else
              <span class="badge bg-white text-success ms-2">Sudah Upload</span>
            @endif
          </h6>
        </div>
        <div class="card-body">
          @if($order->payment_proof)
            <div class="text-center">
              <img src="{{ asset('storage/'.$order->payment_proof) }}"
                   alt="Bukti Transfer"
                   class="img-fluid rounded shadow"
                   style="max-height:400px;object-fit:contain;cursor:pointer;"
                   data-bs-toggle="modal" data-bs-target="#modalProof">
              <p class="text-muted small mt-2">Klik gambar untuk memperbesar</p>
              <a href="{{ asset('storage/'.$order->payment_proof) }}" download
                 class="btn btn-outline-primary btn-sm mt-1">
                <i class="bi bi-download me-1"></i>Download Bukti
              </a>
            </div>

            {{-- Modal zoom --}}
            <div class="modal fade" id="modalProof" tabindex="-1">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h6 class="modal-title">Bukti Transfer — {{ $order->order_code }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body text-center p-2">
                    <img src="{{ asset('storage/'.$order->payment_proof) }}" class="img-fluid rounded">
                  </div>
                </div>
              </div>
            </div>
          @else
            <div class="text-center py-4">
              <i class="bi bi-image text-muted" style="font-size:3rem;"></i>
              <p class="text-muted mt-2 mb-0">Pelanggan belum mengupload bukti transfer.</p>
            </div>
          @endif
        </div>
      </div>
      @endif

      {{-- Produk --}}
      <div class="card mb-4 shadow-sm">
        <div class="card-header"><h6 class="mb-0"><i class="bi bi-box me-2"></i>Produk yang Dipesan</h6></div>        <div class="card-body p-0">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>Produk</th>
                <th class="text-center">Harga Satuan</th>
                <th class="text-center">Qty</th>
                <th class="text-end">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->items as $item)
                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      @if($item->product && $item->product->image)
                        <img src="{{ asset('storage/'.$item->product->image) }}" style="width:45px;height:45px;object-fit:cover;border-radius:6px;">
                      @endif
                      <span class="fw-semibold">{{ $item->product_name }}</span>
                    </div>
                  </td>
                  <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                  <td class="text-center"><span class="badge bg-secondary">{{ $item->qty }}</span></td>
                  <td class="text-end fw-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot class="table-light">
              <tr><td colspan="3" class="text-end">Subtotal</td><td class="text-end">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td></tr>
              <tr><td colspan="3" class="text-end">Ongkos Kirim</td><td class="text-end">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td></tr>
              <tr><td colspan="3" class="text-end fw-bold">Total</td><td class="text-end fw-bold text-success fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</td></tr>
            </tfoot>
          </table>
        </div>
      </div>

      {{-- Ubah Status --}}
      <div class="card shadow-sm">
        <div class="card-header"><h6 class="mb-0"><i class="bi bi-arrow-repeat me-2"></i>Ubah Status Pesanan</h6></div>
        <div class="card-body">
          <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex gap-3 align-items-end">
            @csrf @method('PATCH')
            <div class="flex-grow-1">
              <label class="form-label small fw-semibold">Status Baru</label>
              <select name="status" class="form-select">
                @foreach(['pending'=>'Pending','diproses'=>'Diproses','dikirim'=>'Dikirim','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'] as $val => $lbl)
                  <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-save me-1"></i>Simpan
            </button>
          </form>
        </div>
      </div>

      <div class="mt-3">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">
          <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Pesanan
        </a>
      </div>

    </div>
  </div>
</section>

@endsection
