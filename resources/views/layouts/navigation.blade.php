<nav class="navbar navbar-expand-lg bg-white shadow-sm px-4">

    <div class="container-fluid">

        <div class="fw-bold fs-5">

            <i class="bi bi-building text-success"></i>

            Sistem Pengambilan Gula

        </div>


        <div class="d-flex align-items-center gap-3">

            @auth

                <span>

                    <i class="bi bi-person-circle"></i>

                    {{ auth()->user()->name }}

                </span>


                <form method="POST" action="/logout">

                    @csrf

                    <button class="btn btn-danger btn-sm">

                        <i class="bi bi-box-arrow-right"></i>
                        Logout

                    </button>

                </form>

            @else

                <a href="{{ route('choose-login') }}" class="btn btn-success btn-sm">

                    <i class="bi bi-box-arrow-in-right"></i>
                    Login

                </a>

            @endauth

        </div>

    </div>

</nav>