<x-print-layout>
    <x-slot name="name">
        {{ __('FM-DCC-01') }}
    </x-slot>
    <x-slot name="rev">
        {{ __('Rev.00 19.01.2015') }}
    </x-slot>
    <div id="FM-LDS-009" class="text-sm max-w-3xl m-auto p-2 shadow-lg print:shadow-none">

        <!-- <img class="h-16 w-full object-contain pb-4" src="{{asset('/img/logo.jpeg') }}"> -->
        <section class="pb-4">
            <h2 class="text-xl mb-2  font-bold text-center">
                DOCUMENT ACTION REQUEST</h2>
            <h2 class="text-xl mb-4 font-bold text-center">
                ใบแจ้งขอดำเนินการด้านเอกสาร</h2>
        </section>

        <section class="pb-4">
            <div class="grid grid-cols-2">
                <span>
                    <strong>{{__('Name')}} :</strong> {{$documentRequest->user->name}}
                </span>
                <span>
                    <strong>{{__('Department')}} :</strong> {{$documentRequest->user->department}}
                </span>
                <span>
                    <strong>{{__('Date Request')}} :</strong> {{$documentRequest->created_at->isoFormat('Do MMM YYYY')}}
                </span>
                <span>
                    <strong>{{__('Department Head')}} :</strong> {{App\Models\User::find($documentRequest->user->department_head)->name}}
                </span>
            </div>
            <x-jet-section-border />
        </section>

        <section class="pb-4">
            <div>
                <strong>{{__('Dar Number')}} :</strong>{{$documentRequest->req_code}}
            </div>
            <div>
                <strong>{{__('Objective')}} :</strong>{{$documentRequest->req_obj}}
            </div>
            <div>
            <strong>{{__('Discription')}} :</strong>{{$documentRequest->req_description}}
            </div>
            <x-jet-section-border />
        </section>

        <section class="pb-4">
            <div class="grid grid-cols-4">
                <div>
                    <strong>{{__('Document Type')}} :</strong>{{$documentRequest->doc_type}}
                </div>
                <div>
                    <strong>{{__('Doc Code')}} :</strong>{{$documentRequest->doc_code}}
                </div>
                <div class="col-span-2">
                    <strong>{{__('Document Name')}} :</strong>{{$documentRequest->doc_name}}
                </div>

                <div>
                    <strong>{{__('Effctive_Date')}} :</strong>{{$documentRequest->doc_startDate->isoFormat('Do MMM YYYY')}}
                </div>
                <div>
                    <strong>{{__('Doc Version')}} :</strong>{{$documentRequest->doc_ver}}
                </div>
                <div>
                    <strong>{{__('DocumentAge')}} :</strong>
                    @if ($documentRequest->doc_life == -1)
                    {{__('Until Change')}}
                    @else
                    {{$documentRequest->doc_life}} {{__('YEAR')}}
                    @endif
                </div>

                <div>
                    <strong>{{__('Attachment')}} : </strong>{{$documentRequest->pdf_location ? __('YES') :"N/A"}}
                </div>

            </div>
            <x-jet-section-border />
        </section>

        <section class="pb-4">
            <div class="grid grid-cols-2 gap-2">
                <x-card shadow="none" class="border">
                    <x-slot name="header">
                        <div class="text-center bg-gray-300 p-4">
                            DCC เจ้าหน้าที่ควบควมเอกสาร
                        </div>
                    </x-slot>
                    <strong>{{__('Name')}} : </strong>{{$documentRequest->user_review?App\Models\User::find($documentRequest->user_review)->name :'-'}}<br>
                    <strong>{{__('Date')}} : </strong>{{$documentRequest->req_dateReview?$documentRequest->req_dateReview->isoFormat('Do MMM YYYY'):'-'}}
                </x-card>

                <x-card shadow="none" class="border">
                    <x-slot name="header">
                        <div class="text-center bg-gray-300 p-4">
                            OMR/MR ตัวแทนฝ่ายบริหารพิจารณาอนุมัติ
                        </div>
                    </x-slot>
                    <strong>{{__('Name')}} : </strong>{{$documentRequest->user_approve?App\Models\User::find($documentRequest->user_approve)->name :'-'}}<br>
                    <strong>{{__('Date')}} : </strong>{{$documentRequest->req_dateApprove?$documentRequest->req_dateApprove->isoFormat('Do MMM YYYY'):'-'}}

                </x-card>
            </div>
        </section>


    </div>


</x-print-layout>
