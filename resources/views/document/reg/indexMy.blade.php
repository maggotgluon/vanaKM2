<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Registed Document') }}
        </h2>
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <style>
        #table_id_length select {
            padding-inline: 1.5rem;
        }
        .Pending td{
        }
        .Reviewed td{
            background-color: rgb(255, 255, 0, .1);
        }
        .Approved td{
            background-color: rgb(0, 255, 0, .1);
        }
        .Reject td{
            background-color: rgb(255, 0, 0, .1);}
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

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-5 gap-4">
                        <x-button href="{{route('regDoc.allUser')}}">All </x-button>
                        <x-button href="{{route('regDoc.allUser',0)}}">pending </x-button>
                        <x-button href="{{route('regDoc.allUser',1)}}">Reviewed</x-button>
                        <x-button href="{{route('regDoc.allUser',2)}}">Approved</x-button>
                        <x-button href="{{route('regDoc.allUser',-1)}}">Rejected</x-button>
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th> {{ __('Dar Number') }}</th>
                                <th class="w-1/6"> {{ __('Document_Status') }}</th>
                                <th class="w-1/6"> {{ __('Date') }}</th>
                                <th class="w-1/12"> {{ __('View_Document') }}</th>
                                <th class="w-1/12"> {{ __('Remark') }}</th>
                            </tr>

                        </thead>
                        <tbody>
                        @foreach ($documents as $document)
                        @php
                            $status;
                            if($document->Doc_Status==0){
                                $status='Pending';
                            }else if($document->Doc_Status==1){
                                $status='Reviewed';
                            }else if($document->Doc_Status==2){
                                $status='Approved';
                            }else if($document->Doc_Status==-1){
                                $status='Reject';
                            }
                        @endphp
                        <!-- {{$document}} -->
                        <tr class="{{$status}}">
                            <td>
                                <details>
                                    <summary>
                                        {{$document->Doc_Code}}:{{$document->Doc_Name}} {{$document->Doc_FullName}}
                                    </summary>
                                    <span>{{$document->Doc_Type}}</span>
                                    <hr>
                                    <span>{{$document->Doc_Obj}} {{__('reason')}} {{$document->Doc_Description}}</span>
                                </details>
                                <x-button href="{{route('regDoc.DarForm',$document->Doc_Code)}}" target="_blank" class="bg-brand_blue py-1 m-1">DAR</x-button>
                            </td>

                            <td>

                                @if ($document->Doc_Status == 2)
                                    Approved
                                    <span class="text-sm w-full block group relative isolate z-10">{{$document->Doc_DateMRApproveT}} <span class="absolute z-10 top-full -left-1/2 w-max p-2 bg-white transition-all delay-500 duration-500 opacity-0 translate-y-16 group-hover:opacity-100 group-hover:translate-y-0">by {{$document->User_MRApprove->name}}</span></span>
                                @elseif ($document->Doc_Status == 1)
                                    Reviewed
                                    <span class="text-sm w-full block group relative isolate z-10">{{$document->Doc_DateApproveT}} <span class="absolute z-10 top-full -left-1/2 w-max p-2 bg-white transition-all delay-500 duration-500 opacity-0 translate-y-16 group-hover:opacity-100 group-hover:translate-y-0">by {{$document->User_Approve->name}}</span></span>
                                @elseif ($document->Doc_Status == -1)
                                    Rejected
                                    <span class="text-sm w-full block group relative isolate z-10">{{$document->updated_atT}}</span>
                                @else
                                    Pending
                                @endif

                            </td>
                            <td>
                                    {{ __('Date Used') }} : <br>{{$document->Doc_StartDate}}<br>
                                    @if($document->Doc_DateApprove ==null)
                                        @if($document->Remark ==null)
                                            <span class="text-sm w-full block group relative isolate z-10">Last Update :<br> {{$document->updated_atT}}</span>
                                        @else
                                            <span class="text-sm w-full block group relative isolate z-10">Rejected :<br> {{$document->updated_atT}}</span>
                                        @endif
                                    @endif

                                    @if ($document->Doc_DateApprove !==null && $document->User_Approve !== null)
                                    <span class="text-sm w-full block group relative isolate z-10">Review : {{$document->Doc_DateApproveT}}<span class="absolute z-10 top-full -left-1/2 w-max p-2 bg-white transition-all delay-500 duration-500 opacity-0 translate-y-16 group-hover:opacity-100 group-hover:translate-y-0">Review by {{$document->User_Approve->name}}</span></span>

                                    @endif
                                    @if ($document->Doc_DateMRApprove !==null && $document->User_MRApprove !== null)
                                    <span class="text-sm w-full block group relative isolate">Approve : {{$document->Doc_DateMRApproveT}}<span class="absolute top-full -left-1/2 w-max p-2 bg-white transition-all delay-500 duration-500 opacity-0 translate-y-16 group-hover:opacity-100 group-hover:translate-y-0">Approve by {{$document->User_MRApprove->name}}</span></span>

                                    @endif
                            </td>
                            <td><x-button href="{{route('regDoc.view',$document->Doc_Code)}}" class="bg-brand_blue py-1 m-1 w-full">view</x-button></td>
                            <td>
                                <span class="max-w-[12ch] max-h-[5ch] block text-ellipsis overflow-hidden whitespace-nowrap">
                                    {{$document->Remark}}
                                </span>
                            </td>

                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
