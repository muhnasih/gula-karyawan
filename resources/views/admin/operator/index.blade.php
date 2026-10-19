@extends('layouts.app')

@section('content')

<div class="container-fluid px-3 px-md-4 px-lg-5 py-4">

    {{-- ================= HEADER ================= --}}
    <div class="op-header mb-4">
        <div class="op-header-left">
            <div class="op-badge">
                <i class="bi bi-person-gear"></i>
                <span>MANAJEMEN PENGGUNA</span>
            </div>
            <h1 class="op-title">Daftar Operator</h1>
            <p class="op-desc">
                Kelola akun operator yang memiliki akses ke sistem pengambilan gula.
            </p>
        </div>

        <a href="{{ route('admin.operator.create') }}" class="btn-op-add">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Operator</span>
        </a>
    </div>


    {{-- ================= SUCCESS ALERT ================= --}}
    @if (session('success'))
        <div class="op-alert success mb-4">
            <div class="op-alert-icon">
                <i class="bi bi-check-lg"></i>
            </div>
            <div>
                <div class="op-alert-title">Berhasil</div>
                <div class="op-alert-msg">{{ session('success') }}</div>
            </div>
        </div>
    @endif


    {{-- ================= SUMMARY ================= --}}
    @php
        $totalOperator   = $users->count();
        $operatorAktif   = $users->where('status', 'aktif')->count();
        $operatorNonaktif = $users->where('status', '!=', 'aktif')->count();
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="op-stat">
                <div class="op-stat-icon blue">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="op-stat-label">Total Operator</div>
                    <div class="op-stat-value">{{ $totalOperator }}</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="op-stat">
                <div class="op-stat-icon green">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <div>
                    <div class="op-stat-label">Operator Aktif</div>
                    <div class="op-stat-value">{{ $operatorAktif }}</div>
                </div>
                <span class="op-stat-badge green">Aktif</span>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="op-stat">
                <div class="op-stat-icon gray">
                    <i class="bi bi-person-x-fill"></i>
                </div>
                <div>
                    <div class="op-stat-label">Nonaktif</div>
                    <div class="op-stat-value">{{ $operatorNonaktif }}</div>
                </div>
                <span class="op-stat-badge gray">Nonaktif</span>
            </div>
        </div>
    </div>


    {{-- ================= MAIN CARD ================= --}}
    <div class="op-card">

        <div class="op-card-header">
            <div>
                <h5 class="op-card-title">Data Operator</h5>
                <p class="op-card-sub">Daftar akun operator yang terdaftar dalam sistem</p>
            </div>
            <div class="op-count">{{ $totalOperator }} Operator</div>
        </div>


        {{-- DESKTOP TABLE --}}
        <div class="table-responsive d-none d-md-block">
            <table class="table op-table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width:60px">No</th>
                        <th>Operator</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-end pe-4" style="width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="ps-4">
                                <span class="op-no">{{ $loop->iteration }}</span>
                            </td>

                            <td>
                                <div class="op-user">
                                    <div class="op-avatar">
                                        {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="op-name">{{ $user->nama_lengkap }}</div>
                                        <div class="op-role">Operator Sistem</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="op-username">
                                    <i class="bi bi-person"></i>
                                    {{ $user->username }}
                                </span>
                            </td>

                            <td>
                                <div class="op-email">
                                    <i class="bi bi-envelope"></i>
                                    {{ $user->email }}
                                </div>
                            </td>

                            <td>
                                @if ($user->status === 'aktif')
                                    <span class="op-status active">
                                        <span class="dot"></span> Aktif
                                    </span>
                                @else
                                    <span class="op-status inactive">
                                        <span class="dot"></span> Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                <div class="op-actions">
                                    <a href="{{ route('admin.operator.edit', $user->id) }}"
                                       class="op-btn edit"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.operator.destroy', $user->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus operator ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="op-btn delete" title="Hapus">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border-0 p-0">
                                @include('admin.operator._empty')
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- MOBILE LIST --}}
        <div class="d-block d-md-none op-mobile">
            @forelse ($users as $user)
                <div class="op-m-card">
                    <div class="op-m-top">
                        <div class="op-user">
                            <div class="op-avatar">
                                {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                            </div>
                            <div>
                                <div class="op-name">{{ $user->nama_lengkap }}</div>
                                <div class="op-role">@ {{ $user->username }}</div>
                            </div>
                        </div>

                        @if ($user->status === 'aktif')
                            <span class="op-status active">
                                <span class="dot"></span> Aktif
                            </span>
                        @else
                            <span class="op-status inactive">
                                <span class="dot"></span> Nonaktif
                            </span>
                        @endif
                    </div>

                    <div class="op-m-email">
                        <i class="bi bi-envelope"></i>
                        <span>{{ $user->email }}</span>
                    </div>

                    <div class="op-m-actions">
                        <a href="{{ route('admin.operator.edit', $user->id) }}" class="op-m-btn edit">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <form action="{{ route('admin.operator.destroy', $user->id) }}"
                              method="POST"
                              class="flex-fill"
                              onsubmit="return confirm('Yakin ingin menghapus operator ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="op-m-btn delete w-100">
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


@push('styles')
<style>
    /* ===== HEADER ===== */
    .op-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
    }

    .op-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .08em;
        color: #0d6e4a;
    }

    .op-badge i {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #e6f7ef;
        color: #198754;
        font-size: 14px;
    }

    .op-title {
        font-size: 26px;
        font-weight: 750;
        color: #111827;
        letter-spacing: -.4px;
        margin-bottom: 4px;
    }

    .op-desc {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    /* ===== ADD BUTTON ===== */
    .btn-op-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 18px;
        background: linear-gradient(135deg, #198754, #157347);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(25, 135, 84, .25);
        transition: all .2s ease;
        text-decoration: none;
    }

    .btn-op-add:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(25, 135, 84, .32);
        color: #fff;
    }

    /* ===== ALERT ===== */
    .op-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1px solid transparent;
    }

    .op-alert.success {
        background: #ecfdf5;
        border-color: #a7f3d0;
    }

    .op-alert-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #198754;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .op-alert-title {
        font-size: 13px;
        font-weight: 700;
        color: #065f46;
    }

    .op-alert-msg {
        font-size: 13px;
        color: #047857;
    }

    /* ===== STAT CARDS ===== */
    .op-stat {
        position: relative;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(0,0,0,.04);
        transition: all .2s ease;
        min-height: 88px;
    }

    .op-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,.06);
    }

    .op-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .op-stat-icon.blue  { background: #eff6ff; color: #3b82f6; }
    .op-stat-icon.green { background: #ecfdf5; color: #198754; }
    .op-stat-icon.gray  { background: #f3f4f6; color: #6b7280; }

    .op-stat-label {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 2px;
    }

    .op-stat-value {
        font-size: 24px;
        font-weight: 750;
        color: #111827;
        line-height: 1;
    }

    .op-stat-badge {
        margin-left: auto;
        padding: 4px 9px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .op-stat-badge.green { background: #ecfdf5; color: #198754; }
    .op-stat-badge.gray  { background: #f3f4f6; color: #6b7280; }

    /* ===== MAIN CARD ===== */
    .op-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,.04);
    }

    .op-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 22px;
        border-bottom: 1px solid #f1f5f9;
    }

    .op-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 2px;
    }

    .op-card-sub {
        font-size: 12px;
        color: #9ca3af;
        margin: 0;
    }

    .op-count {
        padding: 5px 11px;
        background: #ecfdf5;
        color: #198754;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    /* ===== TABLE ===== */
    .op-table thead {
        background: #f8fafc;
    }

    .op-table thead th {
        padding: 11px 14px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #94a3b8;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .op-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background .15s ease;
    }

    .op-table tbody tr:last-child {
        border-bottom: none;
    }

    .op-table tbody tr:hover {
        background: #f8fafc;
    }

    .op-table td {
        padding: 14px;
        font-size: 13px;
        color: #374151;
        vertical-align: middle;
    }

    .op-no {
        font-size: 12px;
        font-weight: 600;
        color: #9ca3af;
    }

    /* User */
    .op-user {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .op-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
        font-size: 15px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .op-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #111827;
    }

    .op-role {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 1px;
    }

    /* Username */
    .op-username {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 9px;
        background: #f1f5f9;
        border-radius: 6px;
        font-size: 12px;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        color: #475569;
    }

    .op-username i {
        font-size: 12px;
        color: #94a3b8;
    }

    /* Email */
    .op-email {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12.5px;
        color: #64748b;
    }

    .op-email i {
        color: #94a3b8;
        font-size: 13px;
    }

    /* Status */
    .op-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
    }

    .op-status .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .op-status.active {
        background: #ecfdf5;
        color: #047857;
    }

    .op-status.active .dot {
        background: #10b981;
    }

    .op-status.inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .op-status.inactive .dot {
        background: #94a3b8;
    }

    /* Actions */
    .op-actions {
        display: inline-flex;
        gap: 6px;
    }

    .op-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid transparent;
        background: #fff;
        font-size: 14px;
        transition: all .18s ease;
        cursor: pointer;
    }

    .op-btn.edit {
        color: #d97706;
        border-color: #fde68a;
    }

    .op-btn.edit:hover {
        background: #fffbeb;
        color: #b45309;
    }

    .op-btn.delete {
        color: #ef4444;
        border-color: #fecaca;
    }

    .op-btn.delete:hover {
        background: #fef2f2;
        color: #dc2626;
    }

    /* ===== MOBILE ===== */
    .op-mobile {
        padding: 12px;
        background: #f8fafc;
    }

    .op-m-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 15px;
        margin-bottom: 10px;
        box-shadow: 0 1px 2px rgba(0,0,0,.03);
    }

    .op-m-card:last-child {
        margin-bottom: 0;
    }

    .op-m-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
    }

    .op-m-email {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #f1f5f9;
        font-size: 12.5px;
        color: #64748b;
        overflow-wrap: anywhere;
    }

    .op-m-email i {
        color: #94a3b8;
    }

    .op-m-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
    }

    .op-m-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-height: 38px;
        padding: 7px 12px;
        border-radius: 9px;
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid transparent;
        transition: all .18s ease;
        cursor: pointer;
    }

    .op-m-btn.edit {
        flex: 1;
        background: #fffbeb;
        border-color: #fde68a;
        color: #b45309;
    }

    .op-m-btn.edit:hover {
        background: #fef3c7;
    }

    .op-m-btn.delete {
        background: #fef2f2;
        border-color: #fecaca;
        color: #dc2626;
    }

    .op-m-btn.delete:hover {
        background: #fee2e2;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 767.98px) {
        .op-header {
            flex-direction: column;
            align-items: stretch;
        }

        .op-title {
            font-size: 22px;
        }

        .op-desc {
            font-size: 13px;
        }

        .btn-op-add {
            width: 100%;
            justify-content: center;
        }

        .op-stat {
            min-height: 76px;
            padding: 15px;
        }

        .op-stat-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .op-stat-value {
            font-size: 21px;
        }

        .op-stat-badge {
            font-size: 10px;
        }

        .op-card-header {
            padding: 15px 16px;
        }
    }

    @media (max-width: 400px) {
        .op-stat-badge {
            display: none;
        }

        .op-avatar {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .op-name {
            font-size: 13px;
        }
    }
</style>
@endpush

@endsection