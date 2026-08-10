<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Gula Karyawan') }}
    </title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    />


    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="font-sans text-gray-900 antialiased">


    <!-- Background -->
    <div
        class="min-h-screen flex items-center justify-center
               px-4 py-8
               bg-gradient-to-br
               from-green-50
               via-white
               to-emerald-100"
    >


        <!-- Container -->
        <div class="w-full max-w-md">


            <!-- Logo / Header -->
            <div class="text-center mb-7">


                <!-- Icon -->
                <div
                    class="mx-auto mb-4
                           flex items-center justify-center
                           w-20 h-20
                           rounded-2xl
                           bg-green-600
                           shadow-xl
                           shadow-green-600/30"
                >

                    <i
                        class="bi bi-building-fill
                               text-white text-4xl"
                    ></i>

                </div>


                <!-- Title -->
                <h1
                    class="text-3xl font-bold
                           text-gray-800"
                >
                    Gula Karyawan
                </h1>


                <p class="mt-2 text-sm text-gray-500">
                    Sistem Pengambian Gula
                </p>


                <p
                    class="mt-1
                           text-sm
                           font-semibold
                           text-green-600"
                >
                    PG Gending
                </p>

            </div>



            <!-- Login Card -->
            <div
                class="bg-white
                       rounded-2xl
                       shadow-xl
                       border border-gray-100
                       p-7 sm:p-8"
            >

                {{ $slot }}

            </div>



            <!-- Footer -->
            <div class="text-center mt-6">

                <p class="text-xs text-gray-400">
                    © {{ date('Y') }} PG Gending
                </p>

                <p class="text-xs text-gray-400 mt-1">
                    Sistem Pengelolaan Gula Karyawan
                </p>

            </div>


        </div>

    </div>


</body>

</html>