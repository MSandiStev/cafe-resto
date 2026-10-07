<x-guest-layout heading="Masuk ke Akun" subheading="Lanjutkan pesanan favoritmu atau pantau status pesanan terkini." activeTab="login">
    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5" x-data="{ showPassword: false }">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Alamat Email" class="font-semibold text-neutral-800" />
            <div class="relative mt-1.5 rounded-xl">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                    </svg>
                </div>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="nama@email.com"
                       class="block w-full rounded-xl border-neutral-200 bg-neutral-50/50 py-3 pl-11 pr-4 text-sm text-neutral-900 placeholder:text-neutral-400 transition focus:border-brand-600 focus:bg-white focus:ring-4 focus:ring-brand-500/15" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" value="Kata Sandi" class="font-semibold text-neutral-800" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-brand-600 transition hover:text-brand-700 hover:underline" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <div class="relative mt-1.5 rounded-xl">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password"
                       :type="showPassword ? 'text' : 'password'"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="••••••••"
                       class="block w-full rounded-xl border-neutral-200 bg-neutral-50/50 py-3 pl-11 pr-11 text-sm text-neutral-900 placeholder:text-neutral-400 transition focus:border-brand-600 focus:bg-white focus:ring-4 focus:ring-brand-500/15" />

                {{-- Toggle Show/Hide Password --}}
                <button type="button"
                        @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-neutral-400 hover:text-neutral-700 focus:outline-none"
                        title="Lihat kata sandi">
                    <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember me --}}
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex cursor-pointer items-center gap-2.5">
                <input id="remember_me"
                       type="checkbox"
                       name="remember"
                       class="h-4 w-4 rounded border-neutral-300 text-brand-600 shadow-sm focus:ring-brand-500">
                <span class="text-sm font-medium text-neutral-600">Ingat sesi saya</span>
            </label>
        </div>

        {{-- Submit Button --}}
        <button type="submit"
                class="group flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-600 to-brand-700 py-3.5 px-6 text-sm font-bold text-white shadow-lg shadow-brand-600/30 transition-all duration-200 hover:from-brand-500 hover:to-brand-600 hover:shadow-brand-600/40 active:scale-[0.99] focus:outline-none focus:ring-4 focus:ring-brand-500/25">
            <span>Masuk ke Akun</span>
            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>
    </form>

    {{-- Switcher Footer --}}
    @if (Route::has('register'))
        <div class="mt-7 text-center">
            <p class="text-sm text-neutral-500">
                Belum memiliki akun pelanggan?
                <a href="{{ route('register') }}" class="font-bold text-brand-600 transition hover:text-brand-700 hover:underline">
                    Daftar sekarang
                </a>
            </p>
        </div>
    @endif
</x-guest-layout>
