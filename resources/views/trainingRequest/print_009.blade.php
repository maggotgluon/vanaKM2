<x-print-layout>
    <x-slot name="name">
        {{__('FM-LDS-009') }}
    </x-slot>
    <x-slot name="rev">
        {{__('Rev. 00 : 17.02.2016') }}
    </x-slot>

    <div id="FM-LDS-009" class="text-sm max-w-3xl m-auto p-2 shadow-lg print:shadow-none">
        <img class="h-16 w-full object-contain  pb-4" src=" {{asset('/img/logo.jpeg') }}">
        <!-- <span class="text-sm text-gray-300">FM-LDS-009-rev.00-แนวทางการประเมินผลการอบรมในการปฏิบัติงาน</span> -->
        <section class="pb-4">
            <h2 class="text-xl mb-4 font-bold text-center">
                OJT ASSESSMENT GUIDELINE แนวทางการประเมินผลการอบรมในการปฏิบัติงาน
            </h2>
            <x-jet-section-border />
        </section>

        <section class="pb-4">
            <div class="border p-4 mt-2">
                <strong>DEPARTMENT แผนก :</strong> {{App\Models\User::find( $training->user_id )->department }}

            </div>
            <div class="border p-4 mt-2">
                <strong>SUBJECT หัวข้อ :</strong>{{$training->training_009->subject}}
            </div>
        </section>

        <section class="pb-4">
            <div class="border p-4 mt-2">
                <strong> รูปแบบการประเมิน :</strong>
                <!-- {{$training->training_009->assessment_process}} -->
                @foreach ( $training->training_009->assessment_process as $assessmentProcess)
                    $assessmentProcess}}
                @endforeach


                <!-- <span class="px-2 mx-2">☐ ถาม-ตอบ</span><span class="px-2 mx-2">☐ แบบทดสอบ</span><span class="px-2 mx-2">☐ ทดลองปฏิบัติงานจริง</span> -->
            </div>
            <div class="p-4">
                <strong> หมายเหตุ :</strong>
                <ol class="list-decimal	list-inside	">
                    <li>กรณีที่เป็นการถามตอบ กรุณาระบุคำถามและคำตอบโดยคร่าวพร้อมเกณฑ์การผ่านประเมิน</li>
                    <li>กรณีที่เป็นการทดสอบ กรุณาแนบแบบทดสอบพร้อมระบุเกณฑ์การผ่านประเมิน</li>
                    <li>กรณีที่เป็นการทดลองปฏิบัติงานจริง กรุณาระบุกิจกรรมพร้อมเกณฑ์การผ่านประเมิน</li>
                </ol>
            </div>

        </section>

        <section class="pb-4">
            <div class="border p-4 mt-2 pb-6">
                <strong>คำถาม/แบบทดสอบ/หัวข้อการปฏิบัติงาน : </strong>

                <p> {{ $training->training_009->assessment_tools }} </p>

            </div>
            <div class="border p-4 mt-2 pb-6">
                <strong>เกณฑ์การประเมิน : </strong>

                <p class="pb-4">
                    <strong>ผ่าน : </strong>{{ $training->training_009->assessment_pass }}
                </p>
                <p class="pb-4">
                    <strong>ไม่ผ่าน : </strong>{{ $training->training_009->assessment_fail }}
                </p>

            </div>
        </section>


        <section class="pb-4">
            <div class="grid grid-cols-8">
                <p class="col-span-4">
                    <strong>{{__('Requester Information')}}: </strong>{{ App\Models\User::find($training->user_id)->name  }}
                </p>
                <p class="col-span-2">
                    <strong>{{__('Position')}}: </strong>{{ App\Models\User::find($training->user_id)->position  }}
                </p>
                <p class="col-span-2">
                    <strong>{{__('Date')}}: </strong> {{$training->created_at->isoFormat('Do MMM YYYY') }}
                </p>
            </div>

            <div class="grid grid-cols-8">
                <p class="col-span-4">
                    <strong>{{__('Instructor')}}: </strong>{{ App\Models\User::find($training->instructor)->name  }}
                </p>
                <p class="col-span-2">
                    <strong>{{__('Position')}}: </strong>{{ App\Models\User::find($training->instructor)->position  }}
                </p>
                <p class="col-span-2">
                    <strong>{{__('Date Strat')}}: </strong> {{$training->training_008->train_dateStart->isoFormat('Do MMM YYYY') }}
                </p>
            </div>

            <div class="grid grid-cols-8">
            <p class="col-span-4">
                    <strong>{{__('Reviewed')}}: </strong>{{ $training->user_review?App\Models\User::find($training->user_review)->name:'-'}}
                </p>
                <p class="col-span-2">
                    <strong>{{__('Position')}}: </strong>{{ $training->user_review?App\Models\User::find($training->user_review)->position  :'-'}}
                </p>
                <p class="col-span-2">
                    <strong>{{__('Date')}}: </strong>{{$training->training_dateReview?$training->training_dateReview->isoFormat('Do MMM YYYY') :'-' }}
                </p>
            </div>

            <div class="grid grid-cols-8">
            <p class="col-span-4">
                    <strong>{{__('Approved')}}: </strong>{{ $training->user_approve?App\Models\User::find($training->user_approve)->name:'-'}}
                </p>
                <p class="col-span-2">
                    <strong>{{__('Position')}}: </strong> {{ $training->user_approve?App\Models\User::find($training->user_approve)->position  :'-'}}
                </p>
                <p class="col-span-2">
                    <strong>{{__('Date')}}: </strong>{{$training->training_dateApprove?$training->training_dateApprove->isoFormat('Do MMM YYYY'):'-'}}
                </p>
            </div>
        </section>
    </div>


</x-print-layout>
