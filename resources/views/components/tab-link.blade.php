@props(['aktif', 'as' => 'Link'])

@php
$classes = ($aktif ?? false)
? 'inline-flex items-center h-10 px-4 -mb-px text-sm text-center text-secondary-focus bg-transparent border-b-2
border-secondary-focus sm:text-base font-bold whitespace-normal focus:outline-none'
: '';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>