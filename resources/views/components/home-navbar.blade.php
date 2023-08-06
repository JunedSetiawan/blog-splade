<x-splade-toggle data="isOpen">
    <section class="bg-base-100 border-t-4 border-secondary">
        <nav class="container p-5 mx-auto lg:flex lg:justify-between lg:items-center">
            <div class="flex items-center justify-between">
                <a href="#">
                    Blog Post Splade
                </a>

                <!-- Mobile menu button -->
                <div class="flex lg:hidden">
                    <button @click.prevent="toggle('isOpen')" type="button"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400"
                        aria-label="toggle menu">
                        <svg v-if="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                        </svg>

                        <svg v-if="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div :class="isOpen ? 'translate-x-0 opacity-100' : 'opacity-0 -translate-x-full'"
                class="font-semibold absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-base-100 shadow-md lg:bg-transparent lgent lg:shadow-none lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:w-auto lg:opacity-100 lg:translate-x-0 lg:flex lg:items-center">
                <div class="flex flex-col space-y-4 lg:mt-0 lg:flex-row lg:-px-8 lg:space-y-0">
                    <a class="text-base-content transition-colors duration-300 transform lg:mx-6 hover:text-secondary-focus"
                        href="#">Home</a>
                    <a class="text-base-content transition-colors duration-300 transform lg:mx-6 hover:text-secondary-focus"
                        href="#">Components</a>
                    <a class="text-base-content transition-colors duration-300 transform lg:mx-6 hover:text-secondary-focus"
                        href="#">Pricing</a>
                    <a class="text-base-content transition-colors duration-300 transform lg:mx-6 hover:text-secondary-focus"
                        href="#">Contact</a>
                </div>
                @if (Route::has('login'))
                @auth
                <Link href="{{ url('/dashboard') }}"
                    class="lg:flex block mt-4 text-sm text-center  btn btn-outline  capitalize bg-base-100 rounded-lg lg:mt-0 lg:w-auto">
                Dashboard
                </Link>
                @else
                <Link
                    class="lg:flex block px-5 py-2 mt-4 text-sm text-center btn btn-outline  capitalize bg-base-100 rounded-lg lg:mt-0 lg:w-auto"
                    href="{{ url('login') }}">
                Get Started
                </Link>
                @endauth
                @endif
            </div>
        </nav>
        {{ $hero ?? '' }}
    </section>
</x-splade-toggle>