<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('training') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    show single doc
                    {{ Auth::user()->id }}

                    @foreach($documents as $doc)
                        <li class="clear-both">
                            
                            <a href="{{route('documentView',$doc->Doc_Code)}}">
                                {{$doc->id}} {{$doc->Doc_Code}} : {{$doc->Doc_Name}} 
                                @unless ($doc->Doc_ver===0)
                                Rev {{$doc->Doc_ver}}
                                @endunless
                                <br>
                            </a>
                            <a href="{{route('regForm008',$doc->Doc_Code)}}" class="bg-green-300 px-2 hover:bg-blue-200">view 008</a>
                            <a href="{{route('regForm009',$doc->Doc_Code)}}" class="bg-green-300 px-2 hover:bg-blue-200">view 009</a>
                        <span class="text-sm ">update {{$doc->updated_at}}</span> <hr>
                        <!-- {{$doc}} -->
                        </li>
                            
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
