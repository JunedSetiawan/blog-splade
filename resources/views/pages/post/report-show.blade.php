<x-guest-layout>
    <x-home-navbar></x-home-navbar>
    <!-- Blog Article -->
    <div class="max-w-5xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-5xl">
            <!-- Avatar Media -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                    <div class="flex-shrink-0">
                        <img class="h-12 w-12 rounded-full"
                            src="https://api.dicebear.com/6.x/identicon/svg?scale=75&seed={{ $post->user->name }}"
                            alt="Image Description">
                    </div>

                    <div class="grow">
                        <div class="grid sm:flex sm:justify-between sm:items-center gap-2">
                            <div>
                                <!-- Tooltip -->
                                <div class="hs-tooltip inline-block [--trigger:hover] [--placement:bottom]">
                                    <div class="hs-tooltip-toggle sm:mb-1 block text-left cursor-pointer">
                                        <span class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $post->user->name }}
                                        </span>
                                    </div>
                                </div>
                                <!-- End Tooltip -->

                                <ul class="text-xs text-gray-500">
                                    <li
                                        class="inline-block relative pr-6 last:pr-0 last-of-type:before:hidden before:absolute before:top-1/2 before:right-2 before:-translate-y-1/2 before:w-1 before:h-1 before:bg-gray-300 before:rounded-full dark:text-gray-400 dark:before:bg-gray-600">
                                        {{ $post->created_at->diffForHumans() }}
                                    </li>
                                    <li
                                        class="inline-block relative pr-6 last:pr-0 last-of-type:before:hidden before:absolute before:top-1/2 before:right-2 before:-translate-y-1/2 before:w-1 before:h-1 before:bg-gray-300 before:rounded-full dark:text-gray-400 dark:before:bg-gray-600">
                                        8 min read
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Avatar Media -->

            <!-- Content -->
            <div class="space-y-5 md:space-y-8">
                <div class="space-y-3">
                    <h2 class="text-2xl font-bold md:text-3xl dark:text-white pb-3">{{ $post->title }}
                    </h2>

                    <figure>
                        <img class="w-full object-cover rounded-xl h-44 sm:h-96"
                            src="{{ route('getImage', ['filename' => $post->image ?? 'default.jpg']) }}"
                            alt="Image Description">
                        <figcaption class="mt-3 text-sm text-center text-gray-500">
                            A woman sitting at a table.
                        </figcaption>
                    </figure>

                </div>
                <p class="my-4 text-3xl text-bold text-error text-center">
                    <span class="flex items-center justify-center">Your Post Has Been Takedown <x-heroicon-o-x-circle
                            class="w-9 h-9" />
                    </span>
                </p>
                <div>
                    <a class="m-1 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-200"
                        href="#">
                        {{ $post->category->name }}
                    </a>
                    <a class="m-1 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-200"
                        href="#">
                        Web development
                    </a>
                    <a class="m-1 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-200"
                        href="#">
                        Free
                    </a>
                    <a class="m-1 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-200"
                        href="#">
                        Team
                    </a>
                </div>
            </div>
            <!-- End Content -->
            <div class="border-t-2 border-gray-300 my-12"></div>
            <div class="text-center">
                <h1 class="text-3xl font-bold text-base-content lg:text-3xl">Best Article Chosen for you
                </h1>
                <p class="mt-4 text-gray-500">We have curated the best article based on your internet topic</p>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 sm:mx-auto lg:max-w-full my-8">
                @forelse($match_posts as $match)
                    <div class="overflow-hidden transition-shadow duration-300 rounded shadow-sm">
                        <img src="{{ route('getImage', ['filename' => $match->image ?? 'default.jpg']) }}"
                            class="object-cover w-full h-48 sm:h-56" alt="" />
                        <div class="pt-5">
                            <p class="mb-3 text-xs font-semibold tracking-wide uppercase">
                                <span
                                    class="text-base-content">{{ $match->user->name . ' - ' . $match->created_at->diffForHumans() }}</span>
                            </p>
                            <Link href="{{ route('post.show', $match->id) }}">
                            <h2
                                class="text-base-content inline-block mb-3 text-xl font-semibold transition-colors
                        duration-200">
                                {{ $match->title }}</h2>
                            <p class="mb-2 text-base-content">
                                {{ $match->shortBody() }}
                            </p>
                            </Link>
                            <div class="mt-4 space-x-2">
                                <div class="badge badge-outline border-2 border-secondary-focus  text-base-content">
                                    {{ $match->category->name }}
                                </div>
                                <div class="badge badge-outline border-2 text-base-content">#tutorial</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center mt-5 font-semibold">
                        <p class="text-3xl text-base-content">
                            Sorry, Don't find the best match post for you
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- End Blog Article -->

    <!-- Sticky Share Group -->
    <div class="sticky bottom-6 inset-x-0 text-center">
        <div class="inline-block bg-white shadow-md rounded-full py-3 px-4 dark:bg-gray-800">
            <div class="flex items-center gap-x-1.5">
                <!-- Button -->
                <div class="tooltip" data-tip="Likes">
                    <div class="inline-block">
                        <button type="button"
                            class="flex items-center gap-x-2 text-sm text-gray-500 hover:text-gray-800">
                            <div class="flex flex-row space-x-2 items-center">
                                <div>
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg> {{ $post->likes_count }}
                                </div>
                            </div>
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-sm dark:bg-black"
                                role="tooltip">
                                Like
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sticky Share Group -->
    <x-footer></x-footer>
</x-guest-layout>
