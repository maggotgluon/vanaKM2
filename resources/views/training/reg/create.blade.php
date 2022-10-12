<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new Training Presentation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                     

                    <form action="{{route('regTraining.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                     
                    
                        <!-- <div class="py-2 hidden">
                    
                            <x-input-label 
                                for="DocCode" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('TRAINCODE')}} : 
                            </x-input-label>
                            <x-text-input 
                                name="DocCode" id="DocCode"
                                value="{{'TRAIN'. date('Y').str_pad($count_train_code+1,4,'0',STR_PAD_LEFT)}}"
                                type="text" readonly/>

                        </div> -->

                        <h2 class=" z-20 text-2xl mb-4  font-bold text-center">{{__('TRAINING OUTLINE')}}  </h2>
                        <hr class="col-span-2">
                        <h2 class="text-lg font-bold">FM-LDS-008</h2>
                            <x-input-label 
                                for="SUBJECT" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('SUBJECT')}} : 
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
                                for="starttraindate" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Date Strat')}} : 
                            </x-input-label>
                            
                                <x-text-input 
                                    name="starttraindate" id="starttraindate"
                                    class="" maxlength="3"
                                    value="{{old( 'starttraindate' ,Carbon\Carbon::now()->addDay(3)->toDateString()) }}"
                                    min="{{Carbon\Carbon::now()->addDay(3)->toDateString()}}"
                                    type="date" />
                            <!-- <label for="date">วันที่เริ่มการอบรม:</label>
                            <input type="date" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-1/4" id="starttraindate" name="starttraindate"> -->
                            @error('starttraindate')
                                 <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                            @enderror
                        <x-input-label 
                                for="endtraindate" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Date End')}} : 
                            </x-input-label>
                                <x-text-input 
                                    name="endtraindate" id="endtraindate"
                                    class="" maxlength="3"
                                    value="{{old( 'endtraindate' ,Carbon\Carbon::now()->addDay(3)->toDateString()) }}"
                                    min="{{Carbon\Carbon::now()->addDay(3)->toDateString()}}"
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
                                for="starttraintime" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Time Strat')}} : 
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
                                for="endtraintime" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                {{__('Time End')}} : 
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

                        <x-input-label  for="Objective"><span class="required text-brand_orange text-xs"> * </span>{{__('Objective')}}  </x-input-label >
                        @error('Objective')
                             <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full w-full" >{{$message}}</span> 
                        @enderror
                        <x-textarea-input rows="10" cols="20" class="w-full"
                        id="Objective" name="Objective">{{old('Objective')}}</x-textarea-input>
                       
                       

                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">{{__('SubjectDetails')}}</h3>
                        <div class="flex justify-start  gap-2">
                            <div class="w-2/4">
                                
                                <x-input-label for="SubjectDetails"><span class="required text-brand_orange text-xs"> * </span>{{__('description')}} </x-input-label>
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
                                    for="SubjectTime" class=""> <span class="required text-brand_orange text-xs"> * </span>
                                    {{__('Duration')}} : 
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

                            <!-- <div class="w-1/6">
                                <x-input-label for="SubjectMaterial">
                                {{__('Material')}} :  
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="SubjectMaterial" name="SubjectMaterial">
                                {{old('SubjectMaterial')}}
                                </x-textarea-input><br>
                                @error('SubjectMaterial')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div> -->

                            <!-- <div>

                                <x-input-label for="SubjectRemark">
                                {{__('Remark')}} :  
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="SubjectRemark" name="SubjectRemark">
                                {{old('SubjectRemark')}}
                                </x-textarea-input><br>
                            </div> -->


                        </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">{{__('Activity')}}</h3>
                        <div class="flex justify-start gap-2">
                            <div class="w-2/4">
                                
                                <x-input-label for="ActivityDetails">{{__('description')}} :</x-input-label>
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
                                    {{__('Duration')}} : 
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

                            <!-- <div class="w-1/6">
                                <x-input-label for="ActivityMaterial">
                                {{__('Material')}} :  
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="ActivityMaterial" name="ActivityMaterial">
                                {{old('ActivityMaterial')}}
                                </x-textarea-input><br>
                                @error('ActivityMaterial')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div> -->

                            <!-- <div>

                                <x-input-label for="ActivityRemark">
                                     {{__('Remark')}} :  
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="ActivityRemark" name="ActivityRemark">
                                {{old('ActivityRemark')}}
                                </x-textarea-input><br>
                            </div> -->


                        </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">{{__('Assessment')}}</h3>
                        <div class="flex justify-start gap-2">
                            <div class="w-2/4">
                                
                                <x-input-label for="AssessmentDetails"><span class="required text-brand_orange text-xs"> * </span>{{__('description')}} :</x-input-label>
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
                                    for="AssessmentTime" class=""> <span class="required text-brand_orange text-xs"> * </span>
                                    {{__('Duration')}} : 
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

                            <!-- <div class="w-1/6">
                                <x-input-label for="AssessmentMaterial"><span class="required text-brand_orange text-xs"> * </span>
                                {{__('Material')}} :  
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="AssessmentMaterial" name="AssessmentMaterial">
                                {{old('AssessmentMaterial')}}
                                </x-textarea-input><br>
                                @error('AssessmentMaterial')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div> -->
