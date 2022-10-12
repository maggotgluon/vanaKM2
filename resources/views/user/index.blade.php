<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage User') }}
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

    @isset($data->department)
    <script>
        $(document).ready( function () {
            const departmentValue = document.querySelector('#departmentValue')
            const filterDepartment = document.querySelector('#department')
            filterDepartment.value=departmentValue.value
        } );
    </script>
    @endisset
    @isset($data->level)
    <script>
        $(document).ready( function () {
            const levelValue = document.querySelector('#levelValue')
            const filterLevel = document.querySelector('#level')
            filterLevel.value=levelValue.value
        } );
    </script>
    @endisset
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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('ListAllUser') }}</h2>
                    
                    <div class="flex gap-4 py-2">
                        <form method="post" action="{{ route('user.allFilter') }}">
                        @csrf
                        {{__('Department')}}
                            @isset($data->department)
                            <input id="departmentValue" hidden value="{{$data->department}}">
                            @endisset
                            <select name="department" id="department" onchange="this.closest('form').submit();">
                                <option value="null">All</option>
                                <option value="Admissions">Admissions</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Executive Office">Executive Office</option>
                                <option value="Finance">Finance</option>
                                <option value="Food and Beverage">Food and Beverage</option>
                                <option value="Human Resources">Human Resources</option>
                                <option value="IT">IT</option>
                                <option value="Laundry">Laundry</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Operations">Operations</option>
                                <option value="Park Service">Park Service</option>
                                <option value="Retail">Retail</option>
                                <option value="Sales">Sales</option>
                            </select>
                        </form> 
                    
                        <form method="post" action="{{ route('user.allFilter') }}">
                        @csrf
                        {{__('Level')}}
                            @isset($data->level)
                            <input id="levelValue" hidden value="{{$data->level}}">
                            @endisset
                            <select name="level" id="level" onchange="this.closest('form').submit();">
                                <option value="null">Any</option>
                                <option value="MR">MR</option>
                                <option value="Director">Director</option>
                                <option value="Manager">Manager</option>
                                <option value="Assistant Manager">Assistant Manager</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </form> 
                    </div>

                    <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>{{__('IDSTAFF')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Department')}}</th>
                            <th>{{__('Position')}}</th>
                            <th>{{__('Level')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->staff_id}}</td>
                        <td><a href="{{route('user.profile',$user->id)}}">{{$user->name}}</a> <br> <span class="text-sm">{{$user->email}}</span></td>
                        <td>{{$user->department}}</td>
                        <td>{{$user->position}}</td>
                        <td>{{$user->user_level}}</td>
                        <td><a href="{{route('user.profile',$user->id)}}" class="bg-green-400 py-2 px-8 hover:bg-green-700 hover:text-white transition-all duration-500">Edit</a></td>
                    </tr>
                    @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>