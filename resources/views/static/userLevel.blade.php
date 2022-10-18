<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('User Level') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    User Level
                    <table>
                        <thead>
                            <tr>
                            <th rowspan="2">Level</th>
                            <th colspan="10">Capible</th>
                            <th rowspan="2">Remark</th>
                            </tr>
                            <tr>
                            <th>View Document</th>
                            <th>Add Document</th>
                            <th>Review Document</th>
                            <th>Approve Document</th>

                            <th>View Training</th>
                            <th>Add Training</th>
                            <th>Review Training</th>
                            <th>Approve Training</th>

                            <th>View Profile</th>
                            <th>Manage User</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr class="h-24 min-h-max">
                                <td class="h-24 min-h-max"> 1</td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object> </td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td>-</td>
                            </tr>
                            <tr class="h-24 min-h-max">
                                <td class="h-24 min-h-max">2</td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td>-</td>
                            </tr>
                            <tr class="h-24 min-h-max">
                                <td class="h-24 min-h-max">3</td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td>-</td>
                            </tr>
                            <tr class="h-24 min-h-max">
                                <td class="h-24 min-h-max">4</td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_green m-auto" type="image/svg+xml" data="{{asset('icon/check-circle.svg')}}"><img src="{{asset('icon/check-circle.svg')}}" /></object> </td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td><object class="stroke-brand_orange m-auto" type="image/svg+xml" data="{{asset('icon/x-circle.svg')}}"><img src="{{asset('icon/x-circle.svg')}}" /></object></td><td>-</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