<!-- 
                            <div>

                                <x-input-label for="AssessmentRemark">
                                {{__('Remark')}} :  
                                </x-input-label>
                                <x-textarea-input class="w-full"
                                 id="AssessmentRemark" name="AssessmentRemark">
                                {{old('AssessmentRemark')}}
                                </x-textarea-input><br>
                            </div> -->
                        </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">{{__('Remark')}}</h3>
                        <div class="flex justify-start gap-2">
                            <div class="w-full">
                                
                                <x-input-label for="Remark"></x-input-label>
                                <x-textarea-input class="w-3/4"
                                 id="Remark" name="Remark">
                                {{old('Remark')}}
                                </x-textarea-input>
                              

                            </div>

                            
                        </div>
                
                        <hr class="my-4">
                        <h2 class="text-lg font-bold">FM-LDS-009</h2>
                        <span> {{__('Assessment process')}} </span>
                        <x-input-label for="checkbox[]"><span class="required text-brand_orange text-xs"> * </span>รูปแบบการประเมิน:</x-input-label>
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




                                 
                        <hr class="w-1/2 m-auto mt-4 mb-2 border-2">
                        <!-- "Subject Details รายละเอียดการอบรม"
                        "Description รายละเอียด"
                        Durationเวลา(นาที)
                        "Material อุปกรณ์"
                        "Remark หมายเหตุ"
                    "Activity กิจกรรม ในการอบรม" -->

                        <!-- Assessment การประเมินผล -->

                        <!-- รูปแบบการประเมิน :  ☐ ถาม-ตอบ	☐ แบบทดสอบ		☐ ทดลองปฏิบัติงานจริง -->

                        {{__('Remark')}} :  
                        <ol class="list-decimal	list-inside	">
                            <li>กรณีที่เป็นการถามตอบ กรุณาระบุคำถามและคำตอบโดยคร่าวพร้อมเกณฑ์การผ่านประเมิน</li>
                            <li>กรณีที่เป็นการทดสอบ กรุณาแนบแบบทดสอบพร้อมระบุเกณฑ์การผ่านประเมิน</li>
                            <li>กรณีที่เป็นการทดลองปฏิบัติงานจริง กรุณาระบุกิจกรรมพร้อมเกณฑ์การผ่านประเมิน</li>
                        </ol>
                        

                        <x-input-label for="Testing009"><span class="required text-brand_orange text-xs"> * </span>{{__('Assessment Tools')}} :</x-input-label> 
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
                        

                        <h3 class="text-lg">{{__('Assessment Criteriament')}} : </h3>
                        <x-input-label for="pass"><span class="required text-brand_orange text-xs"> * </span>{{__('Pass')}} :</x-input-label> 
                         @error('pass')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                        <x-textarea-input class="w-full"
                                 id="pass" name="pass">
                                {{old('pass')}}
                                </x-textarea-input>
                        <!-- <textarea rows="2" cols="30" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="pass" name="pass" ></textarea> -->
                        <x-input-label for="nopass"><span class="required text-brand_orange text-xs"> * </span>{{__('Nopass')}} : :</x-input-label> 
                         @error('nopass')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                        <x-textarea-input class="w-full"
                                 id="nopass" name="nopass">
                                {{old('nopass')}}
                                </x-textarea-input>
                        <!-- <textarea rows="2" cols="30" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="nopass" name="nopass" ></textarea> -->
                      
                        <!-- คำถาม/แบบทดสอบ/หัวข้อการปฏิบัติงาน :  -->


                    <h3 class="text-lg"> {{__('AttachmentTrain')}} :  </h3>
                    <!-- <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >*** กรูณารวมเป็นไฟล์เดียว เฉพาะ PDF</span>  -->
                    <x-input-label 
                                    for="file" class="inline"> <span class="required text-brand_orange text-xs"> * </span>
                                    {{__('AttachmentTrain')}} : 
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