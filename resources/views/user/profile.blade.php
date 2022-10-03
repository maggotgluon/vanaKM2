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
                        <!-- {{$user}} -->
                        <form action="{{route('user.update',$user)}}" method="post" >
                        @csrf
                            <label for="suser">Department Head : </label>  {{$user->department_head}} 
                            <div class="update">
                            Change to 
                                <select class="bg-backdrop rounded-md"  name="suser" id="suser">
                                    <option value="">{{$user->department_head}}</option>
                                    @foreach ($dp as $suser)
                                        <option value="{{$suser->staff_id}}">{{$suser->staff_id}}:{{$suser->name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Save</button>
                                
                            </div>
                        </form>
                       

                        <hr>
                        @can('manage_users', Auth::user())
                        <div>
                                <h2>Add permission</h2>
                                <!-- {{$user}} -->
                                @can('edit_document', $user)
                                <a href="{{route('user.addPri',[$user,'edit_document','TRUE'])}}"><button id="edit_document" class="bg-green-400 py-2 px-4 m-2">can edit document</button></a>
                                @endcan
                                @can('edit_trainDocument', $user)
                                <a href="{{route('user.addPri',[$user,'edit_trainDocument'])}}"><button id="edit_trainDocument" class="bg-green-400 py-2 px-4 m-2">can edit train Document</button></a>
                                @endcan
                                @can('manage_document', $user)
                                <a href="{{route('user.addPri',[$user,'manage_document'])}}"><button id="manage_document" class="bg-green-400 py-2 px-4 m-2">can manage document</button></a>
                                @endcan
                                @can('manage_trainDocument', $user)
                                <a href="{{route('user.addPri',[$user,'manage_trainDocument'])}}"><button id="manage_trainDocument" class="bg-green-400 py-2 px-4 m-2">can manage train Document</button></a>
                                @endcan
                                @can('manage_users', $user)
                                <a href="{{route('user.addPri',[$user,'manage_users'])}}"><button id="manage_users" class="bg-green-400 py-2 px-4 m-2">can manage users</button></a>
                                @endcan
                                @can('publish_document', $user)
                                <a href="{{route('user.addPri',[$user,'publish_document'])}}"><button id="publish_document" class="bg-green-400 py-2 px-4 m-2">can publish document</button></a>
                                @endcan
                            </div>
                            
                            {{$user->users_permission}}
                            @foreach ($user->users_permission as $permission)
                                @if ( $permission->allowance === 1 )
                                <div class="flex justify-between items-center w-full bg-gray-100">
                                    <span>
                                    {{$permission->permissions_type}} :
                                    {{$permission->parmission_name}} 
                                    </span>
                                    <a href="{{route('user.remPri',[$user, $permission->parmission_name])}}">
                                        <button class="bg-red-400 px-4 py-2">removed</button>
                                    </a>
                                </div>
                                @endif
                            @endforeach
                        @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>