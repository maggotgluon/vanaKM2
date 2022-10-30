<x-print-layout>
    <x-slot name="name">
        {{ __('FM-DCC-01') }}
    </x-slot>
    <x-slot name="rev">
        {{ __('Rev.00 19.01.2015') }}
    </x-slot>
    <div id="FM-LDS-009" class="">


        <h2 class=" z-20 text-2xl mb-4  font-bold text-center">
            DOCUMENT ACTION REQUEST</h2>
        <h2 class="text-2xl mb-4 font-bold text-center">
            ใบแจ้งขอดำเนินการด้านเอกสาร</h2>




        <table class="md:table-auto p-4  w-full mt-4">
            <thead class="table-auto ">
                <tr class="bg-gray-300">
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="table-auto p-4   mt-4 w-1/2"><span class=" font-bold">{{__('Name')}} :</span>
                        <span>
                            {{$user->name}}

                        </span><br>

                        <span class="font-bold">{{__('Department')}} :</span>
                        <span>
                            {{$user->department}}

                        </span>
                    </td>

                    <td class="table-auto  w-1/2"><span class=" font-bold">{{__('Date Request')}} :</span>
                        <span>
                            {{$date['created_at']}}
                        </span><br>
                        <span class=" font-bold">{{__('Department Head')}} : </span>
                        <span>
                            {{$user->department_head}}

                        </span>
                    </td>
                </tr>
            </tbody>
        </table>

        <hr class="mt-2">

        <div class=" p-4  py-2 ">
            <span class=" font-bold">{{__('Dar Number')}} :</span>
            <span>
                {{$DarForm->Doc_Code}}
            </span>
        </div>

        <div class=" p-4  py-1 pt-1 ">
            <span class=" font-bold">{{__('Objective')}} :</span>
            <span>
                {{$DarForm->Doc_Obj}}
            </span>

        </div>

        <hr class="my-2">

        <div class="  flex w-full px-4 py-2 ">

            <div class="w-1/4">
                <div>
                    <span class=" font-bold">{{__('Doc Code')}} : </span> {{$DarForm->Doc_Name}}
                </div>
            </div>

            <div class="w-3/4 float-right ">
                <div>
                    <span class=" font-bold">{{__('Document Name')}} : </span>{{$DarForm->Doc_FullName}}
                </div>
            </div>
        </div>

        <div class=" flex w-full px-4 py-2 ">

            <div class="w-1/4">
                <div>
                    <span class=" font-bold"> {{__('Document Type')}} : </span> {{$DarForm->Doc_Type}}
                </div>
            </div>

            <div class="w-1/4 float-right ">
                <div>
                    <span class=" font-bold">{{__('Effctive_Date')}} : </span>{{$DarForm->Doc_StartDate}}
                </div>
            </div>

            <div class="w-1/6 float-right ">
                <div>
                    <span class=" font-bold">{{__('Doc Version')}} : </span>{{$DarForm->Doc_ver}}
                </div>
            </div>

            <div class="w-1/6 float-right ">
                <div>
                    <span class=" font-bold">{{__('DocumentAge')}} : </span>{{$DarForm->Doc_Life}} YEAR
                </div>
            </div>
            <div class="w-1/6 float-right ">
                <div>
                    <span class=" font-bold">{{__('Attachment')}} : </span>
                    @php
                    $Attachment= $DarForm->Doc_Location ? "YES" :"N/A"
                    @endphp
                    {{$Attachment}}
                </div>
            </div>

        </div>

        <hr class="my-4 ">


        <table class="md:table-auto border w-full mt-4">
            <thead class="table-auto border">
                <tr class="bg-gray-300">
                    <th class="border w-1/2">DCC เจ้าหน้าที่ควบควมเอกสาร</th>
                    <th class="border w-1/2">OMR/MR ตัวแทนฝ่ายบริหารพิจารณาอนุมัติ</th>

                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="table-auto border"><span class=" p-4 font-bold">{{__('Name')}} : </span>
                        <span>
                            {{$DarForm->User_MRApprove}}

                        </span><br>
                        <span class="p-4 font-bold">{{__('Date')}} : </span>
                        <span>
                            {{$date['Doc_DateMRApprove']}}

                        </span>
                    </td>

                    <td class="table-auto border mt-4"><span class=" p-4 font-bold">{{__('Name')}} : </span>
                        <span>
                            {{$DarForm->User_Approve}}
                        </span><br>
                        <span class=" p-4 font-bold">{{__('Date')}} :</span>
                        <span>
                            {{$date['Doc_DateApprove']}}
                        </span>
                    </td>

                </tr>

            </tbody>
        </table>

    </div>


</x-print-layout>
