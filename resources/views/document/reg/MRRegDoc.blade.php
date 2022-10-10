<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MR Requested Document') }}
        </h2>
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <style>
        #table_id_length select {
            padding-inline: 1.5rem;
        }
    </style>
    <script>
        $(document).ready( function () {
            console.log('jqready')
            $('#table_id').DataTable();
        } );
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                
                <div class="p-6 bg-white border-b border-gray-200">
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Last Update</th>
                                <th>Remark</th>
                            </tr>
                        
                        </thead>
                        <tbody>
                        @foreach ($documents as $document)
                        <!-- {{$document}} -->
                        <tr>
                            <td>{{$document->Doc_Code}}:{{$document->Doc_Name}} <hr>
                                <span>{{$document->Doc_Obj}} {{__('reason')}} {{$document->Doc_Description}}</span>
                            </td>
                            <td>{{$document->Doc_Type}}</td>
                            <td>
                                @if ($document->Doc_Status==0)
                                    Pending
                                @elseif ($document->Doc_Status==-1)
                                    Reject
                                @elseif ($document->Doc_Status==1)
                                    Approve
                                @endif
                                
                            </td>
                            <td>{{$document->updated_at}}<br><span class="text-sm"> Create at :{{$document->created_at}}</span></td>
                            <td></td>
                            
                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>