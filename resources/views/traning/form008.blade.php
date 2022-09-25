<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('training') }} 008
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
    </div>
</x-app-layout>
