

 <x-app-layout   >
    <x-slot  name="header">
        <h2  class="font-semibold text-xl text-gray-800 leading-tight print:hidden ">
            {{ __('DAR FROM') }}         </h2>
    </x-slot>
    <span class="print:block print:absolute print:bottom-0  hidden">FM-DCC-001</span>
    <span class="print:block print:absolute print:bottom-0  print:right-0 hidden">Rev. 00 : 19.01.2015 </span>
       
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <img class="h-16 w-1/4 object-contain hidden print:block" src="{{ asset('/img/logo.jpeg') }}">
                        <button  onclick="window.print();" class="  rounded-lg  ring  p-1 ring-blue-900 bg-blue-500 font-bold text-white  print:hidden  "> PRINT </button>
                    </div>
                <div id="FM-LDS-009"class="">
  
    <!-- <span class="text-sm text-gray-300">FM-LDS-009-rev.00-แนวทางการประเมินผลการอบรมในการปฏิบัติงาน</span> -->

    <h2 class="text-2xl mb-4 font-bold text-center">
        DOCUMENT ACTION REQUEST
        <br>
        ใบแจ้งขอดำเนินการด้านเอกสาร
    </h2>
  


<div class="grid grid-cols-2 gap-2">

   

    <div class="border p-4 mt-2">
        <span class=" font-bold" >Name ชื่อ นามสกุล  :</span>
        <span>
        {{ Auth::user()->name }} 
        </span>
        
    </div>
    <div class="border p-4 mt-2">
        <span class=" font-bold" >Department แผนก :</span>
        <span>
        {{Auth::user()->department}}
        </span>
    </div>

</div>

    <div class="border p-4 mt-2 ">
        <span class=" font-bold" >Head Department หัวหน้าแผนก :</span>
        <span>
        {{Auth::user()->department_head}}
        </span>
    </div>




<div class="grid grid-cols-2 gap-2">
    <div class="border p-4 mt-2">
        <span class=" font-bold" >Dar Number รหัสเอกสาร  :</span>
        <span>
        {{$DarForm->Doc_Code}}
        </span>
        
    </div>
    <div class="border p-4 mt-2">
        <span class=" font-bold" >Date Request วันที่ส่งเอกสาร:</span>
        <span>
        {{$date['created_at']}}
        
        </span>
    </div>
    <div class="border p-4 mt-2">
        <span class=" font-bold" >Objective  รหัสเอกสาร  :</span>
        <span>
        {{$DarForm->Doc_Obj}}
        </span>
        
    </div>
    <div class="border p-4 mt-2">
        <span class=" font-bold" >Document Type ประเภทเอกสาร:</span>
        <span>
        {{$DarForm->Doc_Type}}
        </span>
    </div>

    <div class="border p-4 mt-2">
        <span class=" font-bold" >Date Public วันบังคับใช้:</span>
        <span>
        {{$DarForm->Doc_StartDate}}
     
        </span>
    </div>
    <div class="border p-4 mt-2">
        <span class=" font-bold" >Document Age อายุการเก็บเอกสาร  :</span>
        <span>
        {{$DarForm->Doc_Life}} Year
        </span>
    </div>

    
    
</div>

    <div class="border p-4 mt-2">
        <span class=" font-bold" >Description รายละเอียดการแก้ไข:</span>
        <span>
        {{$DarForm->Doc_Description}}
        </span>
    </div>

<div class="grid grid-cols-2 gap-2">
    <div class="border p-4 mt-2">
        <span class=" font-bold" > DCC เจ้าหน้าที่ควบควมเอกสาร  :</span>
        <span>
        {{$DarForm->Doc_Code}}
        </span>
        
    </div>
    <div class="border p-4 mt-2">
        <span class=" font-bold" >Date  วันที่:</span>
        <span>
        {{$date['created_at']}}
        
        </span>
    </div>
    <div class="border p-4 mt-2">
        <span class=" font-bold" > OMR/MR ตัวแทนฝ่ายบริหารพิจารณาอนุมัติ :</span>
        <span>
        {{$DarForm->Doc_Code}}
        </span>
        
    </div>
    <div class="border p-4 mt-2">
        <span class=" font-bold" >Date  วันที่:</span>
        <span>
        {{$date['created_at']}}
        
        </span>
    </div>
    
</div>  
    </div>
</div>
</div>
</div>
    
  
</x-app-layout>
