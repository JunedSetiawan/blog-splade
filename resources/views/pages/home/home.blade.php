<x-guest-layout>
    <x-home-navbar>
        <x-slot name="hero">
            <div class="container px-6 py-16 mx-auto text-center">
                <div class="mx-auto">
                    <h1 class="text-3xl font-bold text-base-content lg:text-4xl">Future Innovation: Shaping the World
                        with
                        New
                        Ideas
                    </h1>
                    <p class="mt-6 text-base-content">Exploring the Boundless Horizons of Technology</p>
                    <x-splade-form class="mx-auto flex flex-row ">
                        <div class="flex mx-auto space-x-2">
                            <x-splade-input name="search" float="true" label="Search.." size="60" />
                            <x-splade-submit label="Search" class="my-5 bg-base-content text-base-200 border-0" />
                        </div>
                    </x-splade-form>
                </div>
            </div>
        </x-slot>
    </x-home-navbar>
    <div class="container px-6 py-3 mx-auto">
        <h1 class="mb-4 font-semibold text-2xl text-base-content">Recent blog posts</h1>
        <div class="lg:flex lg:-mx-6">
            <div class="lg:w-1/2 lg:px-6">

                <img class="object-cover object-center w-full h-80 xl:h-[20rem] rounded-md"
                    src="{{ asset('default.jpg') }}" alt="">
                <div class="mt-4">
                    <p class="text-xs font-medium text-base-content mb-2">Olivia Rythle - 20 Jan 2024</p>
                    <h1 class="max-w-lg text-2xl font-semibold leading-tight text-base-content">
                        What do you want to know about UI
                    </h1>

                    <div class="flex items-center mt-6">

                        <p class="text-md font-medium text-base-content">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, distinctio fuga! Ipsa
                            amet eveniet obcaecati maiores excepturi delectus rerum magnam.
                        </p>

                    </div>
                    <div class="my-3 space-x-3">
                        <div class="badge badge-outline border-2 border-secondary-focus  text-base-content">Technology
                        </div>
                        <div class="badge badge-outline border-2 text-base-content">#tutorial</div>
                        <div class="badge badge-outline border-2 text-base-content">#design</div>
                    </div>
                </div>
            </div>

            <div class="mt-8 lg:w-1/2 lg:mt-0 lg:px-6 space-y-8">
                <div class="space-y-8">
                    <div class="sm:flex lg:items-end group">
                        <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-4">
                            <img class="w-full rounded-md h-56 md:h-60 lg:h-48 lg:w-40 object-cover object-center"
                                src="{{ asset('default.jpg') }}" alt="default image">
                        </div>
                        <div>
                            <span class="text-sm text-base-content font-medium">User - 19 Jan 2024</span>
                            <p class="mt-3 text-lg font-medium leading-6">
                                <a href="./blog-post.html" class="text-lg text-base-content lg:text-xl font-semibold">12
                                    Graphic
                                    Design Skills You Need To Get Hired (&amp; How to Develop Them) </a>
                            </p>
                            <p class="mt-2 text-md text-base-content">Lorem ipsum dolor sit amet consectetur adipisicing
                                elit. A possimus, eius iusto provident eum neque.</p>
                            <div class="mt-2 space-x-2">
                                <div class="badge badge-outline border-2 border-secondary-focus  text-base-content">
                                    Technology
                                </div>
                                <div class="badge badge-outline border-2 text-base-content">#tutorial</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:flex lg:items-end group">
                        <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-4">
                            <img class="w-full rounded-md h-56 md:h-60 lg:h-48 lg:w-40 object-cover"
                                src="{{ asset('default.jpg') }}" alt="default image">
                        </div>
                        <div>
                            <span class="text-sm text-base-content font-medium">User - 19 Jan 2024</span>
                            <p class="mt-3 text-lg font-medium leading-6">
                                <a href="./blog-post.html" class="text-lg text-base-content lg:text-xl font-semibold">12
                                    Graphic
                                    Design Skills You Need To Get Hired (&amp; How to Develop Them) </a>
                            </p>
                            <p class="mt-2 text-md text-base-content">Lorem ipsum dolor sit amet consectetur adipisicing
                                elit. A possimus, eius iusto provident eum neque.</p>
                            <div class="mt-2 space-x-2">
                                <div class="badge badge-outline border-2 border-secondary-focus  text-base-content">
                                    Technology
                                </div>
                                <div class="badge badge-outline border-2 text-base-content">#tutorial</div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:flex lg:items-end group">
                        <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-4">
                            <img class="w-full rounded-md h-56 md:h-60 lg:h-48 lg:w-40 object-cover"
                                src="{{ asset('default.jpg') }}" alt="default image">
                        </div>
                        <div>
                            <span class="text-sm text-base-content font-medium">User - 19 Jan 2024</span>
                            <p class="mt-3 text-lg font-medium leading-6">
                                <a href="./blog-post.html" class="text-lg text-base-content lg:text-xl font-semibold">12
                                    Graphic
                                    Design Skills You Need To Get Hired (&amp; How to Develop Them) </a>
                            </p>
                            <p class="mt-2 text-md text-base-content">Lorem ipsum dolor sit amet consectetur adipisicing
                                elit. A possimus, eius iusto provident eum neque.</p>
                            <div class="mt-2 space-x-2">
                                <div class="badge badge-outline border-2 border-secondary-focus  text-base-content">
                                    Technology
                                </div>
                                <div class="badge badge-outline border-2 text-base-content">#tutorial</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <h1 class="mt-14 mb-5 font-semibold text-2xl text-base-content">All blog posts</h1>
        <div class="mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl py-4">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 sm:mx-auto lg:max-w-full">
                <div class="overflow-hidden transition-shadow duration-300 rounded shadow-sm">
                    <img src="{{ asset('default.jpg') }}" class="object-cover w-full h-48 sm:h-56" alt="" />
                    <div class="pt-5">
                        <p class="mb-3 text-xs font-semibold tracking-wide uppercase">
                            <span class="text-base-content">User — 28 Dec 2020</span>
                        </p>
                        <a href="/"
                            class="text-base-content inline-block mb-3 text-xl font-semibold transition-colors duration-200">Lorem
                            ipsum dolor sit amet consectetur adipisicing elit. Quia animi corporis dicta aspernatur.</a>
                        <p class="mb-2 text-base-content">
                            Sed ut perspiciatis unde omnis iste natus error sit sed quia consequuntur magni voluptatem
                            doloremque.
                        </p>
                        <div class="mt-4 space-x-2">
                            <div class="badge badge-outline border-2 border-secondary-focus  text-base-content">
                                Technology
                            </div>
                            <div class="badge badge-outline border-2 text-base-content">#tutorial</div>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden transition-shadow duration-300 rounded shadow-sm">
                    <img src="{{ asset('default.jpg') }}" class="object-cover w-full h-48 sm:h-56" alt="" />
                    <div class="pt-5">
                        <p class="mb-3 text-xs font-semibold tracking-wide uppercase">
                            <span class="text-base-content">User — 28 Dec 2020</span>
                        </p>
                        <a href="/"
                            class="text-base-content inline-block mb-3 text-xl font-semibold transition-colors duration-200">Lorem
                            ipsum dolor sit amet consectetur adipisicing elit. Quia animi corporis dicta aspernatur.</a>
                        <p class="mb-2 text-base-content">
                            Sed ut perspiciatis unde omnis iste natus error sit sed quia consequuntur magni voluptatem
                            doloremque.
                        </p>
                        <div class="mt-4 space-x-2">
                            <div class="badge badge-outline border-2 border-secondary-focus  text-base-content">
                                Technology
                            </div>
                            <div class="badge badge-outline border-2 text-base-content">#tutorial</div>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden transition-shadow duration-300 rounded shadow-sm">
                    <img src="{{ asset('default.jpg') }}" class="object-cover w-full h-48 sm:h-56" alt="" />
                    <div class="pt-5">
                        <p class="mb-3 text-xs font-semibold tracking-wide uppercase">
                            <span class="text-base-content">User — 28 Dec 2020</span>
                        </p>
                        <a href="/"
                            class="text-base-content inline-block mb-3 text-xl font-semibold transition-colors duration-200">Lorem
                            ipsum dolor sit amet consectetur adipisicing elit. Quia animi corporis dicta aspernatur.</a>
                        <p class="mb-2 text-base-content">
                            Sed ut perspiciatis unde omnis iste natus error sit sed quia consequuntur magni voluptatem
                            doloremque.
                        </p>
                        <div class="mt-4 space-x-2">
                            <div class="badge badge-outline border-2 border-secondary-focus  text-base-content">
                                Technology
                            </div>
                            <div class="badge badge-outline border-2 text-base-content">#tutorial</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-guest-layout>