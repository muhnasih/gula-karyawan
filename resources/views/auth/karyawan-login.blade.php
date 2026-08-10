@extends('layouts.app')

@section('title', 'Login Karyawan')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card border-0 shadow">

                <div class="card-body p-4">

                    {{-- HEADER --}}

                    <div class="text-center mb-4">

                        <div
                            class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-success text-white"
                            style="width: 75px; height: 75px;"
                        >

                            <i class="bi bi-person-badge fs-1"></i>

                        </div>


                        <h3 class="fw-bold">
                            Login Karyawan
                        </h3>


                        <p class="text-muted mb-0">
                            Sistem Pengambilan Gula Karyawan
                        </p>

                    </div>


                    {{-- ERROR SESSION --}}

                    @if(session('error'))

                        <div class="alert alert-danger">

                            <i class="bi bi-exclamation-circle me-1"></i>

                            {{ session('error') }}

                        </div>

                    @endif


                    {{-- ERROR VALIDASI --}}

                    @if($errors->any())

                        <div class="alert alert-danger">

                            @foreach($errors->all() as $error)

                                <div>
                                    {{ $error }}
                                </div>

                            @endforeach

                        </div>

                    @endif


                    {{-- FORM LOGIN --}}

                    <form
                        action="{{ route('karyawan.login.store') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- NIK --}}

                        <div class="mb-4">

                            <label
                                for="nik"
                                class="form-label fw-semibold"
                            >

                                NIK Karyawan

                            </label>


                            <input
                                type="text"
                                id="nik"
                                name="nik"
                                class="form-control form-control-lg @error('nik') is-invalid @enderror"
                                value="{{ old('nik') }}"
                                placeholder="Masukkan NIK"
                                autocomplete="off"
                                autofocus
                                required
                            >


                            <small class="text-muted">

                                Masukkan NIK sesuai data karyawan.

                            </small>

                        </div>


                        {{-- TOMBOL MASUK --}}

                        <button
                            type="submit"
                            class="btn btn-success btn-lg w-100"
                        >

                            <i class="bi bi-box-arrow-in-right me-1"></i>

                            Masuk

                        </button>

                    </form>


                    {{-- INFORMASI --}}

                    <div class="text-center mt-4">

                        <small class="text-muted d-block mb-2">
                            Login karyawan menggunakan NIK
                            tanpa password.
                        </small>

                        <small class="text-muted">
                            Login sebagai admin / operator?
                            <a href="{{ route('login') }}" class="text-success fw-semibold text-decoration-none">
                                Klik di sini
                            </a>
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection