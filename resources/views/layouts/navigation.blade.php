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
                                
                                <div>Document</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">                        
                            <x-dropdown-link :href="route('document')">
                                    {{ __('Document') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('regisDoc')">
                                    {{ __('Register new Document') }}
                            </x-dropdown-link>
                            @cannot('manage_document', Auth::user())
                            @if(Auth::user()->document_request->count()>0)
                            <x-dropdown-link :href="route('regisOwn')">
                                    {{ __('My Registed Document') }}
                            </x-dropdown-link>
                            @endif
                            @endcan
                            
                            @can('manage_document', Auth::user())
                                <x-dropdown-link :href="route('regisManage')">
                                        {{ __('Registed Document Management') }}
                                </x-dropdown-link>
                            @endcan
                        </x-slot>

                    </x-dropdown-nav>
                    @else
                        <x-nav-link :href="route('document')" :active="request()->routeIs('document')">
                            {{ __('Document') }}
                        </x-nav-link>
                    

                    @endcan

                    @can('edit_document', Auth::user())
                    <x-dropdown-nav align="top" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>Training</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">                        
                            <x-dropdown-link :href="route('training')">
                                    {{ __('Training') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('regisTrain')">
                                    {{ __('Add new Training Presentation') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('regisTrainOwn')">
                                    {{ __('My Presentation') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('regisTrainManage')">
                                    {{ __('Training Management') }}
                            </x-dropdown-link>
                        </x-slot>

                    </x-dropdown-nav>
                    @else
                        <x-nav-link>
                            {{ __('Training') }}
                        </x-nav-link>
                    @endcan

                    @can('manage_users', Auth::user())
                    <x-nav-link :href="route('userManage')" :active="request()->routeIs('userManage')">
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
                        <x-responsive-nav-link :href="route('userProfile',Auth::user())">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
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

            <x-responsive-nav-link :href="route('document')" :active="request()->routeIs('document')">
                {{ __('document') }}
            </x-responsive-nav-link>

            @can('edit_document', Auth::user())
                <x-responsive-nav-link :href="route('regisDoc')" :active="request()->routeIs('regisDoc')">
                    {{ __('regisDoc') }}
                </x-responsive-nav-link>
                @cannot('manage_document', Auth::user())
                    @if(Auth::user()->document_request->count()>0)
                        <x-responsive-nav-link :href="route('regisOwn')" :active="request()->routeIs('regisOwn')">
                            {{ __('regisOwn') }}
                        </x-responsive-nav-link>
                    @endif
                @endcan
                
                @can('manage_document', Auth::user())
                    <x-responsive-nav-link :href="route('regisManage')" :active="request()->routeIs('regisManage')">
                        {{ __('regisManage') }}
                    </x-responsive-nav-link>
                @endcan
            @endcan

            <x-responsive-nav-link>
                {{ __('training') }}
            </x-responsive-nav-link>
            @can('edit_document', Auth::user())
                <x-responsive-nav-link>
                    {{ __('add training') }}
                </x-responsive-nav-link>
                @cannot('manage_document', Auth::user())
                    @if(Auth::user()->document_request->count()>0)
                        <x-responsive-nav-link>
                            {{ __('my training') }}
                        </x-responsive-nav-link>
                    @endif
                @endcan
                @can('manage_document', Auth::user())
                    <x-responsive-nav-link>
                        {{ __('manage training') }}
                    </x-responsive-nav-link>
                @endcan
            @endcan

            @can('manage_users', Auth::user())
            <x-responsive-nav-link :href="route('userManage')" :active="request()->routeIs('userManage')">
                {{ __('Manage User') }}
            </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <x-responsive-nav-link :href="route('userProfile',Auth::user())">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
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
