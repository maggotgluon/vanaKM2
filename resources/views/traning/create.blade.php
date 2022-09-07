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
                    You're logged in!
                    show single doc
                    {{ Auth::user()->id }}

                    <form action="" method="post">

                        <h2 class="text-lg font-bold">FM-LDS-008</h2>
                        <span>TRAINING OUTLINE เค้าโครงการฝึกอบรมรายหัวข้อ</span>
                        <hr>
                        <!-- SUBJECT หัวข้อเรื่อง: ________________________________ -->
                        <label for="SUBJECT">SUBJECT หัวข้อเรื่อง:</label>
                        <input class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="SUBJECT">
                        <div class="flex">
                            <label for="date">วันที่อบรม:</label>
                            <input type="date" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="date">
                            <label for="time">เวลา:</label>
                            <input type="time" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time">
                        </div>
                        <!-- วันที่อบรม____________________  เวลา_________________ -->
                        <!-- "Objective & Outcome วัตถุประสงค์" -->

                        <label for="time">Objective & Outcome วัตถุประสงค์:</label>
                        <textarea rows="5" cols="20" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>

                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">Subject Details รายละเอียดการอบรม</h3>
                        <div class="flex justify-between gap-2">
                            <div class="w-1/2">
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                                <label for="time">Description รายละเอียด:</label>
                            </div>

                            <div class="w-24">
                                <input type="number" min="0" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time">
                                <label for="time">Duration เวลา(นาที):</label>
                            </div>

                            <div>
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                                <label for="time">Material อุปกรณ์:</label>
                            </div>

                            <div>
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                                <label for="time">Remark หมายเหตุ:</label>
                            </div>

                        </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">Activity กิจกรรม ในการอบรม</h3>
                        <div class="flex justify-between gap-2">
                            <div class="w-1/2">
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                                <label for="time">Description รายละเอียด:</label>
                            </div>

                            <div class="w-24">
                                <input type="number" min="0" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time">
                                <label for="time">Duration เวลา(นาที):</label>
                            </div>

                            <div>
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                                <label for="time">Material อุปกรณ์:</label>
                            </div>

                            <div>
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                                <label for="time">Remark หมายเหตุ:</label>
                            </div>

                        </div>
                        <hr class="w-1/2 m-auto mt-10 mb-2 border-2">
                        <h3 class="text-lg">Assessment การประเมินผล</h3>
                        <div class="flex justify-between gap-2">
                            <div class="w-1/2">
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                                <label for="time">Description รายละเอียด:</label>
                            </div>

                            <div class="w-24">
                                <input type="number" min="0" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time">
                                <label for="time">Duration เวลา(นาที):</label>
                            </div>

                            <div>
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                                <label for="time">Material อุปกรณ์:</label>
                            </div>

                            <div>
                                <textarea class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                                <label for="time">Remark หมายเหตุ:</label>
                            </div>

                        </div>
                        <hr>
                        <h2 class="text-lg font-bold">FM-LDS-009</h2>
                        <span>แนวทางการประเมินผลการอบรมในการปฏิบัติงาน</span>
                        <label for="time">รูปแบบการประเมิน:</label>
                        <div class="flex w-full justify-around">
                            <span>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                <label for="vehicle1"> ถาม-ตอบ</label>
                            </span>
                            <span>
                                <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                                <label for="vehicle2"> แบบทดสอบ</label>
                            </span>
                            <span>
                                <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                                <label for="vehicle3"> ทดลองปฏิบัติงานจริง</label>
                            </span>
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
                        <textarea rows="10" cols="30" class="bg-slate-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-fullbg-backdrop-dark rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="time"></textarea>
                        <!-- คำถาม/แบบทดสอบ/หัวข้อการปฏิบัติงาน :  -->

                        <input class="m-2" type="file" name="" id="">
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