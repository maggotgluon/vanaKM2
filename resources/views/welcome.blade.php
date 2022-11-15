<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <x-button href="{{ url('/dashboard') }}">
                    {{__('Dashboard')}}
                </x-button>
            @else
                <x-button href="{{ route('login') }}">
                    {{__('Log in')}}
                </x-button>
                @if (Route::has('register'))
                    <x-button href="{{ route('register') }}">
                        {{__('Register')}}
                    </x-button>
                @endif
            @endauth
        </div>
    @endif

    <div class="py-12 min-h-screen grid place-content-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-visible">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-guest-layout>

