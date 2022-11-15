<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Document') }}
        </h2>
    </x-slot>
    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 min-h-screen">
                livewire:document-request-table />
            </div>
        </div>
    </div> -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-screen p-4">
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
                            <x-jet-responsive-nav-link href="{{ route('document.request.all') }}">
                                {{ __('Show All') }}
                            </x-jet-responsive-nav-link>

                            <x-jet-responsive-nav-link href="{{ route('document.request.all',['filter'=>2]) }}">
                                {{ __('Approved') }}
                            </x-jet-responsive-nav-link>

                            <x-jet-responsive-nav-link href="{{ route('document.request.all',['filter'=>1]) }}">
                                {{ __('Reviewed') }}
                            </x-jet-responsive-nav-link>

                            <x-jet-responsive-nav-link href="{{ route('document.request.all',['filter'=>0]) }}">
                                {{ __('Pending') }}
                            </x-jet-responsive-nav-link>

                            <x-jet-responsive-nav-link href="{{ route('document.request.all',['filter'=>-1]) }}">
                                {{ __('Rejected') }}
                            </x-jet-responsive-nav-link>

                        </x-slot>
                    </x-jet-dropdown>


                </div>
                @if($documentRequests->count()>0)
                <table class="w-full">
                    <thead class="bg-gray-300">
                        <tr class="text-center">
                            <th class="border w-1/12 px-2 hidden md:table-cell">DAR No.</th>
                            <!-- <th class="border w-1/12 px-2 hidden md:table-cell">{{__('Document Type')}}</th> -->
                            <th class="border w-6/12 px-1 ">{{__('Document Name')}}</th>
                            <th class="border w-2/12 px-1 hidden md:table-cell">{{__('Last Update')}}</th>
                            <th class="border w-1/12 px-2 hidden md:table-cell">
                                <x-jet-dropdown align="center">
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
                                        <x-jet-responsive-nav-link href="{{ route('document.request.all') }}">
                                            {{ __('Show All') }}
                                        </x-jet-responsive-nav-link>

                                        <x-jet-responsive-nav-link href="{{ route('document.request.all',['filter'=>2]) }}">
                                            {{ __('Approved') }}
                                        </x-jet-responsive-nav-link>

                                        <x-jet-responsive-nav-link href="{{ route('document.request.all',['filter'=>1]) }}">
                                            {{ __('Reviewed') }}
                                        </x-jet-responsive-nav-link>

                                        <x-jet-responsive-nav-link href="{{ route('document.request.all',['filter'=>0]) }}">
                                            {{ __('Pending') }}
                                        </x-jet-responsive-nav-link>

                                        <x-jet-responsive-nav-link href="{{ route('document.request.all',['filter'=>-1]) }}">
                                            {{ __('Rejected') }}
                                        </x-jet-responsive-nav-link>

                                    </x-slot>
                                </x-jet-dropdown>
                            </th>
                            <th class="border w-1/12 px-2 hidden md:table-cell">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentRequests as $documentRequest)
                        <tr class="even:bg-gray-100 mb-4 border-b-2 md:border-b-0 hover:bg-brand_blue/10 p-2">
                            <!-- <td class="border w-min px-2 text-right">{{$documentRequest->id}}</td> -->
                            <td class="px-2 text-sm  md:text-center block md:table-cell">
                                <span class="text-sm">{{$documentRequest->req_code}}</span>
                            </td>
                            <!-- <td class="px-2 text-sm  md:text-center hidden md:table-cell">
                                {{$documentRequest->doc_type}}
                            </td> -->
                            <td class="px-2 block md:table-cell">

                                <x-button flat onclick="document.querySelector('#{{$documentRequest->req_code}}_detail').classList.toggle('hidden')" class="justify-between w-full">
                                {{$documentRequest->doc_type}}-{{$documentRequest->doc_code}}-{{$documentRequest->doc_name}}-Rev-{{$documentRequest->doc_ver}}
                                    <x-icon name="chevron-double-down" class="w-4 h-4 text-gray-500" />
                                </x-button>
                                <div class="hidden py-4" id="{{$documentRequest->req_code}}_detail">
                                    <x-card>
                                        {{__('Doc Name')}} : {{$documentRequest->doc_type}}-{{$documentRequest->doc_code}}-{{$documentRequest->doc_name}}-Rev-{{$documentRequest->doc_ver}}<br>
                                        {{__('Effective Date')}} : {{$documentRequest->doc_startDate->isoFormat('Do MMM YYYY')}}<br>
                                        {{__('Objective')}} : {{$documentRequest->req_obj}}<br>
                                        {{__('description')}} : {{$documentRequest->req_description}}<br>

                                                @if ($documentRequest->req_remark)
                                                <x-badge negative label="{{__('Reject Remark')}}" />  : <x-badge outline warning label="{{$documentRequest->req_remark}}" />
                                                @endif

                                        <x-slot name="footer">
                                            <x-button icon="eye" outline info href="{{route('document.request.show',['id'=>$documentRequest->id])}}">
                                                {{ __('View') }}{{ __('Document') }}
                                            </x-button>
                                            <x-button icon="document" outline positive href="{{route('document.request.showDar',['id'=>$documentRequest->id])}}" target="_blank">
                                                {{ __('View') }} DAR
                                            </x-button>
                                        </x-slot>
                                    </x-card>
                                </div>
                            </td>
                            <td class="px-2 text-sm  md:text-center block md:table-cell">
                                    {{$documentRequest->updated_at->isoFormat('Do MMM YYYY H:M')}}
                            </td>
                            <td class="px-2 text-sm md:text-center block md:table-cell">
                                    <x-request-status :status="$documentRequest->req_status"/>
                            </td>
                            <td class="px-2 block md:table-cell">
                                <div class="flex justify-center gap-2">
                                    @can('publish_document')
                                    @if ($documentRequest->req_status==1)
                                    <form action=" {{ route('document.request.updateStatus') }} " method="post">
                                        @csrf
                                        <input hidden name='id' value="{{$documentRequest->id}}">
                                        <input hidden name='status' value="2">

                                        <x-button.circle primary icon="check" type="submit" class="max-w-full w-full">
                                            {{ __('Approved') }}
                                        </x-button>
                                    </form>
                                    @endif
                                    @endcan

                                    @can('review_document')
                                    @if ($documentRequest->req_status!==2)
                                    @if ($documentRequest->req_status==0)
                                    <form action=" {{ route('document.request.updateStatus') }} " method="post">
                                        @csrf
                                        <input hidden name='id' value="{{$documentRequest->id}}">
                                        <input hidden name='status' value="1">

                                        <x-button.circle positive type="submit" icon="check">
                                            {{ __('Review') }}
                                        </x-button>
                                    </form>
                                    @endif
                                    @endif
                                    @endcan

                                    @can('reject_document')
                                    @if ($documentRequest->req_status!==-1 && $documentRequest->req_status!==2)

                                    <x-button.circle icon="x" negative spinner onclick="document.querySelector('#{{$documentRequest->req_code}}').showModal()">
                                        {{ __('Reject') }}
                                    </x-button>
                                        <dialog id="{{$documentRequest->req_code}}"
                                            class="rounded-lg max-w-lg w-full overflow-visible">

                                            <x-button.circle icon="x" red type="reset"
                                                onclick="document.querySelector('#{{$documentRequest->req_code}}').close()"
                                                class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2"/>

                                            <p>Reject reason for {{$documentRequest->req_code}}</p>
                                            <form action=" {{ route('document.request.updateStatus') }}" method="post">
                                                @csrf
                                                <input hidden name='id' value="{{$documentRequest->id}}">
                                                <input hidden name='status' value="-1">
                                                <textarea required name="remark" class="w-full form-input rounded-md rounded-br-none"> </textarea>
                                                <div class="flex gap-4 p-2 py-4">
                                                    <x-button positive icon="" label="{{ __('Save') }}" type="submit" />

                                                    <x-button negative icon="" label="{{__('Dismiss')}}" type="reset" onclick="document.querySelector('#{{$documentRequest->req_code}}').close()" class="py-1"/>

                                                </div>
                                            </form>

                                        </dialog>
                                    @endif
                                    @endcan

                                    <x-button.circle icon="eye" info href="{{route('document.request.show',['id'=>$documentRequest->id])}}">
                                        {{ __('View') }}
                                    </x-button>
                                </div>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ( $documentRequests->lastPage()!==1 )

                <div class="m-4 bg-slate-200 rounded-md text-center p-4">
                    {{ $documentRequests->links() }}
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
