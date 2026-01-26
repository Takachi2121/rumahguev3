@extends('admin.main')

@section('title', 'Data User')
@section('subtitle', 'Kelola data user di sini.')

@section('mainContent')
<link rel="stylesheet" href="{{ asset('assets/css/user.css')}}">

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="fw-semibold fs-4">List Data User</p>
            </div>
            <div class="col-md-6 text-end align-self-center">
                <button class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i> Tambah Data</button>
            </div>
        </div>
        <table id="usersTable" class="table table-bordered table-striped nowrap" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            @if($user->is_mitra == 0)
                                <span class="badge badge-role badge-user">User</span>
                            @elseif($user->is_mitra == 1)
                                <span class="badge badge-role badge-mitra">Mitra</span>
                            @else
                                <span class="badge badge-role badge-admin">Admin</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm text-white btn-warning btn-edit"
                                data-id="{{ $user->id }}"
                                data-nama="{{ $user->nama }}"
                                data-email="{{ $user->email }}"
                                data-role="{{ $user->is_mitra }}"
                            >
                                <i class="fa-solid fa-pen"></i>&nbsp;&nbsp;Edit</button>
                            <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i>&nbsp;&nbsp;Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="namaUser" id="namaUser" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email User</label>
                        <input type="email" name="emailUser" id="emailUser" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role User</label>
                        <select name="roleUser" id="roleUser" class="form-control">
                            <option value="2">Admin</option>
                            <option value="1">Mitra</option>
                            <option value="0">User</option>
                        </select>
                    </div>
                </div>

                <div class="w-100 d-flex justify-content-center">
                    <button type="submit" class="btn bg-danger py-2 mb-3 w-75" id="btnUser">
                        <span class="btn-text text-white">
                            <i class="fa-solid fa-rotate"></i>&nbsp;&nbsp;Perbarui Data
                        </span>
                        <span class="btn-loading d-none">
                            <span class="spinner-border spinner-border-sm"></span>
                            Loading...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
