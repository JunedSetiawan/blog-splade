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
    <div class="container px-6 py-6 mx-auto">
        <h1 class="mb-4 font-semibold text-2xl">Recent blog posts</h1>
        <div class="lg:flex lg:-mx-6">
            <div class="lg:w-1/2 lg:px-6">

                <img class="object-cover object-center w-full h-80 xl:h-[20rem] rounded-md"
                    src="https://images.unsplash.com/photo-1624996379697-f01d168b1a52?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                    alt="">

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
                        <div class="badge badge-outline border-secondary-focus">Technology</div>
                        <div class="badge badge-outline">#tutorial</div>
                        <div class="badge badge-outline">#design</div>
                    </div>
                </div>
            </div>

            <div class="mt-8 lg:w-1/2 lg:mt-0 lg:px-6 space-y-8">




            </div>
        </div>
    </div>

</x-guest-layout>