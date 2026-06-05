@extends('backend.layout.app')
@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card shadow-sm">
        <div class="card-body">

          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">
              <i class="bi bi-tags me-2 text-primary"></i>Daftar Kategori
            </h5>
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
              <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
            </a>
          </div>

          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <table class="table datatable table-hover table-bordered align-middle">
            <thead class="table-dark">
              <tr>
                <th width="60">No</th>
                <th>Nama Kategori</th>
                <th width="160" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($categories as $key => $item)
                <tr>
                  <td class="text-center">{{ $key + 1 }}</td>
                  <td>{{ $item->name }}</td>
                  <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <a href="{{ route('categories.edit', $item->id) }}"
                         class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                      </a>
                      <form action="{{ route('categories.destroy', $item->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                          <i class="bi bi-trash"></i> Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center text-muted py-4">
                    <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                    Belum ada kategori
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
