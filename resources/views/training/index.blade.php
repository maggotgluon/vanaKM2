<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show All Train approved') }}
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
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
                {{__('Training')}}
                <!-- {{ Auth::user()->id }} -->
                <!-- {{gettype($documents)}} -->


                <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th> {{ __('Dar Number') }}</th>
                                <th class="w-2/6"> {{ __('Date') }}</th>
                                <th class="w-1/6"> {{ __('View_Document') }}</th>
                            </tr>

                        </thead>
                        <tbody>
                        @foreach ($documents as $document)
                        <!-- {{$document}} -->

                        <tr class="m-1">
                            <td>
                                <a href="{{route('training.view',$document->Doc_Code)}}">
                                    {{$document->Doc_008->SUBJECT}}
                                </a>
                            </td>

                            <td><span class="text-sm ">update {{$document->updated_atT}}</span></td>
                            <td><x-button href="{{route('training.view',$document->Doc_Code)}}" class="py-1 m-1">view</x-button></td>
                        </tr>
                        @endforeach
                    </table>
            </div>
        </div>
    </div>
</x-app-layout>
