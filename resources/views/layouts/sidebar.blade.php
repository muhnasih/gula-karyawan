{{-- =========================================================
    SIDEBAR PG GENDING
========================================================= --}}

@php
    // =========================================================
    // DETEKSI GUARD YANG SEDANG LOGIN
    // =========================================================

    $isKaryawan = auth('karyawan')->check();

    if ($isKaryawan) {

        $sidebarUserName = auth('karyawan')->user()->nama ?? 'Karyawan';
        $sidebarUserRole = 'Karyawan';
        $sidebarLogoutRoute = route('karyawan.logout');

    } else {

        $sidebarUserName = auth()->user()->nama_lengkap
            ?? auth()->user()->username
            ?? '';

        $sidebarUserRole = auth()->user()->role ?? '';
        $sidebarLogoutRoute = route('logout');

    }
@endphp


<div class="d-flex flex-column h-100">


    {{-- =====================================================
        HEADER SIDEBAR
    ====================================================== --}}

    <div class="px-3 pt-4 pb-3">

        <div class="d-flex align-items-center">


            {{-- Logo --}}

            <div class="sidebar-logo-icon">

                <i class="bi bi-buildings-fill fs-4"></i>

            </div>


            {{-- Judul --}}

            <div class="ms-3 overflow-hidden">

                <div
                    class="text-white fw-bold text-truncate"
                    style="font-size: 0.95rem;"
                >
                    PG GENDING
                </div>


                <div
                    class="text-truncate"
                    style="
                        color: rgba(255,255,255,0.65);
                        font-size: 0.68rem;
                    "
                >
                    Sistem Pengambilan Gula
                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
        GARIS PEMBATAS
    ====================================================== --}}

    <div class="sidebar-divider"></div>



    {{-- =====================================================
        MENU
    ====================================================== --}}

    <nav class="flex-grow-1" aria-label="Menu utama">


        {{-- =================================================
            ADMIN / OPERATOR
        ================================================== --}}

        @auth('web')


            {{-- =================================================
                ADMIN
            ================================================== --}}

            @if(auth()->user()->role === 'admin')

                <div class="nav flex-column">


                    {{-- Section --}}

                    <div
                        class="text-uppercase small opacity-75 mb-2 text-white"
                        style="
                            padding-left: 0.85rem;
                            margin-top: 1rem;
                            font-size: 0.68rem;
                            letter-spacing: 0.8px;
                        "
                    >
                        Menu Admin
                    </div>



                    {{-- =========================================
                        DATA KARYAWAN
                    ========================================== --}}

                    @php

                        $isKaryawanMenuActive =
                            request()->routeIs('admin.karyawan')
                            || request()->routeIs('admin.karyawan.show')
                            || request()->routeIs('admin.karyawan.create')
                            || request()->routeIs('admin.karyawan.edit');

                    @endphp


                    <a
                        href="{{ route('admin.karyawan') }}"
                        class="nav-link mb-1 {{ $isKaryawanMenuActive ? 'active' : '' }}"
                        @if($isKaryawanMenuActive)
                            aria-current="page"
                        @endif
                    >

                        <i class="bi bi-people-fill"></i>

                        <span>
                            Data Karyawan
                        </span>

                    </a>



                    {{-- =========================================
                        LAPORAN
                    ========================================== --}}

                    @php

                        $isLaporanActive =
                            request()->routeIs('admin.laporan.*');

                    @endphp


                    <a
                        href="{{ route('admin.laporan.index') }}"
                        class="nav-link mb-1 {{ $isLaporanActive ? 'active' : '' }}"
                        @if($isLaporanActive)
                            aria-current="page"
                        @endif
                    >

                        <i class="bi bi-file-earmark-bar-graph"></i>

                        <span>
                            Laporan
                        </span>

                    </a>



                    {{-- =========================================
                        KELOLA OPERATOR
                    ========================================== --}}

                    @php

                        $isOperatorMenuActive =
                            request()->routeIs('admin.operator.*');

                    @endphp


                    <a
                        href="{{ route('admin.operator.index') }}"
                        class="nav-link mb-1 {{ $isOperatorMenuActive ? 'active' : '' }}"
                        @if($isOperatorMenuActive)
                            aria-current="page"
                        @endif
                    >

                        <i class="bi bi-person-gear"></i>

                        <span>
                            Kelola Operator
                        </span>

                    </a>


                </div>

            @endif



            {{-- =================================================
                OPERATOR
            ================================================== --}}

            @if(auth()->user()->role === 'operator')

                <div class="nav flex-column">


                    {{-- Section --}}

                    <div
                        class="text-uppercase small opacity-75 mb-2 text-white"
                        style="
                            padding-left: 0.85rem;
                            margin-top: 1rem;
                            font-size: 0.68rem;
                            letter-spacing: 0.8px;
                        "
                    >
                        Menu Operator
                    </div>



                    {{-- =========================================
                        DASHBOARD
                    ========================================== --}}

                    @php

                        $isOperatorDashboardActive =
                            request()->routeIs('operator.dashboard');

                    @endphp


                    <a
                        href="{{ route('operator.dashboard') }}"
                        class="nav-link mb-1 {{ $isOperatorDashboardActive ? 'active' : '' }}"
                        @if($isOperatorDashboardActive)
                            aria-current="page"
                        @endif
                    >

                        <i class="bi bi-speedometer2"></i>

                        <span>
                            Dashboard
                        </span>

                    </a>



                    {{-- =========================================
                        STATISTIK
                    ========================================== --}}

                    @php

                        $isOperatorStatistikActive =
                            request()->routeIs('operator.statistik');

                    @endphp


                    <a
                        href="{{ route('operator.statistik') }}"
                        class="nav-link mb-1 {{ $isOperatorStatistikActive ? 'active' : '' }}"
                        @if($isOperatorStatistikActive)
                            aria-current="page"
                        @endif
                    >

                        <i class="bi bi-bar-chart-line-fill"></i>

                        <span>
                            Statistik
                        </span>

                    </a>


                </div>

            @endif


        @endauth



        {{-- =================================================
            KARYAWAN
        ================================================== --}}

        @auth('karyawan')

            <div class="nav flex-column">


                {{-- Section --}}

                <div
                    class="text-uppercase small opacity-75 mb-2 text-white"
                    style="
                        padding-left: 0.85rem;
                        margin-top: 1rem;
                        font-size: 0.68rem;
                        letter-spacing: 0.8px;
                    "
                >
                    Menu Karyawan
                </div>



                {{-- =============================================
                    DASHBOARD KARYAWAN
                ============================================== --}}

                @php

                    $isKaryawanDashboardActive =
                        request()->routeIs('karyawan.dashboard');

                @endphp


                <a
                    href="{{ route('karyawan.dashboard') }}"
                    class="nav-link mb-1 {{ $isKaryawanDashboardActive ? 'active' : '' }}"
                    @if($isKaryawanDashboardActive)
                        aria-current="page"
                    @endif
                >

                    <i class="bi bi-house-door-fill"></i>

                    <span>
                        Dashboard
                    </span>

                </a>


            </div>

        @endauth


    </nav>



    {{-- =====================================================
        USER INFO + LOGOUT
    ====================================================== --}}

    @if($isKaryawan || auth('web')->check())

        <div class="px-3 pb-4">


            {{-- Garis --}}

            <div class="sidebar-divider--footer"></div>



            {{-- Kartu User --}}

            <div class="sidebar-user-card">


                {{-- Avatar --}}

                <div class="sidebar-avatar">

                    <i class="bi bi-person-fill"></i>

                </div>



                {{-- Nama + Role --}}

                <div class="ms-2 overflow-hidden">

                    <div class="sidebar-user-name text-truncate">

                        {{ $sidebarUserName }}

                    </div>


                    <div class="sidebar-user-role">

                        {{ $sidebarUserRole }}

                    </div>

                </div>


            </div>



            {{-- Logout --}}

            <form
                method="POST"
                action="{{ $sidebarLogoutRoute }}"
            >

                @csrf

                <button
                    type="submit"
                    class="nav-link sidebar-logout-btn w-100 text-start"
                    aria-label="Keluar dari akun {{ $sidebarUserName }}"
                >

                    <i class="bi bi-box-arrow-right"></i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>


        </div>

    @endif


</div>