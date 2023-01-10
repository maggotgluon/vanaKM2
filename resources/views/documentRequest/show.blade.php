<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @can('review_document')
            <div class="flex justify-start gap-2 mb-4">
                @can('publish_document')
                @if ($documentRequest->req_status==1)
                <form action=" {{ route('document.request.updateStatus') }} " method="post">
                    @csrf
                    <input hidden name='id' value="{{$documentRequest->id}}">
                    <input hidden name='status' value="2">

                    <x-button primary icon="check" type="submit" class="max-w-full w-full">
                        {{ __('Approved') }}
                    </x-button>
                </form>
                @endif
                @endcan

                @can('review_document')
                @if ($documentRequest->req_status!==2)
                @if ($documentRequest->req_status==0)
                <form action=" {{ route('document.request.updateStatus') }} " method="post">
                    @csrf
                    <input hidden name='id' value="{{$documentRequest->id}}">
                    <input hidden name='status' value="1">

                    <x-button positive type="submit" icon="check">
                        {{ __('Review') }}
                    </x-button>
                </form>
                @endif
                @endif
                @endcan

                @can('reject_document')
                @if ($documentRequest->req_status!==-1 && $documentRequest->req_status!==2)

                <x-button icon="x" negative spinner onclick="document.querySelector('#{{$documentRequest->req_code}}').showModal()">
                    {{ __('Reject') }}
                </x-button>
                    <dialog id="{{$documentRequest->req_code}}"
                        class="rounded-lg max-w-lg w-full overflow-visible">

                        <x-button.circle icon="x" red type="reset"
                            onclick="document.querySelector('#{{$documentRequest->req_code}}').close()"
                            class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2"/>

                        <p>Reject reason for {{$documentRequest->req_code}}</p>
                        <form action=" {{ route('document.request.updateStatus') }}" method="post">
                            @csrf
                            <input hidden name='id' value="{{$documentRequest->id}}">
                            <input hidden name='status' value="-1">
                            <textarea required name="remark" class="w-full form-input rounded-md rounded-br-none"> </textarea>
                            <div class="flex gap-4 p-2 py-4">
                                <x-button positive icon="" label="{{ __('Save') }}" type="submit" />

                                <x-button negative icon="" label="{{__('Dismiss')}}" type="reset" onclick="document.querySelector('#{{$documentRequest->req_code}}').close()" class="py-1"/>

                            </div>
                        </form>

                    </dialog>
                @endif
                @endcan
            </div>
            @endcan

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 flex gap-2 mb-2">
                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" href="{{route('document.request.all')}}">Back</a>

                @if ($documentRequest->pdf_location)
                <a href="{{route('document.request.download',['file'=>$documentRequest->pdf_location,'id'=>$documentRequest->id])}}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-200 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Download PDF</a>
                @endif
                @if ($documentRequest->doc_location)
                <a href="{{route('document.request.download',['file'=>$documentRequest->doc_location,'id'=>$documentRequest->id])}}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-200 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Download Raw file</a>
                @endif

                <a href="{{route('document.request.showDar',['id'=>$documentRequest->id])}}" target="_blank" class="ml-auto inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Print</a>

            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <div class="m-4 p-2 round bg-gray-200 rounded-md">
                    {{__('Last Update')}} : {{Carbon\Carbon::parse($documentRequest->updated_at)->isoFormat('Do MMM YYYY')}}
                    <hr>
                    {{__('Request Status')}} :
                    <x-request-status :status="$documentRequest->req_status" /><br>
                    @if ($documentRequest->req_remark)
                    {{__('Remark')}} : {{$documentRequest->req_remark}}
                    @endif
                </div>
                <div class="grid grid-cols-2  p-4  py-2 ">
                    <span>
                        <span class=" font-bold">{{__('Requester')}} :</span>
                        {{App\Models\User::find($documentRequest->user_id)->name}}
                    </span>

                    <span>
                        <span class=" font-bold">{{__('Date Request')}} :</span>
                        {{Carbon\Carbon::parse($documentRequest->created_at)->isoFormat('Do MMM YYYY')}}
                    </span>
                    <span>
                        <span class="font-bold">{{__('Department')}} :</span>
                        {{App\Models\User::find($documentRequest->user_id)->department}}
                    </span>

                    <span>
                        <span class=" font-bold">{{__('Department Head')}} : </span>
                        {{App\Models\User::find($documentRequest->user->department_head)->name}}
                    </span>
                </div>

                <hr class="mt-2">

                <div class=" p-4  py-2 ">
                    <span class="block py-2">
                        <span class=" font-bold">{{__('Dar No.')}} :</span>
                        {{$documentRequest->req_code}}
                    </span>
                    <span class="block py-2">
                        <span class=" font-bold">{{__('Objective')}} :</span>
                        {{$documentRequest->req_obj}}
                    </span>
                </div>
                <hr class="my-2">

                <div class="  flex w-full px-4 py-2 ">
                    <div class="w-1/4">

                        <span class=" font-bold"> {{__('Document Type')}} : </span> {{$documentRequest->doc_type}}

                    </div>
                    <div class="w-1/4">

                        <span class=" font-bold">{{__('Document Code')}} : </span> {{$documentRequest->doc_code}}

                    </div>

                    <div class="w-3/4 float-right ">

                        <span class=" font-bold">{{__('Document Name')}} : </span>{{$documentRequest->doc_name}}

                    </div>
                </div>

                <div class=" flex justify-between w-full px-4 py-2 ">



                    <div class=" float-right ">

                        <span class=" font-bold">{{__('Effective Date')}} : </span>{{$documentRequest->doc_startDate->isoFormat('Do MMM YYYY')}}

                    </div>

                    <div class=" float-right ">

                        <span class=" font-bold">{{__('Revision No.')}} : </span> {{str_pad($documentRequest->doc_ver , 2,'0', STR_PAD_LEFT)}} 
                    </div>

                    <div class=" float-right ">
                        <span class=" font-bold">{{__('Shelf-life')}} : </span>
                        @if ($documentRequest->doc_life == -1)
                        {{__('Until Change')}}
                        @else
                        {{$documentRequest->doc_life}} YEAR
                        @endif
                    </div>
                    <!-- <div class=" float-right ">
                        <span class=" font-bold">{{__('Attachment')}} : </span> {{$documentRequest->pdf_location ? "YES" :"N/A"}}
                    </div> -->

                </div>
                <div class="px-4 py-2">
                    <span class=" font-bold">{{__('Discription')}} :</span>
                    <p>
                        {{$documentRequest->req_description}}
                    </p>

                </div>
                @if($documentRequest->pdf_location)
                <!-- {{asset($documentRequest->pdf_location)}} -->
                <iframe src="{{asset($documentRequest->pdf_location)}}" width="100%" height="500px"></iframe>
                @endif
                <div class="m-2 p-2">
                    @if ($documentRequest->req_remark==null)
                    <table class="md:table-auto border w-full mt-4 py-4">
                        <thead class="table-auto border">
                            <tr class="bg-gray-300">
                                <th class="border w-1/2 p-2">DCC เจ้าหน้าที่ควบคุมเอกสาร</th>
                                <th class="border w-1/2 p-2">QMR/MR ตัวแทนฝ่ายบริหารพิจารณาอนุมัติ</th>

                            </tr>
                        </thead>

                        <tbody>
                            <tr class="min-h-max h-16">
                                <td class="table-auto border mt-4 p-2">
                                    @if ($documentRequest->req_dateApprove!=null)
                                    <span class=" p-4 font-bold">{{__('Name')}} : </span>
                                    {{App\Models\User::find($documentRequest->user_approve)->name}}
                                    <br>
                                    <span class="p-4 font-bold">{{__('Date')}} : </span>
                                    {{$documentRequest->req_dateApprove->isoFormat('Do MMM YYYY')}}
                                    @else
                                    <hr class="w-1/4 border-black m-auto">
                                    @endif
                                </td>

                                <td class="table-auto border mt-4 p-2">
                                    @if ($documentRequest->user_review!=null)
                                    <span class=" p-4 font-bold">{{__('Name')}} : </span>
                                    {{App\Models\User::find($documentRequest->user_review)->name}}
                                    <br>
                                    <span class=" p-4 font-bold">{{__('Date')}} :</span>
                                    {{$documentRequest->req_dateReview->isoFormat('Do MMM YYYY')}}
                                    @else
                                    <hr class="w-1/4 border-black m-auto">
                                    @endif

                                </td>
                            </tr>

                        </tbody>
                    </table>
                    @else
                    Reject : <br>
                    Remark : {{$documentRequest->req_remark}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
