<x-guest-layout>

    <!-- Judul Login -->
    <div class="mb-7">

        <h2 class="text-2xl font-bold text-gray-800">
            Selamat Datang 👋
        </h2>

        <p class="mt-2 text-sm text-gray-500">
            Silakan login untuk melanjutkan ke sistem
        </p>

    </div>


    <!-- Session Status -->
    @if (session('status'))

        <div
            class="mb-5 rounded-lg
                   bg-green-50
                   border border-green-200
                   px-4 py-3
                   text-sm text-green-700"
        >

            <div class="flex items-center gap-2">

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('status') }}
                </span>

            </div>

        </div>

    @endif


    <!-- Error Login -->
    @if ($errors->any())

        <div
            class="mb-5 rounded-lg
                   bg-red-50
                   border border-red-200
                   px-4 py-3
                   text-sm text-red-600"
        >

            <div class="flex items-start gap-2">

                <i class="bi bi-exclamation-circle-fill mt-0.5"></i>

                <div>

                    <p class="font-semibold">
                        Login gagal
                    </p>

                    <p class="mt-1">
                        Username atau password yang Anda masukkan salah.
                    </p>

                </div>

            </div>

        </div>

    @endif


    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}">

        @csrf


        <!-- Username -->
        <div>

            <x-input-label
                for="username"
                value="Username"
                class="text-gray-700 font-semibold"
            />

            <div class="relative mt-2">

                <!-- Icon -->
                <div
                    class="absolute inset-y-0 left-0
                           flex items-center
                           pl-3
                           pointer-events-none"
                >

                    <i class="bi bi-person text-gray-400"></i>

                </div>


                <!-- Input -->
                <x-text-input
                    id="username"
                    name="username"
                    type="text"
                    :value="old('username')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Masukkan username"
                    class="block w-full
                           pl-10 pr-4 py-3
                           rounded-lg
                           border-gray-300
                           text-gray-800
                           placeholder-gray-400
                           focus:border-green-500
                           focus:ring-green-500"
                />

            </div>


            <x-input-error
                :messages="$errors->get('username')"
                class="mt-2"
            />

        </div>



        <!-- Password -->
        <div class="mt-5">

            <x-input-label
                for="password"
                value="Password"
                class="text-gray-700 font-semibold"
            />

            <div class="relative mt-2">

                <!-- Icon -->
                <div
                    class="absolute inset-y-0 left-0
                           flex items-center
                           pl-3
                           pointer-events-none"
                >

                    <i class="bi bi-lock text-gray-400"></i>

                </div>


                <!-- Input -->
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Masukkan password"
                    class="block w-full
                           pl-10 pr-4 py-3
                           rounded-lg
                           border-gray-300
                           text-gray-800
                           placeholder-gray-400
                           focus:border-green-500
                           focus:ring-green-500"
                />

            </div>


            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>



        <!-- Remember Me + Forgot Password -->
        <div
            class="flex items-center
                   justify-between
                   mt-5"
        >

            <!-- Remember -->
            <label
                for="remember_me"
                class="inline-flex
                       items-center
                       cursor-pointer"
            >

                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded
                           border-gray-300
                           text-green-600
                           shadow-sm
                           focus:ring-green-500"
                >

                <span class="ms-2 text-sm text-gray-600">
                    Ingat saya
                </span>

            </label>


            <!-- Forgot Password -->
            @if (Route::has('password.request'))

                <a
                    href="{{ route('password.request') }}"
                    class="text-sm
                           text-green-600
                           hover:text-green-700
                           hover:underline
                           transition"
                >
                    Lupa password?
                </a>

            @endif

        </div>



        <!-- Login Button -->
        <div class="mt-7">

            <button
                type="submit"
                class="w-full
                       flex
                       justify-center
                       items-center
                       gap-2
                       py-3
                       px-4
                       rounded-lg
                       bg-green-600
                       hover:bg-green-700
                       active:bg-green-800
                       text-white
                       font-semibold
                       shadow-md
                       shadow-green-600/20
                       transition
                       duration-200
                       focus:outline-none
                       focus:ring-2
                       focus:ring-green-500
                       focus:ring-offset-2"
            >

                <i class="bi bi-box-arrow-in-right text-lg"></i>

                <span>
                    Masuk ke Sistem
                </span>

            </button>

        </div>


        <!-- Link ke Login Karyawan -->
        <div class="mt-5 text-center">

            <p class="text-sm text-gray-500">
                Login sebagai karyawan?
                <a
                    href="{{ route('karyawan.login') }}"
                    class="text-green-600 font-semibold hover:underline"
                >
                    Klik di sini
                </a>
            </p>

        </div>

    </form>

</x-guest-layout>