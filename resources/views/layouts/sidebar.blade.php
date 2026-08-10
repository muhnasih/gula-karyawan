{{-- =========================================================
    SIDEBAR PG GENDING
========================================================= --}}

<div class="d-flex flex-column min-vh-100">


    {{-- =====================================================
        HEADER SIDEBAR
    ====================================================== --}}

    <div class="px-3 pt-4 pb-3">

        <div class="d-flex align-items-center">

            {{-- Logo --}}
            <div
                style="
                    width: 45px;
                    height: 45px;
                    min-width: 45px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 13px;
                    background: rgba(255,255,255,0.15);
                    color: white;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
                "
            >
                <i class="bi bi-buildings-fill fs-4"></i>
            </div>


            {{-- Judul --}}
            <div class="ms-3">

                <div
                    class="text-white fw-bold"
                    style="font-size: 0.95rem;"
                >
                    PG GENDING
                </div>

                <div
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

    <div
        style="
            height: 1px;
            background: rgba(255,255,255,0.12);
            margin: 0 1rem;
        "
    ></div>



    {{-- =====================================================
        MENU
    ====================================================== --}}

    <div class="flex-grow-1">


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

                    <a
                        href="{{ route('admin.karyawan') }}"
                        class="nav-link
                               mb-1
                               {{ request()->routeIs('admin.karyawan')
                                  || request()->routeIs('admin.karyawan.show')
                                  ? 'active'
                                  : '' }}"
                    >

                        <i class="bi bi-people-fill"></i>

                        <span>
                            Data Karyawan
                        </span>

                    </a>


                    {{-- =========================================
                        LAPORAN
                    ========================================== --}}

                    <a
                        href="{{ route('admin.laporan.index') }}"
                        class="nav-link
                               mb-1
                               {{ request()->routeIs('admin.laporan.*')
                                  ? 'active'
                                  : '' }}"
                    >

                        <i class="bi bi-file-earmark-bar-graph"></i>

                        <span>
                            Laporan
                        </span>

                    </a>


                    {{-- =========================================
                        KELOLA USER
                    ========================================== --}}

                    <a
                        href="{{ route('admin.user.index') }}"
                        class="nav-link
                               mb-1
                               {{ request()->routeIs('admin.user.*')
                                  ? 'active'
                                  : '' }}"
                    >

                        <i class="bi bi-person-gear"></i>

                        <span>
                            Kelola User
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

                    <a
                        href="{{ route('operator.dashboard') }}"
                        class="nav-link
                               mb-1
                               {{ request()->routeIs('operator.dashboard')
                                  ? 'active'
                                  : '' }}"
                    >

                        <i class="bi bi-speedometer2"></i>

                        <span>
                            Dashboard
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

                <a
                    href="{{ route('karyawan.dashboard') }}"
                    class="nav-link
                           mb-1
                           {{ request()->routeIs('karyawan.dashboard')
                              ? 'active'
                              : '' }}"
                >

                    <i class="bi bi-house-door-fill"></i>

                    <span>
                        Dashboard
                    </span>

                </a>


            </div>

        @endauth

    </div>



    {{-- =====================================================
        USER INFO + LOGOUT
    ====================================================== --}}

    <div class="px-3 pb-4">


        {{-- Garis --}}
        <div
            style="
                height: 1px;
                background: rgba(255,255,255,0.12);
                margin-bottom: 1rem;
            "
        ></div>


        {{-- =================================================
            ADMIN / OPERATOR USER
        ================================================== --}}

        @auth('web')

            <div
                class="d-flex align-items-center mb-3"
                style="
                    padding: 0.7rem;
                    border-radius: 12px;
                    background: rgba(255,255,255,0.08);
                "
            >

                {{-- Avatar --}}
                <div
                    style="
                        width: 38px;
                        height: 38px;
                        min-width: 38px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        background: rgba(255,255,255,0.18);
                        color: white;
                    "
                >

                    <i class="bi bi-person-fill"></i>

                </div>


                {{-- User --}}
                <div class="ms-2 overflow-hidden">

                    <div
                        class="text-white fw-semibold text-truncate"
                        style="font-size: 0.82rem;"
                    >
                        {{ auth()->user()->nama_lengkap ?? auth()->user()->username }}
                    </div>

                    <div
                        style="
                            color: rgba(255,255,255,0.60);
                            font-size: 0.68rem;
                            text-transform: capitalize;
                        "
                    >
                        {{ auth()->user()->role }}
                    </div>

                </div>

            </div>


            {{-- Logout --}}
            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="nav-link w-100 border-0 text-start"
                    style="
                        background: transparent;
                        color: rgba(255,255,255,0.78);
                    "
                >

                    <i class="bi bi-box-arrow-right"></i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        @endauth



        {{-- =================================================
            KARYAWAN
        ================================================== --}}

        @auth('karyawan')

            <div
                class="d-flex align-items-center mb-3"
                style="
                    padding: 0.7rem;
                    border-radius: 12px;
                    background: rgba(255,255,255,0.08);
                "
            >

                {{-- Avatar --}}
                <div
                    style="
                        width: 38px;
                        height: 38px;
                        min-width: 38px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        background: rgba(255,255,255,0.18);
                        color: white;
                    "
                >

                    <i class="bi bi-person-fill"></i>

                </div>


                {{-- User --}}
                <div class="ms-2 overflow-hidden">

                    <div
                        class="text-white fw-semibold text-truncate"
                        style="font-size: 0.82rem;"
                    >
                        {{ auth('karyawan')->user()->nama ?? 'Karyawan' }}
                    </div>

                    <div
                        style="
                            color: rgba(255,255,255,0.60);
                            font-size: 0.68rem;
                        "
                    >
                        Karyawan
                    </div>

                </div>

            </div>


            {{-- Logout Karyawan --}}
            <form
                method="POST"
                action="{{ route('karyawan.logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="nav-link w-100 border-0 text-start"
                    style="
                        background: transparent;
                        color: rgba(255,255,255,0.78);
                    "
                >

                    <i class="bi bi-box-arrow-right"></i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        @endauth


    </div>

</div>
