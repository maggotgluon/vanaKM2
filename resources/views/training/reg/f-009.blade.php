<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        FM-LDS-009
        </h2>
    </x-slot>
    <span class="print:block print:absolute print:bottom-0  hidden">FM-LDS-009</span>
    <span class="print:block print:absolute print:bottom-0  print:right-0 hidden">Rev. 00 : 17.02.2016 </span>
        
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <button  onclick="window.print();" class=" rounded-lg  ring  p-1 ring-blue-900 bg-blue-500 font-bold text-white  print:hidden  "> PRINT </button>
    <div id="FM-LDS-009"class="">
    <img class="h-16 w-full object-contain hidden print:block" src="{{ asset('/img/logo.jpeg') }}">
    <!-- <span class="text-sm text-gray-300">FM-LDS-009-rev.00-แนวทางการประเมินผลการอบรมในการปฏิบัติงาน</span> -->
    <h2 class="text-2xl mb-4 font-bold text-center">
        OJT ASSESSMENT GUIDELINE แนวทางการประเมินผลการอบรมในการปฏิบัติงาน
    </h2>
    <div class="border p-4 mt-2">
        <span>DEPARTMENT แผนก :</span>
        <span>
        {{ Auth::user()->department }}
        </span>
    </div>
    <div class="border p-4 mt-2">
        <span>SUBJECT หัวข้อ :</span>
        <span>
                {{ $f009['SUBJECT'] }}
        </span>
    </div>
    <div class=" p-4 mt-2 flex justify-between">รูปแบบการประเมิน :  
        
        @if ($f009['checkbox']!==null)
            @foreach ($f009['checkbox'] as $checkbox)
            <span class="py-1">
                {{$checkbox}}
            </span> 
            @endforeach
        @endif

            <!-- <span class="px-2 mx-2">☐ ถาม-ตอบ</span><span class="px-2 mx-2">☐ แบบทดสอบ</span><span class="px-2 mx-2">☐ ทดลองปฏิบัติงานจริง</span> -->
        
    </div>
    <div class=" p-4 mt-2">
    หมายเหตุ :
        <ol class="list-decimal	list-inside	">
            <li>กรณีที่เป็นการถามตอบ กรุณาระบุคำถามและคำตอบโดยคร่าวพร้อมเกณฑ์การผ่านประเมิน</li>
            <li>กรณีที่เป็นการทดสอบ กรุณาแนบแบบทดสอบพร้อมระบุเกณฑ์การผ่านประเมิน</li>
            <li>กรณีที่เป็นการทดลองปฏิบัติงานจริง กรุณาระบุกิจกรรมพร้อมเกณฑ์การผ่านประเมิน</li>
        </ol>
    </div>
    <div class="border p-4 mt-2">
        <h3 class="text-lg mb-4 font-bold">คำถาม/แบบทดสอบ/หัวข้อการปฏิบัติงาน : </h3>
        <div><p>  {{ $f009['009Testing'] }} </p></div>
    </div>
    <div class="border p-4 mt-2">
        <h3 class="text-lg mb-4 font-bold">เกณฑ์การประเมิน : </h3>
        <div><p> ผ่าน :  {{ $f009['pass']  }}<br>
                 ไม่ผ่าน : {{ $f009['nopass']  }}
        </p></div>
       </div>
    </div>
    </div></div></div></div>
    
  
</x-app-layout>
