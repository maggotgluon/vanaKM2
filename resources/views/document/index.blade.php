<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents approved') }}
        </h2>
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <style>
        #table_id_length select {
            padding-inline: 1.5rem;
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
        } );
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                    {{__('Document')}}
                    <!-- {{ Auth::user()->id }} -->
                    <!-- {{gettype($documents)}} -->
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th> {{ __('Dar Number') }}</th>
                                <th> {{ __('Document Type') }}</th>
                                <th> {{ __('Date') }}</th>
                                <th> {{ __('View_Document') }}</th>
                            </tr>

                        </thead>
                        <tbody>
                        @foreach ($documents as $document)
                        <!-- {{$document}} -->
                        <tr class="">
                            <td>{{$document->Doc_Name}} {{$document->Doc_FullName}} <hr>
                            </td>
                            <td>{{$document->Doc_Type}}</td>

                            <td>{{$document->Doc_StartDate}}</td>
                            <td><x-button href="{{route('document.view',$document->Doc_Code)}}">view</x-button></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
