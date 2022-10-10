<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requested Document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-4 gap-4 ">
                    <x-button href="#Approved">MR Approved</x-button>
                    <x-button href="#Approved">Approved</x-button>
                    <x-button href="#Pending">Pending Approved</x-button>
                    <x-button href="#Reject">Reject</x-button>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">

                    
                    @if($docPending->count()==0)
                        <h2 class="text-xl mt-10 text-center">😀 No Pending Approved</h2>
                    @else
                        <h2 class="text-xl mt-10" id="Pending">Pending Approved </h2>
                        <ul class="border-2 border-top-none  p-4">
                            @foreach($docPending as $doc)
                            @if ($doc->Doc_Status == 0)
                            <li class="clear-both ">

                    

                                @can('manage_document', Auth::user())
                                <span class="float-right">
                                        <div class="flex">
                                            <!-- route('regisApprove',$doc->id,'approve=true') -->
                                            @if($doc->Doc_Status == 1||1==1)
                                            <form action="{{ route('regDoc.approve',$doc->id,'approve=true') }}" method="post">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$doc->id}}">
                                                <input type="hidden" name="manage" value="mrapproved">
                                                <x-primary-button class="bg-brand_blue py-1 m-2">MR Approve</x-button>
                                            </form>
                                            @endif
                                            <!-- route('regisApprove',$doc->id,'approve=true') -->
                                            <form action="{{ route('regDoc.approve',$doc->id,'approve=true') }}" method="post">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$doc->id}}">
                                                <input type="hidden" name="manage" value="approved">
                                                <x-primary-button class="bg-brand_green py-1 m-2">Approve</x-button>
                                            </form>
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
                            @endif
                                
                            @endforeach
                        </ul>
                        <span class="m-4">
                            {{ $docPending->links() }}
                        </span>
                    @endif
                        <hr>
                        
                    @if($docAccepted->count()==0)
                        <h2 class="text-xl mt-10 text-center">😀 No Approved</h2>
                    @else
                        <h2 class="text-xl mt-10" id="Approved">Approved </h2>
                        <ul class="border-2 border-top-none  p-4">
                            @foreach($docAccepted as $doc)
                            @if ($doc->Doc_Status == 1)
                            <li class="clear-both">
                                
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
                            
                            </details>
                            <!-- {{$doc}} -->
                            </li>
                            @endif
                                
                            @endforeach
                        </ul>

                        <span class="m-4">
                            {{ $docAccepted->links() }}
                        </span>
                    @endif
                    <hr>

                        
                    @if($docReject->count()==0)
                        <h2 class="text-xl mt-10 text-center">😀 No Reject</h2>
                    @else
                        <h2 class="text-xl mt-10" id="Reject">Reject </h2>
                        <ul class="border-2 border-top-none  p-4">
                            @foreach($docReject as $doc)
                            @if ($doc->Doc_Status == -1)
                            <li class="clear-both">
                                {{$doc->Doc_Status}}
                                Remark : {{$doc->Remark}}
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
                                
                                </details>
                                
                                <!-- {{$doc}} -->
                                </li>
                        @endif
                            
                        @endforeach
                        </ul>
                    
                        <span class="m-4">
                            {{ $docReject->links() }}
                        </span>
                    @endif
                        <hr>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


