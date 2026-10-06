<x-guest-layout heading="Lupa kata sandi" subheading="Masukkan email Anda. Kami akan mengirim tautan untuk membuat kata sandi baru.">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">Kirim tautan reset</x-primary-button>
    </form>

    <p class="mt-6 text-center text-sm text-neutral-600">
        <a href="{{ route('login') }}" class="font-semibold text-brand-600 hover:underline">← Kembali ke halaman masuk</a>
    </p>
</x-guest-layout>
