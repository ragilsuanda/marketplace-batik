<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Menampilkan daftar laporan di halaman admin.
     */
    public function index()
    {
        $reports = Report::latest()->get();
        return view('backend.reports.index', compact('reports'));
    }

    /**
     * Menampilkan form pelaporan untuk user.
     */
    public function create()
    {
        return view('frontend.reports.create');
    }

    /**
     * Menyimpan laporan yang dikirim user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'victim_name' => 'required|string|max:255',
            'perpetrator_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'incident_date' => 'required|date',
            'description' => 'required|string',
            'media' => 'nullable|mimes:jpg,jpeg,png,mp4,mov|max:10240',
        ]);

        // Simpan file jika ada
        $filePath = $request->hasFile('media') ? $request->file('media')->store('reports', 'public') : null;

        // Simpan ke database
        Report::create([
            'user_id' => Auth::id(),
            'victim_name' => $request->victim_name,
            'perpetrator_name' => $request->perpetrator_name,
            'location' => $request->location,
            'incident_date' => $request->incident_date,
            'report_date' => now(), // Tanggal otomatis
            'description' => $request->description,
            'media' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('reports.create')->with('success', 'Laporan berhasil dikirim.');
    }

    /**
     * Menampilkan detail laporan dalam modal.
     */
    public function show(Report $report)
    {
        return view('backend.reports.show', compact('report'));
    }

    /**
     * Mengupdate status laporan.
     */
    public function updateStatus(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $report->update(['status' => $request->status]);

        return redirect()->route('reports.index')->with('success', 'Status laporan diperbarui.');
    }
    /**
     * Menghapus laporan.
     */
    public function destroy(Report $report)
    {
        if ($report->media) {
            Storage::disk('public')->delete($report->media);
        }

        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
