<div x-data="{ open: false }">
    <!-- Toggle Button -->
    <button @click="open = !open" class="p-2 m-4 text-gray-700 bg-gray-200 rounded-md">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Sidebar Navigation -->
    <nav :class="{'block': open, 'hidden': !open}" class="bg-white border-r border-gray-100 h-screen fixed hidden">
        <div class="w-64 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between h-screen">
                <div>
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center my-4">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo" class="w-10">
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="space-y-4">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        @role('owner|teacher')
                        <x-nav-link :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.index')">
                            {{ __('Manage Courses') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.quiz_questions.index')" :active="request()->routeIs('admin.quiz_questions.index')">
                            {{ __('Manage Quiz Questions') }}
                        </x-nav-link>
                        @endrole
                        @role('owner')
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">
                            {{ __('Manage Categories') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.index')">
                            {{ __('Manage Teachers') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.subscribe_transactions.index')" :active="request()->routeIs('admin.subscribe_transactions.index')">
                            {{ __('Manage Subscriptions') }}
                        </x-nav-link>
                        <x-nav-link :href="route('front.certificate.store')" :active="request()->routeIs('certificates.index')">
                            Create New Certificate
                        </x-nav-link>
                        @endrole
                        <x-nav-link :href="route('front.index')" :active="request()->routeIs('front.index')">
                            {{ __('Home') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="mb-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('front.index')"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="ml-64 p-4" :class="{'ml-0': !open, 'ml-64': open}">
        <!-- Logout Button -->
        <div class="flex justify-end mb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>

        <!-- Your main page content here -->
    </div>
</div>
