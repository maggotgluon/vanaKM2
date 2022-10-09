<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- {{Auth::user()}} -->
                    <h2>{{$user->name}}</h2>
                        email : {{$user->email}}<br>
                        ID : {{$user->staff_id}}<br>
                        Department : {{$user->department}}<br>
                        Department : {{$user->position}}<br>
                        Department Head : {{$user->department_head}}<br>
                        {{$user->user_level}}<br>
                        <hr>
                        <form action="{{route('user.update',$user)}}" method="post" >
                        @csrf
                            <label for="suser">Department Head : </label>  {{$user->department_head}} 
                            <div class="update">
                            Change to 
                                <select class="bg-backdrop rounded-md"  name="suser" id="suser">
                                    <option value="{{$user->department_head}}">{{$user->department_head}}</option>
                                    @foreach ($dp as $suser)
                                        <option value="{{$suser->staff_id}}">{{$suser->staff_id}}:{{$suser->name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Save</button>

                            </div>
                        </form>

                        <hr>
                        @can('manage_users', Auth::user())
                        <h2>Add permission</h2>
                        <div class="grid grid-cols-3 gap-4">
                            <form action="{{route('user.permission',$user)}}" method="post" >
                                @csrf
                                    <x-text-input hidden value="edit_document" name="permission"></x-text-input>
                                    <x-text-input hidden value="1" name="allowance"></x-text-input>
                                    <x-primary-button class="w-full">can edit document</x-primary-button>
                                </form>


                            <form action="{{route('user.permission',$user)}}" method="post" >
                                @csrf
                                    <x-text-input hidden value="edit_trainDocument" name="permission"></x-text-input>
                                    <x-text-input hidden value="1" name="allowance"></x-text-input>
                                    <x-primary-button class="w-full">can edit_trainDocument</x-primary-button>
                                </form>

                            <form action="{{route('user.permission',$user)}}" method="post" >
                                @csrf
                                    <x-text-input hidden value="manage_document" name="permission"></x-text-input>
                                    <x-text-input hidden value="1" name="allowance"></x-text-input>
                                    <x-primary-button class="w-full">can manage_document</x-primary-button>
                                </form>

                            <form action="{{route('user.permission',$user)}}" method="post" >
                                @csrf
                                    <x-text-input hidden value="manage_trainDocument" name="permission"></x-text-input>
                                    <x-text-input hidden value="1" name="allowance"></x-text-input>
                                    <x-primary-button class="w-full">can manage_trainDocument</x-primary-button>
                                </form>

                            <form action="{{route('user.permission',$user)}}" method="post" >
                                @csrf
                                    <x-text-input hidden value="manage_users" name="permission"></x-text-input>
                                    <x-text-input hidden value="1" name="allowance"></x-text-input>
                                    <x-primary-button class="w-full">can manage_users</x-primary-button>
                                </form>

                            <form action="{{route('user.permission',$user)}}" method="post" >
                                @csrf
                                    <x-text-input hidden value="publish_document" name="permission"></x-text-input>
                                    <x-text-input hidden value="1" name="allowance"></x-text-input>
                                    <x-primary-button class="w-full">can publish_document</x-primary-button>
                                </form>
                        </div>

                            
                        <div class="p-4">
                            @foreach ($user->userPermission as $permission)
                                @if ( $permission->allowance === 1 )
                                <div class="flex gap-4 my-2">
                                    <span class="">
                                    {{$permission->permissions_type}}
                                    </span>
                                    <span>
                                    {{$permission->parmission_name }}
                                    </span> 
                                    <form action="{{route('user.permission',$user)}}" method="post" class="ml-auto">
                                    @csrf
                                        <x-text-input hidden value="{{$permission->parmission_name }}" name="permission"></x-text-input>
                                        <x-text-input hidden value="0" name="allowance"></x-text-input>
                                        <x-primary-button class="w-full bg-red-500 hover:bg-red-700">Removed {{$permission->parmission_name }}</x-primary-button>
                                    </form>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>