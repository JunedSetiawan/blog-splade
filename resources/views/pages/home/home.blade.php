<x-guest-layout>
    <x-home-navbar>
        <x-slot name="hero">
            <div class="container px-6 py-16 mx-auto text-center">
                <div class="mx-auto">
                    <h1 class="text-6xl font-bold text-base-content lg:text-4xl">Future Innovation: Shaping the World
                        with
                        New
                        Ideas
                    </h1>
                    <p class="mt-6 text-base-content">Exploring the Boundless Horizons of Technology</p>
                    <x-splade-form class="mx-auto flex flex-row ">
                        <div class="flex mx-auto space-x-2">
                            <x-splade-input name="search" float="true" label="Search.." size="60" />
                            <x-splade-submit label="Search" class="my-5" />
                        </div>
                    </x-splade-form>
                </div>
            </div>
        </x-slot>
    </x-home-navbar>

</x-guest-layout>