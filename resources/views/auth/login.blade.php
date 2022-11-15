<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <!-- <x-jet-label for="staff_id" value="{{ __('Staff ID') }}" /> -->
                <x-input label="{{ __('Staff ID') }}" id="staff_id" class="block mt-1 w-full"
                type="text" name="staff_id" :value="old('staff_id')" required autofocus />
            </div>

            <div class="mt-4">
                <!-- <x-jet-label for="password" value="{{ __('Password') }}" /> -->
                <x-input label="{{ __('Password') }}" id="password" class="block mt-1 w-full"
                type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))

                    <x-button outline secondary href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </x-button>
                    <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a> -->
                @endif

                <x-button primary type="submit" class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
