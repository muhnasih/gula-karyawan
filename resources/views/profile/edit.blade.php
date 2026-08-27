@extends('layouts.app')

@section('content')
<div class="profile-page">
    <div class="container-fluid px-3 px-md-4 px-xl-5 py-4 py-lg-5">

        {{-- =========================
            HEADER
        ========================== --}}
        <div class="profile-header mb-4 mb-lg-5">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">

                <div class="d-flex align-items-center gap-3">
                    <div class="page-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>

                    <div>
                        <h1 class="page-title mb-1">Pengaturan Profil</h1>
                        <p class="page-subtitle mb-0">
                            Kelola informasi akun dan keamanan Anda
                        </p>
                    </div>
                </div>

                {{-- User Badge --}}
                <div class="user-badge">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->nama_lengkap ?? $user->username ?? 'U', 0, 1)) }}
                    </div>

                    <div class="user-info">
                        <span class="user-name">
                            {{ $user->nama_lengkap ?? $user->username ?? 'User' }}
                        </span>

                        <span class="user-role">
                            <i class="fas fa-shield-alt me-1"></i>
                            {{ ucfirst($user->role ?? 'User') }}
                        </span>
                    </div>
                </div>

            </div>
        </div>


        {{-- =========================
            ALERT SUCCESS
        ========================== --}}
        @if (session('status') === 'profile-updated')
            <div class="custom-alert alert-success-custom mb-4" role="alert">
                <div class="alert-icon">
                    <i class="fas fa-check"></i>
                </div>

                <div class="alert-content">
                    <strong>Profil berhasil diperbarui</strong>
                    <span>Perubahan informasi profil Anda telah disimpan.</span>
                </div>

                <button type="button"
                        class="alert-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif


        @if (session('status') === 'password-updated')
            <div class="custom-alert alert-success-custom mb-4" role="alert">
                <div class="alert-icon">
                    <i class="fas fa-check"></i>
                </div>

                <div class="alert-content">
                    <strong>Kata sandi berhasil diubah</strong>
                    <span>Keamanan akun Anda telah diperbarui.</span>
                </div>

                <button type="button"
                        class="alert-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif


        {{-- =========================
            VALIDATION ERROR
        ========================== --}}
        @if ($errors->any())
            <div class="custom-alert alert-danger-custom mb-4" role="alert">

                <div class="alert-icon">
                    <i class="fas fa-exclamation"></i>
                </div>

                <div class="alert-content">
                    <strong>Periksa kembali data Anda</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                <button type="button"
                        class="alert-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>

            </div>
        @endif


        {{-- =========================
            MAIN CONTENT
        ========================== --}}
        <div class="row g-4 align-items-stretch">

            {{-- =====================================================
                INFORMASI PROFIL
            ====================================================== --}}
            <div class="col-12 col-xl-6">

                <div class="profile-card h-100">

                    {{-- Card Header --}}
                    <div class="card-header-custom">

                        <div class="section-icon profile-icon">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="section-title-wrapper">
                            <h2>Informasi Profil</h2>
                            <p>Perbarui informasi dasar akun Anda</p>
                        </div>

                    </div>


                    {{-- Card Body --}}
                    <div class="card-content">

                        <form method="POST"
                              action="{{ route('profile.update') }}"
                              id="profileForm">

                            @csrf
                            @method('PATCH')


                            {{-- Nama Lengkap --}}
                            <div class="form-field">

                                <label for="nama_lengkap">
                                    Nama Lengkap
                                </label>

                                <div class="input-wrapper">

                                    <span class="input-icon">
                                        <i class="fas fa-user"></i>
                                    </span>

                                    <input
                                        id="nama_lengkap"
                                        name="nama_lengkap"
                                        type="text"
                                        class="modern-input @error('nama_lengkap') input-error @enderror"
                                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                                        placeholder="Masukkan nama lengkap"
                                        autocomplete="name"
                                        required
                                    >

                                </div>

                                @error('nama_lengkap')
                                    <div class="field-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Username --}}
                            <div class="form-field">

                                <label for="username">
                                    Username
                                </label>

                                <div class="input-wrapper">

                                    <span class="input-icon">
                                        <i class="fas fa-at"></i>
                                    </span>

                                    <input
                                        id="username"
                                        name="username"
                                        type="text"
                                        class="modern-input @error('username') input-error @enderror"
                                        value="{{ old('username', $user->username) }}"
                                        placeholder="Masukkan username"
                                        autocomplete="username"
                                        required
                                    >

                                </div>

                                @error('username')
                                    <div class="field-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Email --}}
                            @if(isset($user->email))

                                <div class="form-field">

                                    <label for="email">
                                        Email
                                    </label>

                                    <div class="input-wrapper">

                                        <span class="input-icon">
                                            <i class="fas fa-envelope"></i>
                                        </span>

                                        <input
                                            id="email"
                                            name="email"
                                            type="email"
                                            class="modern-input @error('email') input-error @enderror"
                                            value="{{ old('email', $user->email) }}"
                                            placeholder="nama@email.com"
                                            autocomplete="email"
                                        >

                                    </div>

                                    @error('email')
                                        <div class="field-error">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            @endif


                            {{-- Role --}}
                            <div class="form-field">

                                <label for="role">
                                    Role Akun
                                </label>

                                <div class="input-wrapper">

                                    <span class="input-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </span>

                                    <input
                                        id="role"
                                        type="text"
                                        class="modern-input role-input"
                                        value="{{ ucfirst($user->role ?? 'User') }}"
                                        readonly
                                    >

                                    <span class="role-badge">
                                        {{ strtoupper($user->role ?? 'USER') }}
                                    </span>

                                </div>

                                <div class="field-hint">
                                    <i class="fas fa-info-circle"></i>
                                    Role akun hanya dapat diubah oleh administrator.
                                </div>

                            </div>


                            {{-- Button --}}
                            <div class="form-action">

                                <button
                                    type="submit"
                                    class="btn-modern btn-primary-modern"
                                    id="profileSubmit">

                                    <span class="button-content">
                                        <i class="fas fa-save"></i>
                                        <span>Simpan Perubahan</span>
                                    </span>

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                UBAH PASSWORD
            ====================================================== --}}
            <div class="col-12 col-xl-6">

                <div class="profile-card security-card h-100">

                    {{-- Card Header --}}
                    <div class="card-header-custom">

                        <div class="section-icon security-icon">
                            <i class="fas fa-lock"></i>
                        </div>

                        <div class="section-title-wrapper">
                            <h2>Keamanan Akun</h2>
                            <p>Kelola kata sandi untuk menjaga akun tetap aman</p>
                        </div>

                    </div>


                    {{-- Card Body --}}
                    <div class="card-content">

                        <form method="POST"
                              action="{{ route('profile.password.update') }}"
                              id="passwordForm">

                            @csrf
                            @method('PUT')


                            {{-- Password Lama --}}
                            <div class="form-field">

                                <label for="current_password">
                                    Kata Sandi Lama
                                </label>

                                <div class="password-wrapper">

                                    <span class="input-icon">
                                        <i class="fas fa-key"></i>
                                    </span>

                                    <input
                                        id="current_password"
                                        name="current_password"
                                        type="password"
                                        class="modern-input password-input @error('current_password', 'updatePassword') input-error @enderror"
                                        placeholder="Masukkan kata sandi lama"
                                        autocomplete="current-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="current_password"
                                        aria-label="Tampilkan kata sandi">

                                        <i class="fas fa-eye"></i>

                                    </button>

                                </div>

                                @error('current_password', 'updatePassword')
                                    <div class="field-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Password Baru --}}
                            <div class="form-field">

                                <label for="password">
                                    Kata Sandi Baru
                                </label>

                                <div class="password-wrapper">

                                    <span class="input-icon">
                                        <i class="fas fa-lock"></i>
                                    </span>

                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="modern-input password-input @error('password', 'updatePassword') input-error @enderror"
                                        placeholder="Minimal 8 karakter"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="password"
                                        aria-label="Tampilkan kata sandi">

                                        <i class="fas fa-eye"></i>

                                    </button>

                                </div>

                                @error('password', 'updatePassword')
                                    <div class="field-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror


                                {{-- Password Strength --}}
                                <div class="password-strength">

                                    <div class="strength-header">
                                        <span>Kekuatan kata sandi</span>
                                        <span id="strengthText">Belum diisi</span>
                                    </div>

                                    <div class="strength-bar">
                                        <div
                                            class="strength-progress"
                                            id="strengthProgress">
                                        </div>
                                    </div>

                                </div>

                            </div>


                            {{-- Konfirmasi Password --}}
                            <div class="form-field">

                                <label for="password_confirmation">
                                    Konfirmasi Kata Sandi
                                </label>

                                <div class="password-wrapper">

                                    <span class="input-icon">
                                        <i class="fas fa-check-double"></i>
                                    </span>

                                    <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        class="modern-input password-input"
                                        placeholder="Ulangi kata sandi baru"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="password_confirmation"
                                        aria-label="Tampilkan kata sandi">

                                        <i class="fas fa-eye"></i>

                                    </button>

                                </div>

                                <div
                                    class="password-match"
                                    id="passwordMatch">
                                </div>

                            </div>


                            {{-- Security Info --}}
                            <div class="security-info">

                                <div class="security-info-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>

                                <div>
                                    <strong>Tips keamanan</strong>

                                    <ul>
                                        <li id="checkLength">
                                            <i class="fas fa-circle"></i>
                                            Minimal 8 karakter
                                        </li>

                                        <li id="checkUpper">
                                            <i class="fas fa-circle"></i>
                                            Mengandung huruf besar
                                        </li>

                                        <li id="checkNumber">
                                            <i class="fas fa-circle"></i>
                                            Mengandung angka
                                        </li>
                                    </ul>

                                </div>

                            </div>


                            {{-- Button --}}
                            <div class="form-action">

                                <button
                                    type="submit"
                                    class="btn-modern btn-security-modern"
                                    id="passwordSubmit">

                                    <span class="button-content">
                                        <i class="fas fa-lock"></i>
                                        <span>Ubah Kata Sandi</span>
                                    </span>

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
            FOOTER INFO
        ========================== --}}
        <div class="profile-footer mt-4">

            <div class="footer-left">
                <i class="fas fa-shield-alt"></i>
                <span>Pastikan informasi akun Anda selalu diperbarui.</span>
            </div>

            <div class="footer-right">
                <i class="fas fa-lock"></i>
                <span>Data Anda terlindungi</span>
            </div>

        </div>

    </div>
