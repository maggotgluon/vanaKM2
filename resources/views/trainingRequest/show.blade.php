<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$training->training_008->subject}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @can('review_document')
            <div class="flex gap-4 p-4">
                @if ($training->req_status!==2)

                @can('publish_document')
                @if ($training->req_status==1)
                <form action=" {{ route('document.request.updateStatus') }} " method="post">
                    @csrf
                    <input hidden name='id' value="{{$training->id}}">
                    <input hidden name='status' value="2">

                    <x-jet-button>
                        {{ __('Approve') }}
                    </x-jet-button>
                </form>
                @endif
                @endcan

                @can('review_document')
                @if ($training->req_status!==2)
                @if ($training->req_status==0)
                <form action=" {{ route('document.request.updateStatus') }} " method="post">
                    @csrf
                    <input hidden name='id' value="{{$training->id}}">
                    <input hidden name='status' value="1">

                    <x-jet-button>
                        {{ __('Review') }}
                    </x-jet-button>
                </form>
                @endif
                @endif
                @endcan

                @can('reject_document')
                @if ($training->req_status!==-1 && $training->req_status!==2)

                <x-jet-button onclick="document.querySelector('#{{$training->req_code}}').showModal()">
                    {{ __('Reject') }}
                </x-jet-button>
                <dialog id="{{$training->req_code}}" class="rounded-lg max-w-lg w-full overflow-visible">

                    <x-jet-button type="reset" onclick="document.querySelector('#{{$training->req_code}}').close()" class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full px-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 18L18 6M6 6L18 18" stroke="#4A5568" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </x-jet-button>
                    <p>Reject reason for {{$training->req_code}}</p>
                    <form action=" {{ route('document.request.updateStatus') }}" method="post">
                        @csrf
                        <input hidden name='id' value="{{$training->id}}">
                        <input hidden name='status' value="-1">
                        <textarea required name="remark" class="w-full form-input rounded-md rounded-br-none"> </textarea>
                        <div class="flex gap-4 p-2 py-4">
                            <x-jet-button>
                                {{ __('Reject') }}
                            </x-jet-button>
                            <x-jet-button type="reset" onclick="document.querySelector('#{{$training->req_code}}').close()" class="py-1">
                                {{__('Dismiss')}}
                            </x-jet-button>
                        </div>
                    </form>

                </dialog>
                @endif
                @endcan

                @endif
            </div>
            @endcan

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 flex gap-2 mb-2">
                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{route('training.request.all')}}">Back</a>

                @if ($training->pdf_location)
                <a href="{{route('training.request.download',['file'=>$training->pdf_location,'id'=>$training->id])}}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-200 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Download PDF</a>
                @endif

                <a href="{{route('training.request.show_008',['id'=>$training->id])}}" target="_blank" class="ml-auto inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    FM-LDS-008</a>

                <a href="{{route('training.request.show_009',['id'=>$training->id])}}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    FM-LDS-009</a>

            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <div class="m-4 p-2 round bg-gray-200 rounded-md">
                    {{__('Last Update')}} : {{Carbon\Carbon::parse($training->updated_at)->isoFormat('Do MMM YYYY H:M')}}
                    <hr>
                    {{__('Request Status')}} : <x-request-status :status="$training->training_status" /><br>
                    @if ($training->req_remark)
                    {{__('Remark')}} : {{$training->req_remark}}
                    @endif
                </div>
                <div class="grid grid-cols-2  p-4  py-2 ">
                    <span>
                        <strong>{{__('Requester Information')}} :</strong>
                        {{App\Models\User::find($training->user_id)->name}}
                    </span>
                    <span>
                        <strong>{{__('Date Request')}} :</strong>
                        {{Carbon\Carbon::parse($training->created_at)->isoFormat('Do MMM YYYY')}}
                    </span>
                    <span>
                        <span class="font-bold">{{__('Department')}} :</span>
                        {{App\Models\User::find($training->user_id)->department}}
                    </span>
                    <span>
                        <strong>{{__('Department Head')}} : </strong>
                        {{App\Models\User::find(App\Models\User::find($training->user_id)->department_head)->name}}
                    </span>
                </div>

                <div class="grid  p-4  py-2 ">
                    <span>
                        <strong>{{__('Instructor')}} :</strong>
                        {{App\Models\User::find($training->instructor)->name}}
                    </span>

                    <span>
                        <strong>{{__('Date Strat')}} :</strong>
                        {{$training->training_008->train_dateStart->isoFormat('Do MMM YYYY')}} - {{$training->training_008->train_dateEnd->isoFormat('Do MMM YYYY')}}

                    </span>
                    <span>
                        <strong>{{__('Time Strat')}} :</strong>
                        {{$training->training_008->train_timeEnd}} - {{$training->training_008->train_timeEnd}}
                    </span>
                </div>

                <hr class="mt-2">

                @if($training->pdf_location)
                <!-- {{asset($training->pdf_location)}} -->
                <iframe src="{{asset($training->pdf_location)}}" width="100%" height="500px"></iframe>
                @endif
                <div class="m-2 p-2">
                    @if ($training->req_remark==null)
                    <table class="md:table-auto border w-full mt-4 py-4">
                        <thead class="table-auto border">
                            <tr class="bg-gray-300">
                                <th class="border w-1/2 p-2">DCC เจ้าหน้าที่ควบควมเอกสาร</th>
                                <th class="border w-1/2 p-2">OMR/MR ตัวแทนฝ่ายบริหารพิจารณาอนุมัติ</th>

                            </tr>
                        </thead>

                        <tbody>
                            <tr class="min-h-max h-16">
                                <td class="table-auto border mt-4 p-2">

                                    <span class=" p-4 font-bold">{{__('Name')}} : </span>
                                    {{$training->user_approve?App\Models\User::find($training->user_approve)->name:'-'}}

                                    <br>
                                    <span class="p-4 font-bold">{{__('Date')}} : </span>
                                    {{$training->training_dateApprove?$training->training_dateApprove->isoFormat('Do MMM YYYY'):'-'}}

                                </td>

                                <td class="table-auto border mt-4 p-2">

                                    <span class=" p-4 font-bold">{{__('Name')}} : </span>
                                    {{$training->user_review?App\Models\User::find($training->user_review)->name:'-'}}
                                    <br>
                                    <span class=" p-4 font-bold">{{__('Date')}} :</span>
                                    {{$training->training_dateReview?$training->training_dateReview->isoFormat('Do MMM YYYY'):'-'}}


                                </td>
                            </tr>

                        </tbody>
                    </table>
                    @else
                    Reject : <br>
                    Remark : {{$training->req_remark}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
