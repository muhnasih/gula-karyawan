@extends('layouts.app')

@section('content')
<div class="container">

    {{-- =========================================================
        HEADER
    ========================================================= --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
        <h1 class="fs-4 fs-md-2 mb-0">Daftar Operator</h1>
        <a href="{{ route('admin.operator.create') }}" class="btn btn-primary w-100 w-md-auto">
            + Tambah Operator
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- =========================================================
        TABEL OPERATOR (tampil di layar md ke atas)
    ========================================================= --}}
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.operator.edit', $user->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.operator.destroy', $user->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus operator ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data operator.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- =========================================================
        DAFTAR OPERATOR - CARD LIST (tampil di layar kecil / HP)
    ========================================================= --}}
    <div class="d-block d-md-none">

        @forelse ($users as $user)

            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="fw-bold mb-0">{{ $user->nama_lengkap }}</h6>
                            <small class="text-muted">{{ $user->username }}</small>
                        </div>
                        <span class="badge {{ $user->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>

                    <div class="small mb-3">
                        <span class="text-muted d-block">Email</span>
                        <span class="text-break">{{ $user->email }}</span>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.operator.edit', $user->id) }}"
                           class="btn btn-sm btn-warning flex-fill">
                            Edit
                        </a>

                        <form action="{{ route('admin.operator.destroy', $user->id) }}"
                              method="POST"
                              class="flex-fill"
                              onsubmit="return confirm('Yakin ingin menghapus operator ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        @empty

            <div class="card shadow-sm border-0">
                <div class="card-body text-center text-muted py-4">
                    Belum ada data operator.
                </div>
            </div>

        @endforelse

    </div>

</div>
@endsection