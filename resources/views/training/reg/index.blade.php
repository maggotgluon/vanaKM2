



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Training Management') }}
        </h2>
    </x-slot>
    @php
        function nameFilter($filter){
            if($filter==-1){
                return 'Reject';
            }else if($filter==0){
                return 'Pending Approved';
            }else if($filter==1){
                return 'Approved';
            }else if($filter==2){
                return 'MR Approved';
            }else{
                return 'Other';
            }
        }
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-4 gap-4 ">
                    <x-button href="{{route('regTraining.all',2)}}">Approved</x-button>
                    <x-button href="{{route('regTraining.all',1)}}">Review</x-button>
                    <x-button href="{{route('regTraining.all',0)}}">Pending Approved</x-button>
                    <x-button href="{{route('regTraining.all',-1)}}">Reject</x-button>
                </div>


                        <table  id="table_id" class="display">
                        <thead>
                            <tr>
                                <th class="w-4/6"> {{ __('Dar Number') }}</th>
                                <!-- <th> {{ __('Document Type') }}</th> -->
                                <!-- <th> {{ __('Doc Code') }}</th> -->
                                <!-- <th> {{ __('Requested by (Department)') }}</th> -->
                                <th class="w-1/12"> {{ __('Document_Status') }}</th>
                                <!-- <th> {{ __('Review Status') }}</th> -->
                                <!-- <th> {{ __('Approvel Status') }}</th> -->
                                <th class="w-2/6"> {{ __('Last Update') }}</th>
                                <th class="w-1/12"> {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($documents as $document)

                            <tr>

                                <td>

                                <details>
                                    <summary>
                                    <a href="{{route('regTraining.view',$document->Doc_Code)}}" class="hover:text-brand_blue">
                                    {{$document->Doc_Code}} : {{$document->Doc_008->SUBJECT}}
                                    </a>
                                    <span class="text-sm w-full block">{{ __('Date Request') }} : {{$document->created_atT}}</span>

                                    </summary>
                                <span class="text-sm w-full block">{{ __('Request By') }} : {{$document->user_id->name}}</span>
                                    <div class="flex gap-4">
                                        <x-button href="{{route('regTraining.view',$document->Doc_Code)}}" class="py-1">
                                            {{__('view Requested Training')}}
                                        </x-button>

                                        <x-button href="{{route('regTraining.form008',$document->Doc_Code)}}" class="py-1">
                                            {{__('view 008')}}
                                        </x-button>
                                        <x-button href="{{route('regTraining.form009',$document->Doc_Code)}}" class="py-1">
                                            {{__('view 009')}}
                                        </x-button>
                                    </div>
                                </details>
                            </td>

                                <!-- <td>
                                <a href="{{route('regDoc.view',$document->Doc_Code)}}" class="hover:text-brand_blue"> {{$document->Doc_Name}} : {{$document->Doc_FullName}} Rev. {{$document->Doc_ver}}</a>
                                    <span class="text-sm w-full block">วันที่บังคับใช้ :  {{$document->Doc_StartDate}}</span>
                                </td> -->
                                <td>
                                    @if ($document->Doc_Status == 2)
                                        Approved
                                    @elseif ($document->Doc_Status == 1)
                                        Reviewed
                                    @elseif ($document->Doc_Status == -1)
                                        Rejected
                                    @else
                                        Pending
                                    @endif
                                </td>
                                <td>
                                    {{ __('Last Update') }} : {{$document->updated_atT}}
                                    @if ($document->Doc_DateReview !==null && $document->User_Review !== null)
                                    <span class="text-sm w-full block group relative isolate z-10">Review : {{$document->Doc_DateReviewT}} <span class="absolute pointer-events-none z-10 top-full -left-1/2 w-max p-2 bg-white transition-all delay-500 duration-500 opacity-0 translate-y-16 group-hover:opacity-100 group-hover:translate-y-0">by {{$document->User_Review->name}}</span></span>

                                    @endif
                                    @if ($document->Doc_DateApprove !==null && $document->User_Approve !== null)
                                    <span class="text-sm w-full block group relative isolate">Approve : {{$document->Doc_DateApproveT}} <span class="absolute pointer-events-none z-10 top-full -left-1/2 w-max p-2 bg-white transition-all delay-500 duration-500 opacity-0 translate-y-16 group-hover:opacity-100 group-hover:translate-y-0">by {{$document->User_Approve->name}}</span></span>

                                    @endif
                                </td>
                                <td>
                                    <!-- if ($doc->Doc_Status==1) -->
                                        <form action="{{ route('regTraining.approve',$document->id,'approve=true') }}" method="post">
                                        @csrf
                                            <input type="hidden" name="regID" value="{{$document->id}}">
                                            <input type="hidden" name="manage" value="approved">
                                            <x-primary-button class="bg-brand_blue py-1 m-1 w-full">Approve</x-primary-button>
                                        </form>

                                    <!-- endif -->
                                    <!-- if ($doc->Doc_Status==0) -->
                                        <form action="{{ route('regTraining.approve',$document->id,'approve=true') }}" method="post">
                                        @csrf
                                            <input type="hidden" name="regID" value="{{$document->id}}">
                                            <input type="hidden" name="manage" value="review">
                                            <x-primary-button class="bg-brand_green py-1 m-1 w-full">Review</x-primary-button>
                                        </form>

                                        <x-primary-button class="bg-brand_orange py-1 m-1 w-full" onclick="document.querySelector('#{{$document->Doc_Code}}').showModal()">Reject</x-primary-button>
                                        <dialog id="{{$document->Doc_Code}}">
                                            <p>{{$document->Doc_Code}}</p>
                                            <form action="{{ route('regTraining.approve',$document->id,'approve=false') }}" method="post">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$document->id}}">
                                                <input type="hidden" name="manage" value="rejected">
                                                <x-textarea-input required name="remark" class="w-full"></x-textarea-input>

                                                <x-primary-button class="py-1">
                                                    {{__('Submit')}}
                                                </x-primary-button>
                                            </form>
                                            <x-primary-button onclick="document.querySelector('#{{$document->Doc_Code}}').close()" class="py-1 ">
                                                {{__('Dismiss')}}
                                            </x-primary-button>
                                        </dialog>
                                    <!-- endif -->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
