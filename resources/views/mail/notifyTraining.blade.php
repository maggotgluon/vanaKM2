<x-guest-layout>
    <x-slot name="header">
    </x-slot>
    <div class="w-full bg-gray-100 py-10 min-h-screen">

        <div class="rounded-md max-w-lg w-full shadow-md m-auto bg-brand_blue/10 p-2 pb-6">
            <table class="w-full">
                <tr>
                    <td>
                        <x-jet-application-logo class="block h-24 w-auto m-auto -mt-9" />
                    </td>
                </tr>
                <tr>
                    <td>

                        <div class="bg-white rounded-md shadow-sm p-4 my-4 w-full">
                            <table class="w-full">
                                <tr>
                                    <td class="w-1/6">
                                        <strong>{{__('Status')}} :</strong>
                                    </td>
                                    <td class="text-left w-5/6">
                                        <x-request-status :status="$data->training_status" />
                                    </td>
                                </tr>

                                @if ($data->req_remark!==null)
                                <tr>
                                    <td>
                                        <strong>{{__('Remark')}}:</strong>
                                    </td>
                                    <td class="text-left">
                                        {{$data->req_remark}}
                                    </td>
                                </tr>
                                @endif

                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{__('Requester Information')}} :</strong> {{App\Models\User::find($data->user_id)->staff_id}} {{App\Models\User::find($data->user_id)->name}}
                    </td>
                </tr>
                <tr>
                    <td class="py-4">
                        <x-card title="{{__('Subject')}} : {{$data->training_008->subject}}" >
                            {{__('Instructor')}} :{{App\Models\User::find($data->instructor)->name}}<br>
                            {{__('Date Strat')}} : {{$data->training_008->train_dateStart->isoFormat('Do MMM YYYY')}} - {{$data->training_008->train_dateEnd->isoFormat('Do MMM YYYY')}}<br>
                            {{__('Time Strat')}} : {{$data->training_008->train_timeStart}} - {{$data->training_008->train_timeEnd}} <br>
                        </x-card>
                    </td>
                </tr>
                <tr>
                    <td class="grid grid-cols-3 gap-4">
                        <x-button primary href="{{route('training.request.show',['id'=>$data->id]) }}" label="{{__('View')}}" />
                        <x-button outline primary href="{{route('training.request.show_008',['id'=>$data->id]) }}" label="{{__('FM-LDS-008')}}" />
                        <x-button outline primary href="{{route('training.request.show_009',['id'=>$data->id]) }}" label="{{__('FM-LDS-009')}}" />
                    </td>
                </tr>
            </table>
        </div>
</x-guest-layout>
