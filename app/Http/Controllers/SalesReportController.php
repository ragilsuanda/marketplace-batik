<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // ── Tentukan filter ─────────────────────────────────
        $filter    = $request->get('filter', 'monthly'); // monthly | yearly | range
        $year      = $request->get('year', now()->year);
        $month     = $request->get('month', now()->month);
        $dateFrom  = $request->get('date_from');
        $dateTo    = $request->get('date_to');

        // ── Base query pesanan yang dihitung ─────────────────
        $statusDihitung = ['selesai', 'dikirim', 'diproses'];

        $baseQuery = Order::whereIn('status', $statusDihitung);

        if ($filter === 'monthly') {
            $baseQuery->whereYear('created_at', $year)->whereMonth('created_at', $month);
            $periodLabel = Carbon::create($year, $month)->translatedFormat('F Y');
        } elseif ($filter === 'yearly') {
            $baseQuery->whereYear('created_at', $year);
            $periodLabel = "Tahun {$year}";
        } else { // range
            if ($dateFrom) $baseQuery->whereDate('created_at', '>=', $dateFrom);
            if ($dateTo)   $baseQuery->whereDate('created_at', '<=', $dateTo);
            $periodLabel = ($dateFrom && $dateTo)
                ? Carbon::parse($dateFrom)->format('d M Y') . ' – ' . Carbon::parse($dateTo)->format('d M Y')
                : 'Semua Waktu';
        }

        // ── Ringkasan ────────────────────────────────────────
        $ringkasan = [
            'total_order'     => (clone $baseQuery)->count(),
            'total_pendapatan' => (clone $baseQuery)->sum('total'),
            'total_item'      => OrderItem::whereIn('order_id',
                (clone $baseQuery)->pluck('id')
            )->sum('qty'),
            'rata_rata_order' => (clone $baseQuery)->count() > 0
                ? (clone $baseQuery)->sum('total') / (clone $baseQuery)->count()
                : 0,
        ];

        // ── Grafik per hari/bulan ─────────────────────────────
        if ($filter === 'monthly') {
            // Per hari dalam bulan
            $daysInMonth = Carbon::create($year, $month)->daysInMonth;
            $grafikLabels = collect(range(1, $daysInMonth))->map(fn($d) => $d);
            $grafikData   = collect(range(1, $daysInMonth))->map(function ($d) use ($year, $month, $statusDihitung) {
                return Order::whereIn('status', $statusDihitung)
                    ->whereYear('created_at', $year)->whereMonth('created_at', $month)
                    ->whereDay('created_at', $d)->sum('total');
            });
        } elseif ($filter === 'yearly') {
            // Per bulan dalam tahun
            $grafikLabels = collect(range(1, 12))->map(fn($m) => Carbon::create($year, $m)->translatedFormat('M'));
            $grafikData   = collect(range(1, 12))->map(function ($m) use ($year, $statusDihitung) {
                return Order::whereIn('status', $statusDihitung)
                    ->whereYear('created_at', $year)->whereMonth('created_at', $m)->sum('total');
            });
        } else {
            // Per hari dalam range
            $from = $dateFrom ? Carbon::parse($dateFrom) : now()->subDays(29);
            $to   = $dateTo   ? Carbon::parse($dateTo)   : now();
            $days = collect();
            for ($d = $from->copy(); $d->lte($to); $d->addDay()) {
                $days->push($d->format('d M'));
            }
            $grafikLabels = $days;
            $grafikData   = $days->map(function ($label) use ($from, $to, $statusDihitung) {
                $date = Carbon::createFromFormat('d M', $label)->year(now()->year);
                return Order::whereIn('status', $statusDihitung)->whereDate('created_at', $date)->sum('total');
            });
        }

        // ── Produk terlaris dalam filter ─────────────────────
        $orderIds      = (clone $baseQuery)->pluck('id');
        $produkTerlaris = OrderItem::select(
            'product_name',
            DB::raw('SUM(qty) as total_qty'),
            DB::raw('SUM(subtotal) as total_revenue')
        )->whereIn('order_id', $orderIds)
         ->groupBy('product_name')
         ->orderByDesc('total_revenue')
         ->take(10)
         ->get();

        // ── Daftar pesanan ────────────────────────────────────
        $orders = (clone $baseQuery)->with(['user', 'items'])->latest()->get();

        // ── Daftar tahun tersedia ─────────────────────────────
        $tahunList = Order::selectRaw('YEAR(created_at) as year')
            ->distinct()->orderByDesc('year')->pluck('year');

        return view('backend.reports.sales', compact(
            'filter', 'year', 'month', 'dateFrom', 'dateTo', 'periodLabel',
            'ringkasan', 'grafikLabels', 'grafikData',
            'produkTerlaris', 'orders', 'tahunList'
        ));
    }
}
