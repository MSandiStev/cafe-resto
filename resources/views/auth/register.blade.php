<x-guest-layout heading="Buat Akun Baru" subheading="Daftar dalam sekejap untuk memesan lebih cepat dan nikmati menu favoritmu." activeTab="register">
    <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ showPassword: false, showConfirm: false }">
        @csrf

        {{-- Nama Lengkap --}}
        <div>
            <x-input-label for="name" value="Nama Lengkap" class="font-semibold text-neutral-800" />
            <div class="relative mt-1.5 rounded-xl">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       autocomplete="name"
                       placeholder="Contoh: Budi Santoso"
                       class="block w-full rounded-xl border-neutral-200 bg-neutral-50/50 py-3 pl-11 pr-4 text-sm text-neutral-900 placeholder:text-neutral-400 transition focus:border-brand-600 focus:bg-white focus:ring-4 focus:ring-brand-500/15" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

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
                       autocomplete="username"
                       placeholder="nama@email.com"
                       class="block w-full rounded-xl border-neutral-200 bg-neutral-50/50 py-3 pl-11 pr-4 text-sm text-neutral-900 placeholder:text-neutral-400 transition focus:border-brand-600 focus:bg-white focus:ring-4 focus:ring-brand-500/15" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        {{-- Kata Sandi --}}
        <div>
            <x-input-label for="password" value="Kata Sandi" class="font-semibold text-neutral-800" />
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
                       autocomplete="new-password"
                       placeholder="Minimal 8 karakter"
                       class="block w-full rounded-xl border-neutral-200 bg-neutral-50/50 py-3 pl-11 pr-11 text-sm text-neutral-900 placeholder:text-neutral-400 transition focus:border-brand-600 focus:bg-white focus:ring-4 focus:ring-brand-500/15" />

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
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        {{-- Ulangi Kata Sandi --}}
        <div>
            <x-input-label for="password_confirmation" value="Ulangi Kata Sandi" class="font-semibold text-neutral-800" />
            <div class="relative mt-1.5 rounded-xl">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <input id="password_confirmation"
                       :type="showConfirm ? 'text' : 'password'"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       placeholder="Masukkan ulang kata sandi"
                       class="block w-full rounded-xl border-neutral-200 bg-neutral-50/50 py-3 pl-11 pr-11 text-sm text-neutral-900 placeholder:text-neutral-400 transition focus:border-brand-600 focus:bg-white focus:ring-4 focus:ring-brand-500/15" />

                <button type="button"
                        @click="showConfirm = !showConfirm"
                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-neutral-400 hover:text-neutral-700 focus:outline-none"
                        title="Lihat konfirmasi kata sandi">
                    <svg x-show="!showConfirm" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showConfirm" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        {{-- Terms Note --}}
        <p class="pt-1 text-xs text-neutral-500">
            Dengan mendaftar, Anda menyetujui ketentuan layanan dan kebijakan privasi <span class="font-semibold text-neutral-700">{{ config('app.name') }}</span>.
        </p>

        {{-- Submit Button --}}
        <div class="pt-2">
            <button type="submit"
                    class="group flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-600 to-brand-700 py-3.5 px-6 text-sm font-bold text-white shadow-lg shadow-brand-600/30 transition-all duration-200 hover:from-brand-500 hover:to-brand-600 hover:shadow-brand-600/40 active:scale-[0.99] focus:outline-none focus:ring-4 focus:ring-brand-500/25">
                <span>Daftar Akun Sekarang</span>
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </form>

    {{-- Switcher Footer --}}
    <div class="mt-7 text-center">
        <p class="text-sm text-neutral-500">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="font-bold text-brand-600 transition hover:text-brand-700 hover:underline">
                Masuk ke akunmu
            </a>
        </p>
    </div>
</x-guest-layout>
