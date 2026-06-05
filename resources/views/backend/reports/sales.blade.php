@extends('backend.layout.app')
@section('content')

<div class="pagetitle">
  <h1>Laporan Penjualan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Laporan Penjualan</li>
    </ol>
  </nav>
</div>

<section class="section">

  {{-- ── FILTER ── --}}
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title"><i class="bi bi-funnel me-2"></i>Filter Laporan</h5>
      <form method="GET" action="{{ route('admin.sales-report') }}" id="filterForm">
        <div class="row g-3 align-items-end">

          {{-- Tipe Filter --}}
          <div class="col-md-3">
            <label class="form-label fw-semibold small">Tipe Laporan</label>
            <select name="filter" class="form-select" id="filterType" onchange="toggleFilter()">
              <option value="monthly" {{ $filter=='monthly'?'selected':'' }}>Per Bulan</option>
              <option value="yearly"  {{ $filter=='yearly' ?'selected':'' }}>Per Tahun</option>
              <option value="range"   {{ $filter=='range'  ?'selected':'' }}>Rentang Tanggal</option>
            </select>
          </div>

          {{-- Per Bulan --}}
          <div class="col-md-2 filter-monthly" id="grpMonth">
            <label class="form-label fw-semibold small">Bulan</label>
            <select name="month" class="form-select">
              @foreach(range(1,12) as $m)
                <option value="{{ $m }}" {{ $month==$m?'selected':'' }}>
                  {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- Tahun --}}
          <div class="col-md-2 filter-year" id="grpYear">
            <label class="form-label fw-semibold small">Tahun</label>
            <select name="year" class="form-select">
              @foreach($tahunList->isNotEmpty() ? $tahunList : [now()->year] as $y)
                <option value="{{ $y }}" {{ $year==$y?'selected':'' }}>{{ $y }}</option>
              @endforeach
            </select>
          </div>

          {{-- Range --}}
          <div class="col-md-2 filter-range d-none" id="grpFrom">
            <label class="form-label fw-semibold small">Dari Tanggal</label>
            <input type="date" name="date_from" class="form-control" value="{{ $dateFrom }}">
          </div>
          <div class="col-md-2 filter-range d-none" id="grpTo">
            <label class="form-label fw-semibold small">Sampai Tanggal</label>
            <input type="date" name="date_to" class="form-control" value="{{ $dateTo }}">
          </div>

          <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-search me-1"></i>Tampilkan
            </button>
          </div>

        </div>
      </form>
    </div>
  </div>

  {{-- ── JUDUL PERIODE ── --}}
  <div class="alert alert-primary d-flex align-items-center gap-2 mb-4">
    <i class="bi bi-calendar-range fs-5"></i>
    <div><strong>Periode:</strong> {{ $periodLabel }}</div>
  </div>

  {{-- ── STAT CARDS ── --}}
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card text-center border-0 shadow-sm h-100">
        <div class="card-body">
          <div style="font-size:2rem;color:#0d6efd;"><i class="bi bi-bag-check"></i></div>
          <h4 class="fw-bold mt-1 mb-0">{{ $ringkasan['total_order'] }}</h4>
          <p class="text-muted small mb-0">Total Pesanan</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center border-0 shadow-sm h-100">
        <div class="card-body">
          <div style="font-size:2rem;color:#198754;"><i class="bi bi-cash-stack"></i></div>
          <h4 class="fw-bold mt-1 mb-0" style="font-size:1.1rem;">Rp {{ number_format($ringkasan['total_pendapatan'], 0, ',', '.') }}</h4>
          <p class="text-muted small mb-0">Total Pendapatan</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center border-0 shadow-sm h-100">
        <div class="card-body">
          <div style="font-size:2rem;color:#fd7e14;"><i class="bi bi-box-seam"></i></div>
          <h4 class="fw-bold mt-1 mb-0">{{ number_format($ringkasan['total_item']) }}</h4>
          <p class="text-muted small mb-0">Total Item Terjual</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center border-0 shadow-sm h-100">
        <div class="card-body">
          <div style="font-size:2rem;color:#6f42c1;"><i class="bi bi-calculator"></i></div>
          <h4 class="fw-bold mt-1 mb-0" style="font-size:1.1rem;">Rp {{ number_format($ringkasan['rata_rata_order'], 0, ',', '.') }}</h4>
          <p class="text-muted small mb-0">Rata-rata per Pesanan</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">

    {{-- ── GRAFIK ── --}}
    <div class="col-lg-8">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Grafik Pendapatan — {{ $periodLabel }}</h5>
          <canvas id="chartSales" style="max-height:300px;"></canvas>
        </div>
      </div>
    </div>

    {{-- ── PRODUK TERLARIS ── --}}
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Produk Terlaris</h5>
          <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0">
              <thead class="table-light">
                <tr><th>#</th><th>Produk</th><th class="text-center">Qty</th><th class="text-end">Revenue</th></tr>
              </thead>
              <tbody>
                @forelse($produkTerlaris as $i => $item)
                  <tr>
                    <td><span class="badge bg-primary">{{ $i+1 }}</span></td>
                    <td style="font-size:.82rem;">{{ $item->product_name }}</td>
                    <td class="text-center"><span class="badge bg-success">{{ $item->total_qty }}</span></td>
                    <td class="text-end fw-semibold" style="font-size:.8rem;">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                  </tr>
                @empty
                  <tr><td colspan="4" class="text-center text-muted py-3">Tidak ada data</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- ── TABEL PESANAN ── --}}
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title mb-0">
          <i class="bi bi-list-ul me-2"></i>Daftar Pesanan — {{ $periodLabel }}
        </h5>
        <span class="badge bg-secondary">{{ $orders->count() }} pesanan</span>
      </div>

      <table class="table datatable table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Kode Pesanan</th>
            <th>Pelanggan</th>
            <th>Tgl Pesan</th>
            <th>Items</th>
            <th>Subtotal</th>
            <th>Ongkir</th>
            <th>Total</th>
            <th>Metode</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $key => $order)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td class="fw-semibold text-primary">
                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-decoration-none">
                  {{ $order->order_code }}
                </a>
              </td>
              <td>
                <div class="fw-semibold" style="font-size:.85rem;">{{ $order->user->name ?? '-' }}</div>
                <div class="text-muted" style="font-size:.75rem;">{{ $order->phone }}</div>
              </td>
              <td style="font-size:.82rem;">{{ $order->created_at->format('d M Y') }}</td>
              <td class="text-center">
                <span class="badge bg-info text-dark">{{ $order->items->sum('qty') }} item</span>
              </td>
              <td>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
              <td>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
              <td class="fw-semibold text-success">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              <td><span class="badge bg-secondary">{{ strtoupper($order->payment_method) }}</span></td>
              <td><span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span></td>
            </tr>
          @empty
            <tr>
              <td colspan="10" class="text-center text-muted py-4">
                <i class="bi bi-inbox fs-3 d-block mb-2"></i>Tidak ada data pesanan pada periode ini
              </td>
            </tr>
          @endforelse
        </tbody>
        @if($orders->isNotEmpty())
        <tfoot class="table-light fw-bold">
          <tr>
            <td colspan="5" class="text-end">Total:</td>
            <td>Rp {{ number_format($orders->sum('subtotal'), 0, ',', '.') }}</td>
            <td>Rp {{ number_format($orders->sum('shipping_cost'), 0, ',', '.') }}</td>
            <td class="text-success">Rp {{ number_format($orders->sum('total'), 0, ',', '.') }}</td>
            <td colspan="2"></td>
          </tr>
        </tfoot>
        @endif
      </table>

    </div>
  </div>

</section>

<script>
// Toggle form filter
function toggleFilter() {
    const v = document.getElementById('filterType').value;
    document.getElementById('grpMonth').classList.toggle('d-none', v !== 'monthly');
    document.getElementById('grpYear').classList.toggle('d-none', v === 'range');
    document.getElementById('grpFrom').classList.toggle('d-none', v !== 'range');
    document.getElementById('grpTo').classList.toggle('d-none', v !== 'range');
}
document.addEventListener('DOMContentLoaded', function() {
    toggleFilter();

    // Grafik
    const ctx = document.getElementById('chartSales');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($grafikLabels) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($grafikData) !!},
                borderColor: 'rgb(13, 110, 253)',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                borderWidth: 2.5,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => ' Rp ' + new Intl.NumberFormat('id-ID').format(ctx.raw)
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: v => 'Rp ' + new Intl.NumberFormat('id-ID', { notation: 'compact' }).format(v) }
                }
            }
        }
    });
});
</script>

@endsection
