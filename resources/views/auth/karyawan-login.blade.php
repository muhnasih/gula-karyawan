<x-guest-layout>

    {{-- ERROR SESSION --}}
    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700 flex items-start gap-2">
            <i class="bi bi-exclamation-circle mt-0.5"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ERROR VALIDASI --}}
    @if($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- FORM LOGIN --}}
    <form action="{{ route('karyawan.login.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- NIK --}}
        <div>
            <label for="nik" class="block mb-1.5 text-sm font-semibold text-gray-700">
                NIK Karyawan
            </label>
            <input
                type="text"
                id="nik"
                name="nik"
                value="{{ old('nik') }}"
                placeholder="Masukkan NIK"
                autocomplete="off"
                autofocus
                required
                class="w-full rounded-lg border px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500
                       {{ $errors->has('nik') ? 'border-red-400' : 'border-gray-300' }}"
            >
            @error('nik')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-gray-400">Masukkan NIK sesuai data karyawan.</p>
        </div>

        {{-- PASSWORD --}}
        <div>
            <label for="password" class="block mb-1.5 text-sm font-semibold text-gray-700">
                Password
            </label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                autocomplete="current-password"
                required
                class="w-full rounded-lg border px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500
                       {{ $errors->has('password') ? 'border-red-400' : 'border-gray-300' }}"
            >
            @error('password')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- TOMBOL MASUK --}}
        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 rounded-lg bg-green-600 hover:bg-green-700 transition text-white font-semibold py-2.5 text-sm shadow-md shadow-green-600/20"
        >
            <i class="bi bi-box-arrow-in-right"></i>
            Masuk
        </button>
    </form>

    {{-- INFORMASI --}}
    <div class="text-center mt-6 space-y-2">
        <p class="text-xs text-gray-400">
            Password awal adalah NIK karyawan.
            Silakan ubah password setelah berhasil login.
        </p>
        <p class="text-xs text-gray-500">
            Login sebagai admin / operator?
            <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">
                Klik di sini
            </a>
        </p>
    </div>

</x-guest-layout>