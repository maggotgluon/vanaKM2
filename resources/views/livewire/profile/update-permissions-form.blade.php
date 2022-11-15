

<x-jet-form-section submit="updatePermission">
    <x-slot name="title">
        {{ __('User permission section') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update user account\'s permission information') }}
    </x-slot>

    <x-slot name="form">
        <div class="max-w-xl text-sm text-gray-600 col-span-6 sm:col-span-6">
            {{ __('User permission section') }}
        </div>

        <!-- {{Auth::user()}} -->
        <!-- <form action="alert('true')" wire:submit.prevent="add"> -->
            <!-- csrf -->
            <div class="col-span-3 sm:col-span-3">
                <x-native-select label="{{__('Permission Type')}}" :options="[
                        ['name' => 'Paemission', 'id' => 'permission'],
                                ]" option-label="name" option-value="id" wire:model="type"
                                wire:onchange="updateType"/>
            </div>

            <div class="col-span-3 sm:col-span-3">
                <x-native-select label="{{__('Permission Type')}}" placeholder="{{__('Please select')}} {{__('Permission Type')}}" :options="[

                        ['name' => '---- Document Section ----', 'id' => 'x','disabled'=>true],

                        ['name' => 'Request document', 'id' => 'edit_document'],
                        ['name' => 'Manage document', 'id' => 'review_document'],
                        ['name' => 'Publish document', 'id' => 'publish_document'],

                        ['name' => '---- Training Section ----', 'id' => 'x','disabled'=>true],

                        ['name' => 'Request training Document', 'id' => 'edit_trainDocument'],
                        ['name' => 'Manage training Document', 'id' => 'review_trainDocument'],
                        ['name' => 'Publish training Document', 'id' => 'publish_trainDocument'],

                        ['name' => '---- Admin Section ----', 'id' => 'x','disabled'=>true],

                        ['name' => 'Manage users', 'id' => 'manage_users'],
                        ['name' => 'View log', 'id' => 'view_log'],
                        ]" option-label="name" option-value="id" wire:model="permission" />
            </div>

            <!-- <x-jet-button class="float-right">
                {{ __('Add') }}
            </x-jet-button> -->

        <!-- </form> -->
    </x-slot>

    <x-slot name="actions">

        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>

