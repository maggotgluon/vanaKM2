<div class="flex justify-between mb-6">
    <x-dropdown align="left" wire:model="req_status">
        <x-slot name="trigger">
            <x-button label="{{ __('Request Status') }}" primary />
        </x-slot>

            <x-dropdown.item label="{{__('Approved')}}" value="a1" wire:model="search"/>
            <x-dropdown.item label="{{__('Reviewed')}}" value="a2" wire:model="search"/>
            <x-dropdown.item label="{{__('Pending')}}"  value="a3" wire:model="search"/>
            <x-dropdown.item label="{{__('Rejected')}}" value="a4" wire:model="search"/>

    </x-dropdown>

    <x-input placeholder="Search" wire:model="search">
        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                <x-button
                    wire:click="search"
                    class="h-full rounded-r-md"
                    icon="search"
                    primary
                    flat
                    squared
                />
            </div>
        </x-slot>
    </x-input>
</div>

<div>
    <table class="w-full">
        <thead>
            <tr class="bg-gray-300">
                <th class="p-4 hidden md:table-cell w-1/12 rounded-tl-lg">dar</th>
                <th class="p-4 hidden md:table-cell w-1/12 border">type</th>
                <th class="p-4 hidden md:table-cell w-1/12 border">name</th>
                <th class="p-4 hidden md:table-cell w-1/12 border">update</th>
                <th class="p-4 hidden md:table-cell w-1/12 border">status</th>
                <th class="p-4 hidden md:table-cell w-1/12 rounded-tr-lg">action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr class="even:bg-gray-200">
                    <td class="p-2 block md:table-cell">{{$request->req_code}}</td>
                    <td class="p-2 block md:table-cell">{{$request->doc_type}}</td>
                    <td class="p-2 block md:table-cell">{{$request->doc_name}}</td>
                    <td class="p-2 block md:table-cell">{{$request->updated_at}}</td>
                    <td class="p-2 block md:table-cell md:text-center">
                        <x-request-status status="{{$request->req_status}}"/>
                    </td>
                    <td class="p-2 block md:table-cell">
                        <x-button.circle info icon="eye"/>
                        <x-button.circle primary icon="check"/>
                        <x-button.circle positive icon="inbox-in"/>
                        <x-button.circle negative icon="x"/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
