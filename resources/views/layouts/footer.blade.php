<footer id="lokasi" class="mt-24 bg-neutral-900 text-neutral-300">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 py-14 md:grid-cols-3">
        <div>
            <p class="text-lg font-bold text-white">{{ config('app.name') }}</p>
            <p class="mt-3 text-sm leading-relaxed">Tulis satu kalimat singkat tentang cafe Anda di sini.</p>
        </div>
        <div class="text-sm">
            <p class="font-semibold text-white">Jam Buka</p>
            <p class="mt-3">Senin – Jumat: 08.00 – 22.00</p>
            <p>Sabtu – Minggu: 08.00 – 23.00</p>
        </div>
        <div class="text-sm">
            <p class="font-semibold text-white">Lokasi & Kontak</p>
            <p class="mt-3">Alamat lengkap cafe Anda</p>
            <p>WhatsApp: 08xx-xxxx-xxxx</p>
        </div>
    </div>
    <div class="border-t border-neutral-800 py-5 text-center text-xs text-neutral-500">
        © {{ date('Y') }} {{ config('app.name') }}
    </div>
</footer>