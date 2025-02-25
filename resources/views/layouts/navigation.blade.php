<div x-data="{ open: false }" class="relative">
    <!-- Overlay -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity" @click="open = false"></div>

    <!-- Toggle Button -->
    <button @click="open = !open" class="fixed top-4 left-4 z-50 p-2 text-white bg-[#2597D4] rounded-md transition duration-300 hover:bg-white hover:text-[#2597D4]">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Sidebar Navigation -->
    <nav :class="{ 'translate-x-0': open, '-translate-x-full': !open }" class="fixed top-0 left-0 h-full w-64 bg-[#2597D4] border-r border-gray-100 z-50 transform transition-transform duration-300 ease-in-out">
        <div class="w-64 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between h-full">
                <!-- Logo -->
                <div class="my-4">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo" class="w-20">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-y-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @role('owner|teacher')
                        <x-nav-link :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                            {{ __('Manage Courses') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.quiz_questions.index')" :active="request()->routeIs('admin.quiz_questions.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                            {{ __('Manage Quiz Questions') }}
                        </x-nav-link>
                    @endrole

                    @role('owner')


                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                            {{ __('Manage Categories') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                            {{ __('Manage Teachers') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.subscribe_transactions.index')" :active="request()->routeIs('admin.subscribe_transactions.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                            {{ __('Manage Subscriptions') }}
                        </x-nav-link>
                        <x-nav-link :href="route('front.certificate.store')" :active="request()->routeIs('certificates.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                            {{ __('Create New Certificate') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.coupons.index')" :active="request()->routeIs('admin.coupons.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                            {{ __('Create Coupon') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.paket.pakets.index')" :active="request()->routeIs('admin.coupons.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                            {{ __('Create Pakets') }}
                        </x-nav-link>
                    @endrole


                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div x-data="{ open: false }" class="relative">
        <!-- Overlay -->
        <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity" @click="open = false"></div>

        <!-- Toggle Button -->
        <button @click="open = !open" class="fixed top-4 left-4 z-50 p-2 text-white bg-[#2597D4] rounded-md transition duration-300 hover:bg-white hover:text-[#2597D4]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Sidebar Navigation -->
        <nav :class="{ 'translate-x-0': open, '-translate-x-full': !open }" class="fixed top-0 left-0 h-full w-64 bg-[#2597D4] border-r border-gray-100 z-50 transform transition-transform duration-300 ease-in-out">
            <div class="w-64 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col justify-between h-full">
                    <!-- Logo -->
                    <div class="my-4">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo" class="w-20">
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="space-y-4">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        @role('owner|teacher')
                            <x-nav-link :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                                {{ __('Manage Courses') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.quiz_questions.index')" :active="request()->routeIs('admin.quiz_questions.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                                {{ __('Manage Quiz Questions') }}
                            </x-nav-link>
                        @endrole

                        @role('owner')


                            <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                                {{ __('Manage Categories') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                                {{ __('Manage Teachers') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.subscribe_transactions.index')" :active="request()->routeIs('admin.subscribe_transactions.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                                {{ __('Manage Subscriptions') }}
                            </x-nav-link>
                            <x-nav-link :href="route('front.certificate.store')" :active="request()->routeIs('certificates.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                                {{ __('Create New Certificate') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.coupons.index')" :active="request()->routeIs('admin.coupons.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                                {{ __('Create Coupon') }}
                            </x-nav-link>
                            {{-- <x-nav-link :href="route('admin.paket.pakets.index')" :active="request()->routeIs('admin.coupons.index')" class="text-white hover:text-[#2597D4] hover:bg-white transition duration-300 p-2 rounded-md">
                                {{ __('Create Pakets') }}
                            </x-nav-link> --}}
                        @endrole


                    </div>
                </div>
            </div>
        </nav>


    </div>


 <!-- Main Content -->
 <div :class="{ 'ml-0': !open, 'ml-64': open }" class="ml-auto p-4 max-w-screen-lg w-full transition-all duration-300">
    <!-- Top Bar -->
    <div class="flex justify-end items-center space-x-4 mb-4">
        <!-- Home Button -->
        <x-nav-link :href="route('front.index')" :active="request()->routeIs('front.index')">
            <button class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                {{ __('Home') }}
            </button>
        </x-nav-link>

        <!-- User Dropdown -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-gray-600 focus:outline-none">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>
