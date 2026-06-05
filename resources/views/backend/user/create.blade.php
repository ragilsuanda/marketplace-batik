@extends('backend.layout.app')
@section('content')
<div class="container">
    <h2>Tambah Pengguna</h2>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Handphone</label>
            <input type="text" name="phone" class="form-control" required pattern="\d{10,15}" title="Masukkan nomor handphone 10-15 digit">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
