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
                    <!-- {{ Auth::user()->id }} -->
                    <!-- {{gettype($message)}} -->

                    <style>
                        .approved{
                            background: green;
                        }
                        .rejected{
                            background: red;
                        }
                    </style>
                        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
                    @isset($message->name)
                        <script>
                            console.log('tost')
                            Toastify({
                                text: "{{$message->name}} : {{$message->result}}",
                                duration: 6000,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "center", // `left`, `center` or `right`
                                className:"{{$message->result}}",
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                            }).showToast();
                        </script>
                    @endif

                    <h2 class="text-xl mt-10">Pending Approved</h2>
                    <ul class="border-2 border-top-none border-red-400 p-4">
                        @foreach($documents as $doc)
                        @if ($doc->Doc_Status == 0)
                        <li class="clear-both">
                            @if (Auth::user()->id ==99 || 1)
                            <span class="float-right">
                                upload by :
                                {{Auth::user()->name}}
                                status : {{$doc->Doc_Status}} 
                                <div class="flex">
                                <form action="{{route('regisApprove',$doc->id,'approve=true')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                    <input type="hidden" name="manage" value="approved">
                                    <button class="bg-pink-400 p-2 m-2">Approve</button>
                                </form>

                                <form action="{{route('regisApprove',$doc->id,'approve=false')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                    <input type="hidden" name="manage" value="rejected">
                                    <button class="bg-pink-400 p-2 m-2">Reject</button>
                                </form>
                            </div>
                            </span>
                            @endif
                            {{$doc->id}} {{$doc->Doc_Code}} : {{$doc->Doc_Name}} 
                            @unless ($doc->Doc_ver===0)
                            Rev {{$doc->Doc_ver}}
                            @endunless
                            <br>
                            <span class="text-sm ">update {{$doc->updated_at}}</span> <hr>
                            <a href="{{route('regisView',$doc->Doc_Code)}}" class="color-blue-400">
                                view
                            </a>
                        <!-- {{$doc}} -->
                        </li>
                        @endif
                            
                        @endforeach
                    </ul>
                    <hr>
                    <h2 class="text-xl mt-10">Approved</h2>
                    <ul class="border-2 border-top-none border-red-400 p-4">
                        @foreach($documents as $doc)
                        @if ($doc->Doc_Status == 1)
                        <li class="clear-both">
                            @if (Auth::user()->id ==99 || 1)
                            <span class="float-right">
                                upload by :
                                {{Auth::user()->name}}
                                status : {{$doc->Doc_Status}} 
                                <div class="flex">
                                <!-- <form action="{{route('regisApprove',$doc->id,'approve=true')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                    <input type="hidden" name="manage" value="approved">
                                    <button class="bg-pink-400 p-2 m-2">Approve</button>
                                </form> -->

                                <form action="{{route('regisApprove',$doc->id,'approve=false')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                    <input type="hidden" name="manage" value="rejected">
                                    <button class="bg-pink-400 p-2 m-2">Reject</button>
                                </form>
                            </div>
                            </span>
                            @endif
                            {{$doc->id}} {{$doc->Doc_Code}} : {{$doc->Doc_Name}} 
                            @unless ($doc->Doc_ver===0)
                            Rev {{$doc->Doc_ver}}
                            @endunless
                            <br>
                            <span class="text-sm ">update {{$doc->updated_at}}</span> <hr>
                            <a href="{{route('regisView',$doc->Doc_Code)}}" class="color-blue-400">
                                view
                            </a>
                        <!-- {{$doc}} -->
                        </li>
                        @endif
                            
                        @endforeach
                    </ul>
                    <hr>
                    <h2 class="text-xl mt-10">Reject</h2>
                    <ul class="border-2 border-top-none border-red-400 p-4">
                        @foreach($documents as $doc)
                        @if ($doc->Doc_Status == -1)
                        <li class="clear-both">
                            @if (Auth::user()->id ==99 || 1)
                            <span class="float-right">
                                upload by :
                                {{Auth::user()->name}}
                                status : {{$doc->Doc_Status}} 
                                <div class="flex">
                                <form action="{{route('regisApprove',$doc->id,'approve=true')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                    <input type="hidden" name="manage" value="approved">
                                    <button class="bg-pink-400 p-2 m-2">Approve</button>
                                </form>

                                <!-- <form action="{{route('regisApprove',$doc->id,'approve=false')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="regID" value="{{$doc->id}}">
                                    <input type="hidden" name="manage" value="rejected">
                                    <button class="bg-pink-400 p-2 m-2">Reject</button>
                                </form> -->
                            </div>
                            </span>
                            @endif
                            {{$doc->id}} {{$doc->Doc_Code}} : {{$doc->Doc_Name}} 
                            @unless ($doc->Doc_ver===0)
                            Rev {{$doc->Doc_ver}}
                            @endunless
                            <br>
                            <span class="text-sm ">update {{$doc->updated_at}}</span> <hr>
                            <a href="{{route('regisView',$doc->Doc_Code)}}" class="color-blue-400">
                                view
                            </a>
                        <!-- {{$doc}} -->
                        </li>
                        @endif
                            
                        @endforeach
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
