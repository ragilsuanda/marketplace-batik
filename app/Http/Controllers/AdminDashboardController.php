<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total laporan masuk
        $totalReports = Report::count();

        // Total laporan yang disetujui
        $approvedReports = Report::where('status', 'approved')->count();

        // Laporan per bulan
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->translatedFormat('F'); // Nama bulan dalam Bahasa Indonesia
        });

        $reportCounts = collect(range(1, 12))->map(function ($month) {
            return Report::whereMonth('created_at', $month)->count(); // Hitung laporan tiap bulan
        });

        return view('backend.dashboard.index', compact('totalReports', 'approvedReports', 'months', 'reportCounts'));
    }
}
