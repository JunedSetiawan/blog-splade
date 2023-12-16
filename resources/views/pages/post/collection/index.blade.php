<x-guest-layout>
    <x-home-navbar>
        <x-slot name="hero">
            <section class="bg-white dark:bg-gray-900">
                <div class="container px-4 pt-7 mx-auto lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white">
                        My Collection Posts
                    </h2>
                </div>
            </section>
        </x-slot>
    </x-home-navbar>
    <div class="container px-6 py-3 mx-auto">
        <section class="bg-white dark:bg-gray-900">
            <div class="grid gap-8 lg:grid-cols-3 sm:max-w-sm sm:mx-auto lg:max-w-full mt-5">
                @forelse ($collections as $collection)
                    <div class="p-8 bg-white border rounded shadow-sm">
                        <p class="mb-3 text-xs font-semibold tracking-wide uppercase">
                            <Link href="{{ route('category.select', $collection->post->category->slug) }}"
                                class="transition-colors duration-200 text-deep-purple-accent-400 hover:text-deep-purple-800"
                                aria-label="Category">{{ $collection->post->category->name }}</Link>
                            <span class="text-gray-600">— {{ $collection->post->created_at->diffForHumans() }}</span>
                        </p>
                        <Link href="{{ route('post.show', $collection->post->id) }}" aria-label="Article"
                            title="Jingle Bells"
                            class="inline-block mb-3 text-2xl font-bold leading-5 text-black transition-colors duration-200 hover:text-deep-purple-accent-400">
                        {{ $collection->post->title }}</Link>
                        <p class="mb-5 text-gray-700">
                            {!! $collection->post->shortBody() !!}
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex">
                                <img src="https://api.dicebear.com/6.x/identicon/svg?scale=75&seed={{ Auth::user()->name }}"
                                    alt="avatar" class="object-cover w-10 h-10 rounded-full shadow-sm pr-2" />

                                <div
                                    class="font-semibold text-gray-800 transition-colors duration-200 hover:text-deep-purple-accent-400">
                                    {{ auth()->user()->name }}
                                    <p class="text-sm font-medium leading-4 text-gray-600">Author</p>
                                </div>
                            </div>
                            <div class="flex space-x-3">
                                <x-splade-form action="{{ route('post.collection.delete', $collection->id) }}"
                                    confirm="Delete collection"
                                    confirm-text="Are you sure you want to delete your collection?" method="delete">
                                    @csrf
                                    <button><x-heroicon-o-trash /></button>
                                </x-splade-form>
                            </div>
                        </div>
                    </div>

                @empty
                    You Not Have Collection Post Yet
                @endforelse
            </div>
        </section>
        {{ $collections->links() }}
    </div>
    <div class="mt-14 inset-x-0 top-0 h-2 bg-gradient-to-l from-pink-500 via-red-500 to-yellow-500"></div>
    <x-footer>
    </x-footer>

</x-guest-layout>
