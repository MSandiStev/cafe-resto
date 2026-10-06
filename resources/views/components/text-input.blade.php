@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-lg border-neutral-300 text-sm shadow-sm focus:border-brand-600 focus:ring-brand-600 disabled:bg-neutral-100']) }}>
