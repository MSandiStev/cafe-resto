<x-guest-layout heading="Lupa Kata Sandi?" subheading="Jangan khawatir. Masukkan email yang terdaftar dan kami akan mengirimkan tautan reset kata sandi.">
    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Alamat Email Terdaftar" class="font-semibold text-neutral-800" />
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
                       placeholder="nama@email.com"
                       class="block w-full rounded-xl border-neutral-200 bg-neutral-50/50 py-3 pl-11 pr-4 text-sm text-neutral-900 placeholder:text-neutral-400 transition focus:border-brand-600 focus:bg-white focus:ring-4 focus:ring-brand-500/15" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Submit Button --}}
        <button type="submit"
                class="group flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-600 to-brand-700 py-3.5 px-6 text-sm font-bold text-white shadow-lg shadow-brand-600/30 transition-all duration-200 hover:from-brand-500 hover:to-brand-600 hover:shadow-brand-600/40 active:scale-[0.99] focus:outline-none focus:ring-4 focus:ring-brand-500/25">
            <span>Kirim Tautan Reset</span>
            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </button>
    </form>

    <div class="mt-7 text-center">
        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-neutral-600 transition hover:text-brand-600">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali ke Halaman Masuk</span>
        </a>
    </div>
</x-guest-layout>
