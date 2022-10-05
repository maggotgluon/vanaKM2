<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    

                    <form action="{{route('regTraining.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <h2 class="text-lg font-bold">FM-LDS-008</h2>
                        <hr class="col-span-2">
                        <div class="py-2">
                        <!-- TRAINCODE :
                        {{'TRAIN'.date('Y').str_pad( $count_train_code+1 ,4,'0',STR_PAD_LEFT)}}

                        

                        <input class="bg-backdrop rounded-md"  name="DocCode" type="text"  value="{{'TRAIN'. date('Y').str_pad($count_train_code+1,4,'0',STR_PAD_LEFT)}}"> 
                         -->
                            <x-input-label 
                                for="DocCode" class="inline"> 
                                {{__('TRAINCODE')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="DocCode" id="DocCode"
                                value="{{'TRAIN'. date('Y').str_pad($count_train_code+1,4,'0',STR_PAD_LEFT)}}"
                                type="text" readonly/>

                        </div>
                        <span>TRAINING OUTLINE เค้าโครงการฝึกอบรมรายหัวข้อ</span>
                        <hr>
                        <!-- SUBJECT หัวข้อเรื่อง: ________________________________ -->
                            <x-input-label 
                                for="SUBJECT" class="inline"> 
                                {{__('SUBJECT หัวข้อเรื่อง')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="SUBJECT" id="SUBJECT" class="w-full"
                                value="{{old('SUBJECT')}}"
                                type="text" />

                        <!-- <label for="SUBJECT">SUBJECT หัวข้อเรื่อง:</label>
                        <input class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" id="SUBJECT" name="SUBJECT" > -->
                        @error('SUBJECT')
                             <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                       <br>
                       
                        <div class="flex items-center gap-4 mt-2">
                        <x-input-label 
                                for="starttraindate" class="inline"> 
                                {{__('วันที่เริ่มการอบรม')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="starttraindate" id="starttraindate"
                                value="{{old( 'starttraindate' ,Carbon\Carbon::now()->toDateString()) }}"
                                min="{{Carbon\Carbon::now()->toDateString()}}"
                                
                                type="date" />
                            <!-- <label for="date">วันที่เริ่มการอบรม:</label>
                            <input type="date" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-1/4" id="starttraindate" name="starttraindate"> -->
                            @error('starttraindate')
                                 <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                            @enderror
                        <x-input-label 
                                for="endtraindate" class="inline"> 
                                {{__('วันสิ้นสุดการอบรม')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="endtraindate" id="endtraindate"
                                value="{{old( 'endtraindate' ,Carbon\Carbon::now()->toDateString()) }}"
                                min="{{Carbon\Carbon::now()->toDateString()}}"
                                
                                type="date" />
                           
                            <!-- <label for="date">วันสิ้นสุดการอบรม:</label>
                            <input type="date" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-1/4" id="endtraindate" name="endtraindate"> -->
                            @error('endtraindate')
                                 <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                            @enderror

                        </div>
                        <br>
                        <div class="flex items-center gap-4 mt-2">
                            
                            <x-input-label 
                                for="starttraintime" class="inline"> 
                                {{__('เริ่มเวลา')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="starttraintime" id="starttraintime"
                                value="{{old( 'starttraintime' ,'09:00:00') }}"
                                type="time" />
                            <!-- <label for="time">เริ่มเวลา:</label>
                            <input type="time" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-1/4" id="starttraintime" name="starttraintime"> -->
                            @error('starttraintime')
                                <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                            @enderror
                        <x-input-label 
                                for="endtraintime" class="inline"> 
                                {{__('เวลาสิ้นสุด')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="endtraintime" id="endtraintime"
                                value="{{old( 'endtraintime' ,'18:00:00') }}"
                                type="time" />

                            <!-- <label for="time">เวลาสิ้นสุด:</label>
                            <input type="time" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-1/4" id="endtraintime" name="endtraintime"> -->
                            @error('endtraintime')
                                <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                            @enderror
                        </div>
                       
                        
                        <!-- วันที่อบรม____________________  เวลา_________________ -->
                        <!-- "Objective & Outcome วัตถุประสงค์" -->

                        <x-input-label  for="Objective">Objective & Outcome วัตถุประสงค์:</x-input-label >
                        @error('Objective')
                             <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full w-full" >{{$message}}</span> 
                        @enderror
                        <x-textarea-input rows="10" cols="20" class="w-full"
                        id="Objective" name="Objective">{{old('Objective')}}</x-textarea-input>
                       
                       

                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">Subject Details รายละเอียดการอบรม</h3>
                        <div class="flex justify-between gap-2">
                            <div class="w-2/4">
                                
                                <x-input-label for="SubjectDetails">Description รายละเอียด:</x-input-label>
                                <x-textarea-input class="w-full"
                                 id="SubjectDetails" name="SubjectDetails">
                                {{old('SubjectDetails')}}
                                </x-textarea-input>
                                @error('SubjectDetails')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror

                            </div>

                            <div class="w-1/6">

                                <x-input-label 
                                    for="SubjectTime" class=""> 
                                    {{__('Duration เวลา(นาที)')}} : 
                                </x-input-label>
                                <x-text-input 
                                    name="SubjectTime" id="SubjectTime"
                                    class="w-full"
                                    value="{{old( 'SubjectTime') }}"
                                    min="1" step="1"
                                    type="number" /> 

                                @error('SubjectTime')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div class="w-1/6">
                                <x-input-label for="SubjectMaterial">
                                    Material อุปกรณ์:
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="SubjectMaterial" name="SubjectMaterial">
                                {{old('SubjectMaterial')}}
                                </x-textarea-input><br>
                                @error('SubjectMaterial')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div>

                                <x-input-label for="SubjectRemark">
                                    Remark หมายเหตุ:
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="SubjectRemark" name="SubjectRemark">
                                {{old('SubjectRemark')}}
                                </x-textarea-input><br>
                            </div>


                        </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">Activity กิจกรรม ในการอบรม</h3>
                        <div class="flex justify-between gap-2">
                            <div class="w-2/4">
                                
                                <x-input-label for="ActivityDetails">Description รายละเอียด:</x-input-label>
                                <x-textarea-input class="w-full"
                                 id="ActivityDetails" name="ActivityDetails">
                                {{old('ActivityDetails')}}
                                </x-textarea-input>
                                @error('ActivityDetails')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror

                            </div>

                            <div class="w-1/6">

                                <x-input-label 
                                    for="ActivityTime" class=""> 
                                    {{__('Duration เวลา(นาที)')}} : 
                                </x-input-label>
                                <x-text-input 
                                    name="ActivityTime" id="ActivityTime"
                                    class="w-full"
                                    value="{{old( 'ActivityTime') }}"
                                    min="1" step="1"
                                    type="number" /> 

                                @error('ActivityTime')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div class="w-1/6">
                                <x-input-label for="ActivityMaterial">
                                    Material อุปกรณ์:
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="ActivityMaterial" name="ActivityMaterial">
                                {{old('ActivityMaterial')}}
                                </x-textarea-input><br>
                                @error('ActivityMaterial')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div>

                                <x-input-label for="ActivityRemark">
                                    Remark หมายเหตุ:
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="ActivityRemark" name="ActivityRemark">
                                {{old('ActivityRemark')}}
                                </x-textarea-input><br>
                            </div>


                        </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">Assessment การประเมินผล</h3>
                        <div class="flex justify-between gap-2">
                            <div class="w-2/4">
                                
                                <x-input-label for="AssessmentDetails">Description รายละเอียด:</x-input-label>
                                <x-textarea-input class="w-full"
                                 id="AssessmentDetails" name="AssessmentDetails">
                                {{old('AssessmentDetails')}}
                                </x-textarea-input>
                                @error('AssessmentDetails')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror

                            </div>

                            <div class="w-1/6">

                                <x-input-label 
                                    for="AssessmentTime" class=""> 
                                    {{__('Duration เวลา(นาที)')}} : 
                                </x-input-label>
                                <x-text-input 
                                    name="AssessmentTime" id="AssessmentTime"
                                    class="w-full"
                                    value="{{old( 'AssessmentTime') }}"
                                    min="1" step="1"
                                    type="number" /> 

                                @error('AssessmentTime')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div class="w-1/6">
                                <x-input-label for="AssessmentMaterial">
                                    Material อุปกรณ์:
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="AssessmentMaterial" name="AssessmentMaterial">
                                {{old('AssessmentMaterial')}}
                                </x-textarea-input><br>
                                @error('AssessmentMaterial')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div>

                                <x-input-label for="AssessmentRemark">
                                    Remark หมายเหตุ:
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="AssessmentRemark" name="AssessmentRemark">
                                {{old('AssessmentRemark')}}
                                </x-textarea-input><br>
                            </div>


                        </div>
                        <hr>
                        <h2 class="text-lg font-bold">FM-LDS-009</h2>
                        <span>แนวทางการประเมินผลการอบรมในการปฏิบัติงาน</span>
                        <x-input-label for="checkbox[]">รูปแบบการประเมิน:</x-input-label>
                        <div class="flex w-full justify-around">
                            <span>
                                <x-text-input type="checkbox" id="Q&A" name="checkbox[]" value="ถาม-ตอบ" />
                                <x-input-label class="inline" for="Q&A"> ถาม-ตอบ</x-input-label>
                            </span>
                            <span>
                                <x-text-input type="checkbox" id="Quiz" name="checkbox[]" value="แบบทดสอบ" />
                                <x-input-label class="inline" for="Quiz"> แบบทดสอบ</x-input-label>
                            </span>
                            <span>
                                <x-text-input type="checkbox" id="practice" name="checkbox[]" value="ทดลองปฏิบัติงานจริง" />
                                <x-input-label class="inline" for="practice"> ทดลองปฏิบัติงานจริง</x-input-label>
                            </span>
                            
                        </div>
                        <br>
                        <div class=" ">
                               @error('checkbox')
                                         <span class=" center  text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                                 </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <!-- "Subject Details รายละเอียดการอบรม"
                        "Description รายละเอียด"
                        Durationเวลา(นาที)
                        "Material อุปกรณ์"
                        "Remark หมายเหตุ"
                    "Activity กิจกรรม ในการอบรม" -->

                        <!-- Assessment การประเมินผล -->

                        <!-- รูปแบบการประเมิน :  ☐ ถาม-ตอบ	☐ แบบทดสอบ		☐ ทดลองปฏิบัติงานจริง -->

                        หมายเหตุ :
                        <ol class="list-decimal	list-inside	">
                            <li>กรณีที่เป็นการถามตอบ กรุณาระบุคำถามและคำตอบโดยคร่าวพร้อมเกณฑ์การผ่านประเมิน</li>
                            <li>กรณีที่เป็นการทดสอบ กรุณาแนบแบบทดสอบพร้อมระบุเกณฑ์การผ่านประเมิน</li>
                            <li>กรณีที่เป็นการทดลองปฏิบัติงานจริง กรุณาระบุกิจกรรมพร้อมเกณฑ์การผ่านประเมิน</li>
                        </ol>
                        

                        <x-input-label for="Testing009">คำถาม/แบบทดสอบ/หัวข้อการปฏิบัติงาน :</x-input-label> 
                         @error('Testing009')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                        <x-textarea-input class="w-full"
                                rows="10"
                                 id="Testing009" name="Testing009">
                                {{old('Testing009')}}
                                </x-textarea-input>
                        <!-- <textarea rows="5" cols="30" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="Testing009" name="Testing009" ></textarea> -->
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        

                        <h3 class="text-lg">เกณฑ์การประเมิน </h3>
                        <x-input-label for="pass">ผ่าน :</x-input-label> 
                         @error('pass')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                        <x-textarea-input class="w-full"
                                 id="pass" name="pass">
                                {{old('pass')}}
                                </x-textarea-input>
                        <!-- <textarea rows="2" cols="30" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="pass" name="pass" ></textarea> -->
                        <x-input-label for="nopass">ไม่ผ่าน :</x-input-label> 
                         @error('nopass')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                        <x-textarea-input class="w-full"
                                 id="nopass" name="nopass">
                                {{old('nopass')}}
                                </x-textarea-input>
                        <!-- <textarea rows="2" cols="30" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="nopass" name="nopass" ></textarea> -->
                      
                        <!-- คำถาม/แบบทดสอบ/หัวข้อการปฏิบัติงาน :  -->


                    <h3 class="text-lg">เอกสารแนบการอบรม </h3>
                    <!-- <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >*** กรูณารวมเป็นไฟล์เดียว เฉพาะ PDF</span>  -->
                    <x-input-label 
                                    for="file" class="inline"> 
                                    {{__('เอกสารแนบการอบรม')}} : 
                                </x-input-label>
                                <x-text-input 
                                    name="file" id="file"
                                    value="{{old( 'file') }}"
                                    type="file" accept=".pdf" required/>     
                    <!-- <input class="m-2" type="file" name="file" id=""> -->
                        @error('file')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                       <div  class="w-full text-right">
                        <x-primary-button>submit</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="module">
    import { faker } from 'https://cdn.skypack.dev/@faker-js/faker';

    const e=document.querySelectorAll('input');
    e.forEach(ee => {
        // console.log(ee.name,ee.value)
        if(ee.type=='text' & ee.value ==''){
            ee.value=faker.hacker.noun()
        }

        if(ee.type=='number' & ee.value ==''){
            ee.value=faker.mersenne.rand()
        }
        if(ee.type=='date' & ee.value ==''){
            dd  = faker.date.future()
            ee.value= dd.toDateString()
        }
        
    });

    const e2=document.querySelectorAll('textarea');
    e2.forEach(ee=>{
        ee.value=faker.lorem.lines()
    })
</script>