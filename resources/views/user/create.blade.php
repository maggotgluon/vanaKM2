<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-jet-authentication-card>
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('user.register') }}">
                @csrf

                <div>
                    <!-- <x-jet-label for="name" value="{{ __('Name') }}" /> -->
                    <x-input label="{{ __('Name') }}" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                <div class="mt-4">
                <x-input label="{{__('Staff ID')}}" name="staff_id"/>
                </div>
                <div class="mt-4">
                <x-input label="{{__('Position')}}" name="position"/>
                </div>
                <div class="mt-4">
                    <x-native-select label="{{__('Department')}}" name="department" id="department">
                        <!-- <option value="null">All</option> -->
                        <option value="Admissions" >Admissions</option>
                        <option value="Engineering" >Engineering</option>
                        <option value="Executive Office">Executive Office</option>
                        <option value="Finance" >Finance</option>
                        <option value="Food and Beverage" d':>Food and Beverage</option>
                        <option value="Human Resources">Human Resources</option>
                        <option value="IT" >IT</option>
                        <option value="Laundry" >Laundry</option>
                        <option value="Marketing" >Marketing</option>
                        <option value="Operations" >Operations</option>
                        <option value="Park Service">Park Service</option>
                        <option value="Retail" >Retail</option>
                        <option value="Sales" >Sales</option>
                    </x-native-select>
                </div>

                <div class="mt-4">

                <x-native-select label="User Level" name="user_level" id="user_level" wire:model.defer="state.status">

                    <option value="1">1 : User</option>
                    <option value="2">2 : Requester</option>
                    <option value="3">3 : Acknowledgment</option>
                    <option value="4">4 : Reviewer-TN</option>
                    <option value="5">5 : Approver-TN</option>
                    <option value="6">6 : Reviewer-DCC</option>
                    <option value="7">7 : Approver-DCC</option>
                    <option disabled> ---- For System Test Only ---- </option>
                    <option value="99">99 : Admin</option>

                </x-native-select>
                </div>

                <div class="mt-4">
                    <!-- <x-label for="email" value="{{ __('Email') }}" /> -->
                    <x-input label="{{ __('Email') }}" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                </div>

                <div class="mt-4">
                    <!-- <x-label for="password" value="{{ __('Password') }}" /> -->
                    <x-input label="{{ __('Password') }}" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <!-- <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" /> -->
                    <x-input label="{{ __('Confirm Password') }}" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms" required />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-jet-button class="ml-4">
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
                                    </x-app-layout>
