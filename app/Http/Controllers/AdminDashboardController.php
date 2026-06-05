<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $year = now()->year;

        // ── Stat Cards ───────────────────────────────────────
        $totalProduk      = Product::count();
        $totalStok        = Product::sum('stock');
        $totalPesanan     = Order::count();
        $pesananPending   = Order::where('status', 'pending')->count();
        $pesananSelesai   = Order::where('status', 'selesai')->count();
        $pendapatanTotal  = Order::whereIn('status', ['selesai', 'dikirim', 'diproses'])->sum('total');
        $totalPelanggan   = User::where('role', 'user')->count();
        $produkStokHabis  = Product::where('stock', 0)->count();

        // ── Grafik penjualan per bulan (tahun ini) ──────────
        $bulanLabels = collect(range(1, 12))->map(
            fn($m) => Carbon::create($year, $m)->translatedFormat('M')
        );

        $penjualanBulanan = collect(range(1, 12))->map(function ($m) use ($year) {
            return Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)
                ->whereIn('status', ['selesai', 'dikirim', 'diproses'])
                ->sum('total');
        });

        $orderBulanan = collect(range(1, 12))->map(function ($m) use ($year) {
            return Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)
                ->count();
        });

        // ── Produk terlaris ─────────────────────────────────
        $produkTerlaris = OrderItem::select('product_name', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('order', fn($q) => $q->whereIn('status', ['selesai', 'dikirim', 'diproses']))
            ->groupBy('product_name')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        // ── Pesanan terbaru ──────────────────────────────────
        $pesananTerbaru = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // ── Stok menipis (stok < 5) ──────────────────────────
        $stokMenipis = Product::where('stock', '>', 0)
            ->where('stock', '<', 5)
            ->with('category')
            ->get();

        return view('backend.dashboard.index', compact(
            'totalProduk', 'totalStok', 'totalPesanan', 'pesananPending',
            'pesananSelesai', 'pendapatanTotal', 'totalPelanggan', 'produkStokHabis',
            'bulanLabels', 'penjualanBulanan', 'orderBulanan',
            'produkTerlaris', 'pesananTerbaru', 'stokMenipis', 'year'
        ));
    }
}
