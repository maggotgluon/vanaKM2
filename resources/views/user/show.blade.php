<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg min-h-screen">
                <div class="sm:flex sm:items-center sm:ml-6 m-4">
                    <!-- $user -->
                    <x-button rounded primary icon="chevron-left" href="{{route('user.index')}}">Back</x-button>
                </div>

                <div class="sm:flex sm:items-center sm:ml-6 m-4">
                    <form action="{{route('user.update',['id'=>$user->id])}}" method="post" class="grid grid-cols-6 gap-4 w-full">
                        @csrf
                        <div class="col-span-2 sm:col-span-2">
                            <x-input label="Staff ID" name="staff_id" value="{{$user->staff_id}}" />
                        </div>
                        <div class="col-span-4 sm:col-span-4">
                            <x-input label="Name" name="name" value="{{$user->name}}" />
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <x-input label="Email" name="email" value="{{$user->email}}" />
                        </div>
                        <div class="col-span-3 sm:col-span-3">
                            <x-input label="Position" name="position" value="{{$user->position}}" />
                        </div>
                        <div class="col-span-3 sm:col-span-3">
                            <!-- <x-input label="Department" name="department" value="{{$user->department}}"/> -->
                            <x-native-select label="Department" name="department" id="department" wire:model.defer="state.department">
                                <!-- <option value="null">All</option> -->
                                <option value="Admissions" {{ $user->department=="Admissions"?'selected':"" }}>Admissions</option>
                                <option value="Engineering" {{ $user->department=="Engineering"?'selected':"" }}>Engineering</option>
                                <option value="Executive Office" {{ $user->department=="Executive Office"?'selected':"" }}>Executive Office</option>
                                <option value="Finance" {{ $user->department=="Finance"?'selected':"" }}>Finance</option>
                                <option value="Food and Beverage" {{ $user->department=="Food and Beverage"?'selected':"" }}>Food and Beverage</option>
                                <option value="Human Resources" {{ $user->department=="Human Resources"?'selected':"" }}>Human Resources</option>
                                <option value="IT" {{ $user->department=="IT"?'selected':"" }}>IT</option>
                                <option value="Laundry" {{ $user->department=="Laundry"?'selected':"" }}>Laundry</option>
                                <option value="Marketing" {{ $user->department=="Marketing"?'selected':"" }}>Marketing</option>
                                <option value="Operations" {{ $user->department=="Operations"?'selected':"" }}>Operations</option>
                                <option value="Park Service" {{ $user->department=="Park Service"?'selected':"" }}>Park Service</option>
                                <option value="Retail" {{ $user->department=="Retail"?'selected':"" }}>Retail</option>
                                <option value="Sales" {{ $user->department=="Sales"?'selected':"" }}>Sales</option>

                                <option value="Event" {{ $user->department=="Event"?'selected':"" }}>Event</option>
                                <option value="Training" {{ $user->department=="Training"?'selected':"" }}>Training</option>
                                <option value="Purchasing" {{ $user->department=="Purchasing"?'selected':"" }}>Purchasing</option>
                            </x-native-select>
                        </div>
                        <div class="col-span-6 sm:col-span-6">

                            <x-native-select label="Department Head" name="department_head" id="department_head" wire:model.defer="state.department_head" class="bg-backdrop w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                @foreach ( App\Models\User::find($user->id)->HOD() as $hod )
                                @if ($hod->user_level>=3)
                                <option value="{{$hod->id}}" @if ($user->department_head == $hod->id)
                                    selected
                                    @endif
                                    >{{$hod->name}}</option>
                                @endif
                                @endforeach
                            </x-native-select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <!-- <x-input label="User Level" name="user_level" value="{{$user->user_level}}"/> -->

                            <x-native-select label="User Level" name="user_level" id="user_level" wire:model.defer="state.status">

                                <option {{$user->user_level==1?'selected':''}} value="1">1 : User</option>
                                <option {{$user->user_level==2?'selected':''}} value="2">2 : Requester</option>
                                <option {{$user->user_level==3?'selected':''}} value="3">3 : Acknowledgment</option>
                                <option {{$user->user_level==4?'selected':''}} value="4">4 : Reviewer-TN</option>
                                <option {{$user->user_level==5?'selected':''}} value="5">5 : Approver-TN</option>
                                <option {{$user->user_level==6?'selected':''}} value="6">6 : Reviewer-DCC</option>
                                <option {{$user->user_level==7?'selected':''}} value="7">7 : Approver-DCC</option>
                                <option disabled> ---- For System Test Only ---- </option>
                                <option {{$user->user_level==99?'selected':''}} value="99">99 : Admin</option>

                            </x-native-select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <!-- <x-input label="Status" name="status" value="{{$user->status}}"/> -->

                            <x-native-select label="Status" name="status" id="status" wire:model.defer="state.status">

                                <option value="0" {{$user->status?'selected':''}}>Resigned</option>
                                <option value="1" {{$user->status?'selected':''}}>Valid</option>

                            </x-native-select>
                        </div>
                        <div class="col-span-6 sm:col-span-6 p-6">
                            <table class="w-full">
                                <thead>
                                    <th class="w-2/6 text-center p-2">
                                    <td class="w-1/6 border text-center p-2">View</td>
                                    <td class="w-1/6 border text-center p-2">Request</td>
                                    <td class="w-1/6 border text-center p-2">Review</td>
                                    <td class="w-1/6 border text-center p-2">Approved</td>
                                    </th>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-brand_blue/10">
                                        <td class="border p-4">Document</td>
                                        <td class="border text-center p-2">
                                            <x-badge.circle positive icon="check" />
                                        </td>
                                        <td class="border text-center p-2">
                                            @if($user->can('edit_document'))
                                            <x-badge.circle positive icon="check" />
                                            @else
                                            <x-badge.circle negative icon="x" />
                                            @endcan
                                        </td>
                                        <td class="border text-center p-2">

                                            @if($user->can('review_document'))
                                            <x-badge.circle positive icon="check" />
                                            @else
                                            <x-badge.circle negative icon="x" />
                                            @endcan
                                        </td>
                                        <td class="border text-center p-2">

                                            @if($user->can('publish_document'))
                                            <x-badge.circle positive icon="check" />
                                            @else
                                            <x-badge.circle negative icon="x" />
                                            @endcan
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-brand_blue/10">
                                        <td class="border p-4">Training</td>
                                        <td class="border text-center p-2">
                                            <x-badge.circle positive icon="check" />
                                        </td>
                                        <td class="border text-center p-2">

                                            @if($user->can('edit_trainDocument'))
                                            <x-badge.circle positive icon="check" />
                                            @else
                                            <x-badge.circle negative icon="x" />
                                            @endcan
                                        </td>
                                        <td class="border text-center p-2">

                                            @if($user->can('review_trainDocument'))
                                            <x-badge.circle positive icon="check" />
                                            @else
                                            <x-badge.circle negative icon="x" />
                                            @endcan
                                        </td>
                                        <td class="border text-center p-2">

                                            @if($user->can('publish_trainDocument'))
                                            <x-badge.circle positive icon="check" />
                                            @else
                                            <x-badge.circle negative icon="x" />
                                            @endcan
                                        </td>
                                    </tr>
                                    <th class="text-center p-2">
                                    <td class="border text-center p-2" colspan="2">View</td>
                                    <td class="border text-center p-2" colspan="2">Manage</td>
                                    </th>
                                    <tr class="hover:bg-brand_blue/10">
                                        <td class="border p-4">User</td>
                                        <td class="border text-center p-2" colspan="2">
                                            <x-badge.circle positive icon="check" />
                                        </td>
                                        <td class="border text-center p-2" colspan="2">

                                            @if($user->can('manage_users'))
                                            <x-badge.circle positive icon="check" />
                                            @else
                                            <x-badge.circle negative icon="x" />
                                            @endcan

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <x-button type="submit">save</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="sm:ml-6 m-4 sm:grid sm:grid-cols-2 gap-3">
                    <div class="pb-6">
                        <x-card title="Permission">
                            <form action="{{route('user.permission',['id'=>$user->id])}}" method="post" class="grid grid-cols-6 gap-4 w-full">
                                @csrf
                                <input hidden name="permissions_type" value="permission" />
                                <div class="col-span-6 sm:col-span-6">
                                <x-native-select label="Permission" name="permissions_name">
                                    <optgroup label="Document">
                                    <option value="can_request_document">can request document</option>
                                    <option value="can_review_document">can review document</option>
                                    <option value="can_approve_document">can approve document</option>
                                    </optgroup>
                                    <optgroup label="Training">
                                    <option value="can_request_training">can request training</option>
                                    <option value="can_review_training">can review training</option>
                                    <option value="can_approve_training">can approve training</option>
                                    </optgroup>
                                    <optgroup label="Administrator">
                                    <option value="can_manage_user">can manage user</option>
                                    <option value="can_view_log">can view log</option>
                                    </optgroup>
                                </x-native-select>
                                </div>
                                <input hidden name="allowance" value="1" />
                                <div class="col-span-6 sm:col-span-6">
                                    <x-button type="submit">Add</x-button>
                                </div>
                            </form>
                            @foreach ( $user->permissions->where('permissions_type','permission')->where('allowance',1) as $permission )
                                <x-badge flat red label="{{$permission->parmission_name}}">
                                    <x-slot name="append" class="relative flex items-center w-2 h-2">
                                        <form action="{{route('user.permission',['id'=>$user->id])}}" method="post">
                                            @csrf
                                            <input hidden name="permissions_type" value="permission" />
                                            <input hidden name="permissions_name" value="{{$permission->parmission_name}}" />
                                            <input hidden name="allowance" value="0" />
                                            <button type="submit">
                                                <x-icon name="x" class="w-4 h-4" />
                                            </button>
                                        </form>
                                    </x-slot>
                                </x-badge>
                            @endforeach
                        </x-card>
                    </div>
                    <div class="pb-6">
                        <x-card title="Role">
                            <form action="{{route('user.permission',['id'=>$user->id])}}" method="post" class="grid grid-cols-6 gap-4 w-full">
                                @csrf
                                <input hidden name="permissions_type" value="role" />
                                <div class="col-span-6 sm:col-span-6">
                                    <x-native-select label="Permission" name="permissions_name">
                                        <optgroup label="User">
                                            <option value="User">User</option>
                                            <option value="Requester">Requester</option>
                                            <option value="Acknowledgment">Acknowledgment</option>
                                            <option value="Reviewer-TN">Reviewer-TN</option>
                                            <option value="Approver-TN">Approver-TN</option>
                                            <option value="Reviewer-DCC">Reviewer-DCC</option>
                                            <option value="Approver-DCC">Approver-DCC</option>
                                        </optgroup>
                                        <optgroup label="Administrator">
                                            <option value="Admin">Admin</option>
                                        </optgroup>

                                    </x-native-select>
                                </div>
                                <input hidden name="allowance" value="1" />
                                <div class="col-span-6 sm:col-span-6">
                                    <x-button type="submit">Add</x-button>
                                </div>
                            </form>
                            @foreach ( $user->permissions->where('permissions_type','role')->where('allowance',1) as $permission )
                                <x-badge flat red label="{{$permission->parmission_name}}">
                                    <x-slot name="append" class="relative flex items-center w-2 h-2">
                                        <form action="{{route('user.permission',['id'=>$user->id])}}" method="post">
                                            @csrf
                                            <input hidden name="permissions_type" value="role" />
                                            <input hidden name="permissions_name" value="{{$permission->parmission_name}}" />
                                            <input hidden name="allowance" value="0" />
                                            <button type="submit">
                                                <x-icon name="x" class="w-4 h-4" />
                                            </button>
                                        </form>
                                    </x-slot>
                                </x-badge>
                            @endforeach
                        </x-card>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
