<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Manage') }}
        </h2>
    </x-slot>


    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
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
                    <h2>list of all user</h2>
                    <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->staff_id}}</td>
                        <td>{{$user->name}} <br> <span calss="text-sm">{{$user->email}}</span></td>
                        <td>{{$user->department}}</td>
                        <td><a href="{{route('user.profile',$user->id)}}" class="bg-green-400 py-2 px-8 hover:bg-green-700 hover:text-white transition-all duration-500">Edit</a></td>
                    </tr>
                    @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>