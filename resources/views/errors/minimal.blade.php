
<title>@yield('title')</title>

<x-guest-layout>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class=" mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pt-8 justify-center sm:pt-0 flex-wrap">
                    <x-jet-authentication-card-logo />
                    <div class="flex items-center ">

                        <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                        {{__('error')}}
                        @yield('code')
                        </div>

                        <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                            @yield('message')
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <x-jet-section-border />
                    Please Contact  <x-button flat primary label="IT Support" /> or
                    <x-button flat primary href="{{url()->previous()}}" label="Try again" />
                </div>
            </div>
        </div>


</x-guest-layout>
