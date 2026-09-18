@extends('layouts.app')

@section('content')

<div class="container-fluid px-3 px-md-4 px-lg-5 py-4">

    {{-- HEADER --}}
    <div class="operator-header mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="page-icon">
                    <i class="bi bi-person-gear"></i>
                </div>
                <span class="page-label">MANAJEMEN PENGGUNA</span>
            </div>

            <h1 class="page-title mb-1">Daftar Operator</h1>

            <p class="page-description mb-0">
                Kelola akun operator yang memiliki akses ke sistem pengambilan gula.
            </p>
        </div>

        <a href="{{ route('admin.operator.create') }}"
           class="btn btn-add-operator">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Operator</span>
        </a>
    </div>


    {{-- SUCCESS ALERT --}}
    @if (session('success'))
        <div class="success-alert mb-4">
            <div class="success-icon">
                <i class="bi bi-check-lg"></i>
            </div>

            <div>
                <div class="success-title">Berhasil</div>
                <div class="success-message">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif


    {{-- SUMMARY --}}
    @php
        $totalOperator = $users->count();
        $operatorAktif = $users->where('status', 'aktif')->count();
        $operatorNonaktif = $users->where('status', '!=', 'aktif')->count();
    @endphp

    <div class="row g-3 mb-4">

        {{-- TOTAL --}}
        <div class="col-12 col-md-4">
            <div class="summary-card">
                <div class="summary-icon summary-icon-blue">
                    <i class="bi bi-people"></i>
                </div>

                <div>
                    <div class="summary-label">Total Operator</div>
                    <div class="summary-value">{{ $totalOperator }}</div>
                </div>
            </div>
        </div>

        {{-- AKTIF --}}
        <div class="col-12 col-md-4">
            <div class="summary-card">
                <div class="summary-icon summary-icon-green">
                    <i class="bi bi-person-check"></i>
                </div>

                <div>
                    <div class="summary-label">Operator Aktif</div>
                    <div class="summary-value">{{ $operatorAktif }}</div>
                </div>

                <div class="summary-status">
                    Aktif
                </div>
            </div>
        </div>

        {{-- NONAKTIF --}}
        <div class="col-12 col-md-4">
            <div class="summary-card">
                <div class="summary-icon summary-icon-gray">
                    <i class="bi bi-person-x"></i>
                </div>

                <div>
                    <div class="summary-label">Nonaktif</div>
                    <div class="summary-value">{{ $operatorNonaktif }}</div>
                </div>

                <div class="summary-status summary-status-gray">
                    Nonaktif
                </div>
            </div>
        </div>

    </div>


    {{-- OPERATOR TABLE --}}
    <div class="operator-wrapper">

        {{-- TABLE HEADER --}}
        <div class="operator-wrapper-header">

            <div>
                <h5 class="operator-title mb-1">
                    Data Operator
                </h5>

                <p class="operator-subtitle mb-0">
                    Daftar akun operator yang terdaftar dalam sistem
                </p>
            </div>

            <div class="operator-count">
                {{ $totalOperator }} Operator
            </div>

        </div>


        {{-- DESKTOP --}}
        <div class="table-responsive d-none d-md-block">

            <table class="table operator-table align-middle mb-0">

                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Operator</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($users as $user)

                        <tr>

                            {{-- NUMBER --}}
                            <td class="ps-4">
                                <span class="row-number">
                                    {{ $loop->iteration }}
                                </span>
                            </td>


                            {{-- OPERATOR --}}
                            <td>

                                <div class="operator-info">

                                    <div class="operator-avatar">
                                        {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="operator-name">
                                            {{ $user->nama_lengkap }}
                                        </div>

                                        <div class="operator-role">
                                            Operator Sistem
                                        </div>
                                    </div>

                                </div>

                            </td>


                            {{-- USERNAME --}}
                            <td>
                                <span class="username">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $user->username }}
                                </span>
                            </td>


                            {{-- EMAIL --}}
                            <td>
                                <div class="email-text">
                                    <i class="bi bi-envelope me-2"></i>
                                    {{ $user->email }}
                                </div>
                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if ($user->status === 'aktif')

                                    <span class="status status-active">
                                        <span class="status-indicator"></span>
                                        Aktif
                                    </span>

                                @else

                                    <span class="status status-inactive">
                                        <span class="status-indicator"></span>
                                        Nonaktif
                                    </span>

                                @endif

                            </td>


                            {{-- ACTION --}}
                            <td class="text-end pe-4">

                                <div class="action-buttons">

                                    <a href="{{ route('admin.operator.edit', $user->id) }}"
                                       class="action-btn action-edit"
                                       title="Edit operator">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <form action="{{ route('admin.operator.destroy', $user->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus operator ini?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="action-btn action-delete"
                                                title="Hapus operator">

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


        {{-- MOBILE --}}
        <div class="d-block d-md-none mobile-operator-list">

            @forelse ($users as $user)

                <div class="mobile-operator-card">

                    <div class="mobile-top">

                        <div class="operator-info">

                            <div class="operator-avatar">
                                {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                            </div>

                            <div>

                                <div class="operator-name">
                                    {{ $user->nama_lengkap }}
                                </div>

                                <div class="operator-role">
                                    @ {{ $user->username }}
                                </div>

                            </div>

                        </div>


                        @if ($user->status === 'aktif')

                            <span class="status status-active">
                                <span class="status-indicator"></span>
                                Aktif
                            </span>

                        @else

                            <span class="status status-inactive">
                                <span class="status-indicator"></span>
                                Nonaktif
                            </span>

                        @endif

                    </div>


                    <div class="mobile-email">

                        <i class="bi bi-envelope"></i>

                        <span>
                            {{ $user->email }}
                        </span>

                    </div>


                    <div class="mobile-actions">

                        <a href="{{ route('admin.operator.edit', $user->id) }}"
                           class="mobile-action mobile-edit">

                            <i class="bi bi-pencil-square"></i>
                            Edit

                        </a>


                        <form action="{{ route('admin.operator.destroy', $user->id) }}"
                              method="POST"
                              class="flex-fill"
                              onsubmit="return confirm('Yakin ingin menghapus operator ini?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="mobile-action mobile-delete w-100">

                                <i class="bi bi-trash3"></i>
                                Hapus

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

    /* =========================================================
       GLOBAL
    ========================================================= */

    .operator-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
    }


    .page-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #e8f5ee;
        color: #198754;

        font-size: 17px;
    }


    .page-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .08em;
        color: #198754;
    }


    .page-title {
        font-size: 28px;
        font-weight: 750;
        color: #17221b;
        letter-spacing: -.5px;
    }


    .page-description {
        color: #7a8580;
        font-size: 14px;
    }


    /* =========================================================
       ADD BUTTON
    ========================================================= */

    .btn-add-operator {
        display: inline-flex;
        align-items: center;
        gap: 9px;

        padding: 11px 18px;

        border: none;
        border-radius: 10px;

        background: #198754;
        color: #fff;

        font-size: 14px;
        font-weight: 600;

        box-shadow: 0 5px 14px rgba(25, 135, 84, .18);

        transition: .2s ease;
    }


    .btn-add-operator:hover {
        background: #157347;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(25, 135, 84, .24);
    }


    /* =========================================================
       SUCCESS
    ========================================================= */

    .success-alert {
        display: flex;
        align-items: center;
        gap: 12px;

        padding: 13px 16px;

        background: #edf9f2;
        border: 1px solid #d5f0df;
        border-radius: 12px;
    }


    .success-icon {
        width: 32px;
        height: 32px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #198754;
        color: #fff;
    }


    .success-title {
        font-size: 13px;
        font-weight: 700;
        color: #146c43;
    }


    .success-message {
        font-size: 13px;
        color: #47715a;
    }


    /* =========================================================
       SUMMARY
    ========================================================= */

    .summary-card {
        position: relative;

        display: flex;
        align-items: center;
        gap: 14px;

        min-height: 90px;

        padding: 17px 18px;

        background: #fff;

        border: 1px solid #edf0ee;
        border-radius: 14px;

        box-shadow: 0 3px 12px rgba(30, 45, 37, .045);

        transition: .2s ease;
    }


    .summary-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(30, 45, 37, .07);
    }


    .summary-icon {
        width: 48px;
        height: 48px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        font-size: 21px;
    }


    .summary-icon-blue {
        background: #edf4ff;
        color: #3b82f6;
    }


    .summary-icon-green {
        background: #eaf8f0;
        color: #198754;
    }


    .summary-icon-gray {
        background: #f2f3f4;
        color: #6c757d;
    }


    .summary-label {
        font-size: 12px;
        color: #7b8580;
        margin-bottom: 2px;
    }


    .summary-value {
        font-size: 25px;
        line-height: 1;
        font-weight: 750;
        color: #18221c;
    }


    .summary-status {
        margin-left: auto;

        padding: 5px 9px;

        background: #eaf8f0;
        color: #198754;

        border-radius: 7px;

        font-size: 11px;
        font-weight: 600;
    }


    .summary-status-gray {
        background: #f1f2f3;
        color: #6c757d;
    }


    /* =========================================================
       MAIN CARD
    ========================================================= */

    .operator-wrapper {
        background: #fff;

        border: 1px solid #e9eceb;
        border-radius: 16px;

        overflow: hidden;

        box-shadow: 0 4px 15px rgba(30, 45, 37, .045);
    }


    .operator-wrapper-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 20px 22px;

        border-bottom: 1px solid #edf0ee;
    }


    .operator-title {
        font-size: 16px;
        font-weight: 700;
        color: #1b241e;
    }


    .operator-subtitle {
        font-size: 12px;
        color: #89928d;
    }


    .operator-count {
        padding: 6px 10px;

        background: #f2f8f4;
        color: #198754;

        border-radius: 8px;

        font-size: 12px;
        font-weight: 600;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .operator-table thead {
        background: #f8faf9;
    }


    .operator-table thead th {
        padding: 12px 14px;

        border-bottom: 1px solid #e9eeeb;

        color: #79837e;

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: .07em;

        white-space: nowrap;
    }


    .operator-table tbody tr {
        border-bottom: 1px solid #f0f2f1;

        transition: background .15s ease;
    }


    .operator-table tbody tr:last-child {
        border-bottom: none;
    }


    .operator-table tbody tr:hover {
        background: #fbfcfb;
    }


    .operator-table td {
        padding: 15px 14px;

        color: #4c5751;

        font-size: 13px;
    }


    .row-number {
        color: #9ba49f;
        font-size: 12px;
        font-weight: 600;
    }


    /* =========================================================
       OPERATOR INFO
    ========================================================= */

    .operator-info {
        display: flex;
        align-items: center;
        gap: 11px;
    }


    .operator-avatar {
        width: 40px;
        height: 40px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 11px;

        background: #e9f6ef;
        color: #198754;

        font-size: 15px;
        font-weight: 750;

        border: 1px solid #d8eee1;
    }


    .operator-name {
        color: #202923;
        font-size: 13px;
        font-weight: 700;
    }


    .operator-role {
        margin-top: 2px;

        color: #929b96;

        font-size: 11px;
    }


    /* =========================================================
       USERNAME
    ========================================================= */

    .username {
        display: inline-flex;
        align-items: center;

        padding: 5px 8px;

        background: #f5f7f6;

        border-radius: 7px;

        color: #59635e;

        font-size: 12px;
        font-family: monospace;
    }


    /* =========================================================
       EMAIL
    ========================================================= */

    .email-text {
        display: flex;
        align-items: center;

        color: #68736d;

        font-size: 12px;
    }


    .email-text i {
        color: #9ba49f;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .status {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 5px 9px;

        border-radius: 7px;

        font-size: 11px;
        font-weight: 650;
    }


    .status-indicator {
        width: 6px;
        height: 6px;

        border-radius: 50%;
    }


    .status-active {
        background: #eaf8f0;
        color: #198754;
    }


    .status-active .status-indicator {
        background: #22a06b;
    }


    .status-inactive {
        background: #f2f3f4;
        color: #747c78;
    }


    .status-inactive .status-indicator {
        background: #9da4a0;
    }


    /* =========================================================
       ACTION
    ========================================================= */

    .action-buttons {
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }


    .action-btn {
        width: 34px;
        height: 34px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #fff;

        font-size: 14px;

        transition: .18s ease;
    }


    .action-edit {
        color: #d98b00;
        border: 1px solid #f3dfb4;
    }


    .action-edit:hover {
        background: #fff6e5;
        color: #b87500;
    }


    .action-delete {
        color: #dc3545;
        border: 1px solid #f2c6cb;
    }


    .action-delete:hover {
        background: #fff0f1;
        color: #bb2d3b;
    }


    /* =========================================================
       MOBILE
    ========================================================= */

    .mobile-operator-list {
        padding: 12px;
        background: #f8faf9;
    }


    .mobile-operator-card {
        padding: 15px;

        background: #fff;

        border: 1px solid #e9eeeb;
        border-radius: 13px;

        margin-bottom: 11px;

        box-shadow: 0 2px 7px rgba(30, 45, 37, .035);
    }


    .mobile-operator-card:last-child {
        margin-bottom: 0;
    }


    .mobile-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 10px;
    }


    .mobile-email {
        display: flex;
        align-items: center;
        gap: 8px;

        margin-top: 14px;
        padding-top: 12px;

        border-top: 1px solid #f0f2f1;

        color: #707a75;

        font-size: 12px;

        overflow-wrap: anywhere;
    }


    .mobile-email i {
        color: #9ba49f;
    }


    .mobile-actions {
        display: flex;
        gap: 8px;

        margin-top: 13px;
    }


    .mobile-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;

        min-height: 37px;

        padding: 7px 12px;

        border-radius: 8px;

        font-size: 12px;
        font-weight: 600;

        text-decoration: none;

        transition: .18s ease;
    }


    .mobile-edit {
        flex: 1;

        background: #fff8ea;
        border: 1px solid #f0d9a9;

        color: #b87800;
    }


    .mobile-edit:hover {
        background: #fff0ce;
        color: #9c6700;
    }


    .mobile-delete {
        background: #fff0f1;
        border: 1px solid #f1c8cd;

        color: #dc3545;
    }


    .mobile-delete:hover {
        background: #ffe2e5;
        color: #bb2d3b;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767.98px) {

        .operator-header {
            align-items: stretch;
            flex-direction: column;
        }


        .page-title {
            font-size: 22px;
        }


        .page-description {
            font-size: 12px;
            line-height: 1.6;
        }


        .btn-add-operator {
            width: 100%;
            justify-content: center;
        }


        .summary-card {
            min-height: 78px;
        }


        .summary-icon {
            width: 42px;
            height: 42px;
            font-size: 18px;
        }


        .summary-value {
            font-size: 21px;
        }


        .summary-status {
            font-size: 10px;
        }


        .operator-wrapper-header {
            padding: 16px;
        }


        .operator-title {
            font-size: 14px;
        }


        .operator-subtitle {
            font-size: 11px;
        }


        .operator-count {
            font-size: 10px;
        }

    }


    @media (max-width: 400px) {

        .container-fluid {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }


        .summary-card {
            padding: 14px;
        }


        .summary-status {
            display: none;
        }


        .mobile-operator-card {
            padding: 13px;
        }


        .operator-avatar {
            width: 38px;
            height: 38px;
        }


        .operator-name {
            font-size: 12px;
        }

    }

</style>

@endpush

@endsection