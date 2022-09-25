<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('training') }} 008
        </h2>
    </x-slot>


        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
           <div id="FM-LDS-008">
              <h2 class="text-2xl mb-4 font-bold text-center">
              <span>TRAINING OUTLINE เค้าโครงการฝึกอบรมรายหัวข้อ</span>
              </h2>
        
      
        <div class="font-bold text-center">
            <h3 >SUBJECT หัวข้อเรื่อง :   {{ $f008['SUBJECT'] }} </h3>
        </div>
      
        <div class="font-bold text-center">
                <h3>วันที่อบรม : {{ $f008['traindate'] }}  เวลา : {{ $f008['traintime'] }} </h3>
            </div>
            
    
        <div >
            <span class="font-bold " >
            Objective & Outcome วัตถุประสงค์
            </span>
            <div>
                <span>เพื่อให้พนักงานมีความรู้และความสามารถในเรื่องของ:</span>
                <span> {{ $f008['Objective'] }} </span>
            </div>
        </div>
        <table class="border-separate border-spacing-2  border border-slate-500 ">
            <thead>
                <tr class="border-separate border border-slate-500 " >
                    <td class="border-separate border border-slate-500 " >"Topic รายการ"</td>
                    <td class="border-separate border border-slate-500 ">"Description รายละเอียด"</td>
                    <td class="border-separate border border-slate-500 " >Duration เวลา(นาที)</td>
                    <td class="border-separate border border-slate-500 " >"Material อุปกรณ์"</td>
                    <td class="border-separate border border-slate-500 ">"Remark หมายเหตุ"</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-separate border border-slate-500 ">"Subject Details รายละเอียดการอบรม"</td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['SubjectDetails'] }}</span></td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['SubjectTime'] }}</span></td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['SubjectMaterial'] }}</span></td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['SubjectRemark'] }}</span></td>
                </tr>
                <tr>
             
                    <td class="border-separate border border-slate-500 ">"Activity กิจกรรม ในการอบรม"</td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['ActivityDetail'] }}</span></td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['ActivityTime'] }}</span></td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['ActivityMaterial'] }}</span></td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['ActivityRemark'] }}</span></td>
                </tr>
                <tr>
                  
                    <td class="border-separate border border-slate-500 ">"Assessment การประเมินผล"</td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['AssessmentDetail'] }}</span></td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['AssessmentTime'] }}</span></td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['AssessmentMaterial'] }}</span></td>
                    <td class="border-separate border border-slate-500 "><span> {{ $f008['AssessmentRemark'] }}</span></td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-between">
            <span>Trained by: <br>สอนโดย</span><span> {{ Auth::user()->name }}</span>
            <span>Position:<br>ตำแหน่ง</span><span>{{ Auth::user()->position }}</span>
            <span>Date:<br>วันที่</span><span> {{date("d-m-Y")}}</span>
        </div>

        <div class="flex justify-between">
            <span>Acknowledge by: <br>รับทราบโดย </span><span> test text</span>
            <span>Position:<br>ตำแหน่ง</span><span>{{ Auth::user()->position }}</span>
            <span>Date:<br>วันที่</span><span> {{date("d-m-Y")}}</span>
        </div>

        <div class="flex justify-between">
            <span>Reviewed by: <br>ตรวจสอบโดย </span><span> test text</span>
            <span>Position:<br>ตำแหน่ง</span><span> {{ Auth::user()->position }}</span>
            <span>Date:<br>วันที่</span><span>{{date("d-m-Y")}}</span>
        </div>
    </div>
    </div></div></div></div>

</x-app-layout>
