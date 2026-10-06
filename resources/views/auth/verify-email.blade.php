<x-guest-layout heading="Verifikasi email" subheading="Terima kasih sudah mendaftar. Klik tautan di email yang baru kami kirim untuk memverifikasi alamat email Anda. Belum menerima emailnya? Kami bisa mengirim ulang.">
    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 rounded-lg bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            Tautan verifikasi baru sudah dikirim ke email yang Anda gunakan saat mendaftar.
        </div>
    @endif

    <div class="flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>Kirim ulang email</x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-neutral-500 transition hover:text-brand-600">
                Keluar
            </button>
        </form>
    </div>
</x-guest-layout>
