@extends('frontend.layout.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Laporkan Kasus Bullying</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Judul Laporan</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Korban</label>
            <input type="text" name="victim_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pelaku</label>
            <input type="text" name="perpetrator_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi Kejadian</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Kejadian</label>
            <input type="date" name="incident_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Kejadian</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Unggah Bukti (Foto/Video)</label>
            <input type="file" name="media" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Kirim Laporan</button>
    </form>
</div>
@endsection
