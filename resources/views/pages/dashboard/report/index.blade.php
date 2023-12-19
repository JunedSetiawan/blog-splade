<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Dashboard') }}
    </x-slot>
    <div class="p-4 space-y-3">
        <h1 class="text-3xl">All Report Post</h1>
        <x-splade-table :for="$reports">
            <x-splade-cell actions as="$report">
                @if ($report->status === 1)
                    <span class="badge badge-success">Post TakeDown</span>
                @else
                    <x-splade-form confirm action="{{ route('post.report.accept', $report->id) }}" method="patch">
                        @csrf
                        <x-splade-submit label="Accept" />
                    </x-splade-form>
                @endif
            </x-splade-cell>
        </x-splade-table>
    </div>
</x-app-layout>
