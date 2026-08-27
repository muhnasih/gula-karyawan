@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card border-0 shadow">

                {{-- HEADER --}}
                <div class="card-header bg-success text-white py-3">

                    <h5 class="mb-0">
                        <i class="bi bi-shield-lock me-2"></i>
                        Pengaturan Password
                    </h5>

                </div>


                <div class="card-body p-4">

                    {{-- SUCCESS --}}
                    @if(session('success'))

                        <div class="alert alert-success">

                            <i class="bi bi-check-circle me-2"></i>

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- ERROR --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <i class="bi bi-exclamation-circle me-2"></i>

                            <strong>Password gagal diubah.</strong>

                            <ul class="mb-0 mt-2">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- INFORMASI --}}
                    <div class="alert alert-info">

                        <i class="bi bi-info-circle me-2"></i>

                        Gunakan password yang mudah Anda ingat,
                        tetapi sulit ditebak oleh orang lain.

                    </div>


                    {{-- FORM --}}
                    <form
                        action="{{ route('karyawan.password.update') }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        {{-- PASSWORD SAAT INI --}}
                        <div class="mb-3">

                            <label
                                for="current_password"
                                class="form-label fw-semibold"
                            >
                                Password Saat Ini
                            </label>

                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                class="form-control form-control-lg @error('current_password') is-invalid @enderror"
                                placeholder="Masukkan password saat ini"
                                required
                            >

                            @error('current_password')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- PASSWORD BARU --}}
                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label fw-semibold"
                            >
                                Password Baru
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                placeholder="Masukkan password baru"
                                required
                            >

                            @error('password')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <small class="text-muted">
                                Minimal 8 karakter.
                            </small>

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-4">

                            <label
                                for="password_confirmation"
                                class="form-label fw-semibold"
                            >
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control form-control-lg"
                                placeholder="Masukkan kembali password baru"
                                required
                            >

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('karyawan.dashboard') }}"
                                class="btn btn-secondary btn-lg"
                            >

                                <i class="bi bi-arrow-left me-1"></i>

                                Kembali

                            </a>


                            <button
                                type="submit"
                                class="btn btn-success btn-lg flex-grow-1"
                            >

                                <i class="bi bi-check-lg me-1"></i>

                                Simpan Password

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection