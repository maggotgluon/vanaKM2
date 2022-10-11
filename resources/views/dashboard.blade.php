<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Document

                    <div class="grid grid-cols-3">
                    @foreach ($documents as $document)
                        <div>
                            <a href="{{route('document.view',$document->Doc_Code)}}" class="hover:text-brand_blue">
                                {{$document->Doc_Name}}
                                <br>
                            </a>
                            <span class="text-sm ">update {{$document->updated_at}}</span> <hr>
                        </div>
                            
                    @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Training
                    <div class="grid grid-cols-3">
                        @foreach ($trainings as $training)
                        @php
                            $f008 = json_decode($training->Doc_008);
                            $f009 = json_decode($training->Doc_009);
                        @endphp
                        <div>
                            <a href="{{route('training.view',$training->Doc_Code)}}" class="hover:text-brand_blue">
                                {{$f008->SUBJECT}}<br>
                                {{$user->find($training->user_id)->name}}<br>
                                {{__('Department')}} : {{$user->find($training->user_id)->department}}
                            </a>
                        </div>
                            
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
