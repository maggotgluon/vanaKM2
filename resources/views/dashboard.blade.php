<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{ Auth::user()->user_level  }}
                <div class="p-6 bg-white border-b border-gray-200 md:flex w-full">
                    <section class="flex-1 min-w-max">
                    <h2>Documents</h2>

                    <ul>
                        @foreach($documents as $doc)
                        <li class="clear-both">
                            
                            <a href="{{route('regisView',$doc->Doc_Code)}}">
                                {{$doc->id}} {{$doc->Doc_Code}} : {{$doc->Doc_Name}} 
                                @unless ($doc->Doc_ver===0)
                                Rev {{$doc->Doc_ver}}
                                @endunless
                                <br>
                            </a>
                        <span class="text-sm ">update {{$doc->updated_at}}</span> <hr>
                        <!-- {{$doc}} -->
                        </li>
                            
                        @endforeach
                    </ul>
                    </section>
                    <section class="mt-16 md:mt-0 flex-1 min-w-max">
                    <h2>Training</h2>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
