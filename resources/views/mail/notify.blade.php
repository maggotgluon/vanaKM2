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
                                        <x-request-status :status="$data->req_status" />
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
                        <x-card title="{{$data->doc_type}}-{{$data->doc_code}}-{{$data->doc_name}}-rev-{{$data->doc_ver}}">
                            {{__('Dar Number')}} : {{$data->req_code}} <br>
                            {{__('Objective')}} : {{$data->req_obj}} <br>
                            {{__('Discription')}} : {{$data->req_description}} <br>
                        </x-card>
                    </td>
                </tr>
                <tr>
                    <td class="grid grid-cols-2 gap-4">
                        <x-button primary href="{{route('document.request.show',['id'=>$data->id]) }}" label="View Document" />
                        <x-button outline primary href="{{route('document.request.showDar',['id'=>$data->id]) }}" label="View Dar" />
                    </td>
                </tr>
            </table>
        </div>
</x-guest-layout>
