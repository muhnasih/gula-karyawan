@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Operator</h1>
        <a href="{{ route('admin.operator.create') }}" class="btn btn-primary">
            + Tambah Operator
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
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
@endsection