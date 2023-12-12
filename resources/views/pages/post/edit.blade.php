<x-guest-layout>
    <x-home-navbar>
        <x-slot name="hero">
            <section class="bg-white dark:bg-gray-900">
                <div class="container px-4 pt-7 mx-auto lg:flex lg:items-center lg:justify-center">
                    <h2 class="text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white ">
                        Edit post
                    </h2>
                </div>
            </section>
        </x-slot>
    </x-home-navbar>
    <div class="container px-6 py-3 mx-auto">
        <x-splade-form class="space-y-3" action="{{ route('post.update', $post->id) }}" :default="$post, ['image' => $image]">
            <x-splade-input name="title" label="Title Post" placeholder="Insert The title.." />

            <x-splade-wysiwyg name="body" label="Content Post" />

            <x-splade-select name="category_id" :options="$categories" label="Category Post"
                placeholder="Select the category..." />

            <x-splade-file filepond preview name="image" accept="image/png,image/jpg,image/jpeg" label="Image post" />

            <x-splade-submit class="mt-4" />
        </x-splade-form>
    </div>
    <div class="mt-14 inset-x-0 top-0 h-2 bg-gradient-to-l from-pink-500 via-red-500 to-yellow-500"></div>
    <x-footer>
    </x-footer>

</x-guest-layout>
