@extends('layouts.app')

@section('title','Kelola User')

@section('content')


<div class="container-fluid">


    {{-- Header --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold text-success">

                <i class="bi bi-person-gear"></i>

                Kelola User

            </h2>


            <p class="text-muted">

                Mengelola akun pengguna sistem PG Gending

            </p>

        </div>


        <a href="#"
           class="btn btn-success">

            <i class="bi bi-person-plus"></i>

            Tambah User

        </a>


    </div>




    {{-- Table User --}}

    <div class="card shadow-sm border-0">


        <div class="card-body">


            <div class="table-responsive">


                <table class="table table-hover align-middle">


                    <thead class="table-success">

                        <tr>

                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>



                    <tbody>


                    @forelse($users as $key=>$user)


                    <tr>


                        <td>
                            {{ $key+1 }}
                        </td>


                        <td>
                            {{ $user->username }}
                        </td>


                        <td>
                            {{ $user->nama_lengkap }}
                        </td>


                        <td>
                            {{ $user->email }}
                        </td>


                        <td>

                            @if($user->role=='admin')

                                <span class="badge bg-success">
                                    Admin
                                </span>


                            @elseif($user->role=='operator')

                                <span class="badge bg-primary">
                                    Operator
                                </span>


                            @else

                                <span class="badge bg-secondary">
                                    Karyawan
                                </span>

                            @endif


                        </td>


                        <td>

                            @if($user->status=='aktif')

                                <span class="badge bg-success">
                                    Aktif
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Nonaktif
                                </span>

                            @endif

                        </td>



                        <td>


                            <a href="#"
                               class="btn btn-sm btn-warning">

                                <i class="bi bi-pencil"></i>

                            </a>



                            <a href="#"
                               class="btn btn-sm btn-danger">

                                <i class="bi bi-trash"></i>

                            </a>


                        </td>


                    </tr>


                    @empty


                    <tr>

                        <td colspan="7"
                            class="text-center text-muted">

                            Belum ada data user

                        </td>

                    </tr>


                    @endforelse



                    </tbody>


                </table>


            </div>


        </div>


    </div>


</div>


@endsection