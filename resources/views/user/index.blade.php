<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-screen p-4">
                <div class="hidden sm:flex sm:items-center sm:ml-6 m-4">
                    <x-jet-dropdown align="left">
                        <x-slot name="trigger">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                {{ __('Department') }}
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-jet-responsive-nav-link href="{{ route('user.index') }}">
                                {{ __('Show All') }}
                            </x-jet-responsive-nav-link>
                            @foreach ( App\Models\User::all()->unique('department') as $department )
                            <x-jet-responsive-nav-link href="{{ route('user.index',['department'=>$department->department]) }}">
                                {{ $department->department }}
                            </x-jet-responsive-nav-link>

                            @endforeach

                        </x-slot>
                    </x-jet-dropdown>

                    {{request()->department}}
                    <x-button icon="user-add" href="{{ route('user.create') }}">{{__('Add New User')}}</x-button>


                    <form action="{{route('user.search')}}" method="POST" class="ml-auto flex gap-2">
                        @csrf
                        <x-input prefix="search" placeholder="search" icon="user" name="search"/>
                        <x-button type="submit">{{__('search')}}</x-button>
                    </form>
                </div>
                @if($users->count()>0)
                <table class="w-full">
                    <thead class="bg-gray-300">
                        <tr class="text-center">
                            <!-- <td class="border w-min px-2">No.</td> -->
                            <td class="border w-1/12 px-2">
                                <x-button flat href="{{route('user.index',['id'=>request()->id=='desc'?'asc':'desc'])}}"
                                    rightIcon="{{request()->id=='desc'?'sort-descending':'sort-ascending'}}"
                                    class="w-max" label="{{__('Staff ID')}}" />
                            </td>
                            <td class="border w-7/12 px-1">{{__('Name')}}</td>
                            <td class="border w-2/12 px-2">
                                <x-jet-dropdown align="left">
                                    <x-slot name="trigger">
                                        <button type="button" class="inline-flex w-max items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  focus:outline-none transition">
                                            {{ __('Department') }}
                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">


                                        <x-jet-responsive-nav-link href="{{ route('user.index',request()->query()) }}">
                                            {{ __('Show All') }}
                                        </x-jet-responsive-nav-link>
                                        @foreach ( App\Models\User::all()->unique('department') as $department )
                                        <x-jet-responsive-nav-link href="{{ route('user.index',['department'=>$department->department] ) }}">

                                            {{ $department->department }}
                                        </x-jet-responsive-nav-link>

                                        @endforeach

                                    </x-slot>
                                </x-jet-dropdown>
                            </td>
                            <td class="border w-2/12 px-2">
                                <x-jet-dropdown align="left">
                                    <x-slot name="trigger">
                                        <button type="button" class="inline-flex w-max items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  focus:outline-none transition">
                                            {{ __('User Level') }}
                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">


                                        <x-jet-responsive-nav-link href="{{ route('user.index') }}">
                                            {{ __('Show All') }}
                                        </x-jet-responsive-nav-link>
                                        @foreach ( App\Models\User::orderBy('user_level')->get()->unique('user_level') as $user )
                                            <x-jet-responsive-nav-link href="{{ route('user.index',['user_level'=>$user->user_level]) }}" class="min-w-max">
                                                {{$user->user_level}}:<x-user-level class="inline" :level="$user->user_level" />
                                            </x-jet-responsive-nav-link>

                                        @endforeach

                                    </x-slot>
                                </x-jet-dropdown>

                            </td>
                            <td class="border w-1/12 px-2">
                                <span class="inline-flex w-max items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  focus:outline-none transition">
                                    {{__('Action')}}</td>
                                </span>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="bg-white odd:bg-gray-100">
                            <td class="md:text-center block md:table-cell p-2">{{$user->staff_id}}</td>
                            <td class="block md:table-cell p-2">{{$user->name}} <span class="block text-xs">{{$user->position}}</span></td>
                            <td class="md:text-center block md:table-cell p-2">

                                <x-button flat href="{{route('user.index',['department'=>$user->department])}}"
                                    class="text-md tracking-normal bg-transparent text-black hover:bg-transparent active:bg-transparent focus:border-transparent focus:ring-0">
                                    {{$user->department}}
                                </x-button>
                            </td>
                            <td class="md:text-center block md:table-cell p-2">

                                <x-button flat href="{{route('user.index',['user_level'=>$user->user_level])}}"
                                    class="text-md tracking-normal bg-transparent text-black hover:bg-transparent active:bg-transparent focus:border-transparent focus:ring-0">
                                    <x-user-level :level="$user->user_level" />
                                </x-button>
                            </td>
                            <td  class="md:text-center block md:table-cell p-2">
                                <x-button positive icon="eye" href="{{route('user.show',[$user->id])}}" >
                                    {{__('View')}}
                                </x-button>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ( $users->lastPage()!==1 )

                <div class="m-4 bg-slate-200 rounded-md text-center p-4">
                    {{ $users->links() }}
                </div>
                @endif


                @else
                <div class="m-4 bg-slate-200 rounded-md text-center p-4">
                    Nothing here
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
