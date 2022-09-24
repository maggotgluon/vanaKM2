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
                    

                    <form action="{{route('createTrain')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <h2 class="text-lg font-bold">FM-LDS-008</h2>
                        <hr class="col-span-2">
                        <div class="py-2">
                        TRAINCODE :
                        <input class="bg-backdrop rounded-md"  name="DocCode" type="text"  value="{{'TRAIN'.date('Y').str_pad( $count_train_code+1 ,4,'0',STR_PAD_LEFT)}}" >
                        </div>
                        <span>TRAINING OUTLINE เค้าโครงการฝึกอบรมรายหัวข้อ</span>
                        <hr>
                        <!-- SUBJECT หัวข้อเรื่อง: ________________________________ -->
                        <label for="SUBJECT">SUBJECT หัวข้อเรื่อง:</label>
                        <input class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" id="SUBJECT" name="SUBJECT" >
                        @error('SUBJECT')
                             <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                       
                       
                        <div class="flex">
                            <label for="date">วันที่อบรม:</label>
                            <input type="date" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-1/4" id="date" name="traindate">
                            @error('traindate')
                                 <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                            @enderror
                            <label for="time">เวลา:</label>
                            <input type="time" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-1/4" id="time" name="traintime">
                            @error('traintime')
                                <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                            @enderror
                        </div>
                       
                        
                        <!-- วันที่อบรม____________________  เวลา_________________ -->
                        <!-- "Objective & Outcome วัตถุประสงค์" -->

                        <label for="time">Objective & Outcome วัตถุประสงค์:</label>
                        @error('Objective')
                             <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full w-full" >{{$message}}</span> 
                        @enderror
                        <textarea rows="5" cols="20" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time" name="Objective" ></textarea>
                       
                       

                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">Subject Details รายละเอียดการอบรม</h3>
                        <div class="flex justify-between gap-2">
                            <div class="w-2/4">
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="SubjectDetails" name="SubjectDetails"></textarea>
                                <label for="time">Description รายละเอียด:</label>
                                @error('SubjectDetails')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror

                            </div>

                            <div class="w-1/6">
                                <input type="number" min="0" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="SubjectTime" name="SubjectTime">
                                <label for="time">Duration เวลา(นาที):</label>
                                <br><br>
                                @error('SubjectTime')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div class="w-1/6">
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="SubjectMaterial" name="SubjectMaterial"></textarea>
                                <label for="time">Material อุปกรณ์:</label>
                                <br><br>
                                @error('SubjectMaterial')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div>
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="SubjectRemark" name="SubjectRemark" ></textarea>
                                <label for="time">Remark หมายเหตุ:</label>
                            </div>


                        </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">Activity กิจกรรม ในการอบรม</h3>
                        <div class="flex justify-between gap-2">
                            <div class="w-2/4">
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="ActivityDetail" name="ActivityDetail" ></textarea>
                                <label for="time">Description รายละเอียด:</label>
                                @error('ActivityDetail')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div class="w-1/6">
                                <input type="number" min="0" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="ActivityTime" name="ActivityTime"  >
                                <label for="time">Duration เวลา(นาที):</label>
                                <br><br>
                                @error('ActivityTime')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div class="w-1/6" >
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="ActivityMaterial" name="ActivityMaterial"  ></textarea>
                                <label for="time">Material อุปกรณ์:</label>
                                <br><br>
                                @error('ActivityMaterial')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div  class="w-1/6"  > 
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="ActivityRemark" name="ActivityRemark" ></textarea>
                                <label for="time">Remark หมายเหตุ:</label>
                            </div>

                        </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">Assessment การประเมินผล</h3>
                        <div class="flex justify-between gap-2">
                            <div class="w-1/2">
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="AssessmentDetail" name="AssessmentDetail"  ></textarea>
                                <label for="time">Description รายละเอียด:</label>
                                @error('AssessmentDetail')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div class="w-1/6">
                                <input type="number" min="0" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="AssessmentTime" name="AssessmentTime"  >
                                <label for="time">Duration เวลา(นาที):</label>
                                <br><br>
                                @error('AssessmentTime')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div class="w-1/6">
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="AssessmentMaterial"   name="AssessmentMaterial"  ></textarea>
                                <label for="time">Material อุปกรณ์:</label>
                                <br><br>
                                @error('AssessmentMaterial')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                                 @enderror
                            </div>

                            <div class="w-1/6" >
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="AssessmentRemark" name="AssessmentRemark"  ></textarea>
                                <label for="time">Remark หมายเหตุ:</label>
                            </div>

                        </div>
                        <hr>
                        <h2 class="text-lg font-bold">FM-LDS-009</h2>
                        <span>แนวทางการประเมินผลการอบรมในการปฏิบัติงาน</span>
                        <label for="time">รูปแบบการประเมิน:</label>
                        <div class="flex w-full justify-around">
                            <span>
                                <input type="checkbox" id="Q&A" name="checkbox[]" value="Q&A">
                                <label for="Q&A"> ถาม-ตอบ</label>
                            </span>
                            <span>
                                <input type="checkbox" id="Quiz" name="checkbox[]" value="Quiz">
                                <label for="Quiz"> แบบทดสอบ</label>
                            </span>
                            <span>
                                <input type="checkbox" id="practice" name="checkbox[]" value="practice">
                                <label for="practice"> ทดลองปฏิบัติงานจริง</label>
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

                        <label for="time">คำถาม/แบบทดสอบ/หัวข้อการปฏิบัติงาน :</label> 
                         @error('Testing009')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                        <textarea rows="10" cols="30" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="Testing009" name="Testing009" ></textarea>
                      
                       
                        <!-- คำถาม/แบบทดสอบ/หัวข้อการปฏิบัติงาน :  -->

                        <input class="m-2" type="file" name="file" id="">
                        @error('file')
                                         <span class="text-blue-800 bg-red-300 p-2 m-2 rounded-full " >{{$message}}</span> 
                        @enderror
                       


                        <button class="w-full bg-green-400 p-4 m-2" type="submit">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
    <div id="FM-LDS-008">
        FM-LDS-008-rev.01-เค้าโครงการฝึกอบรมรายหัวข้อ
        <span>TRAINING OUTLINE เค้าโครงการฝึกอบรมรายหัวข้อ</span>
        <div>
            <span>SUBJECT หัวข้อเรื่อง:</span>
            <span> test text</span>
        </div>
        <div>
            <div>
                <span>วันที่อบรม:</span>
                <span> 31 December 2022</span>
            </div>
            <div>
                <span>เวลา:</span>
                <span> 12:00 - 13:00 </span>
            </div>
        </div>
        <div>
            <span>
            Objective & Outcome วัตถุประสงค์
            </span>
            <div>
                <span>เพื่อให้พนักงานมีความรู้และความสามารถในเรื่องของ:</span>
                <span> test text</span>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <td>"Topic รายการ"</td>
                    <td>"Description รายละเอียด"</td>
                    <td>Duration เวลา(นาที)</td>
                    <td>"Material อุปกรณ์"</td>
                    <td>"Remark หมายเหตุ"</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>"Subject Details รายละเอียดการอบรม"</td>
                    <td><span> test text</span></td>
                    <td><span> test text</span></td>
                    <td><span> test text</span></td>
                    <td><span> test text</span></td>
                </tr>
                <tr>
                    <td>"Activity กิจกรรม ในการอบรม"</td>
                    <td><span> test text</span></td>
                    <td><span> test text</span></td>
                    <td><span> test text</span></td>
                    <td><span> test text</span></td>
                </tr>
                <tr>
                    <td>Assessment การประเมินผล</td>
                    <td><span> test text</span></td>
                    <td><span> test text</span></td>
                    <td><span> test text</span></td>
                    <td><span> test text</span></td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-between">
            <span>Trained by: <br>สอนโดย</span><span> test text</span>
            <span>Position:<br>ตำแหน่ง</span><span> test text</span>
            <span>Date:<br>วันที่</span><span> test text</span>
        </div>

        <div class="flex justify-between">
            <span>Acknowledge by: <br>รับทราบโดย </span><span> test text</span>
            <span>Position:ตำแหน่ง<br></span><span> test text</span>
            <span>Date:</<br>span><span> test text</span>
        </div>

        <div class="flex justify-between">
            <span>Reviewed by: <br>ตรวจสอบโดย </span><span> test text</span>
            <span>Position:<br>ตำแหน่ง</span><span> test text</span>
            <span>Date:<br>วันที่</span><span> test text</span>
        </div>
    </div>
    </div></div></div></div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
    <div id="FM-LDS-009">
    <span class="text-sm text-gray-300">FM-LDS-009-rev.00-แนวทางการประเมินผลการอบรมในการปฏิบัติงาน</span>
    <h2 class="text-2xl mb-4 font-bold text-center">
        OJT ASSESSMENT GUIDELINE แนวทางการประเมินผลการอบรมในการปฏิบัติงาน
    </h2>
    <div class="border p-4 mt-2">
        <span>DEPARTMENT แผนก :</span>
        <span></span>
    </div>
    <div class="border p-4 mt-2">
        <span>SUBJECT หัวข้อ :</span>
        <span></span>
    </div>
    <div class=" p-4 mt-2 flex justify-between">รูปแบบการประเมิน :  
        

            <span class="px-2 mx-2">☐ ถาม-ตอบ</span><span class="px-2 mx-2">☐ แบบทดสอบ</span><span class="px-2 mx-2">☐ ทดลองปฏิบัติงานจริง</span>
        
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
        <div><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi quidem quaerat veritatis tempore laborum nisi consequatur delectus facilis ab et earum repellendus reiciendis fugit accusantium amet eligendi voluptatum, cum ratione.</p></div>
    </div>
    <div class="border p-4 mt-2">
        <h3 class="text-lg mb-4 font-bold">เกณฑ์การประเมิน : </h3>
        <div><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi quidem quaerat veritatis tempore laborum nisi consequatur delectus facilis ab et earum repellendus reiciendis fugit accusantium amet eligendi voluptatum, cum ratione.</p></div>
    </div>
    </div>
    </div></div></div></div>
    
</x-app-layout>