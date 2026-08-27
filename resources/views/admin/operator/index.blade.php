@extends('layouts.app')

@section('content')
<div class="container py-3 py-md-4">
    {{-- =========================================================
        HEADER
    ========================================================= --}}
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
        <div>
            <h1 class="fs-4 fs-md-3 fw-bold mb-1">Daftar Operator</h1>
            <p class="text-muted mb-0 small">Kelola akun operator yang memiliki akses ke sistem.</p>
        </div>
        <a href="{{ route('admin.operator.create') }}"
           class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-2 shadow-sm px-3 py-2 w-100 w-sm-auto">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Operator</span>
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div class="small">{{ session('success') }}</div>
        </div>
    @endif

    {{-- =========================================================
        CARD WRAPPER
    ========================================================= --}}
    <div class="card border-0 shadow-sm operator-card">
        <div class="card-body p-0">

            {{-- =====================================================
                TABEL (Desktop / Tablet ≥ md)
            ===================================================== --}}
            <div class="table-responsive d-none d-md-block">
                <table class="table align-middle mb-0 operator-table">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width: 60px;">#</th>
                            <th>Operator</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th style="width: 130px;">Status</th>
                            <th class="text-end pe-4" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="ps-4 text-muted small">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-circle">
                                            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $user->nama_lengkap }}</span>
                                    </div>
                                </td>
                                <td class="text-muted">{{ $user->username }}</td>
                                <td class="text-muted text-break">{{ $user->email }}</td>
                                <td>
                                    <span class="status-badge {{ $user->status === 'aktif' ? 'status-aktif' : 'status-nonaktif' }}">
                                        <span class="status-dot"></span>
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.operator.edit', $user->id) }}"
                                           class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1 px-2">
                                            <i class="bi bi-pencil-square"></i>
                                            <span class="d-none d-lg-inline">Edit</span>
                                        </a>
                                        <form action="{{ route('admin.operator.destroy', $user->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus operator ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 px-2">
                                                <i class="bi bi-trash3"></i>
                                                <span class="d-none d-lg-inline">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-0 border-0">
                                    @include('admin.operator._empty')
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- =====================================================
                CARD LIST (Mobile < md)
            ===================================================== --}}
            <div class="d-block d-md-none p-3">
                @forelse ($users as $user)
                    <div class="operator-mobile-card mb-3">
                        <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">{{ $user->nama_lengkap }}</h6>
                                    <small class="text-muted">@{{ $user->username }}</small>
                                </div>
                            </div>
                            <span class="status-badge {{ $user->status === 'aktif' ? 'status-aktif' : 'status-nonaktif' }} flex-shrink-0">
                                <span class="status-dot"></span>
                                {{ ucfirst($user->status) }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted small d-block mb-1">Email</span>
                            <span class="text-break small">{{ $user->email }}</span>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.operator.edit', $user->id) }}"
                               class="btn btn-sm btn-outline-warning flex-fill d-inline-flex align-items-center justify-content-center gap-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.operator.destroy', $user->id) }}"
                                  method="POST"
                                  class="flex-fill"
                                  onsubmit="return confirm('Yakin ingin menghapus operator ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger w-100 d-inline-flex align-items-center justify-content-center gap-1">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    @include('admin.operator._empty')
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Card */
    .operator-card {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
    }

    /* Table */
    .operator-table thead tr {
        background-color: #f8f9fb;
    }
    .operator-table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #6b7280;
        font-weight: 600;
        border-bottom: 1px solid #eef0f3;
        padding: 0.85rem 1rem;
        white-space: nowrap;
    }
    .operator-table tbody tr {
        border-bottom: 1px solid #f1f2f5;
        transition: background-color 0.15s ease;
    }
    .operator-table tbody tr:last-child {
        border-bottom: none;
    }
    .operator-table tbody tr:hover {
        background-color: #fafbfc;
    }
    .operator-table td {
        padding: 0.9rem 1rem;
        vertical-align: middle;
    }

    /* Avatar */
    .avatar-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        flex-shrink: 0;
        box-shadow: 0 2px 6px rgba(99, 102, 241, 0.25);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.28rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        line-height: 1.2;
    }
    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-aktif {
        background-color: #e6f7ee;
        color: #15803d;
    }
    .status-aktif .status-dot {
        background-color: #22c55e;
    }
    .status-nonaktif {
        background-color: #f3f4f6;
        color: #6b7280;
    }
    .status-nonaktif .status-dot {
        background-color: #9ca3af;
    }

    /* Mobile Card */
    .operator-mobile-card {
        background: #fff;
        border: 1px solid #eef0f3;
        border-radius: 14px;
        padding: 1.1rem;
        box-shadow: 0 1px 3px rgba(16, 24, 40, 0.04);
        transition: box-shadow 0.15s ease;
    }
    .operator-mobile-card:hover {
        box-shadow: 0 4px 12px rgba(16, 24, 40, 0.06);
    }

    /* Button hover */
    .btn-outline-warning:hover,
    .btn-outline-danger:hover {
        color: #fff !important;
    }

    /* Responsive tweaks */
    @media (max-width: 575.98px) {
        .operator-mobile-card {
            padding: 1rem;
        }
    }
</style>
@endpush
@endsection