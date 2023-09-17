@props(['aktif', 'as' => 'Link'])

@php
$classes = ($aktif ?? false)
? 'inline-flex items-center h-10 px-4 -mb-px text-sm text-center text-secondary-focus bg-transparent border-b-2
border-secondary-focus sm:text-base font-bold whitespace-nowrap focus:outline-none'
: 'inline-flex items-center h-10 px-4 -mb-px text-sm text-center whitespace-nowrap text-gray-700 bg-transparent
border-b-2 border-transparent sm:text-base dark:text-white cursor-base focus:outline-none
hover:border-gray-400';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>