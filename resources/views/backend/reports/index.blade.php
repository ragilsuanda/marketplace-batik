
@extends('backend.layout.app')
@section('content')


  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Laporan Bullying</h5>
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Laporan</th>
                    <th>Pelapor</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
            @foreach($reports as $key => $report)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $report->report_date }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td>
                         <!-- Status dengan fitur ubah (klik badge jika status Pending) -->
                         @if($report->status == 'pending')
                         <form action="{{ route('reports.updateStatus', $report->id) }}" method="POST" class="d-inline">
                             @csrf
                             @method('PATCH')
                             <select name="status" onchange="this.form.submit()" class="badge bg-warning border-0 text-dark" style="cursor: pointer;">
                                 <option value="pending" selected>Pending</option>
                                 <option value="approved">Approved</option>
                                 <option value="rejected">Rejected</option>
                             </select>
                         </form>
                     @else
                         <span class="badge bg-{{ $report->status == 'approved' ? 'success' : 'danger' }}">
                             <i></i> {{ ucfirst($report->status) }}
                         </span>
                     @endif
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <!-- Tombol Detail -->
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $report->id }}">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>     
                </tr>
            @endforeach
        </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>
  @foreach($reports as $report)
  <div class="modal fade" id="modal-{{ $report->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <!-- Header -->
              <div class="modal-header bg-white border-bottom">
                  <h5 class="modal-title fw-bold">Detail Laporan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
  
              <!-- Body -->
              <div class="modal-body px-4 py-3">
                  <h6 class="fw-bold mb-2">1. Informasi Pelapor</h6>
                  <p class="fs-6 text-muted mb-2">Nama Pelapor: <span class="fw-normal">{{ $report->user->name }}</span></p>
                  <hr class="my-2">
  
                  <h6 class="fw-bold mb-2">2. Informasi Kejadian</h6>
                  <div class="row">
                      <div class="col-6">
                          <p class="fs-6 text-muted mb-1">Nama Korban: <span class="fw-normal">{{ $report->victim_name }}</span></p>
                          <p class="fs-6 text-muted mb-1">Nama Pelaku: <span class="fw-normal">{{ $report->perpetrator_name }}</span></p>
                      </div>
                      <div class="col-6">
                          <p class="fs-6 text-muted mb-1">Lokasi Kejadian: <span class="fw-normal">{{ $report->location }}</span></p>
                          <p class="fs-6 text-muted mb-1">Tanggal Kejadian: <span class="fw-normal">{{ $report->incident_date }}</span></p>
                      </div>
                  </div>
                  <hr class="my-2">
  
                  <h6 class="fw-bold mb-2">3. Deskripsi Kejadian</h6>
                  <p class="fs-6 text-muted text-justify" style="text-indent: 20px; line-height: 1.6;">
                      {{ $report->description }}
                  </p>
                  <hr class="my-2">
  
                  <h6 class="fw-bold mb-2">4. Bukti</h6>
                  <div class="text-center py-2">
                      @if($report->media)
                          @if(Str::endsWith($report->media, ['jpg', 'jpeg', 'png']))
                              <img src="{{ asset('storage/' . $report->media) }}" class="img-fluid rounded shadow mb-2">
                              <br>
                              <a href="{{ asset('storage/' . $report->media) }}" download class="btn btn-primary btn-sm">
                                  Download Gambar
                              </a>
                          @elseif(Str::endsWith($report->media, ['mp4', 'mov']))
                              <video class="w-100 rounded shadow mb-2" controls>
                                  <source src="{{ asset('storage/' . $report->media) }}" type="video/mp4">
                              </video>
                              <br>
                              <a href="{{ asset('storage/' . $report->media) }}" download class="btn btn-primary btn-sm">
                                  Download Video
                              </a>
                          @endif
                      @else
                          <p class="text-muted text-center">Tidak ada bukti tersedia.</p>
                      @endif
                  </div>
              </div>
  
              <!-- Footer -->
              <div class="modal-footer bg-light py-2">
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
              </div>
          </div>
      </div>
  </div>
  @endforeach
  
  
  
  
  
@endsection
