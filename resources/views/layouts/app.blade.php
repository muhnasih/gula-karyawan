<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Sistem Pengambilan Gula')
    </title>


    {{-- =========================================================
        BOOTSTRAP
    ========================================================== --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- =========================================================
        BOOTSTRAP ICONS
    ========================================================== --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    {{-- =========================================================
        FONT INTER
    ========================================================== --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    @stack('styles')


    {{-- =========================================================
        CUSTOM STYLE
    ========================================================== --}}
    <style>

        :root {

            /* =========================
               WARNA UTAMA PG
            ========================== */

            --pg-green: #198754;
            --pg-green-dark: #146c43;
            --pg-green-deep: #0f5132;
            --pg-green-soft: #eaf7f0;

            /* =========================
               WARNA BACKGROUND
            ========================== */

            --pg-light: #f4f7f6;
            --pg-white: #ffffff;

            /* =========================
               TEXT
            ========================== */

            --pg-text: #263238;
            --pg-muted: #7b8794;

            /* =========================
               BORDER
            ========================== */

            --pg-border: #e7ece9;

            /* =========================
               UKURAN
            ========================== */

            --pg-sidebar-width: 265px;
            --pg-navbar-height: 72px;
        }


        /* ======================================================
           GLOBAL
        ======================================================= */

        * {
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {

            min-height: 100vh;

            margin: 0;

            overflow-x: hidden;

            background:
                radial-gradient(
                    circle at top right,
                    rgba(25, 135, 84, 0.06),
                    transparent 30%
                ),
                var(--pg-light);

            color: var(--pg-text);

            font-family: 'Inter', sans-serif;

            font-size: 14px;
        }


        a {
            text-decoration: none;
        }


        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }


        /* ======================================================
           APP
        ======================================================= */

        .app-layout {
            min-height: 100vh;
        }


        /* ======================================================
           NAVBAR
        ======================================================= */

        .app-navbar {

            position: sticky;

            top: 0;

            z-index: 1030;

            min-height: var(--pg-navbar-height);

            background: rgba(255, 255, 255, 0.95);

            backdrop-filter: blur(12px);

            -webkit-backdrop-filter: blur(12px);

            border-bottom: 1px solid var(--pg-border);

            box-shadow:
                0 4px 20px rgba(20, 50, 35, 0.05);
        }


        /* ======================================================
           NAVBAR BRAND
        ======================================================= */

        .navbar-brand {

            display: flex;

            align-items: center;

            color: var(--pg-green) !important;

            font-size: 1rem;

            font-weight: 800;

            letter-spacing: -0.4px;
        }


        .navbar-brand-icon {

            width: 42px;

            height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            margin-right: 0.65rem;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    var(--pg-green),
                    var(--pg-green-dark)
                );

            color: white;

            box-shadow:
                0 6px 14px rgba(25, 135, 84, 0.22);
        }


        .navbar-brand-icon i {
            font-size: 1.15rem;
        }


        .navbar-brand small {

            display: block;

            margin-top: 2px;

            color: var(--pg-muted);

            font-size: 0.68rem;

            font-weight: 500;

            letter-spacing: 0;
        }


        /* ======================================================
           NAVBAR TOGGLER
        ======================================================= */

        .navbar-toggler {

            border: 0;

            box-shadow: none !important;

            color: var(--pg-green);

            padding: 0.35rem 0.5rem;
        }


        .navbar-toggler:hover {
            color: var(--pg-green-dark);
        }


        /* ======================================================
           SIDEBAR
        ======================================================= */

        .app-sidebar {

            position: fixed;

            top: var(--pg-navbar-height);

            bottom: 0;

            left: 0;

            z-index: 1020;

            width: var(--pg-sidebar-width);

            overflow-y: auto;

            background:
                linear-gradient(
                    180deg,
                    #198754 0%,
                    #146c43 55%,
                    #0f5132 100%
                );

            border-right:
                1px solid rgba(255, 255, 255, 0.08);

            box-shadow:
                8px 0 30px rgba(16, 71, 45, 0.08);
        }


        /* ======================================================
           SIDEBAR SCROLLBAR
        ======================================================= */

        .app-sidebar::-webkit-scrollbar {
            width: 5px;
        }


        .app-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }


        .app-sidebar::-webkit-scrollbar-thumb {

            background:
                rgba(255, 255, 255, 0.25);

            border-radius: 10px;
        }


        /* ======================================================
           SIDEBAR NAV
        ======================================================= */

        .app-sidebar .nav {

            padding:
                1rem 0.85rem;
        }


        /* ======================================================
           SIDEBAR LINK
        ======================================================= */

        .app-sidebar .nav-link {

            display: flex;

            align-items: center;

            min-height: 45px;

            margin-bottom: 0.3rem;

            padding:
                0.7rem 0.85rem;

            border-radius: 12px;

            color:
                rgba(255, 255, 255, 0.82);

            font-size: 0.88rem;

            font-weight: 500;

            transition:
                background-color 0.2s ease,
                transform 0.2s ease,
                color 0.2s ease;
        }


        /* ======================================================
           SIDEBAR ICON
        ======================================================= */

        .app-sidebar .nav-link i {

            width: 24px;

            margin-right: 0.65rem;

            font-size: 1.05rem;

            text-align: center;
        }


        /* ======================================================
           SIDEBAR HOVER
        ======================================================= */

        .app-sidebar .nav-link:hover {

            color: white;

            background:
                rgba(255, 255, 255, 0.12);

            transform:
                translateX(3px);
        }


        /* ======================================================
           SIDEBAR ACTIVE
        ======================================================= */

        .app-sidebar .nav-link.active {

            color: var(--pg-green-dark);

            background: white;

            font-weight: 700;

            box-shadow:
                0 5px 15px rgba(0, 0, 0, 0.10);
        }


        .app-sidebar .nav-link.active i {

            color: var(--pg-green);
        }


        /* ======================================================
           SIDEBAR SECTION TITLE
        ======================================================= */

        .app-sidebar .text-uppercase {

            margin-top: 1.2rem;

            margin-bottom: 0.55rem;

            padding-left: 0.85rem;

            color:
                rgba(255, 255, 255, 0.55) !important;

            font-size: 0.68rem;

            font-weight: 700;

            letter-spacing: 0.8px;
        }


        /* ======================================================
           MAIN CONTENT
        ======================================================= */

        .app-main {

            min-height:
                calc(100vh - var(--pg-navbar-height));

            margin-left:
                var(--pg-sidebar-width);

            padding: 2rem;
        }


        /* ======================================================
           PAGE CONTAINER
        ======================================================= */

        .page-container {

            width: 100%;

            max-width: 1600px;

            margin: 0 auto;
        }


        /* ======================================================
           PAGE HEADER
        ======================================================= */

        .page-header {
            margin-bottom: 1.5rem;
        }


        .page-header h1,
        .page-header h2,
        .page-header h3 {

            margin-bottom: 0.35rem;

            color: var(--pg-text);

            font-weight: 800;

            letter-spacing: -0.5px;
        }


        .page-header p {

            margin-bottom: 0;

            color: var(--pg-muted);
        }


        /* ======================================================
           CARD
        ======================================================= */

        .card {

            overflow: hidden;

            border:
                1px solid var(--pg-border);

            border-radius: 16px;

            background:
                var(--pg-white);

            box-shadow:
                0 5px 25px rgba(31, 45, 61, 0.045);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }


        .card-header {

            background:
                var(--pg-white);

            border-bottom:
                1px solid var(--pg-border);

            padding:
                1rem 1.25rem;

            font-weight: 700;
        }


        .card-body {
            padding: 1.25rem;
        }


        /* ======================================================
           CARD HOVER
        ======================================================= */

        .card-hover:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 12px 30px rgba(31, 45, 61, 0.08);
        }


        /* ======================================================
           BUTTON
        ======================================================= */

        .btn {

            border-radius: 10px;

            font-weight: 600;

            padding:
                0.6rem 1rem;
        }


        .btn-success {

            background:
                linear-gradient(
                    135deg,
                    var(--pg-green),
                    var(--pg-green-dark)
                );

            border-color:
                var(--pg-green);

            box-shadow:
                0 5px 12px rgba(25, 135, 84, 0.16);
        }


        .btn-success:hover {

            background:
                var(--pg-green-dark);

            border-color:
                var(--pg-green-dark);
        }


        /* ======================================================
           FORM
        ======================================================= */

        .form-control,
        .form-select {

            min-height: 43px;

            border:
                1px solid #dfe6e2;

            border-radius: 10px;
        }


        .form-control:focus,
        .form-select:focus {

            border-color:
                var(--pg-green);

            box-shadow:
                0 0 0 0.2rem
                rgba(25, 135, 84, 0.12);
        }


        /* ======================================================
           TABLE
        ======================================================= */

        .table {
            margin-bottom: 0;
        }


        .table thead th {

            background:
                #f7f9f8;

            color:
                #59656f;

            border-bottom:
                1px solid var(--pg-border);

            font-size:
                0.76rem;

            font-weight:
                700;

            text-transform:
                uppercase;

            letter-spacing:
                0.3px;

            white-space:
                nowrap;
        }


        .table tbody td {

            vertical-align:
                middle;

            border-color:
                #edf1ef;

            color:
                #39444d;
        }


        .table tbody tr {

            transition:
                background-color 0.15s ease;
        }


        .table tbody tr:hover {

            background-color:
                #f8fbf9;
        }


        /* ======================================================
           BADGE
        ======================================================= */

        .badge {

            border-radius:
                8px;

            padding:
                0.45rem 0.65rem;

            font-weight:
                600;
        }


        /* ======================================================
           ALERT
        ======================================================= */

        .alert {

            border:
                0;

            border-radius:
                13px;

            box-shadow:
                0 5px 15px
                rgba(31, 45, 61, 0.04);
        }


        /* ======================================================
           PAGINATION
        ======================================================= */

        .pagination .page-link {

            border:
                0;

            margin:
                0 2px;

            border-radius:
                8px;

            color:
                var(--pg-green);

            font-weight:
                600;
        }


        .pagination .page-item.active .page-link {

            background:
                var(--pg-green);

            color:
                white;
        }


        /* ======================================================
           FOOTER
        ======================================================= */

        .app-footer {

            margin-left:
                var(--pg-sidebar-width);

            padding:
                1.25rem
                2rem
                1.75rem;

            color:
                var(--pg-muted);

            font-size:
                0.8rem;
        }


        .app-footer strong {

            color:
                var(--pg-green);
        }


        /* ======================================================
           MOBILE
        ======================================================= */

        @media (max-width: 991.98px) {

            :root {

                --pg-navbar-height: 65px;
            }


            .app-sidebar {

                position: static;

                width: 100%;

                max-height: calc(100vh - var(--pg-navbar-height));

                overflow-y: auto;

                border-right: 0;

                border-bottom: 1px solid rgba(255, 255, 255, 0.12);

                box-shadow:
                    0 10px 25px rgba(16, 71, 45, 0.15);
            }


            .app-main {

                margin-left: 0;

                padding: 1.25rem;
            }


            .app-footer {

                margin-left: 0;

                padding:
                    1rem
                    1.25rem
                    1.5rem;
            }


            .app-sidebar .nav {

                padding:
                    0.75rem;
            }
        }


        /* ======================================================
           SMALL MOBILE
        ======================================================= */

        @media (max-width: 575.98px) {

            body {
                font-size: 13px;
            }


            .app-main {
                padding: 1rem;
            }


            .card-body {
                padding: 1rem;
            }


            .page-header h1 {
                font-size: 1.4rem;
            }


            .app-footer {

                text-align:
                    center;
            }


            .app-footer .d-flex {

                justify-content:
                    center !important;
            }
        }

    </style>

</head>


<body>

<div class="app-layout">


    {{-- =========================================================
        NAVBAR
    ========================================================== --}}

    <nav class="navbar app-navbar">

        <div class="container-fluid px-3 px-lg-4">

            {{-- Brand --}}

            <a
                href="{{ url('/') }}"
                class="navbar-brand"
            >

                <span class="navbar-brand-icon">

                    <i class="bi bi-buildings-fill"></i>

                </span>


                <span>

                    Sistem Pengambilan Gula

                    <small>
                        PG Gending
                    </small>

                </span>

            </a>


            {{-- Mobile Button --}}

            <button
                class="navbar-toggler d-lg-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mobileSidebar"
                aria-controls="mobileSidebar"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >

                <i class="bi bi-list fs-3"></i>

            </button>

        </div>

    </nav>



    {{-- =========================================================
        SIDEBAR + CONTENT
    ========================================================== --}}

    <div class="d-flex flex-column flex-lg-row">


        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside class="app-sidebar">

            <div
                class="collapse d-lg-block"
                id="mobileSidebar"
            >

                @include('layouts.sidebar')

            </div>

        </aside>



        {{-- =====================================================
            MAIN CONTENT
        ====================================================== --}}

        <main class="app-main flex-grow-1">

            <div class="page-container">


                {{-- =================================================
                    SUCCESS MESSAGE
                ================================================== --}}

                @if (session('success'))

                    <div
                        class="alert alert-success alert-dismissible fade show mb-4"
                        role="alert"
                    >

                        <div class="d-flex align-items-center">

                            <div class="me-3 fs-4">

                                <i class="bi bi-check-circle-fill"></i>

                            </div>


                            <div>

                                <strong>
                                    Berhasil
                                </strong>

                                <div>
                                    {{ session('success') }}
                                </div>

                            </div>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>

                    </div>

                @endif



                {{-- =================================================
                    ERROR MESSAGE
                ================================================== --}}

                @if (session('error'))

                    <div
                        class="alert alert-danger alert-dismissible fade show mb-4"
                        role="alert"
                    >

                        <div class="d-flex align-items-center">

                            <div class="me-3 fs-4">

                                <i class="bi bi-x-circle-fill"></i>

                            </div>


                            <div>

                                <strong>
                                    Terjadi Kesalahan
                                </strong>

                                <div>
                                    {{ session('error') }}
                                </div>

                            </div>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>

                    </div>

                @endif



                {{-- =================================================
                    WARNING MESSAGE
                ================================================== --}}

                @if (session('warning'))

                    <div
                        class="alert alert-warning alert-dismissible fade show mb-4"
                        role="alert"
                    >

                        <div class="d-flex align-items-center">

                            <div class="me-3 fs-4">

                                <i class="bi bi-exclamation-triangle-fill"></i>

                            </div>


                            <div>

                                <strong>
                                    Perhatian
                                </strong>

                                <div>
                                    {{ session('warning') }}
                                </div>

                            </div>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>

                    </div>

                @endif



                {{-- =================================================
                    PAGE CONTENT
                ================================================== --}}

                @yield('content')


            </div>

        </main>

    </div>



    {{-- =========================================================
        FOOTER
    ========================================================== --}}

    <footer class="app-footer">

        <div
            class="d-flex
                   flex-wrap
                   justify-content-between
                   align-items-center
                   gap-2"
        >

            <span>

                &copy; {{ date('Y') }}

                <strong>
                    PG Gending
                </strong>

                · Sistem Pengambilan Gula

            </span>


            <span>

                Sistem Informasi Internal

            </span>

        </div>

    </footer>


</div>



{{-- =========================================================
    BOOTSTRAP JAVASCRIPT
========================================================== --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


@stack('scripts')

</body>

</html>