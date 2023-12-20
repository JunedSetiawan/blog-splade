<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Dashboard') }}
    </x-slot>
    <div class="p-4 space-y-3">
        <h1 class="text-3xl">All Report Post</h1>
        <x-splade-table :for="$users">
            <x-splade-cell actions as="$user">
                Edit
            </x-splade-cell>
        </x-splade-table>
    </div>
</x-app-layout>
