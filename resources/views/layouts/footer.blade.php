@php
    $footerHours = config('cafe.hours');
    $footerDays  = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

    // Gabungkan hari berurutan yang jamnya sama, mis. "Senin – Jumat: 08.00 – 22.00".
    $footerGroups = [];
    foreach ($footerDays as $no => $name) {
        $last = count($footerGroups) - 1;

        if ($last >= 0 && $footerGroups[$last]['hours'] === $footerHours[$no]) {
            $footerGroups[$last]['to'] = $name;
        } else {
            $footerGroups[] = ['from' => $name, 'to' => $name, 'hours' => $footerHours[$no]];
        }
    }
@endphp

<footer class="mt-16 bg-neutral-900 text-neutral-300">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 py-14 md:grid-cols-4">
        <div class="md:col-span-1">
            <p class="text-lg font-semibold text-white">{{ config('app.name') }}</p>
            @if (config('cafe.about'))
                <p class="mt-3 text-sm leading-relaxed">{{ config('cafe.about') }}</p>
            @endif
        </div>

        <div class="text-sm">
            <p class="font-semibold text-white">Jam buka</p>
            <ul class="mt-3 space-y-1">
                @foreach ($footerGroups as $group)
                    <li>
                        {{ $group['from'] === $group['to'] ? $group['from'] : $group['from'] . ' – ' . $group['to'] }}:
                        {{ $group['hours'][0] }} – {{ $group['hours'][1] }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="text-sm">
            <p class="font-semibold text-white">Lokasi dan kontak</p>
            <p class="mt-3">{{ config('cafe.address') }}</p>
            <p class="mt-2">
                <a href="https://wa.me/{{ config('cafe.whatsapp') }}" target="_blank" rel="noopener"
                   class="underline decoration-neutral-600 underline-offset-4 hover:text-white">WhatsApp</a>
                <span class="mx-1 text-neutral-600">·</span>
                <a href="https://www.google.com/maps/search/?api=1&amp;query={{ urlencode(config('cafe.address')) }}"
                   target="_blank" rel="noopener"
                   class="underline decoration-neutral-600 underline-offset-4 hover:text-white">Google Maps</a>
            </p>
        </div>

        <div class="text-sm">
            <p class="font-semibold text-white">Pintasan</p>
            <ul class="mt-3 space-y-1">
                <li><a href="{{ route('menu.index') }}" class="hover:text-white">Menu</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-white">Keranjang</a></li>
                <li><a href="{{ route('tracking.index') }}" class="hover:text-white">Lacak pesanan</a></li>
            </ul>
        </div>
    </div>

    <div class="border-t border-neutral-800 py-5 text-center text-xs text-neutral-500">
        © {{ date('Y') }} {{ config('app.name') }}
    </div>
</footer>
