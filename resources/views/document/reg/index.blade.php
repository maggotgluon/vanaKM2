<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Document') }}
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
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <style>
        #table_id_length select {
            padding-inline: 1.5rem;
        }
    </style>
    <script>
        $(document).ready( function () {
            console.log('jqready')
            $('#table_id').DataTable();
        } );
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-4 gap-4 ">
                    <x-button href="{{route('regDoc.all')}}">All</x-button>
                    <x-button href="{{route('regDoc.all',1)}}">Reviewed</x-button>
                    <x-button href="{{route('regDoc.all',0)}}">Pending</x-button>
                    <x-button href="{{route('regDoc.all',-1)}}">Rejected</x-button>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <table  id="table_id" class="display">
                        <thead>
                            <tr>
                                <th> {{ __('Dar Number') }}</th>
                                <!-- <th> {{ __('Document Type') }}</th> -->
                                <th> {{ __('Doc Code') }}</th>
                                <!-- <th> {{ __('Requested by (Department)') }}</th> -->
                                <th> {{ __('Document_Status') }}</th>
                                <!-- <th> {{ __('Review Status') }}</th> -->
                                <!-- <th> {{ __('Approvel Status') }}</th> -->
                                <th> {{ __('Last Update') }}</th>
                                <th> {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($documents as $document)
                            <tr>

                                <td><a href="{{route('regDoc.view',$document->Doc_Code)}}" class="hover:text-brand_blue"> {{$document->Doc_Code}} : {{$document->Doc_Type}}</a>
                                <span class="text-sm w-full block">{{ __('Date Request') }} : {{$document->created_atT}}</span>

                                <x-button href="{{route('regDoc.DarForm',$document->Doc_Code)}}" class="bg-brand_blue py-1 m-1">DAR</x-button>
                            </td>

                                <td>
                                <a href="{{route('regDoc.view',$document->Doc_Code)}}" class="hover:text-brand_blue"> {{$document->Doc_Name}} : {{$document->Doc_FullName}} Rev. {{$document->Doc_ver}}</a>
                                    <span class="text-sm w-full block">วันที่บังคับใช้ :  {{$document->Doc_StartDateT}}</span>
                                </td>
                                <td>
                                    @if ($document->Doc_Status == 2)
                                        Approved
                                        <span class="text-sm w-full block">{{$document->Doc_DateMRApproveT}}<br>by {{$document->User_MRApprove->name}}</span>
                                    @elseif ($document->Doc_Status == 1)
                                        Reviewed
                                        <span class="text-sm w-full block">{{$document->Doc_DateApproveT}} <br>by {{$document->User_Approve->name}}</span>
                                    @elseif ($document->Doc_Status == -1)
                                        Rejected
                                        <span class="text-sm w-full block">{{$document->updated_atT}}</span>
                                    @else
                                        Pending
                                    @endif
                                </td>
                                <td>
                                    {{ __('Last Update') }} : {{$document->updated_atT}}
                                    @if ($document->Doc_DateApprove !==null && $document->User_Approve !== null)
                                    <span class="text-sm w-full block">Review : {{$document->Doc_DateApproveT}} <br>by {{$document->User_Approve->name}}</span>

                                    @endif
                                    @if ($document->Doc_DateMRApprove !==null && $document->User_MRApprove !== null)
                                    <span class="text-sm w-full block">Approve : {{$document->Doc_DateMRApproveT}} <br>by {{$document->User_MRApprove->name}}</span>

                                    @endif
                                </td>
                                <td>
                                @can('publish_document', Auth::user())
                                    @if($document->Doc_Status == 1)
                                    <form action="{{ route('regDoc.approve',$document->id,'approve=true') }}" method="post">
                                    @csrf
                                        <input type="hidden" name="regID" value="{{$document->id}}">
                                        <input type="hidden" name="manage" value="mrapproved">
                                        <x-primary-button class="bg-brand_blue py-1 m-1 w-full">MR Approve</x-button>
                                    </form>
                                    @endif
                                @if($document->Doc_Status == 0)
                                <!-- route('regisApprove',$document->id,'approve=true') -->
                                <form action="{{ route('regDoc.approve',$document->id,'approve=true') }}" method="post">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$document->id}}">
                                    <input type="hidden" name="manage" value="approved">
                                    <x-primary-button class="bg-brand_green py-1 m-1 w-full">Approve</x-button>
                                </form>
                                @endif
                                <!-- if($document->Doc_Status == 0) -->
                                <!-- route('regisApprove',$document->id,'approve=false') -->
                                <x-primary-button class="bg-brand_orange py-1 m-1 w-full" onclick="document.querySelector('#{{$document->Doc_Code}}').showModal()">Reject</x-button>

                                <dialog id="{{$document->Doc_Code}}">
                                    <p>{{$document->Doc_Code}}</p>
                                    <form action="{{ route('regDoc.approve',$document->id,'approve=false') }}" method="post">
                                    @csrf
                                        <input type="hidden" name="regID" value="{{$document->id}}">
                                        <input type="hidden" name="manage" value="rejected">
                                        <x-textarea-input name="remark" class="w-full"></x-textarea-input>

                                        <x-primary-button href="{{route('regDoc.view',$document->Doc_Code)}}" class="py-1">
                                            {{__('Submit')}}
                                        </x-primary-button>
                                    </form>
                                        <x-primary-button onclick="document.querySelector('#{{$document->Doc_Code}}').close()" class="py-1">
                                            {{__('Dismiss')}}
                                        </x-primary-button>
                                </dialog>

                                <!-- endif -->

                                @endcan
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


