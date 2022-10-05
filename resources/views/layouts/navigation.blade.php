<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @can('edit_document', Auth::user())
                    <x-dropdown-nav align="top" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                                <div>{{ __('Document') }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-responsive-nav-link :href="route('document.all')"  :active="request()->routeIs('document.all')">
                                    {{ __('Document') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link :href="route('regDoc.create')"  :active="request()->routeIs('regDoc.create')">
                                    {{ __('Register new Document') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link :href="route('regDoc.allUser',Auth::User())"  :active="request()->routeIs('regDoc.allUser')">
                                    {{ __('My Registed Document') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link :href="route('regDoc.all')"  :active="request()->routeIs('regDoc.all')">
                                    {{ __('Registed Document Management') }}
                            </x-responsive-nav-link>

                        </x-slot>

                    </x-dropdown-nav>
                    @else
                    <x-nav-link :href="route('document.all')">
                        {{ __('Document') }}
                    </x-nav-link>
                    @endcan

                    @can('edit_trainDocument', Auth::user())
                    <x-dropdown-nav align="top" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>
                                    {{ __('Training') }}
                                </div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-responsive-nav-link :href="route('training.all')" :active="request()->routeIs('training.all')">
                                    {{ __('Training') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link :href="route('regTraining.create')" :active="request()->routeIs('regTraining.create')">
                                    {{ __('Add new Training Presentation') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link :href="route('regTraining.allUser',Auth::User())" :active="request()->routeIs('regTraining.allUser')">
                                    {{ __('My Presentation') }}
                            </x-responsive-nav-link>

                            <x-responsive-nav-link :href="route('regTraining.all')" :active="request()->routeIs('regTraining.all')">
                                    {{ __('Training Management') }}
                            </x-responsive-nav-link>
                        </x-slot>

                    </x-dropdown-nav>
                    @else
                        <x-nav-link :href="route('training.all')">
                            {{ __('Training') }}
                        </x-nav-link>
                    @endcan



                    @can('manage_users', Auth::user())
                    <x-nav-link :href="route('user.manage')" :active="request()->routeIs('user.manage')">
                        {{ __('Manage User') }}
                    </x-nav-link>
                    @endcan



                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <x-responsive-nav-link :href="route('user.profile',Auth::user())" :active="request()->routeIs('user.profile')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        @can('view_log', Auth::user())
                        <x-responsive-nav-link :href="url('log-viewer')">
                            {{ __('View Log') }}
                        </x-responsive-nav-link>
                        @endcan
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link>
                {{ __('document') }}
            </x-responsive-nav-link>

                <x-responsive-nav-link>
                    {{ __('regisDoc') }}
                </x-responsive-nav-link>
                        <x-responsive-nav-link>
                            {{ __('regisOwn') }}
                        </x-responsive-nav-link>

                    <x-responsive-nav-link>
                        {{ __('regisManage') }}
                    </x-responsive-nav-link>

            <x-responsive-nav-link>
                {{ __('training') }}
            </x-responsive-nav-link>
                <x-responsive-nav-link>
                    {{ __('add training') }}
                </x-responsive-nav-link>
                        <x-responsive-nav-link>
                            {{ __('my training') }}
                        </x-responsive-nav-link>
                    <x-responsive-nav-link>
                        {{ __('manage training') }}
                    </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('user.manage')">
                {{ __('Manage User') }}
            </x-responsive-nav-link>


        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            
            <x-responsive-nav-link :href="route('user.profile',Auth::user())" :active="request()->routeIs('user.profile')">
                {{ Auth::user()->name }}
            </x-responsive-nav-link>


            <x-responsive-nav-link :href="route('user.profile',Auth::user())" :active="request()->routeIs('user.profile')">
                {{ __('View Log') }}
            </x-responsive-nav-link>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
