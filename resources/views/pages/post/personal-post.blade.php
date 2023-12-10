<x-guest-layout>
    <x-home-navbar>
        <x-slot name="hero">
            <section class="bg-white dark:bg-gray-900">
                <div class="container px-4 pt-7 mx-auto lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white">
                        My Personal Posts
                        <Link href="{{ route('post.create') }}" class="btn btn-secondary text-base-content">Create</Link>
                    </h2>
                </div>
            </section>
        </x-slot>
    </x-home-navbar>
    <div class="container px-6 py-3 mx-auto">
        @forelse ($posts as $post)
            {{ $post->name }}
        @empty
            You Not Have Post Yet
        @endforelse
    </div>
    <div class="mt-14 inset-x-0 top-0 h-2 bg-gradient-to-l from-pink-500 via-red-500 to-yellow-500"></div>
    <x-footer>
    </x-footer>

</x-guest-layout>
