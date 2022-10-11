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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-4 gap-4 ">
                    <x-button href="{{route('regDoc.all',2)}}">MR Approved</x-button>
                    <x-button href="{{route('regDoc.all',1)}}">Approved</x-button>
                    <x-button href="{{route('regDoc.all',0)}}">Pending Approved</x-button>
                    <x-button href="{{route('regDoc.all',-1)}}">Reject</x-button>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">

                    
                    @if($documents->count()==0)
                        <h2 class="text-xl mt-10 text-center">😀 No  {{nameFilter($filter)}}</h2>
                    @else
                        <h2 class="text-xl mt-10">
                            @if ($filter==null)
                                All 
                            @else
                                {{nameFilter($filter)}}
                            @endif
                        </h2>
                        <ul class="border-2 border-top-none  p-4">
                            @foreach($documents as $doc)
                            <li class="clear-both ">
                                @can('manage_document', Auth::user())
                                <span class="float-right">
                                        <div class="flex">
                                            <!-- route('regisApprove',$doc->id,'approve=true') -->
                                            
                                            @can('publish_document', Auth::user())
                                                @if($doc->Doc_Status == 1)
                                                <form action="{{ route('regDoc.approve',$doc->id,'approve=true') }}" method="post">
                                                @csrf
                                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                                    <input type="hidden" name="manage" value="mrapproved">
                                                    <x-primary-button class="bg-brand_blue py-1 m-2">MR Approve</x-button>
                                                </form>
                                                @endif
                                            @endcan
                                            @if($doc->Doc_Status !== 1)
                                            <!-- route('regisApprove',$doc->id,'approve=true') -->
                                            <form action="{{ route('regDoc.approve',$doc->id,'approve=true') }}" method="post">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$doc->id}}">
                                                <input type="hidden" name="manage" value="approved">
                                                <x-primary-button class="bg-brand_green py-1 m-2">Approve</x-button>
                                            </form>
                                            @endif
                                            @if($doc->Doc_Status !== -1)
                                            <!-- route('regisApprove',$doc->id,'approve=false') -->
                                            <x-primary-button class="bg-brand_orange py-1 m-2" onclick="document.querySelector('#{{$doc->Doc_Code}}').showModal()">Reject</x-button>

                                            <dialog id="{{$doc->Doc_Code}}">
                                                <p>{{$doc->Doc_Code}}</p>
                                                <form action="{{ route('regDoc.approve',$doc->id,'approve=false') }}" method="post">
                                                @csrf
                                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                                    <input type="hidden" name="manage" value="rejected">
                                                    <x-textarea-input name="remark" class="w-full"></x-textarea-input>
                                                    
                                                    <x-primary-button href="{{route('regDoc.view',$doc->Doc_Code)}}" class="py-1">
                                                        {{__('Submit')}}
                                                    </x-primary-button>
                                                </form>
                                                    <x-primary-button onclick="document.querySelector('#{{$doc->Doc_Code}}').close()" class="py-1">
                                                        {{__('Dismiss')}}
                                                    </x-primary-button>
                                            </dialog>

                                            @endif

                                        </div>
                                </span>
                                @endcan
                                <details>
                                    <summary>
                                        <a href="{{route('regDoc.view',$doc->Doc_Code)}}" class="hover:text-brand_blue">
                                        {{$doc->Doc_Code}} : {{$doc->Doc_Name}} 
                                        @unless ($doc->Doc_ver===0)
                                            Rev {{$doc->Doc_ver}}
                                        @endunless

                                        </a>
                                    </summary>
                                    <p>
                                        {{$doc->Doc_Type}}
                                    </p>
                                    <p>
                                        {{$doc->Doc_Obj}} {{__('reason')}} {{$doc->Doc_Description}}
                                    </p>
                                    <p>
                                        upload by :
                                        {{Auth::user()->name}}
                                    </p>
                                
                                    <span class="text-sm ">last update {{$doc->updated_at}}</span> 
                                    <br>
                                    <x-button href="{{route('regDoc.view',$doc->Doc_Code)}}" class="py-1">
                                        {{__('view Requested document')}}
                                    </x-button>
                                    
                                    <x-button href="{{route('regDoc.DarForm',$doc->Doc_Code)}}" class="py-1">
                                        {{__('view dar')}}
                                    </x-button>
                                
                                </details>
                            <!-- {{$doc}} -->
                            </li>
                                
                            @endforeach
                        </ul>
                        <span class="m-4">
                            {{ $documents->links() }}
                        </span>
                    @endif
                        <hr>
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


