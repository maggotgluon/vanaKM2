<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register new Document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class='md:grid md:grid-cols-3 md:gap-6'>
                <x-jet-section-title>
                    <x-slot name="title">{{ __('Register new Document') }}</x-slot>
                    <x-slot name="description">
                        {{ __('Requester Information') }}<br>

                        {{__('Name')}} : {{Auth::User()->name}}<br>
                        {{__('Staff ID')}} : {{Auth::User()->staff_id}}<br>
                        {{__('Department')}} : {{Auth::User()->department}}<br>
                        {{__('Department Head')}} : {{App\Models\User::find(Auth::User()->department_head)->name}}<br>


                    </x-slot>

                </x-jet-section-title>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <livewire:document-request-form />
                </div>
            </div>




        </div>
    </div>


</x-app-layout>
