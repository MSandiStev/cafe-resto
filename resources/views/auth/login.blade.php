<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk - Cafe & Resto</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-white flex items-center justify-center px-5 py-10">

    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="text-center mb-8">

            <img
                src="{{ asset('images/technolife.jpeg') }}"
                alt="Technolife"
                class="w-36 h-36 object-contain mx-auto"
            >

            <p class="text-sm text-gray-500 mt-1">
                Masuk untuk melanjutkan pesanan.
            </p>

        </div>


        <!-- Login Card -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 sm:p-8">

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-5 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700">
                    {{ session('status') }}
                </div>
            @endif


            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">

                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="Masukkan email"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300
                               text-sm text-gray-900 placeholder-gray-400
                               outline-none transition
                               focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    >

                    @error('email')
                        <p class="mt-2 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Password -->
                <div class="mb-4">

                    <div class="flex items-center justify-between mb-2">

                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Kata Sandi
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="text-xs text-red-600 hover:text-red-700 hover:underline"
                            >
                                Lupa kata sandi?
                            </a>
                        @endif

                    </div>


                    <div class="relative">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan kata sandi"
                            class="w-full px-4 py-3 pr-11 rounded-lg border border-gray-300
                                   text-sm text-gray-900 placeholder-gray-400
                                   outline-none transition
                                   focus:border-red-500 focus:ring-1 focus:ring-red-500"
                        >

                        <!-- Toggle Password -->
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2
                                   p-1 text-gray-400 hover:text-red-600 transition"
                            aria-label="Tampilkan kata sandi"
                        >

                            <svg
                                id="eye-icon"
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                                       c4.478 0 8.268 2.943 9.542 7
                                       -1.274 4.057-5.064 7-9.542 7
                                       -4.477 0-8.268-2.943-9.542-7z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />

                            </svg>

                        </button>

                    </div>


                    @error('password')
                        <p class="mt-2 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Remember Me -->
                <div class="flex items-center mb-6">

                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="w-4 h-4 rounded border-gray-300
                               text-red-600 focus:ring-red-500"
                    >

                    <label
                        for="remember_me"
                        class="ml-2 text-sm text-gray-600 cursor-pointer"
                    >
                        Ingat saya
                    </label>

                </div>


                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full py-3 px-4 rounded-lg
                           bg-red-600 text-white
                           text-sm font-medium
                           hover:bg-red-700
                           active:bg-red-800
                           transition"
                >
                    Masuk
                </button>

            </form>


            <!-- Register -->
            <div class="mt-6 pt-6 border-t border-gray-100 text-center">

                <p class="text-sm text-gray-500">

                    Belum punya akun?

                    <a
                        href="{{ route('register') }}"
                        class="font-medium text-red-600
                               hover:text-red-700 hover:underline"
                    >
                        Daftar
                    </a>

                </p>

            </div>

        </div>


        <!-- Back to Home -->
        <div class="text-center mt-6">

            <a
                href="/"
                class="text-sm text-gray-500
                       hover:text-red-600 transition"
            >
                ← Kembali ke halaman utama
            </a>

        </div>


        <!-- Footer -->
        <p class="text-center text-xs text-gray-400 mt-8">
            © {{ date('Y') }} Cafe & Resto
        </p>

    </div>


    <!-- Toggle Password Script -->
    <script>

        function togglePassword() {

            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M13.875 18.825A10.05 10.05 0 0112 19
                           c-4.478 0-8.268-2.943-9.542-7
                           a9.97 9.97 0 011.563-3.029
                           m5.858-5.908a8.98 8.98 0 013.13-.563
                           c4.478 0 8.268 2.943 9.542 7
                           a10.025 10.025 0 01-4.132 5.411
                           m-4.276-4.276a3 3 0 10-4.243-4.243
                           M3 3l18 18"
                    />
                `;

            } else {

                passwordInput.type = 'password';

                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5
                           c4.478 0 8.268 2.943 9.542 7
                           -1.274 4.057-5.064 7-9.542 7
                           -4.477 0-8.268-2.943-9.542-7z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                `;

            }

        }

    </script>

</body>
</html>