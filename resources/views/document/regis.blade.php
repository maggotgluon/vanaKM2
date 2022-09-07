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
                    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
                    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
                    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
                    <script>
                        $(document).ready( function () {
                            console.log('jqready')
                            $('#table_id').DataTable();
                        } );
                    </script>
                    
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

<!--                     
                    <h2 class="text-xl mt-10">Document</h2>
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Document Name</th>
                                <th>Objective</th>
                                <th>Sattus</th>
                                <th>Update</th>

                            @can('manage_document', Auth::user())
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $doc)
                            <tr>
                                <td>{{$doc->Doc_Code}}</td>
                                <td>
                                    <a href="{{route('regisView',$doc->Doc_Code)}}" class="text-blue-400">
                                    {{$doc->Doc_Name}}  
                                    @unless ($doc->Doc_ver===0)
                                        Rev {{$doc->Doc_ver}}
                                    @endunless
                                    </a>
                                    <br>
                                    <span class="text-sm ">by : {{Auth::user()->name}}</span> 
                                </td>
                                <td>Objective</td>
                                <td>{{$doc->Doc_Status}} </td>
                                <td>{{$doc->updated_at}} </td>

                            @can('manage_document', Auth::user())
                                <td>
                                    <div class="flex">
                                        
                                        @if ($doc->Doc_Status <= 0)
                                            <form action="{{route('regisApprove',$doc->id,'approve=true')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$doc->id}}">
                                                <input type="hidden" name="manage" value="approved">
                                                <button class="bg-pink-400 p-2 m-2">Approve</button>
                                            </form>
                                        @endif
                                        @if ($doc->Doc_Status >= 0)
                                            <form action="{{route('regisApprove',$doc->id,'approve=false')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden" name="regID" value="{{$doc->id}}">
                                                <input type="hidden" name="manage" value="rejected">
                                                <button class="bg-pink-400 p-2 m-2">Reject</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                                @endcan
                            </tr>
                            @endforeach

                        </tbody>
                    </table> -->
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
                    @endif
                        <hr>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
