<x-guest-layout>
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{__('Dashboard')}}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{__('Log in')}}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">{{__('Register')}}</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl  mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    
                        <x-application-logo class="w-64 fill-current text-gray-500" />
                    
                </div>
                <div class="flex justify-center gap-4 mt-16">
                
                @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-brand_blue text-sm text-brand_yellow hover:text-brand_orange hover:scale-110 px-8 py-4 rounded-lg hover:bg-brand_green transition-all duration-500 shadow hover:shadow-xl uppercase font-bold shadow-brand_yellow"></a>
                        @else
                            <x-button href="{{ route('login') }}">{{__('Log in')}}</x-button>

                            @if (Route::has('register'))
                                <x-button href="{{ route('register') }}">{{__('Register')}}</x-button>
                            @endif
                        @endauth
                @endif
                </div>

            </div>
        </div>
</x-guest-layout>