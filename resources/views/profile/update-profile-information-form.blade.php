<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]); " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="staff_id" value="{{ __('Staff ID') }}" />
            @can('manage_users')
                <x-jet-input id="staff_id" type="text" class="mt-1 block w-full" wire:model.defer="state.staff_id"/>
                <x-jet-input-error for="staff_id" class="mt-2" />
            @else
                {{$this->state['staff_id']}}
            @endcan
        </div>
        <!-- Email -->
        <div class="col-span-6 sm:col-span-6">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>




        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="department" value="{{ __('Department') }}" />

            @can('manage_users')
            <!-- <x-jet-input id="department" type="text" class="mt-1 block w-full" wire:model.defer="state.department"/> -->
            <select wire:model.defer="state.department" class="bg-backdrop w-full  border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="department" id="department">
                <option value="null">All</option>
                <option value="Admissions">Admissions</option>
                <option value="Engineering">Engineering</option>
                <option value="Executive Office">Executive Office</option>
                <option value="Finance">Finance</option>
                <option value="Food and Beverage">Food and Beverage</option>
                <option value="Human Resources">Human Resources</option>
                <option value="IT">IT</option>
                <option value="Laundry">Laundry</option>
                <option value="Marketing">Marketing</option>
                <option value="Operations">Operations</option>
                <option value="Park Service">Park Service</option>
                <option value="Retail">Retail</option>
                <option value="Sales">Sales</option>

                <option value="Event">Event</option>
                <option value="Training">Training</option>
                <option value="Purchasing">Purchasing</option>
            </select>

            <x-jet-input-error for="department" class="mt-2" />
            @else
                {{$this->state['department']}}
            @endcan
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="position" value="{{ __('Position') }}" />
            @can('manage_users')
            <x-jet-input id="position" type="text" class="mt-1 block w-full" wire:model.defer="state.position"/>
            <x-jet-input-error for="position" class="mt-2" />
            @else
                {{$this->state['position']}}
            @endcan
        </div>
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="department_head" value="{{ __('Department Head') }}" />
            <!-- <x-jet-input id="department_head" type="text" class="mt-1 block w-full" wire:model.defer="state.department_head"/> -->

            <select wire:model.defer="state.department_head" class="bg-backdrop w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="department_head" id="department_head">
                @foreach ( Auth::user()->HOD() as $hod )
                    <option value="{{$hod->id}}">{{$hod->name}}</option>
                @endforeach
            </select>

            <x-jet-input-error for="department_head" class="mt-2" />

        </div>

        @can('manage_users' , Auth::user())
        <div class="col-span-6 sm:col-span-3">
            <x-jet-label for="user_level" value="{{ __('Level') }}" />
            <!-- <x-jet-input id="user_level" type="text" class="mt-1 block w-full" wire:model.defer="state.user_level"/> -->
            <select wire:model.defer="state.user_level" class="bg-backdrop w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"  name="user_level" id="user_level">
                <option value="1">1 : User</option>
                <option value="2">2 : Requester</option>
                <option value="3">3 : Acknowledgment</option>
                <option value="4">4 : Reviewer-TN</option>
                <option value="5">5 : Approver-TN</option>
                <option value="6">6 : Reviewer-DCC</option>
                <option value="7">7 : Approver-DCC</option>
                <option disabled> ---- For System Test Only ---- </option>
                <option value="99">99 : Admin</option>
            </select>
            <x-jet-input-error for="user_level" class="mt-2" />
        </div>
        @endcan
        <div class="col-span-6 sm:col-span-6">
            <table class="w-full">
                <thead>
                    <th class="text-center p-2">
                        <td class="border text-center p-2">{{__('View')}}</td>
                        <td class="border text-center p-2">{{__('Request')}}</td>
                        <td class="border text-center p-2">{{__('Review')}}</td>
                        <td class="border text-center p-2">{{__('Approved')}}</td>
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td class="border">{{__('Document')}}</td>
                        <td class="border text-center p-2">
                            <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </td>
                        <td class="border text-center p-2">
                            @can('edit_document')
                                <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @else
                                <svg class="m-auto text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M10 14L12 12M12 12L14 10M12 12L10 10M12 12L14 14M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @endcan
                        </td>
                        <td class="border text-center p-2">

                            @can('review_document')
                                <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @else
                                <svg class="m-auto text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M10 14L12 12M12 12L14 10M12 12L10 10M12 12L14 14M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @endcan
                        </td>
                        <td class="border text-center p-2">

                            @can('publish_document')
                                <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @else
                                <svg class="m-auto text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M10 14L12 12M12 12L14 10M12 12L10 10M12 12L14 14M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @endcan
                        </td>
                    </tr>
                    <tr>
                        <td class="border">{{__('Training')}}</td>
                        <td class="border text-center p-2">
                                <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                        </td>
                        <td class="border text-center p-2">

                            @can('edit_trainDocument')
                                <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @else
                                <svg class="m-auto text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M10 14L12 12M12 12L14 10M12 12L10 10M12 12L14 14M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @endcan
                        </td>
                        <td class="border text-center p-2">

                            @can('review_trainDocument')
                                <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @else
                                <svg class="m-auto text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M10 14L12 12M12 12L14 10M12 12L10 10M12 12L14 14M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @endcan
                        </td>
                        <td class="border text-center p-2">

                            @can('publish_trainDocument')
                                <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @else
                                <svg class="m-auto text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M10 14L12 12M12 12L14 10M12 12L10 10M12 12L14 14M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @endcan
                        </td>
                    </tr>
                    <th class="text-center p-2">
                        <td class="border text-center p-2" colspan="2">{{__('View')}}</td>
                        <td class="border text-center p-2" colspan="2">{{__('Manage')}}</td>
                    </th>
                    <tr>
                        <td class="border">{{__('User')}}</td>
                        <td class="border text-center p-2" colspan="2">
                            <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </td>
                        <td class="border text-center p-2" colspan="2">

                            @can('manage_users')
                                <svg class="m-auto text-brand_green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @else
                                <svg class="m-auto text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M10 14L12 12M12 12L14 10M12 12L10 10M12 12L14 14M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            @endcan

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-slot>



    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
