<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Dashboard') }}
    </x-slot>
    <div class="p-4 space-y-3">
        <h1 class="text-3xl">All Report Post</h1>
        <x-splade-table :for="$reports" />
    </div>
</x-app-layout>
