@php $h = config('cafe.hours'); @endphp

<footer id="lokasi" class="mt-16 bg-neutral-900 text-neutral-300">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 py-14 md:grid-cols-3">
        <div>
            <p class="text-lg font-semibold text-white">{{ config('app.name') }}</p>
            <p class="mt-3 max-w-xs text-sm leading-relaxed">
                {{ config('cafe.about') ?: 'Kopi dan makanan yang bisa dipesan langsung dari website.' }}
            </p>
        </div>

        <div class="text-sm">
            <p class="font-semibold text-white">Jam buka</p>
            <p class="mt-3">Senin – Jumat: {{ $h[1][0] }} – {{ $h[1][1] }}</p>
            <p>Sabtu – Minggu: {{ $h[6][0] }} – {{ $h[6][1] }}</p>
        </div>

        <div class="text-sm">
            <p class="font-semibold text-white">Lokasi dan kontak</p>
            <p class="mt-3">{{ config('cafe.address') }}</p>
            <p>
                WhatsApp:
                <a href="https://wa.me/{{ config('cafe.whatsapp') }}" class="underline underline-offset-4 hover:text-white">
                    +{{ config('cafe.whatsapp') }}
                </a>
            </p>
        </div>
    </div>

    <div class="border-t border-neutral-800 py-5 text-center text-xs text-neutral-500">
        © {{ date('Y') }} {{ config('app.name') }}
    </div>
</footer>