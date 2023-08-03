@props(['active', 'as' => 'Link'])

@php
$classes = ($active ?? false)
? 'active'
: '';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>