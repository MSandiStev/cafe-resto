<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - Cafe & Resto</title>

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

            <h1 class="text-2xl font-semibold text-gray-900 mt-1">
                Buat Akun
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Daftar untuk mulai melakukan pemesanan.
            </p>

        </div>


        <!-- Register Card -->
        <div class="bg-white border border-gray-200 rounded-xl p-6 sm:p-8">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div class="mb-5">

                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Nama Lengkap
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Masukkan nama lengkap"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300
                               text-sm text-gray-900 placeholder-gray-400
                               outline-none transition
                               focus:border-red-500 focus:ring-1 focus:ring-red-500"
                    >

                    @error('name')
                        <p class="mt-2 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


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
                        autocomplete="username"
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
                <div class="mb-5">

                    <label
                        for="password"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Kata Sandi
                    </label>

                    <div class="relative">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Masukkan kata sandi"
                            class="w-full px-4 py-3 pr-11 rounded-lg border border-gray-300
                                   text-sm text-gray-900 placeholder-gray-400
                                   outline-none transition
                                   focus:border-red-500 focus:ring-1 focus:ring-red-500"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('password', 'eye-password')"
                            class="absolute right-3 top-1/2 -translate-y-1/2
                                   p-1 text-gray-400 hover:text-red-600 transition"
                            aria-label="Tampilkan kata sandi"
                        >

                            <svg
                                id="eye-password"
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


                <!-- Konfirmasi Password -->
                <div class="mb-5">

                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Ulangi Kata Sandi
                    </label>

                    <div class="relative">

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Masukkan ulang kata sandi"
                            class="w-full px-4 py-3 pr-11 rounded-lg border border-gray-300
                                   text-sm text-gray-900 placeholder-gray-400
                                   outline-none transition
                                   focus:border-red-500 focus:ring-1 focus:ring-red-500"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('password_confirmation', 'eye-confirm')"
                            class="absolute right-3 top-1/2 -translate-y-1/2
                                   p-1 text-gray-400 hover:text-red-600 transition"
                            aria-label="Tampilkan konfirmasi kata sandi"
                        >

                            <svg
                                id="eye-confirm"
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

                    @error('password_confirmation')
                        <p class="mt-2 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Terms -->
                <p class="text-xs text-gray-500 leading-relaxed mb-6">
                    Dengan mendaftar, Anda menyetujui ketentuan layanan dan
                    kebijakan privasi
                    <span class="font-medium text-gray-700">
                        {{ config('app.name') }}
                    </span>.
                </p>


                <!-- Register Button -->
                <button
                    type="submit"
                    class="w-full py-3 px-4 rounded-lg
                           bg-red-600 text-white
                           text-sm font-medium
                           hover:bg-red-700
                           active:bg-red-800
                           transition"
                >
                    Daftar
                </button>

            </form>


            <!-- Login -->
            <div class="mt-6 pt-6 border-t border-gray-100 text-center">

                <p class="text-sm text-gray-500">

                    Sudah memiliki akun?

                    <a
                        href="{{ route('login') }}"
                        class="font-medium text-red-600
                               hover:text-red-700 hover:underline"
                    >
                        Masuk
                    </a>

                </p>

            </div>

        </div>


        <!-- Back -->
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


    <!-- Password Toggle -->
    <script>

        function togglePassword(inputId, iconId) {

            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {

                input.type = 'text';

                icon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M13.875 18.825A10.05 10.05 0 0112 19
                           c-4.478 0-8.268-2.943-9.542-7
                           a9.97 9.97 0 011.563-3.029
                           m5.858.908a3 3 0 114.243 4.243
                           M9.878 9.878l4.242 4.242
                           M9.88 9.88l-3.29-3.29
                           m7.532 7.532l3.29 3.29
                           M3 3l18 18"
                    />
                `;

            } else {

                input.type = 'password';

                icon.innerHTML = `
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