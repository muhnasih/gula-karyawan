@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Operator</h1>

    <form action="{{ route('admin.operator.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                   class="form-control @error('username') is-invalid @enderror">
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                   class="form-control @error('nama_lengkap') is-invalid @enderror">
            @error('nama_lengkap')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="aktif" {{ old('status', $user->status) === 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="nonaktif" {{ old('status', $user->status) === 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password Baru (opsional)</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.operator.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection