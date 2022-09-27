<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('training') }} 008
        </h2>
    </x-slot>
  
  
    <span class="print:block print:absolute print:bottom-0  hidden">FM-LDS-008</span>
    <span class="print:block print:absolute print:bottom-0  print:right-0 hidden">Rev. 01 : 15.03.2019</span>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button  onclick="window.print();" class=" rounded-lg  ring  p-1 ring-blue-900 bg-blue-500 font-bold text-white  print:hidden  "> PRINT </button>
                    <div id="FM-LDS-008">
               <img class="h-16 w-full object-contain hidden print:block" src="{{ asset('/img/logo.jpeg') }}">
              <h2 class="text-2xl mb-4 font-bold text-center">
              <span>TRAINING OUTLINE เค้าโครงการฝึกอบรมรายหัวข้อ</span>
              </h2>
        
      
        <div class="font-bold text-center">
            <h3 >SUBJECT หัวข้อเรื่อง :   {{ $f008['SUBJECT'] }}  </h3>
        </div>
   
        <div class="font-bold text-center">
                <h3>วันที่เริ่มอบรม : {{ $f008['starttraindate'] }}  วันที่สิ้นสุด : {{ $f008['endtraindate'] }} </h3>
                <h3>   เวลาเริ่ม : {{ $f008['starttraintime'] }}  เวลาสิ้นสุด : {{ $f008['endtraintime'] }} </h3>
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

      
        <table class="border-separate border-spacing-2    w-full ">
            <thead>
                <tr class="" >
                    <td class="" >"Topic รายการ"</td>
                    <td >"Description รายละเอียด"</td>
                    <td class=" " >Duration เวลา(นาที)</td>
                    <td class=" " >"Material อุปกรณ์"</td>
                    <td class=" ">"Remark หมายเหตุ"</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="">"Subject Details รายละเอียดการอบรม"</td>
                    <td class=""><span> {{ $f008['SubjectDetails'] }}</span></td>
                    <td class=""><span> {{ $f008['SubjectTime'] }}</span></td>
                    <td class=""><span> {{ $f008['SubjectMaterial'] }}</span></td>
                    <td class=""><span> {{ $f008['SubjectRemark'] }}</span></td>
                </tr>
                <tr>
             
                    <td class="">"Activity กิจกรรม ในการอบรม"</td>
                    <td class=""><span> {{ $f008['ActivityDetail'] }}</span></td>
                    <td class=""><span> {{ $f008['ActivityTime'] }}</span></td>
                    <td class=""><span> {{ $f008['ActivityMaterial'] }}</span></td>
                    <td class=""><span> {{ $f008['ActivityRemark'] }}</span></td>
                </tr>
                <tr>
                  
                    <td class="">"Assessment การประเมินผล"</td>
                    <td class=""><span> {{ $f008['AssessmentDetail'] }}</span></td>
                    <td class=""><span> {{ $f008['AssessmentTime'] }}</span></td>
                    <td class=""><span> {{ $f008['AssessmentMaterial'] }}</span></td>
                    <td class=""><span> {{ $f008['AssessmentRemark'] }}</span></td>
                </tr>
            </tbody>
        </table>
















    
        @php
            $date = date_format($D008['created_at'],"d F Y");
            $dateApp = $D008['Doc_DateApprove']?date_format($D008['Doc_DateApprove'],"d F Y"):"N/A";
      
            
        @endphp
        <div class="flex justify-between">
            <span>Trained by: <br>สอนโดย</span><span> {{ Auth::user()->name }}</span>
            <span>Position:<br>ตำแหน่ง</span><span>{{ Auth::user()->position }}</span>
            <span>Date:<br>วันที่</span><span> {{ $date }}</span>
        </div>

        <div class="flex justify-between">
            <span>Acknowledge by: <br>รับทราบโดย </span><span> test text</span>
            <span>Position:<br>ตำแหน่ง</span><span>{{ Auth::user()->position }}</span>
            <span>Date:<br>วันที่</span><span> {{$date}} </span>
        </div>

        <div class="flex justify-between">  
               
            <span>Reviewed by: <br>ตรวจสอบโดย </span><span> test text</span>
            <span>Position:<br>ตำแหน่ง</span><span> {{ Auth::user()->position }}</span>
            <span>Date:<br>วันที่</span><span>{{ $dateApp }}</span>
        </div>
    </div>
    </div></div></div></div>

</x-app-layout>
