<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('training') }} 009
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    show single doc
                    {{ Auth::user()->id }}
                </div>
            </div>
        </div>

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
    
    </div>
</x-app-layout>
