



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
                    <x-button href="{{route('regTraining.all',1)}}">Approved</x-button>
                    <x-button href="{{route('regTraining.all',0)}}">Review</x-button>
                    <x-button href="{{route('regTraining.all',0)}}">Pending Approved</x-button>
                    <x-button href="{{route('regTraining.all',-1)}}">Reject</x-button>
                </div>

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

                            @php
                            $f008 = json_decode($doc->Doc_008);
                            $f009 = json_decode($doc->Doc_009);
                            @endphp
                            <li class="flex justify-between pb-2">
                                <details class="flex-1">
                                    <summary>
                                        <a href="{{route('regTraining.view',$doc->Doc_Code)}}" class="hover:text-brand_blue">
                                        {{$doc->Doc_Code}} : {{$f008->SUBJECT}} 

                                        </a>
                                    </summary>
                                
                                    <span class="text-sm ">last update {{$doc->updated_at}}</span> 
                                    <br>
                                    <div class="flex gap-4">
                                        <x-button href="{{route('regTraining.view',$doc->Doc_Code)}}" class="py-1">
                                            {{__('view Requested Training')}}
                                        </x-button>
                                        
                                        <x-button href="{{route('regTraining.form008',$doc->Doc_Code)}}" class="py-1">
                                            {{__('view 008')}}
                                        </x-button>
                                        <x-button href="{{route('regTraining.form009',$doc->Doc_Code)}}" class="py-1">
                                            {{__('view 009')}}
                                        </x-button>
                                    </div>
                                
                                </details>

                                <span >
                                    <span class="text-sm">{{$doc->Doc_Status}}</span>
                                    <div class="flex">
                                        @if ($doc->Doc_Status==1)
                                        <form action="{{ route('regTraining.approve',$doc->id,'approve=true') }}" method="post">
                                        @csrf
                                            <input type="hidden" name="regID" value="{{$doc->id}}">
                                            <input type="hidden" name="manage" value="approved">
                                            <x-primary-button class="bg-brand_green py-1 m-2">Approve</x-primary-button>
                                        </form>
                                            
                                        @endif
                                        @if ($doc->Doc_Status==0)
                                    <form action="{{ route('regTraining.approve',$doc->id,'approve=true') }}" method="post">
                                    @csrf
                                        <input type="hidden" name="regID" value="{{$doc->id}}">
                                        <input type="hidden" name="manage" value="review">
                                        <x-primary-button class="bg-brand_green py-1 m-2">Review</x-primary-button>
                                    </form>

                                    <x-primary-button class="bg-brand_orange py-1 m-2" onclick="document.querySelector('#{{$doc->Doc_Code}}').showModal()">Reject</x-primary-button>
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
                                        @endif
                                </div>
                                
                                </span>
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
