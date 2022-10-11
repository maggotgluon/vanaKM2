<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show All Train approved') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
                {{__('Training')}} 
                <!-- {{ Auth::user()->id }} -->
                <!-- {{gettype($documents)}} -->
                <ul>
                    @foreach($documents as $doc)

                    @php
                        $f008 = json_decode($doc->Doc_008);
                        $f009 = json_decode($doc->Doc_009);
                    @endphp
                    <li class="clear-both">
                        
                        <a href="{{route('training.view',$doc->Doc_Code)}}">
                            {{$f008->SUBJECT}}
                            <br>
                        </a>
                    <span class="text-sm ">update {{$doc->updated_at}}</span> <hr>
                    <!-- {{$doc}} -->
                    </li>
                        
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