</div>


{{-- =========================================================
    STYLE
========================================================= --}}
<style>

    /* =====================================================
       BASE
    ====================================================== */

    .profile-page {
        min-height: 100vh;
        background:
            linear-gradient(
                180deg,
                #f8fafc 0%,
                #f1f5f9 100%
            );
        color: #1e293b;
    }


    /* =====================================================
       HEADER
    ====================================================== */

    .profile-header {
        position: relative;
    }

    .page-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(
            135deg,
            #2563eb,
            #4f46e5
        );
        color: #fff;
        font-size: 1.25rem;
        box-shadow:
            0 10px 25px rgba(37, 99, 235, 0.20);
    }

    .page-title {
        font-size: 1.6rem;
        font-weight: 750;
        color: #0f172a;
        letter-spacing: -0.025em;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 0.9rem;
    }


    /* =====================================================
       USER BADGE
    ====================================================== */

    .user-badge {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 8px 13px 8px 8px;
        background: rgba(255,255,255,0.9);
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(
            135deg,
            #2563eb,
            #4f46e5
        );
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .user-name {
        font-size: 0.85rem;
        font-weight: 700;
        color: #0f172a;
    }

    .user-role {
        margin-top: 3px;
        font-size: 0.7rem;
        color: #64748b;
    }


    /* =====================================================
       ALERT
    ====================================================== */

    .custom-alert {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 15px 17px;
        border-radius: 14px;
        border: 1px solid transparent;
        box-shadow: 0 5px 20px rgba(15, 23, 42, 0.04);
    }

    .alert-success-custom {
        background: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }

    .alert-danger-custom {
        background: #fef2f2;
        border-color: #fecaca;
        color: #991b1b;
    }

    .alert-icon {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }

    .alert-success-custom .alert-icon {
        background: #dcfce7;
        color: #16a34a;
    }

    .alert-danger-custom .alert-icon {
        background: #fee2e2;
        color: #dc2626;
    }

    .alert-content {
        display: flex;
        flex-direction: column;
        gap: 3px;
        flex: 1;
        font-size: 0.82rem;
    }

    .alert-content strong {
        font-weight: 700;
    }

    .alert-content span {
        opacity: 0.8;
    }

    .alert-content ul {
        margin: 6px 0 0;
        padding-left: 18px;
    }

    .alert-content li {
        margin-bottom: 2px;
    }

    .alert-close {
        border: 0;
        background: transparent;
        color: inherit;
        opacity: 0.55;
        cursor: pointer;
        padding: 4px;
        transition: 0.2s;
    }

    .alert-close:hover {
        opacity: 1;
    }


    /* =====================================================
       CARD
    ====================================================== */

    .profile-card {
        position: relative;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        box-shadow:
            0 8px 30px rgba(15, 23, 42, 0.055);
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow:
            0 15px 40px rgba(15, 23, 42, 0.08);
    }

    .profile-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
    }

    .profile-card:not(.security-card)::before {
        background: linear-gradient(
            90deg,
            #2563eb,
            #6366f1
        );
    }

    .security-card::before {
        background: linear-gradient(
            90deg,
            #f59e0b,
            #f97316
        );
    }


    /* =====================================================
       CARD HEADER
    ====================================================== */

    .card-header-custom {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 27px 28px 20px;
    }

    .section-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .profile-icon {
        background: #eff6ff;
        color: #2563eb;
    }

    .security-icon {
        background: #fff7ed;
        color: #f97316;
    }

    .section-title-wrapper h2 {
        margin: 0;
        font-size: 1rem;
        font-weight: 750;
        color: #0f172a;
    }

    .section-title-wrapper p {
        margin: 4px 0 0;
        font-size: 0.78rem;
        color: #64748b;
    }


    /* =====================================================
       CARD CONTENT
    ====================================================== */

    .card-content {
        padding: 4px 28px 28px;
    }


    /* =====================================================
       FORM
    ====================================================== */

    .form-field {
        margin-bottom: 20px;
    }

    .form-field > label {
        display: block;
        margin-bottom: 7px;
        font-size: 0.78rem;
        font-weight: 650;
        color: #475569;
    }

    .input-wrapper,
    .password-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .modern-input {
        width: 100%;
        height: 48px;
        padding: 0 14px 0 43px;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        background: #f8fafc;
        color: #1e293b;
        font-size: 0.88rem;
        outline: none;
        transition:
            border-color 0.2s ease,
            background 0.2s ease,
            box-shadow 0.2s ease;
    }

    .modern-input::placeholder {
        color: #94a3b8;
    }

    .modern-input:hover {
        background: #fff;
        border-color: #cbd5e1;
    }

    .modern-input:focus {
        background: #fff;
        border-color: #3b82f6;
        box-shadow:
            0 0 0 3px rgba(59, 130, 246, 0.10);
    }

    .input-icon {
        position: absolute;
        left: 15px;
        z-index: 2;
        color: #94a3b8;
        font-size: 0.82rem;
        pointer-events: none;
    }

    .modern-input:focus + .input-icon {
        color: #2563eb;
    }

    .input-error {
        border-color: #ef4444 !important;
    }

    .input-error:focus {
        box-shadow:
            0 0 0 3px rgba(239, 68, 68, 0.10);
    }

    .field-error {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 6px;
        color: #dc2626;
        font-size: 0.72rem;
    }

    .field-hint {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 7px;
        color: #94a3b8;
        font-size: 0.7rem;
    }


    /* =====================================================
       ROLE
    ====================================================== */

    .role-input {
        padding-right: 85px;
        cursor: not-allowed;
        background: #f1f5f9;
    }

    .role-badge {
        position: absolute;
        right: 10px;
        padding: 5px 8px;
        border-radius: 7px;
        background: #dbeafe;
        color: #1d4ed8;
        font-size: 0.6rem;
        font-weight: 800;
        letter-spacing: 0.04em;
    }


    /* =====================================================
       PASSWORD
    ====================================================== */

    .password-input {
        padding-right: 48px;
    }

    .password-toggle {
        position: absolute;
        right: 7px;
        width: 36px;
        height: 36px;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: #94a3b8;
        cursor: pointer;
        transition: 0.2s;
    }

    .password-toggle:hover {
        background: #f1f5f9;
        color: #475569;
    }


    /* =====================================================
       PASSWORD STRENGTH
    ====================================================== */

    .password-strength {
        margin-top: 10px;
    }

    .strength-header {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 6px;
        font-size: 0.68rem;
        color: #94a3b8;
    }

    #strengthText {
        font-weight: 700;
    }

    .strength-bar {
        width: 100%;
        height: 4px;
        overflow: hidden;
        border-radius: 20px;
        background: #e2e8f0;
    }

    .strength-progress {
        width: 0;
        height: 100%;
        border-radius: 20px;
        background: #cbd5e1;
        transition:
            width 0.3s ease,
            background 0.3s ease;
    }


    /* =====================================================
       PASSWORD MATCH
    ====================================================== */

    .password-match {
        min-height: 18px;
        margin-top: 6px;
        font-size: 0.7rem;
    }

    .password-match.success {
        color: #16a34a;
    }

    .password-match.error {
        color: #dc2626;
    }


    /* =====================================================
       SECURITY INFO
    ====================================================== */

    .security-info {
        display: flex;
        gap: 12px;
        padding: 14px;
        margin-top: 3px;
        margin-bottom: 22px;
        border: 1px solid #fed7aa;
        border-radius: 12px;
        background: #fff7ed;
    }

    .security-info-icon {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffedd5;
        color: #ea580c;
        font-size: 0.75rem;
    }

    .security-info strong {
        display: block;
        margin-bottom: 5px;
        font-size: 0.75rem;
        color: #9a3412;
    }

    .security-info ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .security-info li {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 4px;
        color: #9a3412;
        font-size: 0.68rem;
    }

    .security-info li i {
        font-size: 0.35rem;
        color: #fb923c;
    }

    .security-info li.valid i {
        color: #16a34a;
    }

    .security-info li.valid {
        color: #166534;
    }


    /* =====================================================
       BUTTON
    ====================================================== */

    .form-action {
        margin-top: 5px;
    }

    .btn-modern {
        width: 100%;
        height: 48px;
        border: 0;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.84rem;
        font-weight: 700;
        cursor: pointer;
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            opacity 0.2s ease;
    }

    .btn-modern:hover {
        transform: translateY(-1px);
    }

    .btn-modern:active {
        transform: translateY(0);
    }

    .button-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-primary-modern {
        background: linear-gradient(
            135deg,
            #2563eb,
            #4f46e5
        );
        color: #fff;
        box-shadow:
            0 8px 20px rgba(37, 99, 235, 0.18);
    }

    .btn-primary-modern:hover {
        box-shadow:
            0 12px 25px rgba(37, 99, 235, 0.25);
    }

    .btn-security-modern {
        background: linear-gradient(
            135deg,
            #f59e0b,
            #f97316
        );
        color: #fff;
        box-shadow:
            0 8px 20px rgba(249, 115, 22, 0.18);
    }

    .btn-security-modern:hover {
        box-shadow:
            0 12px 25px rgba(249, 115, 22, 0.25);
    }


    /* =====================================================
       FOOTER
    ====================================================== */

    .profile-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 14px 17px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: rgba(255,255,255,0.7);
        color: #94a3b8;
        font-size: 0.68rem;
    }

    .footer-left,
    .footer-right {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .footer-left i {
        color: #2563eb;
    }

    .footer-right i {
        color: #16a34a;
    }


    /* =====================================================
       RESPONSIVE TABLET
    ====================================================== */

    @media (max-width: 1199.98px) {

        .card-header-custom {
            padding: 24px 24px 18px;
        }

        .card-content {
            padding: 4px 24px 24px;
        }

    }


    /* =====================================================
       RESPONSIVE MOBILE
    ====================================================== */

    @media (max-width: 767.98px) {

        .profile-page {
            background: #f8fafc;
        }

        .container-fluid {
            padding-top: 22px !important;
        }

        .page-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;
            border-radius: 13px;
            font-size: 1rem;
        }

        .page-title {
            font-size: 1.3rem;
        }

        .page-subtitle {
            font-size: 0.78rem;
        }

        .user-badge {
            width: 100%;
        }

        .user-info {
            flex: 1;
        }

        .profile-card {
            border-radius: 17px;
        }

        .card-header-custom {
            padding: 21px 19px 16px;
        }

        .card-content {
            padding: 3px 19px 20px;
        }

        .section-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 11px;
        }

        .section-title-wrapper h2 {
            font-size: 0.92rem;
        }

        .section-title-wrapper p {
            font-size: 0.7rem;
            line-height: 1.4;
        }

        .modern-input {
            height: 47px;
            font-size: 0.84rem;
        }

        .form-field {
            margin-bottom: 18px;
        }

        .profile-footer {
            flex-direction: column;
            align-items: flex-start;
        }

    }


    /* =====================================================
       SMALL MOBILE
    ====================================================== */

    @media (max-width: 420px) {

        .page-title {
            font-size: 1.18rem;
        }

        .page-subtitle {
            font-size: 0.72rem;
        }

        .user-avatar {
            width: 37px;
            height: 37px;
        }

        .user-name {
            font-size: 0.78rem;
        }

        .card-header-custom {
            gap: 11px;
        }

        .section-icon {
            width: 39px;
            height: 39px;
            min-width: 39px;
        }

        .security-info {
            padding: 12px;
        }

    }


    /* =====================================================
       REDUCE MOTION
    ====================================================== */

    @media (prefers-reduced-motion: reduce) {

        .profile-card,
        .btn-modern,
        .modern-input,
        .password-toggle {
            transition: none !important;
        }

    }

