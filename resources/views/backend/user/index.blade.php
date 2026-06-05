@extends('backend.layout.app')

@section('title', 'Data Siswa')

@section('content')


  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Datatables</h5>
            <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Tambah Pengguna</a>
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No Handphone</th>
                    <th>email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pengguna ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
