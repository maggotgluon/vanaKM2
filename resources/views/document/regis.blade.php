<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Regis
                    <!-- {{ Auth::user()->id }} -->
                    <!-- {{gettype($documents)}} -->
                    <ul>
                        @foreach($documents as $doc)
                        <li class="clear-both">
                            @if (Auth::user()->id ==99 || 1)
                            <span class="float-right">
                                upload by :
                                {{Auth::user()->name}}

                                <form action="{{route('regisApprove',$doc->id,'approve=true')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 gap-2">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                    <input type="hidden" name="manage" value="approved">
                                    <button class="bg-pink-400 p-2 m-2">Approve</button>
                                </form>

                                <form action="{{route('regisApprove',$doc->id,'approve=false')}}" method="post" enctype="multipart/form-data" class="grid grid-cols-2 gap-2">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                    <input type="hidden" name="manage" value="rejected">
                                    <button class="bg-pink-400 p-2 m-2">Reject</button>
                                </form>
                            </span>
                            @endif
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
