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
                    
                    <h2>{{Auth::user()->name}}</h2>
                        email : {{Auth::user()->email}}<br>
                        ID : {{Auth::user()->staff_id}}<br>
                        Department : {{Auth::user()->department}}<br>
                        Department Head : {{Auth::user()->department_head}}<br>
                        <!-- {{Auth::user()->user_level}}<br> -->
                        <hr>
                        <!-- {{Auth::user()}} -->
                        <hr>
                        @can('manage_users', Auth::user())

                        @foreach (Auth::user()->users_permission as $permission)
                            @if ( $permission->allowance === 1 )
                            <div class="flex justify-between items-center w-full bg-gray-100">
                                <span>
                                {{$permission->permissions_type}} :
                                {{$permission->parmission_name}} 
                                </span>
                                <button class="bg-red-400 px-4 py-2">removed</button>
                            </div>
                            @endif
                        @endforeach
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>