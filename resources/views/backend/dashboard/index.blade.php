@extends('backend.layout.app')
@section('content')

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  <div class="row g-3">

    {{-- ── STAT CARDS ── --}}
    <div class="col-xl-3 col-md-6">
      <div class="card info-card revenue-card h-100">
        <div class="card-body">
          <h5 class="card-title">Total Pendapatan</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-currency-dollar"></i>
            </div>
            <div class="ps-3">
              <h6 style="font-size:.9rem;">Rp {{ number_format($pendapatanTotal, 0, ',', '.') }}</h6>
              <span class="text-muted small">Order selesai & diproses</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card info-card sales-card h-100">
        <div class="card-body">
          <h5 class="card-title">Total Pesanan</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-bag-check"></i>
            </div>
            <div class="ps-3">
              <h6>{{ $totalPesanan }}</h6>
              <span class="text-success small"><i class="bi bi-check-circle me-1"></i>{{ $pesananSelesai }} selesai</span>
              <span class="text-warning small ms-2"><i class="bi bi-clock me-1"></i>{{ $pesananPending }} pending</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card info-card customers-card h-100">
        <div class="card-body">
          <h5 class="card-title">Stok Produk</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-box-seam"></i>
            </div>
            <div class="ps-3">
              <h6>{{ number_format($totalStok) }} pcs</h6>
              <span class="text-muted small">{{ $totalProduk }} jenis produk</span>
              @if($produkStokHabis > 0)
                <span class="text-danger small ms-2"><i class="bi bi-exclamation-triangle me-1"></i>{{ $produkStokHabis }} habis</span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card info-card h-100" style="border-left:4px solid #6c5ce7;">
        <div class="card-body">
          <h5 class="card-title">Pelanggan</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background:rgba(108,92,231,.1);">
              <i class="bi bi-people" style="color:#6c5ce7;"></i>
            </div>
            <div class="ps-3">
              <h6>{{ $totalPelanggan }}</h6>
              <span class="text-muted small">Total pelanggan terdaftar</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- ── GRAFIK PENJUALAN ── --}}
    <div class="col-lg-8">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Penjualan per Bulan — {{ $year }}</h5>
            <a href="{{ route('admin.sales-report') }}" class="btn btn-sm btn-outline-primary">
              <i class="bi bi-bar-chart-line me-1"></i>Laporan Lengkap
            </a>
          </div>
          <canvas id="chartPenjualan" style="max-height:280px;margin-top:16px;"></canvas>
        </div>
      </div>
    </div>

    {{-- ── PRODUK TERLARIS ── --}}
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Produk Terlaris</h5>
          @forelse($produkTerlaris as $i => $item)
            <div class="d-flex align-items-center mb-3">
              <span class="badge bg-primary me-2" style="min-width:24px;">{{ $i+1 }}</span>
              <div style="flex:1;min-width:0;">
                <div class="fw-semibold text-truncate" style="font-size:.85rem;">{{ $item->product_name }}</div>
                <div class="progress mt-1" style="height:4px;">
                  <div class="progress-bar" style="width:{{ $produkTerlaris->max('total_qty') > 0 ? ($item->total_qty / $produkTerlaris->max('total_qty') * 100) : 0 }}%;"></div>
                </div>
              </div>
              <span class="badge bg-light text-dark ms-2" style="font-size:.75rem;">{{ $item->total_qty }} terjual</span>
            </div>
          @empty
            <p class="text-muted small text-center py-3">Belum ada penjualan</p>
          @endforelse
        </div>
      </div>
    </div>

    {{-- ── PESANAN TERBARU ── --}}
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Pesanan Terbaru</h5>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-sm align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Kode</th>
                  <th>Pelanggan</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($pesananTerbaru as $order)
                  <tr>
                    <td class="fw-semibold text-primary" style="font-size:.82rem;">{{ $order->order_code }}</td>
                    <td style="font-size:.85rem;">{{ $order->user->name ?? '-' }}</td>
                    <td style="font-size:.85rem;" class="text-success fw-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>
                      <span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
                    </td>
                    <td>
                      <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-xs btn-outline-info btn-sm py-0 px-2" style="font-size:.75rem;">Detail</a>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="5" class="text-center text-muted py-3">Belum ada pesanan</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- ── STOK MENIPIS ── --}}
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-exclamation-triangle text-warning me-2"></i>Stok Menipis</h5>
          @forelse($stokMenipis as $p)
            <div class="d-flex align-items-center justify-content-between mb-2 pb-2" style="border-bottom:1px solid #f5f5f5;">
              <div>
                <div class="fw-semibold" style="font-size:.85rem;">{{ $p->name }}</div>
                <div class="text-muted" style="font-size:.75rem;">{{ $p->category->name ?? '-' }}</div>
              </div>
              <span class="badge bg-warning text-dark">{{ $p->stock }} pcs</span>
            </div>
          @empty
            <p class="text-muted small text-center py-3"><i class="bi bi-check-circle text-success me-1"></i>Semua stok aman</p>
          @endforelse
          <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-warning w-100 mt-2">Kelola Produk</a>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('chartPenjualan');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bulanLabels) !!},
            datasets: [
                {
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($penjualanBulanan) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.25)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 2,
                    borderRadius: 6,
                    yAxisID: 'y',
                },
                {
                    label: 'Jumlah Order',
                    data: {!! json_encode($orderBulanan) !!},
                    type: 'line',
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 4,
                    yAxisID: 'y1',
                }
            ]
        },
        options: {
            responsive: true,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: (ctx) => {
                            if (ctx.datasetIndex === 0) return ' Rp ' + new Intl.NumberFormat('id-ID').format(ctx.raw);
                            return ' ' + ctx.raw + ' order';
                        }
                    }
                }
            },
            scales: {
                y:  { beginAtZero: true, position: 'left',  ticks: { callback: v => 'Rp ' + (v/1000) + 'K' } },
                y1: { beginAtZero: true, position: 'right', grid: { drawOnChartArea: false }, ticks: { stepSize: 1 } }
            }
        }
    });
});
</script>

@endsection
