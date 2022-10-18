<x-app-layout >
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight  print:hidden">
        FM-LDS-008
        </h2>
    </x-slot>
  
  
    <span class="print:block print:absolute print:bottom-0  hidden">FM-LDS-008</span>
    <span class="print:block print:absolute print:bottom-0  print:right-0 hidden">Rev. 01 : 15.03.2019</span>

    <div class="py-4 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-white border-b border-gray-200">
                <button onclick="window.print();" class=" z-10 block  float-right rounded-lg ring p-1 ring-blue-600 bg-blue-500 font-bold text-white  print:hidden  "> PRINT </button>
       
                    <div id="FM-LDS-008">
               <img class="h-16 w-full object-contain hidden print:block" src="{{ asset('/img/logo.jpeg') }}">
              <h2 class="text-2xl mb-2 font-bold text-center">
              <span>TRAINING OUTLINE เค้าโครงการฝึกอบรมรายหัวข้อ</span>
              </h2>
          
      
        <div class="font-bold text-center">
            <h3 >SUBJECT หัวข้อเรื่อง :   {{ $f008['SUBJECT'] }}  </h3>
        </div>
   
        <div class="font-bold text-center"> 
                <h3>วันที่เริ่มอบรม : {{ $f008['starttraindate'] }}  วันที่สิ้นสุด : {{ $f008['endtraindate'] }} </h3>
                <h3>   เวลาเริ่ม : {{ $f008['starttraintime'] }}  เวลาสิ้นสุด : {{ $f008['endtraintime'] }} </h3>
            </div>
            
            <hr class="w-1/2 m-auto mt-4 mb-2 border-2">
        <div >
            <span class="font-bold px-4 py-4 " >
            Objective & Outcome วัตถุประสงค์
            </span>
            <div>
                <span class="px-4 py-4">เพื่อให้พนักงานมีความรู้และความสามารถในเรื่องของ:</span>
                <span> {{ $f008['Objective'] }} </span>
            </div>
        </div>
<hr class="my-2   mb-2 border-2">
      
        <table class=" w-full ">
            <thead class="px-4 py-1">
                <tr class=" bg-gray-400 " >
                    <td class="font-bold px-4 py-1" >Topic รายการ</td>
                    <td class="font-bold px-4 py-1">Description รายละเอียด</td>
                    <td class="font-bold px-4 py-1" >Duration เวลา(นาที)</td>
            
               
                </tr>
            </thead>
            <tbody>
                <tr class="border-y-2 px-4 py-1">
                    <td class="font-bold px-4 py-1">Subject Details รายละเอียดการอบรม</td>
                    <td class="px-4 py-1"><span> {{ $f008['SubjectDetails'] }}</span></td>
                    <td class="px-4 py-1"><span> {{ $f008['SubjectTime'] }}</span></td>
                </tr>
                <tr class="border-y-2">
             
                    <td class="font-bold px-4 py-1">Activity กิจกรรม ในการอบรม</td>
                    <td class="px-4 py-1"><span> {{ $f008['ActivityDetails'] }}</span></td>
                    <td class="px-4 py-1"><span> {{ $f008['ActivityTime'] }}</span></td>
                </tr class="border-y-2">
                <tr>
                  
                    <td class="font-bold px-4 py-1">Assessment การประเมินผล</td>
                    <td class="px-4 py-1"><span> {{ $f008['AssessmentDetails'] }}</span></td>
                    <td class="px-4 py-1"><span> {{ $f008['AssessmentTime'] }}</span></td>
                </tr>
            </tbody>
        </table>

        <hr class="my-2   mb-2 border-2">
        @php
            $date = date_format($D008['created_at'],"d F Y");
            $dateApp = $D008['Doc_DateApprove']?$D008['Doc_DateApprove']:"N/A";    
        @endphp

        
            <div class=" flex justify-self-start gap-2 w-full px-2 py-1">
                <div class="w-2/5">
                <span class="font-bold " >Trained by: </span>{{$user->name }}</div>
                <div class="w-1/3">
                <span class="font-bold " >Position: </span>{{ $user->position }}</div>
                <div class="w-1/5">
                <span class="font-bold " >Date: </span> {{$D008->created_at }}</div>
            </div>

            <div class=" flex justify-self-start gap-2 w-full px-2 py-1">
                <div class="w-2/5">
                <span class="font-bold " >Acknowledge by: </span>MR >name </div>
                <div class="w-1/3">
                <span class="font-bold " >Position: </span>MR</div>
                <div class="w-1/5">
                <span class="font-bold " >Date: </span> MR DATE APPOVRE</div>
            </div>

            <div class=" flex justify-self-start gap-2 w-full px-2 py-1">
                <div class="w-2/5">
                <span class="font-bold " >Reviewed by: </span>{{$D008->User_Approve }}</div>
                <div class="w-1/3">
                <span class="font-bold " >Position: </span>{{ $Position_Approve->position }}</div>
                <div class="w-1/5">
                <span class="font-bold " >Date: </span> {{$D008->Doc_DateApprove }}</div>
            </div>
        
    </div>
    </div></div></div></div>

</x-app-layout>
