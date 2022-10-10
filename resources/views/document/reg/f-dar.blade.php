

 <x-app-layout   >
    <x-slot  name="header">
        <h2  class="font-semibold text-xl text-gray-800 leading-tight print:hidden ">
            {{ __('DAR FROM') }}         </h2>
    </x-slot>
    <span class="print:block print:absolute print:bottom-0  hidden">FM-DCC-001</span>
    <span class="print:block print:absolute print:bottom-0  print:right-0 hidden">Rev. 00 : 19.01.2015 </span>
   
    <img class="m-auto h-16 w-1/4 object-contain hidden print:block" src="{{ asset('/img/logo.jpeg') }}">

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                 
                    <button  onclick="window.print();" class="block  float-right rounded-lg ring p-1 ring-blue-600 bg-blue-500 font-bold text-white  print:hidden  "> PRINT </button>
               
                    <div id="FM-LDS-009"class="">
  
    <!-- <span class="text-sm text-gray-300">FM-LDS-009-rev.00-แนวทางการประเมินผลการอบรมในการปฏิบัติงาน</span> -->

    <h2 class="text-2xl mb-4 font-bold text-center">
        DOCUMENT ACTION REQUEST
        <br>
        ใบแจ้งขอดำเนินการด้านเอกสาร
    </h2>

<table class="md:table-auto p-4  w-full mt-4">
    <thead class="table-auto ">
        <tr class="bg-gray-300">
        </tr>
    </thead>

    <tbody >
        <tr >
        <td class="table-auto p-4   mt-4 w-1/2"><span class=" font-bold" >{{__('Name')}} :</span>
            <span >
            {{ Auth::user()->name }} 
            
            </span><br>

            <span class="font-bold" >Department แผนก :</span> 
            <span>
            {{Auth::user()->department}}
            
            </span>
        </td>

        <td class="table-auto  w-1/2"><span class=" font-bold" >Date Request วันที่ส่งเอกสาร :</span>
            <span>
            {{$date['created_at']}} 
            </span><br>
            <span class=" font-bold" >Head Department หัวหน้าแผนก : </span> 
            <span>
            {{Auth::user()->department_head}}
            </span> 
            </td>
        </tr>
    </tbody>
</table>

    <hr class="mt-2">

        <div class=" p-4  py-4 pt-4 ">
            <span class=" font-bold" >Objective  รหัสเอกสาร :</span>
            <span>
            {{$DarForm->Doc_Obj}}
            </span>
            
        </div>

        <hr class="my-2">


   
    

   
  

<table class="md:table-auto border ">
  <thead class="table-auto border">
    <tr class="bg-gray-300">
      <th class="table-auto border text-center " >Dar Number รหัสเอกสาร</th>
      <th class="table-auto border text-center ">Dar Name ชื่อเอกสาร</th>
      <th class="table-auto border text-center ">Document Type ประเภทเอกสาร</th>
      <th class="table-auto border text-center ">Date Public วันบังคับใช้</th>
      <th class="table-auto border text-center ">Doc Version แก้ไขครั้งที่</th>
      <th class="table-auto border text-center ">Document Age อายุการเก็บเอกสาร</th>
      <th class="table-auto border text-center ">Attachment เอกสารแนบ</th>
      
    </tr>
  </thead>

  <tbody >
    <tr >
      <td class="table-auto border text-center">{{$DarForm->Doc_Code}}</td>
      <td class="table-auto border text-center">{{$DarForm->Doc_Name}}</td>
      <td class="table-auto border text-center">{{$DarForm->Doc_Type}}</td>
      <td class="table-auto border text-center">{{$DarForm->Doc_StartDate}}</td>
      <td class="table-auto border text-center">{{$DarForm->Doc_ver}}</td>
      <td class="table-auto border text-center">{{$DarForm->Doc_Life}} YEAR</td>
      <td class="table-auto border text-center">
        @php
       $Attachment= $DarForm->Doc_Location ?$DarForm->Doc_Location:"N/A" 
      @endphp
      {{$Attachment}}
    </td>
    </tr>
  </tbody>
</table>

<table class="md:table-auto border w-full mt-4">
  <thead class="table-auto border">
    <tr class="bg-gray-300">
        <th class="border w-1/2">DCC เจ้าหน้าที่ควบควมเอกสาร</th>
        <th class="border w-1/2">OMR/MR ตัวแทนฝ่ายบริหารพิจารณาอนุมัติ</th>
    
    </tr>
  </thead>

  <tbody >
    <tr >
      <td class="table-auto border"><span class=" font-bold" >Name ชื่อ-นามสกุล  :</span>
        <span>
        {{$DarForm->User_Approve}}
        
        </span><br>
        <span class=" font-bold" >Date  วันที่ : </span> 
        <span>
        {{$date['Date_Approve']}}
        
        </span>
    </td>

      <td class="table-auto border mt-4"><span class=" font-bold" >Name ชื่อ-นามสกุล  :</span>
        <span>
        {{ Auth::user()->name }} 
        </span><br>
        <span class=" font-bold" >Date  วันที่ : </span> 
        <span>
        {{$date['created_at']}}
        </span> 
    </td>
  
    </tr>
   
  </tbody>
</table>











</div>  
    </div>
</div>
</div>
</div>
    
  
</x-app-layout>
