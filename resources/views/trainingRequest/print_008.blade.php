<x-print-layout>
    <x-slot name="name">
        {{ __('FM-LDS-008') }}
    </x-slot>
    <x-slot name="rev">
        {{ __('Rev. 01 : 15.03.2019') }}
    </x-slot>


    <div id="FM-LDS-008" class="text-sm max-w-3xl m-auto p-2 shadow-lg print:shadow-none">
        <img class="h-16 w-full object-contain pb-4" src="{{asset('/img/logo.jpeg') }}">
        <section class="pb-4">
            <h1 class="text-xl mb-2 font-bold text-center">
                TRAINING OUTLINE เค้าโครงการฝึกอบรมรายหัวข้อ
            </h1>
            <div class="font-bold text-center">
                <h3>SUBJECT หัวข้อเรื่อง : {{$training->training_008->subject}} </h3>
                <h3>วันที่เริ่มอบรม : {{$training->training_008->train_dateStart}} วันที่สิ้นสุด : {{$training->training_008->train_dateEnd}} </h3>
                <h3>เวลาเริ่ม : {{$training->training_008->train_timeEnd}} เวลาสิ้นสุด : {{$training->training_008->train_timeEnd}} </h3>
            </div>
            <x-jet-section-border />
        </section>


        <section class="pb-4">
            <h4 class="font-bold">
                Objective & Outcome วัตถุประสงค์
            </h4>
            <p>
                <strong>เพื่อให้พนักงานมีความรู้และความสามารถในเรื่องของ : </strong>
                <span>{{$training->training_008->train_objective}} </span>
            </p>
            <x-jet-section-border />
        </section>


        <!-- <hr class="w-1/2 m-auto mt-4 mb-2 border-2"> -->

        <!-- <hr class="my-2   mb-2 border-2"> -->

        <section class="pb-4">
            <table class=" w-full ">
                <thead class=" bg-gray-300 h-14">
                    <tr>
                        <th class="w-3/12">Topic รายการ</th>
                        <th class="w-7/12">Description รายละเอียด</th>
                        <th class="w-2/12">Duration เวลา(นาที)</th>
                    </tr>
                </thead>
                <tbody class="align-top">
                    <tr class="border-y">
                        <td class="font-bold pt-2  pl-2">Subject Details<br> รายละเอียดการอบรม</td>
                        <td class="pb-6 pt-2"> {{$training->training_008->train_subjectDetails}} </td>
                        <td class="text-center pt-2"> {{$training->training_008->train_subjectDuration}} </td>
                    </tr>
                    <tr class="border-y">
                        <td class="font-bold pt-2 pl-2">Activity<br> กิจกรรม ในการอบรม</td>
                        <td class="pb-6 pt-2"> {{$training->training_008->train_activityDetails}} </td>
                        <td class="text-center pt-2"> {{$training->training_008->train_activityDuration}} </td>
                    </tr>
                    <tr class="border-y">
                        <td class="font-bold pt-2 pl-2">Assessment<br> การประเมินผล</td>
                        <td class="pb-6 pt-2"> {{$training->training_008->train_assessmentDetails}} </td>
                        <td class="text-center pt-2"> {{$training->training_008->train_assessmentDuration}} </td>
                    </tr>

                    <tr class="border-y">
                        <td class="font-bold pt-2 pl-2">Remark<br> หมายเหตุ</td>
                        <td colspan="2" class="pb-8 pt-2"> {{$training->training_008->train_remark}} </td>

                    </tr>

                </tbody>
            </table>
            <x-jet-section-border />
        </section>


        <!-- <hr class="my-2   mb-2 border-2"> -->


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
