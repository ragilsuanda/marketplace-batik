@extends('backend.layout.app')
@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">

          <h5 class="card-title mb-3">
            <i class="bi bi-bag-check me-2 text-primary"></i>Manajemen Pesanan
          </h5>

          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
              <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Pesanan</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Pembayaran</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($orders as $key => $order)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td class="fw-semibold text-primary">{{ $order->order_code }}</td>
                  <td>
                    <div class="fw-semibold">{{ $order->user->name }}</div>
                    <small class="text-muted">{{ $order->phone }}</small>
                  </td>
                  <td class="fw-semibold text-success">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                  <td><span class="badge bg-secondary">{{ strtoupper($order->payment_method) }}</span></td>
                  <td>{{ $order->created_at->format('d M Y') }}</td>
                  <td>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                      @csrf @method('PATCH')
                      <select name="status" onchange="this.form.submit()"
                              class="form-select form-select-sm border-0 fw-semibold
                              {{ $order->status == 'pending' ? 'bg-warning text-dark' :
                                ($order->status == 'diproses' ? 'bg-info text-white' :
                                ($order->status == 'dikirim' ? 'bg-primary text-white' :
                                ($order->status == 'selesai' ? 'bg-success text-white' : 'bg-danger text-white'))) }}"
                              style="cursor:pointer;min-width:120px;">
                        @foreach(['pending'=>'Pending','diproses'=>'Diproses','dikirim'=>'Dikirim','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'] as $val => $lbl)
                          <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                      </select>
                    </form>
                  </td>
                  <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                      <i class="bi bi-eye"></i> Detail
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center text-muted py-4">
                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>Belum ada pesanan
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

@endsection
