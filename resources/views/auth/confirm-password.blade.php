<x-guest-layout heading="Konfirmasi kata sandi" subheading="Ini area yang aman. Konfirmasi kata sandi Anda untuk melanjutkan.">
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" value="Kata sandi" />
            <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">Konfirmasi</x-primary-button>
    </form>
</x-guest-layout>
