<x-app-layout>
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
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{$documents->Doc_Name}}
        </h2>
        <span class="text-sm ">
            {{$documents->Doc_Code}}
        </span>
        <span class="text-sm {{nameFilter($documents->Doc_Status)}}">
            {{nameFilter($documents->Doc_Status)}}
        </span>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                <div class="flex">
                        <!-- route('regisApprove',$documents->id,'approve=true') -->

                    @can('manage_document', Auth::user())

                    @can('publish_document', Auth::user())
                        @if($documents->Doc_Status == 1)
                        <form action="{{ route('regDoc.approve',$documents->id,'approve=true') }}" method="post">
                        @csrf
                            <input type="hidden" name="regID" value="{{$documents->id}}">
                            <input type="hidden" name="manage" value="mrapproved">
                            <x-primary-button class="bg-brand_blue py-1 m-2">MR Approve</x-button>
                        </form>
                        @endif
                    @endcan
                    @if($documents->Doc_Status <= 1)
                        <!-- route('regisApprove',$documents->id,'approve=true') -->
                        <form action="{{ route('regDoc.approve',$documents->id,'approve=true') }}" method="post">
                        @csrf
                            <input type="hidden" name="regID" value="{{$documents->id}}">
                            <input type="hidden" name="manage" value="approved">
                            <x-primary-button class="bg-brand_green py-1 m-2">Approve</x-button>
                        </form>
                    @endif
                    @if($documents->Doc_Status !== -1)
                        <!-- route('regisApprove',$documents->id,'approve=false') -->
                        <x-primary-button class="bg-brand_orange py-1 m-2" onclick="document.querySelector('#{{$documents->Doc_Code}}').showModal()">Reject</x-button>

                        <dialog id="{{$documents->Doc_Code}}">
                            <p>{{$documents->Doc_Code}}</p>
                            <form action="{{ route('regDoc.approve',$documents->id,'approve=false') }}" method="post">
                            @csrf
                                <input type="hidden" name="regID" value="{{$documents->id}}">
                                <input type="hidden" name="manage" value="rejected">
                                <x-textarea-input name="remark" class="w-full"></x-textarea-input>

                                <x-primary-button href="{{route('regDoc.view',$documents->Doc_Code)}}" class="py-1">
                                    {{__('Submit')}}
                                </x-primary-button>
                            </form>
                                <x-primary-button onclick="document.querySelector('#{{$documents->Doc_Code}}').close()" class="py-1">
                                    {{__('Dismiss')}}
                                </x-primary-button>
                        </dialog>

                    @endif

                    @endcan
                    <x-button href="{{route('regDoc.DarForm',$documents->Doc_Code)}}" class="bg-brand_blue py-1 m-2">DAR</x-button>
                </div>
                    <p>
                        {{$documents->Doc_Type}}
                    </p>
                    <p>
                        {{$documents->Doc_Obj}} {{__('reason')}} {{$documents->Doc_Description}}

                        </p>
                    <p>
                    upload by : {{$documents->user_id}}
                    </p>
                    <span class="text-sm ">created_at  {{$documents->created_at}}</span>
                    <p>
                        Approved by : {{$documents->User_Approve}}
                    </p>
                    <span class="text-sm ">last update {{$documents->updated_at}}</span>

                    <br>
                    <span class="text-sm {{nameFilter($documents->Doc_Status)}}">
                        {{$documents->Doc_Location}}
                    </span>

                    <!-- {{ $documents }} -->
                    <!-- {{ Auth::user()->id }} -->
                    <hr>
                    <iframe src="{{asset($documents->Doc_Location)}}" width="100%" height="500px">

                    <hr>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
