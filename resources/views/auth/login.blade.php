<x-guest-layout heading="Masuk" subheading="Masuk untuk memesan lebih cepat dan melihat riwayat pesanan Anda.">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="Kata sandi" />
                @if (Route::has('password.request'))
                    <a class="text-sm text-neutral-500 transition hover:text-brand-600" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>
            <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-neutral-300 text-brand-600 focus:ring-brand-600" name="remember">
            <span class="ms-2 text-sm text-neutral-600">Ingat saya</span>
        </label>

        <x-primary-button class="w-full">Masuk</x-primary-button>
    </form>

    @if (Route::has('register'))
        <p class="mt-6 text-center text-sm text-neutral-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-brand-600 hover:underline">Daftar</a>
        </p>
    @endif
</x-guest-layout>
