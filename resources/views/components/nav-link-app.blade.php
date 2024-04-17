@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-x-3.5 py-2 px-2.5 bg-slate-100 text-sm font-semibold text-amber-800 rounded-lg hover:bg-rose-100 dark:bg-rose-700 dark:text-white'
            : 'flex items-center gap-x-3.5 py-2 px-2.5 bg-white-100 text-sm text-neutral-700 rounded-lg hover:bg-gray-100 dark:bg-neutral-700 dark:text-white';
@endphp

    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>

