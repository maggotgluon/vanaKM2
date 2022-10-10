



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requested Document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    

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
                        <h2 class="text-xl mt-10">Pending Approved ({{$pending}})</h2>
                        <ul class="border-2 border-top-none  p-4">
                            @foreach($documents as $doc)
                            @if ($doc->Doc_Status == 0)
                            <li class="clear-both">
                                <span class="float-right">
                                    <span class="text-sm">upload by :
                                    {{Auth::user()->name}}</span>
                                    <div class="flex">
                                    <!-- route('regisApprove',$doc->id,'approve=true') -->
                                    <form action="{{ route('regTraining.approve',$doc->id,'approve=true') }}" method="post">
                                    @csrf
                                        <input type="hidden" name="regID" value="{{$doc->id}}">
                                        <input type="hidden" name="manage" value="approved">
                                        <x-primary-button class="bg-brand_green py-1 m-2">Approve</x-primary-button>
                                    </form>
                                    <!-- route('regisApprove',$doc->id,'approve=false') -->
                                    <!-- <form action="{{ route('regTraining.approve',$doc->id,'approve=false') }}" method="post">
                                    @csrf
                                        <input type="hidden" name="regID" value="{{$doc->id}}">
                                        <input type="hidden" name="manage" value="rejected">
                                        <x-primary-button class="py-1">Reject</x-primary-button>
                                    </form> -->

                                    <x-primary-button class="bg-brand_orange py-1 m-2" onclick="document.querySelector('#{{$doc->Doc_Code}}').showModal()">Reject</x-button>
                                    <dialog id="{{$doc->Doc_Code}}">
                                        <p>{{$doc->Doc_Code}}</p>
                                        <form action="{{ route('regTraining.approve',$doc->id,'approve=false') }}" method="post">
                                        @csrf
                                            <input type="hidden" name="regID" value="{{$doc->id}}">
                                            <input type="hidden" name="manage" value="rejected">
                                            <x-textarea-input required name="remark" class="w-full"></x-textarea-input>
                                            
                                            <x-primary-button class="py-1">
                                                {{__('Submit')}}
                                            </x-primary-button>
                                        </form>
                                        <x-primary-button onclick="document.querySelector('#{{$doc->Doc_Code}}').close()" class="py-1">
                                            {{__('Dismiss')}}
                                        </x-primary-button>
                                    </dialog>
                                </div>
                                
                                </span>

                                <details>
                                    <summary>
                                        <a href="{{route('regTraining.view',$doc->Doc_Code)}}" class="hover:text-brand_blue">
                                        {{$doc->Doc_Code}} : {{$doc->Doc_Name}} 
                                        @unless ($doc->Doc_ver===0)
                                            Rev {{$doc->Doc_ver}}
                                        @endunless

                                        </a>
                                    </summary>
                                
                                    <span class="text-sm ">last update {{$doc->updated_at}}</span> 
                                    <br>
                                    <x-button href="{{route('regTraining.view',$doc->Doc_Code)}}" class="py-1">
                                        {{__('view Requested Training')}}
                                    </x-button>
                                    
                                    <x-button href="{{route('regTraining.form008',$doc->Doc_Code)}}" class="py-1">
                                        {{__('view 008')}}
                                    </x-button>
                                    <x-button href="{{route('regTraining.form009',$doc->Doc_Code)}}" class="py-1">
                                        {{__('view 009')}}
                                    </x-button>
                                
                                </details>
                            <!-- {{$doc}} -->
                            </li>
                            @endif
                                
                            @endforeach
                        </ul>
                    @endif
                        <hr>
                        
                    @if($approved==0)
                        <h2 class="text-xl mt-10 text-center">😀 No Approved</h2>
                    @else
                    <h2 class="text-xl mt-10">Approved ({{$approved}})</h2>
                    <ul class="border-2 border-top-none  p-4">
                        @foreach($documents as $doc)
                        @if ($doc->Doc_Status == 1)
                        <li class="clear-both">
                            @if (Auth::user()->id ==99 || 1)
                            <span class="float-right">
                                upload by :
                                {{Auth::user()->name}}
                                status : {{$doc->Doc_Status}} 
                            </span>
                            @endif
                            {{$doc->id}} {{$doc->Doc_Code}} : {{$doc->Doc_Name}} 
                            @unless ($doc->Doc_ver===0)
                            Rev {{$doc->Doc_ver}}
                            @endunless
                            <br>
                            <span class="text-sm ">update {{$doc->updated_at}}</span> <hr>
                            <a href="{{route('regTraining.view',$doc->Doc_Code)}}" class="color-blue-400">
                                view
                            </a>

                            <a href="{{route('regTraining.form008',$doc->Doc_Code)}}" class="bg-green-300 px-2 hover:bg-blue-200">view 008</a>
                            <a href="{{route('regTraining.form009',$doc->Doc_Code)}}" class="bg-green-300 px-2 hover:bg-blue-200">view 009</a>
                  
                        <!-- {{$doc}} -->
                        </li>
                        @endif
                            
                        @endforeach
                        </ul>
                    @endif
                        <hr>

                        
                    @if($reject==0)
                        <h2 class="text-xl mt-10 text-center">😀 No Reject</h2>
                    @else
                    <h2 class="text-xl mt-10">Reject ({{$reject}})</h2>
                    <ul class="border-2 border-top-none  p-4">
                        @foreach($documents as $doc)
                        @if ($doc->Doc_Status == -1)
                            <li class="clear-both">
                                @if (Auth::user()->id ==99 || 1)
                                <span class="float-right">
                                    upload by :
                                    {{Auth::user()->name}}
                                    status : {{$doc->Doc_Status}} 
                                </span>
                                @endif
                                {{$doc->id}} {{$doc->Doc_Code}} : {{$doc->Doc_Name}} 
                                @unless ($doc->Doc_ver===0)
                                Rev {{$doc->Doc_ver}}
                                @endunless
                                <br>
                                <span class="text-sm ">update {{$doc->updated_at}}</span> <hr>
                                <a href="{{route('regTraining.view',$doc->Doc_Code)}}" class="color-blue-400">
                                    view
                                </a>

                            <a href="{{route('regTraining.form008',$doc->Doc_Code)}}" class="bg-green-300 px-2 hover:bg-blue-200">view 008</a>
                            <a href="{{route('regTraining.form009',$doc->Doc_Code)}}" class="bg-green-300 px-2 hover:bg-blue-200">view 009</a>
                  
                            <!-- {{$doc}} -->
                            </li>
                        @endif
                         
                        @endforeach
                        </ul>
                    @endif
                        <hr>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
