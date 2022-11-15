<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Training') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-screen">
                <div class="hidden sm:flex sm:items-center sm:ml-6 m-4">
                    <x-jet-dropdown align="left">
                        <x-slot name="trigger">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                {{ __('Request Status') }}
                                @switch(request()->filter)
                                @case('2')
                                : {{__('Approved')}}
                                @break
                                @case('1')
                                : {{__('Reviewed')}}
                                @break
                                @case('0')
                                : {{__('Pending')}}
                                @break
                                @case('-1')
                                : {{__('Rejected')}}
                                @break
                                @default


                                @endswitch

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-jet-responsive-nav-link href="{{ route('training.request.all') }}">
                                {{ __('Show All') }}
                            </x-jet-responsive-nav-link>

                            <x-jet-responsive-nav-link href="{{ route('training.request.all',['filter'=>2]) }}">
                                {{ __('Approved') }}
                            </x-jet-responsive-nav-link>

                            <x-jet-responsive-nav-link href="{{ route('training.request.all',['filter'=>1]) }}">
                                {{ __('Reviewed') }}
                            </x-jet-responsive-nav-link>

                            <x-jet-responsive-nav-link href="{{ route('training.request.all',['filter'=>0]) }}">
                                {{ __('Pending') }}
                            </x-jet-responsive-nav-link>

                            <x-jet-responsive-nav-link href="{{ route('training.request.all',['filter'=>-1]) }}">
                                {{ __('Rejected') }}
                            </x-jet-responsive-nav-link>

                        </x-slot>
                    </x-jet-dropdown>


                </div>

                @if($trainings->count()>0)
                <table class="m-4">
                    <thead class="bg-gray-300">
                        <tr class="text-center">
                            <td class="border w-1/12 px-2">{{__('Training Code')}}</td>
                            <!-- <td class="border w-min px-2">Department</td> -->
                            <td class="border w-8/12 px-1">{{__('Subject')}}</td>
                            <th class="border w-2/12 px-1 hidden md:table-cell">{{__('Last Update')}}</th>
                            <td class="border w-2/12 px-2">
                                <x-jet-dropdown align="left">
                                    <x-slot name="trigger">
                                        <button type="button" class="inline-flex w-max items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  focus:outline-none transition">

                                            @switch(request()->filter)
                                            @case('2')
                                            {{__('Approved')}}
                                            @break
                                            @case('1')
                                            {{__('Reviewed')}}
                                            @break
                                            @case('0')
                                            {{__('Pending')}}
                                            @break
                                            @case('-1')
                                            {{__('Rejected')}}
                                            @break
                                            @default
                                            {{ __('Request Status') }}
                                            @endswitch

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-jet-responsive-nav-link href="{{ route('training.request.all') }}">
                                            {{ __('Show All') }}
                                        </x-jet-responsive-nav-link>

                                        <x-jet-responsive-nav-link href="{{ route('training.request.all',['filter'=>2]) }}">
                                            {{ __('Approved') }}
                                        </x-jet-responsive-nav-link>

                                        <x-jet-responsive-nav-link href="{{ route('training.request.all',['filter'=>1]) }}">
                                            {{ __('Reviewed') }}
                                        </x-jet-responsive-nav-link>

                                        <x-jet-responsive-nav-link href="{{ route('training.request.all',['filter'=>0]) }}">
                                            {{ __('Pending') }}
                                        </x-jet-responsive-nav-link>

                                        <x-jet-responsive-nav-link href="{{ route('training.request.all',['filter'=>-1]) }}">
                                            {{ __('Rejected') }}
                                        </x-jet-responsive-nav-link>

                                    </x-slot>
                                </x-jet-dropdown>
                            </td>
                            <td class="border w-1/12 px-2">{{__('Action')}}</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($trainings as $training)
                        <tr class="align-text-top hover:bg-brand_blue/10 even:bg-gray-100">
                            <td class="px-2 text-sm md:text-center">
                                {{$training->training_code}}
                            </td>
                            <td class="px-2">
                                <!-- <div id="{{$training->training_code}}_detail" class="hidden py-2"> -->
                                    <x-button onclick="document.querySelector('#{{$training->training_code}}_detail').classList.toggle('hidden')" class="justify-between w-full">
                                        {{$training->training_008->subject}}
                                        <x-icon name="chevron-double-down" class="w-4 h-4 text-gray-500" />
                                    </x-button>
                                    <div id="{{$training->training_code}}_detail" class="hidden">
                                    <x-card shadow="none">
                                            {{__('Instructor')}} : {{App\Models\User::find($training->instructor)->name}}<br>
                                            <x-badge outline label="{{__('Date Strat')}} {{$training->training_008->train_dateStart}} - {{$training->training_008->train_dateEnd}}" />
                                            <x-badge outline label="{{__('Time Strat')}} {{$training->training_008->train_timeStart}} - {{$training->training_008->train_timeEnd}}" />
                                            <x-slot name="footer">
                                            @if ($training->pdf_location)
                                                <x-button icon="download" href="{{route('training.request.download',['file'=>$training->pdf_location,'id'=>$training->id])}}" label="Download PDF"/>
                                            @endif
                                            <x-button icon="document-text" label="FM-LDS-008" href="{{route('training.request.show_008',['id'=>$training->id])}}" target="_blank"/>
                                            <x-button icon="document-text" label="FM-LDS-009" href="{{route('training.request.show_009',['id'=>$training->id])}}" target="_blank"/>
                                            </x-slot>

                                        </x-card>
                                    </div>
                                <!-- </div> -->
                            </td>

                            <td class="px-2 text-sm  md:text-center block md:table-cell">
                                {{$training->updated_at->isoFormat('Do MMM YYYY H:M')}}
                            </td>
                            <td class="px-2 text-sm md:text-center block md:table-cell">
                                <x-request-status :status="$training->training_status" />
                            </td>
                            <td class="p-2">
                                <div class="flex gap-2 px-2 justify-end">

                                    @can('publish_document')
                                    @if ($training->training_status==1)
                                    <form action=" {{ route('training.request.updateStatus') }} " method="post">
                                        @csrf
                                        <input hidden name='id' value="{{$training->id}}">
                                        <input hidden name='status' value="2">

                                        <x-button.circle primary icon="check" type="submit" class="max-w-full w-full">
                                            {{ __('Approved') }}
                                        </x-button>
                                    </form>
                                    @endif
                                    @endcan

                                    @can('review_document')
                                    @if ($training->training_status!==2)
                                    @if ($training->training_status==0)
                                    <form action=" {{ route('training.request.updateStatus') }} " method="post">
                                        @csrf
                                        <input hidden name='id' value="{{$training->id}}">
                                        <input hidden name='status' value="1">

                                        <x-button.circle positive type="submit" icon="check">
                                            {{ __('Review') }}
                                        </x-button>
                                    </form>
                                    @endif
                                    @endif
                                    @endcan

                                    @can('reject_document')
                                    @if ($training->training_status!==-1 && $training->training_status!==2)

                                    <x-button.circle icon="x" negative spinner onclick="document.querySelector('#{{$training->training_code}}').showModal()">
                                        {{ __('Reject') }}
                                    </x-button>
                                    <dialog id="{{$training->training_code}}"
                                        class="rounded-lg max-w-lg w-full overflow-visible">

                                        <x-button.circle icon="x" red type="reset" onclick="document.querySelector('#{{$training->training_code}}').close()" class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2" />

                                        <p>Reject reason for {{$training->training_code}}</p>
                                        <form action=" {{ route('training.request.updateStatus') }}" method="post">
                                            @csrf
                                            <input hidden name='id' value="{{$training->id}}">
                                            <input hidden name='status' value="-1">
                                            <textarea required name="remark" class="w-full form-input rounded-md rounded-br-none"> </textarea>
                                            <div class="flex gap-4 p-2 py-4">

                                            <x-button positive icon="" label="{{ __('Save') }}" type="submit" />
                                            <x-button negative icon="" label="{{__('Dismiss')}}" type="reset" onclick="document.querySelector('#{{$training->training_code}}').close()" class="py-1"/>
                                        </form>

                                    </dialog>
                                    @endif
                                    @endcan

                                    <x-button.circle alt="{{ __('View') }}" icon="eye" info href="{{route('training.request.show',['id'=>$training->id])}}">
                                        {{ __('View') }}
                                    </x-button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ( $trainings->lastPage()!==1 )

                <div class="m-4 bg-slate-200 rounded-md text-center p-4">
                    {{ $trainings->links() }}
                </div>
                @endif

                @else
                <div class="m-4 bg-slate-200 rounded-md text-center p-4">
                {{__('Nothing here')}}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
