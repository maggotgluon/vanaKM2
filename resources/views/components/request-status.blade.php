<span class="inline">
    @switch( $status )
        @case(2)
            <x-badge outline positive label="{{__('Approved')}}" />
            @break
        @case(1)
            <x-badge outline blue label="{{__('Reviewed')}}" />
            @break
        @case(0)
            <x-badge outline slate label="{{__('Pending')}}" />
            @break
        @case(-1)
            <x-badge outline negative label="{{__('Rejected')}}" />
            @break
        @default
            <x-badge outline negative label="{{$status}}" />
            Null
    @endswitch
</span>
