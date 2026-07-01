@extends('layouts.app')

@section('title','Data User')

@section('content')

<style>

.card{
    border:none;
    border-radius:15px;
}

.table thead{
    background:#212529;
    color:white;
}

.table tbody tr:hover{
    background:#f8f9fa;
}

.avatar{

width:45px;
height:45px;
border-radius:50%;
object-fit:cover;

}

.stat-card{

border-left:5px solid #0d6efd;

}

</style>

<div class="container-fluid py-4">

<div class="row mb-4">

<div class="col-lg-6">

<h2 class="fw-bold">

<i class="fas fa-users text-primary"></i>

Data User

</h2>

<p class="text-muted">

Kelola seluruh pengguna TGS Cinema

</p>

</div>

<div class="col-lg-6 text-end">

<button

class="btn btn-primary"

data-bs-toggle="modal"

data-bs-target="#modalTambah">

<i class="fas fa-user-plus"></i>

Tambah User

</button>

</div>

</div>

<div class="row mb-4">

<div class="col-md-4">

<div class="card shadow stat-card">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<small>Total User</small>

<h2>

{{ $users->count() }}

</h2>

</div>

<i class="fas fa-users fa-3x text-primary"></i>

</div>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow stat-card">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<small>Admin</small>

<h2>

{{ $users->where('role','admin')->count() }}

</h2>

</div>

<i class="fas fa-user-shield fa-3x text-danger"></i>

</div>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow stat-card">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<small>Pelanggan</small>

<h2>

{{ $users->where('role','pelanggan')->count() }}

</h2>

</div>

<i class="fas fa-user fa-3x text-success"></i>

</div>

</div>

</div>

</div>

</div>

<div class="card shadow">

<div class="card-header bg-white">

<div class="row">

<div class="col-md-6">

<h5>

Daftar User

</h5>

</div>

<div class="col-md-6">

<input

type="text"

id="searchUser"

class="form-control"

placeholder="Cari user...">

</div>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table

class="table table-hover align-middle"

id="tableUser">

<thead>

<tr>

<th>No</th>

<th>Foto</th>

<th>Nama</th>

<th>Email</th>

<th>No HP</th>

<th>Alamat</th>

<th>Role</th>

<th width="170">

Aksi

</th>

</tr>

</thead>

<tbody>

@foreach($users as $user)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td>

<img

src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D6EFD&color=fff"

class="avatar">

</td>

<td>

<strong>

{{ $user->name }}

</strong>

</td>

<td>

{{ $user->email }}

</td>

<td>

{{ $user->nohp }}

</td>

<td>

{{ $user->alamat }}

</td>

<td>

@if($user->role=='admin')

<span class="badge bg-danger">

Admin

</span>

@else

<span class="badge bg-success">

Pelanggan

</span>

@endif

</td>

<td>

<button

class="btn btn-warning btn-sm btnEdit"

data-id="{{ $user->id }}"

data-name="{{ $user->name }}"

data-email="{{ $user->email }}"

data-nohp="{{ $user->nohp }}"

data-alamat="{{ $user->alamat }}"

data-role="{{ $user->role }}">

<i class="fas fa-edit"></i>

</button>

<form

action="{{ route('users.destroy',$user->id) }}"

method="POST"

class="d-inline formDelete">

@csrf

@method('DELETE')

<button

type="submit"

class="btn btn-danger btn-sm">

<i class="fas fa-trash"></i>

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>
<!-- =======================================================
                MODAL TAMBAH USER
======================================================= -->

<div class="modal fade" id="modalTambah" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">

                    <i class="fas fa-user-plus"></i>

                    Tambah User

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <form action="{{ route('users.store') }}" method="POST">

                @csrf

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Nama Lengkap

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Masukkan Nama"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Masukkan Email"
                                required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Minimal 6 karakter"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Role

                            </label>

                            <select
                                name="role"
                                class="form-select"
                                required>

                                <option value="">-- Pilih Role --</option>

                                <option value="admin">

                                    Admin

                                </option>

                                <option value="pelanggan">

                                    Pelanggan

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Nomor HP

                            </label>

                            <input
                                type="text"
                                name="nohp"
                                class="form-control"
                                placeholder="08xxxxxxxxxx"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Alamat

                            </label>

                            <textarea
                                name="alamat"
                                rows="3"
                                class="form-control"
                                placeholder="Masukkan Alamat"
                                required></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        <i class="fas fa-times"></i>

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Simpan User

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- ==========================================
            MODAL EDIT USER
========================================== -->

<div class="modal fade"
     id="modalEdit"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h5 class="modal-title">

                    <i class="fas fa-user-edit"></i>

                    Edit User

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <form
                id="formEdit"
                method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Nama Lengkap</label>

                            <input
                                type="text"
                                id="edit_name"
                                name="name"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                id="edit_email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Password Baru</label>

                            <input
                                type="password"
                                id="edit_password"
                                name="password"
                                class="form-control">

                            <small class="text-muted">

                                Kosongkan jika tidak ingin mengubah password

                            </small>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Role</label>

                            <select
                                id="edit_role"
                                name="role"
                                class="form-select">

                                <option value="admin">

                                    Admin

                                </option>

                                <option value="pelanggan">

                                    Pelanggan

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>No HP</label>

                            <input
                                type="text"
                                id="edit_nohp"
                                name="nohp"
                                class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Alamat</label>

                            <textarea
                                id="edit_alamat"
                                name="alamat"
                                rows="3"
                                class="form-control"></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Tutup

                    </button>

                    <button
                        type="submit"
                        class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Update User

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // === LOGIKA UNTUK MODAL EDIT ===
    const modal = new bootstrap.Modal(document.getElementById('modalEdit'));
    document.querySelectorAll('.btnEdit').forEach(function(button) {
        button.addEventListener('click', function() {
            let id = this.dataset.id;
            document.getElementById('edit_name').value = this.dataset.name;
            document.getElementById('edit_email').value = this.dataset.email;
            document.getElementById('edit_role').value = this.dataset.role;
            document.getElementById('edit_nohp').value = this.dataset.nohp;
            document.getElementById('edit_alamat').value = this.dataset.alamat;
            document.getElementById('edit_password').value = '';
            document.getElementById('formEdit').action = "{{ url('admin/users') }}/" + id;
            modal.show();
        });
    });

    // === LOGIKA UNTUK PENCARIAN USER (LIVE SEARCH) ===
    const searchInput = document.getElementById('searchUser');
    const tableRows = document.querySelectorAll('#tableUser tbody tr');

    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            // Mengambil teks dari kolom Nama, Email, No HP, Alamat, dan Role
            const text = row.innerText.toLowerCase();
            
            if (text.includes(filter)) {
                row.style.display = ''; // Tampilkan baris jika cocok
            } else {
                row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
            }
        });
    });
});
</script>