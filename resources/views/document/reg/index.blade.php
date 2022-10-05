<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requested Document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-3 gap-4 ">
                    <x-button href="#Approved">Approved</x-button>
                    <x-button href="#Pending">Pending Approved</x-button>
                    <x-button href="#Reject">Reject</x-button>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">

                    @if($documents->links())
                        
                    @endif
                    @php 
                         $pending = 0;
                         $approved = 0;
                         $reject = 0;
                         
                        foreach($documents as $doc){
                            if ($doc->Doc_Status == 0){
                                $pending++;
                            }
                            elseif ($doc->Doc_Status == 1){
                                $approved++;
                            }
                            elseif ($doc->Doc_Status == -1){
                                $reject++;
                            }
                        } 
                    @endphp
                    @if($pending==0)
                        <h2 class="text-xl mt-10 text-center">😀 No Pending Approved</h2>
                    @else
                        <h2 class="text-xl mt-10" id="Pending">Pending Approved ({{$pending}})</h2>
                        <ul class="border-2 border-top-none  p-4">
                            @foreach($documents as $doc)
                            @if ($doc->Doc_Status == 0)
                            <li class="clear-both ">

                    

                                @can('manage_document', Auth::user())
                                <span class="float-right">
                                        <div class="flex">
                                            <!-- route('regisApprove',$doc->id,'approve=true') -->
                                            <form action="{{ route('regDoc.approve',$doc->id,'approve=true') }}" method="post">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$doc->id}}">
                                                <input type="hidden" name="manage" value="approved">
                                                <x-primary-button class="bg-brand_green py-1 m-2">Approve</x-button>
                                            </form>
                                            <!-- route('regisApprove',$doc->id,'approve=false') -->
                                            <form action="{{ route('regDoc.approve',$doc->id,'approve=false') }}" method="post">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$doc->id}}">
                                                <input type="hidden" name="manage" value="rejected">
                                                <x-primary-button class="bg-brand_orange py-1 m-2">Reject</x-button>
                                            </form>
                                        </div>
                                </span>
                                @endcan
                                <details>
                                    @if (Auth::user()->id ==99 || 1)
                                    
                                    @endif
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
                            {{ $documents->links() }}
                        </span>
                    @endif
                        <hr>
                        
                    @if($approved==0)
                        <h2 class="text-xl mt-10 text-center">😀 No Approved</h2>
                    @else
                        <h2 class="text-xl mt-10" id="Approved">Approved ({{$approved}})</h2>
                        <ul class="border-2 border-top-none  p-4">
                            @foreach($documents as $doc)
                            @if ($doc->Doc_Status == 1)
                            <li class="clear-both">
                                
                                @if (Auth::user()->id ==99 || 1)
                                    <span class="float-right">
                                            <div class="flex">
                                                <!-- route('regisApprove',$doc->id,'approve=true') -->
                                                <form action="{{ route('regDoc.approve',$doc->id,'approve=true') }}" method="post">
                                                @csrf
                                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                                    <input type="hidden" name="manage" value="approved">
                                                    <x-primary-button disible class="bg-brand_green py-1 m-2">Approve</x-button>
                                                </form>
                                                <!-- route('regisApprove',$doc->id,'approve=false') -->
                                                <form action="{{ route('regDoc.approve',$doc->id,'approve=false') }}" method="post">
                                                @csrf
                                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                                    <input type="hidden" name="manage" value="rejected">
                                                    <x-primary-button class="bg-brand_orange py-1 m-2">Reject</x-button>
                                                </form>
                                            </div>
                                    </span>
                                @endif
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
                            {{ $documents->links() }}
                        </span>
                    @endif
                    <hr>

                        
                    @if($reject==0)
                        <h2 class="text-xl mt-10 text-center">😀 No Reject</h2>
                    @else
                    <h2 class="text-xl mt-10" id="Reject">Reject ({{$reject}})</h2>
                    <ul class="border-2 border-top-none  p-4">
                        @foreach($documents as $doc)
                        @if ($doc->Doc_Status == -1)
                        <li class="clear-both">
                            
                            @if (Auth::user()->id ==99 || 1)
                                <span class="float-right">
                                        <div class="flex">
                                            <!-- route('regisApprove',$doc->id,'approve=true') -->
                                            <form action="{{ route('regDoc.approve',$doc->id,'approve=true') }}" method="post">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$doc->id}}">
                                                <input type="hidden" name="manage" value="approved">
                                                <x-primary-button class="bg-brand_green py-1 m-2">Approve</x-button>
                                            </form>
                                            <!-- route('regisApprove',$doc->id,'approve=false') -->
                                            <form action="{{ route('regDoc.approve',$doc->id,'approve=false') }}" method="post">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$doc->id}}">
                                                <input type="hidden" name="manage" value="rejected">
                                                <x-primary-button class="bg-brand_orange py-1 m-2">Reject</x-button>
                                            </form>
                                        </div>
                                </span>
                            @endif
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
                            {{ $documents->links() }}
                        </span>
                        @endif
                        <hr>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
