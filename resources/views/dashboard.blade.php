<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <style>
        select {
            padding-inline: 1.5rem !important;
        }
        .Pending td{
        }
        .Approve td{
            background-color: rgb(0, 255, 0, .1);
        }
        .Reject td{
            background-color: rgb(255, 0, 0, .1);}
    </style>
    <script>
        $(document).ready( function () {
            console.log('jqready')
            $('#table_id').DataTable();
            $('#table_document').DataTable();
        } );
    </script>

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

                    <table id="table_document" class="display">
                        <thead>
                            <tr>
                                <th> {{ __('Dar Number') }}</th>
                                <th class="w-1/6"> {{ __('Document Type') }}</th>
                                <th class="w-2/6"> {{ __('Date') }}</th>
                                <th class="w-1/6"> {{ __('View_Document') }}</th>
                            </tr>

                        </thead>
                        <tbody>
                        @foreach ($documents as $document)
                        <!-- {{$document}} -->
                        <tr class="">
                            <td>
                                <a href="{{route('document.view',$document->Doc_Code)}}" class="hover:text-brand_blue">
                                {{$document->Doc_Name}} {{$document->Doc_FullName}}
                                </a>
                            </td>
                            <td>{{$document->Doc_Type}}</td>

                            <td>{{$document->Doc_StartDateT}}</td>
                            <td><x-button href="{{route('document.view',$document->Doc_Code)}}" class="py-1 m-1">view</x-button></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Training

                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th> {{ __('Dar Number') }}</th>
                                <th class="w-2/6"> {{ __('Date') }}</th>
                                <th class="w-1/6"> {{ __('View_Document') }}</th>
                            </tr>

                        </thead>
                        <tbody>
                        @foreach ($trainings as $training)
                        <tr class="m-1">
                            <td>
                                <a href="{{route('training.view',$training->Doc_Code)}}">
                                    {{$training->Doc_008->SUBJECT}}
                                </a>
                            </td>
                            <td><span class="text-sm ">update {{$training->updated_atT}}</span></td>
                            <td><x-button href="{{route('training.view',$training->Doc_Code)}}" class="py-1 m-1">view</x-button></td>
                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
