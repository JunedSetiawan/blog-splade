<x-splade-toggle data="isOpen,isProfileOpen">
    <section class="bg-base-100">
        <div class="absolute inset-x-0 top-0 h-2 bg-gradient-to-l from-pink-500 via-red-500 to-yellow-500"></div>
        <nav class="container p-5 mx-auto lg:flex lg:justify-between lg:items-center">
            <div class="flex items-center justify-between">
                <Link href="/" class="text-base-content font-bold text-xl">
                Blog Post Splade
                </Link>

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
                    <Link
                        class="text-base-content transition-colors duration-300 transform lg:mx-6 hover:text-secondary-focus"
                        href="/">Home</Link>
                    <Link
                        class="text-base-content transition-colors duration-300 transform lg:mx-6 hover:text-secondary-focus"
                        href="{{ route('post.category') }}">Post</Link>
                    <Link
                        class="text-base-content transition-colors duration-300 transform lg:mx-6 hover:text-secondary-focus"
                        href="{{ route('post.category') }}">Categories</Link>
                    <Link
                        class="text-base-content transition-colors duration-300 transform lg:mx-6 hover:text-secondary-focus"
                        href="#">Report</Link>
                </div>
                @if (Route::has('login'))
                    @auth
                        <div class="tooltip tooltip-bottom" data-tip="Profile">
                            <div class="dropdown lg:dropdown-end">
                                <label tabindex="0" class="btn btn-ghost btn-circle avatar mr-2"
                                    @click.prevent="toggle('isProfileOpen')">
                                    <div class="w-10 rounded-full shadow-md">
                                        <img
                                            src="https://api.dicebear.com/6.x/identicon/svg?scale=75&seed={{ Auth::user()->name }}" />
                                    </div>
                                </label>
                                <ul v-show="isProfileOpen" tabindex="0"
                                    class="z-10 menu menu-sm dropdown-content p-2 shadow bg-base-100 rounded-box w-52 space-y-3">
                                    <span class="badge">{{ Auth::user()->name }}</span>
                                    <div class="badge badge-primary badge-outline">{{ Auth::user()->email }}</div>
                                    <li class="my-4">
                                        <Link href="{{ route('dashboard') }}"
                                            class="text-base-content justify-between font-medium">
                                        Dashboard
                                        </Link>
                                    </li>
                                    <li class="my-4">
                                        <Link href="{{ route('profile.edit') }}" class="text-base-content justify-between">
                                        Profile
                                        </Link>
                                    </li>
                                    <li class="my-4">
                                        <Link href="{{ route('logout') }}" method="POST" class="text-base-content">Logout
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
