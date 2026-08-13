<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Sistem Pengambilan Gula')
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    {{-- Font Inter --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @stack('styles')

    {{-- Custom Style --}}
    <style>
        :root {
            /* Warna utama PG */
            --pg-green: #198754;
            --pg-green-dark: #146c43;
            --pg-green-deep: #0f5132;
            --pg-green-soft: #eaf7f0;

            /* Background */
            --pg-light: #f4f7f6;
            --pg-white: #ffffff;

            /* Text */
            --pg-text: #263238;
            --pg-muted: #7b8794;

            /* Border */
            --pg-border: #e7ece9;

            /* Ukuran */
            --pg-sidebar-width: 265px;
            --pg-navbar-height: 72px;
        }

        /* Global */
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

        /* App */
        .app-layout {
            min-height: 100vh;
        }

        /* Navbar */
        .app-navbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            min-height: var(--pg-navbar-height);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--pg-border);
            box-shadow: 0 4px 20px rgba(20, 50, 35, 0.05);
        }

        /* Navbar brand */
        .navbar-brand {
            display: flex;
            align-items: center;
            min-width: 0;
            color: var(--pg-green) !important;
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: -0.4px;
        }

        .navbar-brand-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
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
            box-shadow: 0 6px 14px rgba(25, 135, 84, 0.22);
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

        /* Navbar toggler */
        .navbar-toggler {
            border: 0;
            box-shadow: none !important;
            color: var(--pg-green);
            padding: 0.35rem 0.5rem;
            border-radius: 10px;
        }

        .navbar-toggler:hover {
            color: var(--pg-green-dark);
            background: var(--pg-green-soft);
        }

        /* Sidebar */
        .app-sidebar {
            position: fixed;
            top: var(--pg-navbar-height);
            bottom: 0;
            left: 0;
            z-index: 1025;
            width: var(--pg-sidebar-width);
            overflow-y: auto;
            background:
                linear-gradient(
                    180deg,
                    #198754 0%,
                    #146c43 55%,
                    #0f5132 100%
                );
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 8px 0 30px rgba(16, 71, 45, 0.08);
        }

        .app-sidebar > .collapse {
            min-height: 100%;
        }

        /* Sidebar scrollbar */
        .app-sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .app-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .app-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 10px;
        }

        /* Sidebar nav */
        .app-sidebar .nav {
            padding: 1rem 0.85rem;
        }

        /* Sidebar link */
        .app-sidebar .nav-link {
            display: flex;
            align-items: center;
            min-height: 45px;
            margin-bottom: 0.3rem;
            padding: 0.7rem 0.85rem;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.82);
            font-size: 0.88rem;
            font-weight: 500;
            transition:
                background-color 0.2s ease,
                transform 0.2s ease,
                color 0.2s ease;
        }

        .app-sidebar .nav-link i {
            width: 24px;
            min-width: 24px;
            margin-right: 0.65rem;
            font-size: 1.05rem;
            text-align: center;
        }

        .app-sidebar .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.12);
            transform: translateX(3px);
        }

        .app-sidebar .nav-link.active {
            color: var(--pg-green-dark);
            background: white;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.10);
        }

        .app-sidebar .nav-link.active i {
            color: var(--pg-green);
        }

        /* Sidebar section title */
        .app-sidebar .text-uppercase {
            margin-top: 1.2rem;
            margin-bottom: 0.55rem;
            padding-left: 0.85rem;
            color: rgba(255, 255, 255, 0.55) !important;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.8px;
        }

        /* ==========================================================
           SIDEBAR - elemen yang dulunya inline style (PERBAIKAN BARU)
        ========================================================== */
        .sidebar-logo-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.12);
            margin: 0 1rem;
        }

        .sidebar-divider--footer {
            height: 1px;
            background: rgba(255, 255, 255, 0.12);
            margin-bottom: 1rem;
        }

        .sidebar-user-card {
            display: flex;
            align-items: center;
            padding: 0.7rem;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            margin-bottom: 0.75rem;
        }

        .sidebar-avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            color: white;
        }

        .sidebar-user-name {
            color: white;
            font-weight: 600;
            font-size: 0.82rem;
        }

        .sidebar-user-role {
            color: rgba(255, 255, 255, 0.60);
            font-size: 0.68rem;
            text-transform: capitalize;
        }

        .sidebar-logout-btn {
            background: transparent;
            color: rgba(255, 255, 255, 0.78);
            border: 0;
        }

        /* Main content */
        .app-main {
            min-height: calc(100vh - var(--pg-navbar-height));
            margin-left: var(--pg-sidebar-width);
            padding: 2rem;
        }

        .page-container {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Page header */
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

        /* Card */
        .card {
            overflow: hidden;
            border: 1px solid var(--pg-border);
            border-radius: 16px;
            background: var(--pg-white);
            box-shadow: 0 5px 25px rgba(31, 45, 61, 0.045);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .card-header {
            background: var(--pg-white);
            border-bottom: 1px solid var(--pg-border);
            padding: 1rem 1.25rem;
            font-weight: 700;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(31, 45, 61, 0.08);
        }

        /* Button */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.6rem 1rem;
        }

        .btn-success {
            background:
                linear-gradient(
                    135deg,
                    var(--pg-green),
                    var(--pg-green-dark)
                );
            border-color: var(--pg-green);
            box-shadow: 0 5px 12px rgba(25, 135, 84, 0.16);
        }

        .btn-success:hover {
            background: var(--pg-green-dark);
            border-color: var(--pg-green-dark);
        }

        /* Form */
        .form-control,
        .form-select {
            min-height: 43px;
            border: 1px solid #dfe6e2;
            border-radius: 10px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--pg-green);
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.12);
        }

        /* Table */
        .table {
            margin-bottom: 0;
            table-layout: fixed;   /* lebar kolom konsisten, tidak ikut isi data */
        }

        .table thead th {
            background: var(--pg-green-soft);  /* kontras lebih jelas dari body tabel */
            color: var(--pg-green-dark);
            border-bottom: 2px solid var(--pg-green);
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            white-space: nowrap;
            padding: 0.85rem 1rem;
        }

        .table tbody td {
            vertical-align: middle;
            border-color: #edf1ef;
            color: #39444d;
            padding: 0.75rem 1rem;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table tbody tr {
            transition: background-color 0.15s ease;
        }

        .table tbody tr:hover {
            background-color: #f8fbf9;
        }

        /* Penting untuk tabel di HP: bungkus scroll horizontal */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 12px;
        }

        /* Badge status - hijau untuk aktif, merah untuk nonaktif */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 0.35rem 0.7rem;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-badge.status-aktif {
            background: #e3f7ea;
            color: #198754;
        }

        .status-badge.status-nonaktif {
            background: #fdeaea;
            color: #dc3545;
        }

        .status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        /* Badge */
        .badge {
            border-radius: 8px;
            padding: 0.45rem 0.65rem;
            font-weight: 600;
        }

        /* Alert */
        .alert {
            border: 0;
            border-radius: 13px;
            box-shadow: 0 5px 15px rgba(31, 45, 61, 0.04);
        }

        /* Pagination */
        .pagination {
            flex-wrap: wrap;
        }

        .pagination .page-link {
            border: 0;
            margin: 0 2px;
            border-radius: 8px;
            color: var(--pg-green);
            font-weight: 600;
        }

        .pagination .page-item.active .page-link {
            background: var(--pg-green);
            color: white;
        }

        /* Footer */
        .app-footer {
            margin-left: var(--pg-sidebar-width);
            padding: 1.25rem 2rem 1.75rem;
            color: var(--pg-muted);
            font-size: 0.8rem;
        }

        .app-footer strong {
            color: var(--pg-green);
        }

        /* ==========================================================
           SIDEBAR MOBILE - POLA GESER/PUSH (PERBAIKAN BARU)
           Sidebar slide-in dari kiri, konten (navbar+main+footer)
           ikut geser ke kanan mengikuti lebar sidebar - bukan ditutupi.
        ========================================================== */
        body.sidebar-open {
            overflow: hidden; /* cegah body ikut ter-scroll saat menu terbuka */
        }

        /* Mobile / Tablet */
        @media (max-width: 991.98px) {
            :root {
                --pg-navbar-height: 65px;
                --pg-sidebar-width-mobile: min(85vw, 300px);
            }

            /* Sidebar berubah menjadi drawer, tersembunyi di luar layar (kiri) */
            .app-sidebar {
                top: var(--pg-navbar-height);
                width: var(--pg-sidebar-width-mobile);
                max-height: none;
                overflow-y: auto;
                border-right: 1px solid rgba(255, 255, 255, 0.12);
                border-bottom: 0;
                box-shadow: 8px 0 30px rgba(16, 71, 45, 0.20);
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            /* Netralkan animasi bawaan Bootstrap collapse - visibilitas
               sepenuhnya dikendalikan oleh transform di atas */
            .app-sidebar .collapse:not(.show),
            .app-sidebar .collapsing {
                display: block !important;
                height: auto !important;
            }

            /* Saat menu terbuka: sidebar masuk, konten ikut geser ke kanan */
            body.sidebar-open .app-sidebar {
                transform: translateX(0);
            }

            .app-navbar,
            .app-main,
            .app-footer {
                transition: transform 0.3s ease;
            }

            body.sidebar-open .app-navbar,
            body.sidebar-open .app-main,
            body.sidebar-open .app-footer {
                transform: translateX(var(--pg-sidebar-width-mobile));
            }

            /* Content memenuhi layar saat menu tertutup */
            .app-main {
                margin-left: 0;
                padding: 1.25rem;
            }

            /* Footer */
            .app-footer {
                margin-left: 0;
                padding: 1rem 1.25rem 1.5rem;
            }

            .app-sidebar .nav {
                padding: 0.75rem;
            }

            /* Sidebar link lebih nyaman disentuh */
            .app-sidebar .nav-link {
                min-height: 48px;
                padding: 0.75rem 0.85rem;
            }
        }

        /* Small mobile */
        @media (max-width: 575.98px) {
            body {
                font-size: 13px;
            }

            .app-navbar .container-fluid {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }

            .navbar-brand {
                font-size: 0.85rem;
                max-width: calc(100vw - 70px);
            }

            .navbar-brand-icon {
                width: 38px;
                height: 38px;
                min-width: 38px;
                margin-right: 0.5rem;
            }

            .navbar-brand-icon i {
                font-size: 1rem;
            }

            .navbar-brand small {
                font-size: 0.6rem;
            }

            .app-main {
                padding: 0.75rem;
            }

            .page-header {
                margin-bottom: 1rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .page-header h2 {
                font-size: 1.2rem;
            }

            .page-header h3 {
                font-size: 1.1rem;
            }

            .card {
                border-radius: 13px;
            }

            .card-header {
                padding: 0.85rem 1rem;
            }

            .card-body {
                padding: 0.85rem;
            }

            .btn {
                padding: 0.55rem 0.8rem;
            }

            .app-footer {
                text-align: center;
            }

            .app-footer .d-flex {
                justify-content: center !important;
            }
        }

        /* Extra small mobile */
        @media (max-width: 375px) {
            .navbar-brand {
                font-size: 0.78rem;
            }

            .navbar-brand-icon {
                width: 35px;
                height: 35px;
                min-width: 35px;
            }

            .app-main {
                padding: 0.6rem;
            }

            .card-body {
                padding: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <div class="app-layout">
        {{-- Navbar --}}
        <nav class="navbar app-navbar">
            <div class="container-fluid px-3 px-lg-4">
                {{-- Brand --}}
                <a href="{{ url('/') }}" class="navbar-brand">
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

        {{-- Sidebar + Content --}}
        <div class="d-flex">
            {{-- Sidebar --}}
            <aside class="app-sidebar">
                <div
                    class="collapse d-lg-block h-100"
                    id="mobileSidebar"
                >
                    @include('layouts.sidebar')
                </div>
            </aside>

            {{-- Main Content --}}
            <main class="app-main flex-grow-1">
                <div class="page-container">
                    {{-- Success Message --}}
                    @if (session('success'))
                        <div
                            class="alert alert-success alert-dismissible fade show mb-4"
                            role="alert"
                        >
                            <div class="d-flex align-items-center">
                                <div class="me-3 fs-4">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>

                                <div class="overflow-hidden">
                                    <strong>Berhasil</strong>

                                    <div class="text-break">
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

                    {{-- Error Message --}}
                    @if (session('error'))
                        <div
                            class="alert alert-danger alert-dismissible fade show mb-4"
                            role="alert"
                        >
                            <div class="d-flex align-items-center">
                                <div class="me-3 fs-4">
                                    <i class="bi bi-x-circle-fill"></i>
                                </div>

                                <div class="overflow-hidden">
                                    <strong>Terjadi Kesalahan</strong>

                                    <div class="text-break">
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

                    {{-- Warning Message --}}
                    @if (session('warning'))
                        <div
                            class="alert alert-warning alert-dismissible fade show mb-4"
                            role="alert"
                        >
                            <div class="d-flex align-items-center">
                                <div class="me-3 fs-4">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>

                                <div class="overflow-hidden">
                                    <strong>Perhatian</strong>

                                    <div class="text-break">
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

                    {{-- Page Content --}}
                    @yield('content')
                </div>
            </main>
        </div>

        {{-- Footer --}}
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

    {{-- Bootstrap JavaScript --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    {{-- Script Sidebar Mobile - Pola Geser/Push (PERBAIKAN BARU) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarCollapseEl = document.getElementById('mobileSidebar');
            const sidebarToggleBtn = document.querySelector('[data-bs-target="#mobileSidebar"]');
            const sidebarEl = document.querySelector('.app-sidebar');

            if (!sidebarCollapseEl) {
                return;
            }

            // Saat sidebar mulai terbuka -> tandai body, konten ikut geser (lihat CSS)
            sidebarCollapseEl.addEventListener('show.bs.collapse', function () {
                document.body.classList.add('sidebar-open');
            });

            // Saat sidebar mulai tertutup -> konten kembali ke posisi semula
            sidebarCollapseEl.addEventListener('hide.bs.collapse', function () {
                document.body.classList.remove('sidebar-open');
            });

            // Tap di luar sidebar (area konten yang tergeser) -> tutup sidebar
            document.addEventListener('click', function (e) {
                const isOpen = document.body.classList.contains('sidebar-open');
                if (!isOpen || window.innerWidth >= 992) {
                    return;
                }

                const clickedInsideSidebar = sidebarEl && sidebarEl.contains(e.target);
                const clickedToggleBtn = sidebarToggleBtn && sidebarToggleBtn.contains(e.target);

                if (!clickedInsideSidebar && !clickedToggleBtn) {
                    const instance = bootstrap.Collapse.getInstance(sidebarCollapseEl);
                    if (instance) instance.hide();
                }
            });

            // Tap salah satu menu di HP -> otomatis tutup sidebar
            sidebarCollapseEl.querySelectorAll('.nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 992) {
                        const instance = bootstrap.Collapse.getInstance(sidebarCollapseEl);
                        if (instance) instance.hide();
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>