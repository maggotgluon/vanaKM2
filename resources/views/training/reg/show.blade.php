<x-app-layout>
    @php
        $f008 = json_decode($documents->Doc_008);
        $f009 = json_decode($documents->Doc_009);
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$f008->SUBJECT}}
        </h2>
        <span class="text-sm"></span>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                <!-- {{$documents}} -->
                    <div class="flex gap-4">
                        <!-- if ($doc->Doc_Status==1) -->
                        <form action="{{ route('regTraining.approve',$documents->id,'approve=true') }}" method="post">
                            @csrf
                                <input type="hidden" name="regID" value="{{$documents->id}}">
                                <input type="hidden" name="manage" value="approved">
                                <x-primary-button class="bg-brand_blue py-1 m-1">Approve</x-primary-button>
                            </form>

                        <!-- endif -->
                        <!-- if ($doc->Doc_Status==0) -->
                            <form action="{{ route('regTraining.approve',$documents->id,'approve=true') }}" method="post">
                            @csrf
                                <input type="hidden" name="regID" value="{{$documents->id}}">
                                <input type="hidden" name="manage" value="review">
                                <x-primary-button class="bg-brand_green py-1 m-1">Review</x-primary-button>
                            </form>

                            <x-primary-button class="bg-brand_orange py-1 m-1" onclick="document.querySelector('#{{$documents->Doc_Code}}').showModal()">Reject</x-primary-button>
                            <dialog id="{{$documents->Doc_Code}}">
                                <p>{{$documents->Doc_Code}}</p>
                                <form action="{{ route('regTraining.approve',$documents->id,'approve=false') }}" method="post">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$documents->id}}">
                                    <input type="hidden" name="manage" value="rejected">
                                    <x-textarea-input required name="remark" ></x-textarea-input>

                                    <x-primary-button class="py-1">
                                        {{__('Submit')}}
                                    </x-primary-button>
                                </form>
                                <x-primary-button onclick="document.querySelector('#{{$documents->Doc_Code}}').close()" class="py-1 ">
                                    {{__('Dismiss')}}
                                </x-primary-button>
                            </dialog>
                        <!-- endif -->
                    </div>
                    <p>
                        {{$f008->starttraindate}} - {{$f008->endtraindate}}
                        ({{$f008->starttraintime}} - {{$f008->endtraintime}})
                    </p>

                    <span class="text-sm ">last update {{$documents->updated_at}}</span>
                    <div class="flex gap-4">
                        <x-button href="{{route('regTraining.form008',$documents->Doc_Code)}}" class="py-1">
                            {{__('view 008')}}
                        </x-button>
                        <x-button href="{{route('regTraining.form009',$documents->Doc_Code)}}" class="py-1">
                            {{__('view 009')}}
                        </x-button>
                    </div>
                    <br>

                    <hr>
                    <iframe src="{{asset($documents->Doc_Location)}}" width="100%" height="500px">

                    <hr>
                    </div>
            </div>
        </div>
    </div>

</x-app-layout>