</style>


{{-- =========================================================
    JAVASCRIPT
========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       TOGGLE PASSWORD
    ====================================================== */

    document.querySelectorAll('.password-toggle').forEach(function (button) {

        button.addEventListener('click', function () {

            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (!input || !icon) {
                return;
            }

            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');

                this.setAttribute(
                    'aria-label',
                    'Sembunyikan kata sandi'
                );

            } else {

                input.type = 'password';

                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');

                this.setAttribute(
                    'aria-label',
                    'Tampilkan kata sandi'
                );
            }

        });

    });


    /* =====================================================
       PASSWORD STRENGTH
    ====================================================== */

    const passwordInput = document.getElementById('password');
    const strengthProgress = document.getElementById('strengthProgress');
    const strengthText = document.getElementById('strengthText');

    const checkLength = document.getElementById('checkLength');
    const checkUpper = document.getElementById('checkUpper');
    const checkNumber = document.getElementById('checkNumber');


    function updatePasswordStrength() {

        if (!passwordInput) {
            return;
        }

        const password = passwordInput.value;

        let score = 0;

        const hasLength = password.length >= 8;
        const hasUpper = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[^A-Za-z0-9]/.test(password);

        if (hasLength) score++;
        if (hasUpper) score++;
        if (hasNumber) score++;
        if (hasSpecial) score++;


        /* Checklist */

        if (checkLength) {
            checkLength.classList.toggle('valid', hasLength);
            checkLength.querySelector('i').className =
                hasLength
                    ? 'fas fa-check-circle'
                    : 'fas fa-circle';
        }

        if (checkUpper) {
            checkUpper.classList.toggle('valid', hasUpper);
            checkUpper.querySelector('i').className =
                hasUpper
                    ? 'fas fa-check-circle'
                    : 'fas fa-circle';
        }

        if (checkNumber) {
            checkNumber.classList.toggle('valid', hasNumber);
            checkNumber.querySelector('i').className =
                hasNumber
                    ? 'fas fa-check-circle'
                    : 'fas fa-circle';
        }


        /* Strength */

        if (password.length === 0) {

            strengthProgress.style.width = '0%';
            strengthText.textContent = 'Belum diisi';

        } else if (score <= 1) {

            strengthProgress.style.width = '25%';
            strengthProgress.style.background = '#ef4444';
            strengthText.textContent = 'Lemah';
            strengthText.style.color = '#ef4444';

        } else if (score === 2) {

            strengthProgress.style.width = '50%';
            strengthProgress.style.background = '#f59e0b';
            strengthText.textContent = 'Cukup';
            strengthText.style.color = '#f59e0b';

        } else if (score === 3) {

            strengthProgress.style.width = '75%';
            strengthProgress.style.background = '#22c55e';
            strengthText.textContent = 'Baik';
            strengthText.style.color = '#16a34a';

        } else {

            strengthProgress.style.width = '100%';
            strengthProgress.style.background = '#16a34a';
            strengthText.textContent = 'Sangat kuat';
            strengthText.style.color = '#15803d';

        }

    }


    if (passwordInput) {

        passwordInput.addEventListener(
            'input',
            updatePasswordStrength
        );

    }


    /* =====================================================
       PASSWORD CONFIRMATION
    ====================================================== */

    const confirmationInput =
        document.getElementById('password_confirmation');

    const passwordMatch =
        document.getElementById('passwordMatch');


    function checkPasswordMatch() {

        if (!confirmationInput || !passwordMatch || !passwordInput) {
            return;
        }

        const password = passwordInput.value;
        const confirmation = confirmationInput.value;


        if (confirmation.length === 0) {

            passwordMatch.textContent = '';
            passwordMatch.className = 'password-match';

            return;
        }


        if (password === confirmation) {

            passwordMatch.innerHTML =
                '<i class="fas fa-check-circle me-1"></i> Kata sandi cocok';

            passwordMatch.className =
                'password-match success';

        } else {

            passwordMatch.innerHTML =
                '<i class="fas fa-times-circle me-1"></i> Kata sandi tidak cocok';

            passwordMatch.className =
                'password-match error';

        }

    }


    if (passwordInput) {

        passwordInput.addEventListener(
            'input',
            checkPasswordMatch
        );

    }


    if (confirmationInput) {

        confirmationInput.addEventListener(
            'input',
            checkPasswordMatch
        );

    }


    /* =====================================================
       SUBMIT BUTTON LOADING
    ====================================================== */

    const profileForm =
        document.getElementById('profileForm');

    const profileSubmit =
        document.getElementById('profileSubmit');


    if (profileForm && profileSubmit) {

        profileForm.addEventListener('submit', function () {

            profileSubmit.disabled = true;

            profileSubmit.innerHTML = `
                <span class="button-content">
                    <i class="fas fa-spinner fa-spin"></i>
                    <span>Menyimpan...</span>
                </span>
            `;

        });

    }


    const passwordForm =
        document.getElementById('passwordForm');

    const passwordSubmit =
        document.getElementById('passwordSubmit');


    if (passwordForm && passwordSubmit) {

        passwordForm.addEventListener('submit', function (event) {

            const password =
                document.getElementById('password')?.value || '';

            const confirmation =
                document.getElementById('password_confirmation')?.value || '';


            if (password !== confirmation) {

                event.preventDefault();

                if (passwordMatch) {

                    passwordMatch.innerHTML =
                        '<i class="fas fa-times-circle me-1"></i> Konfirmasi kata sandi tidak cocok';

                    passwordMatch.className =
                        'password-match error';

                }

                if (confirmationInput) {
                    confirmationInput.focus();
                }

                return;
            }


            passwordSubmit.disabled = true;

            passwordSubmit.innerHTML = `
                <span class="button-content">
                    <i class="fas fa-spinner fa-spin"></i>
                    <span>Mengubah...</span>
                </span>
            `;

        });

    }

});
</script>

@endsection