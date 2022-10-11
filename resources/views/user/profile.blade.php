<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile') }} : {{$user->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- {{$user}} -->
                    <!-- <h2>{{$user->name}}</h2> -->
                    {{__('E-mail')}} : {{$user->email}}<br>
                    {{__('ID')}} : {{$user->staff_id}}<br>
                    {{__('Department')}} : {{$user->department}}<br>
                    {{__('position')}} : {{$user->position}}<br>
                    {{__('Department Head')}} : {{$user->department_head}}<br>
                    {{$user->user_level}}<br>
                    <hr>
                </div>
            </div>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6  border-b border-gray-200">
                    <h3>{{__('Update Password')}}</h3>
                    <form action="{{route('user.changePassword',$user)}}" method="post" >
                        @csrf
                        <div>
                            <x-input-label for="current_password" class="inline">{{__('Current Password')}}</x-input-label>
                            <x-text-input required value="{{old('current_password') }}" type="password" name="current_password" id="current_password" />

                            @error('current_password')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </div>
                        <div>
                            <x-input-label for="new_password" class="inline">{{__('New Password')}}</x-input-label>
                            <x-text-input required value="{{old('new_password') }}" type="password" name="new_password" id="new_password" />

                            @error('new_password')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </div>
                        <div>
                            <x-input-label for="new_confirm_password" class="inline">{{__('Confirm Password')}}</x-input-label>
                            <x-text-input required value="{{old('new_confirm_password') }}" type="password" name="new_confirm_password" id="new_confirm_password" />

                            @error('new_confirm_password')
                            <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full ">{{$message}}</span>
                            @enderror
                        </div>
                            <x-primary-button >changePassword</x-primary-button>
                    </form>
                </div>
            </div>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6  border-b border-gray-200">
                    <h3>Update Email</h3>

                    <form action="{{route('user.update',$user)}}" method="post" >
                    @csrf
                        <x-text-input hidden value="email" name="update"></x-text-input>
                        <x-input-label  for="email" class="inline">email</x-input-label >
                        <x-text-input required value="{{$user->email}}" type="email" class="bg-backdrop rounded-md"  name="email" id="email" />
                        <x-primary-button type="submit">Save</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6  border-b border-gray-200">
                    <h3>Update User info</h3>


                    <form action="{{route('user.update',$user)}}" method="post" >
                        @csrf
                            <x-text-input hidden value="department_head" name="update"></x-text-input>
                            <x-input-label for="suser" class="inline">Department Head : </x-input-label >
                            <select class="bg-backdrop rounded-md"  name="suser" id="suser">
                                <option value="{{$user->department_head}}">{{$user->department_head}}</option>
                                @foreach ($dp as $suser)
                                    @if($suser->user_level !=='Staff' && $suser->user_level !=='Supervisor' )
                                    <option value="{{$suser->staff_id}}">{{$suser->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-primary-button type="submit">Save</x-primary-button>
                        </form>

                    @can('manage_users', Auth::user())
                    <form action="{{route('user.update',$user)}}" method="post" >
                        @csrf
                        <x-text-input hidden value="department" name="update"></x-text-input>
                        <x-input-label for="department" class="inline">Department</x-input-label >
                        <!-- <x-text-input value="{{$user->department}}" list="departments" type="text" class="bg-backdrop rounded-md"  name="department" id="department" /> -->
                        <select class="bg-backdrop rounded-md"  name="department" id="department">
                            <option value="{{$user->department}}">{{$user->department}}</option>

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
                        <x-primary-button type="submit">Save</x-primary-button>
                    </form>
                    <form action="{{route('user.update',$user)}}" method="post" >
                        @csrf
                        <x-text-input hidden value="position" name="update"></x-text-input>
                        <x-input-label for="position" class="inline">position</x-input-label >
                        <x-text-input value="{{$user->position}}" type="text" class="bg-backdrop rounded-md"  name="position" id="position" />
                        <x-primary-button type="submit">Save</x-primary-button>
                    </form>
                    <form action="{{route('user.update',$user)}}" method="post" >
                        @csrf
                        <x-text-input hidden value="user_level" name="update"></x-text-input>
                        <x-input-label for="user_level" class="inline">user_level</x-input-label >
                        <select class="bg-backdrop rounded-md"  name="user_level" id="user_level">
                            <option value="{{$user->user_level}}">{{$user->user_level}}</option>
                            <option value="MR">MR</option>
                            <option value="Director">Director</option>
                            <option value="Manager">Manager</option>
                            <option value="Assistant Manager">Assistant Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Staff">Staff</option>
                        </select>
                        <x-primary-button type="submit">Save</x-primary-button>
                    </form>
                    @endcan
                </div>
            </div>

            @can('manage_users', Auth::user())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6  border-b border-gray-200">
                    <h3>Update Parmission</h3>
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
                </div>
            </div>
            @endcan
        </div>
    </div>
</x-app-layout>
