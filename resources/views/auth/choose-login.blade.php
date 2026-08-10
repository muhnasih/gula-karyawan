<x-guest-layout>

    <div class="mb-8 text-center">

        <h2 class="text-2xl font-bold text-gray-800">
            Selamat Datang 👋
        </h2>

        <p class="mt-2 text-sm text-gray-500">
            Silakan pilih jenis akun untuk melanjutkan
        </p>

    </div>


    <div class="space-y-4">

        <!-- Login Admin / Operator -->
        <a
            href="{{ route('login') }}"
            class="flex items-center gap-4
                   w-full p-4
                   rounded-lg
                   border border-gray-200
                   hover:border-green-500
                   hover:bg-green-50
                   transition group"
        >

            <div
                class="flex items-center justify-center
                       w-12 h-12
                       rounded-full
                       bg-green-100
                       text-green-600
                       group-hover:bg-green-600
                       group-hover:text-white
                       transition"
            >

                <i class="bi bi-shield-lock text-xl"></i>

            </div>


            <div class="text-left">

                <p class="font-semibold text-gray-800">
                    Admin / Operator
                </p>

                <p class="text-sm text-gray-500">
                    Login menggunakan username & password
                </p>

            </div>


            <i class="bi bi-chevron-right ml-auto text-gray-400 group-hover:text-green-600"></i>

        </a>


        <!-- Login Karyawan -->
        <a
            href="{{ route('karyawan.login') }}"
            class="flex items-center gap-4
                   w-full p-4
                   rounded-lg
                   border border-gray-200
                   hover:border-blue-500
                   hover:bg-blue-50
                   transition group"
        >

            <div
                class="flex items-center justify-center
                       w-12 h-12
                       rounded-full
                       bg-blue-100
                       text-blue-600
                       group-hover:bg-blue-600
                       group-hover:text-white
                       transition"
            >

                <i class="bi bi-person-badge text-xl"></i>

            </div>


            <div class="text-left">

                <p class="font-semibold text-gray-800">
                    Karyawan
                </p>

                <p class="text-sm text-gray-500">
                    Login menggunakan NIK
                </p>

            </div>


            <i class="bi bi-chevron-right ml-auto text-gray-400 group-hover:text-blue-600"></i>

        </a>

    </div>

</x-guest-layout>