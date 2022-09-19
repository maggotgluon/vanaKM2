<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class TrainRequesrController extends Controller
{
    public function create(request $add){
        // ddd($add);
        //ตรวจสอบข้อมูล
        $add->validate(
            [   
                 'SUBJECT'=>'required',
                 'traindate'=>'required',
                 'traintime'=>'required',
                'Objective'=>'required',
                'SubjectDetails'=>'required',
                'SubjectTime'=>'required',
                'SubjectMaterial'=>'required',
                'ActivityDetail'=>'required',
                'ActivityTime'=>'required',
                'ActivityMaterial'=>'required',
                'AssessmentDetail'=>'required',
                'AssessmentTime'=>'required',
                'AssessmentMaterial'=>'required',
                '009Testing'=>'required',
                'file'=>'required',
               

                
                // 'info'=>'required',
                // // 'usedate'=>'required',
                // // 'Year'=>'required',
                // 'file'=>'required|mimes:pdf|size:10mb',
                
            ],
            [

            
                'SUBJECT.required' => "กรุณาป้อนชื่อเอกสาร",
                'traindate.required' => "กรุณาป้อนข้อมูล",
                'traintime.required' => "กรุณาป้อนข้อมูล",
                'Objective.required' => "กรุณาป้อนข้อมูล",
                'SubjectDetails.required' => "กรุณาป้อนข้อมูล",
                'SubjectTime.required'=>"กรุณาป้อนข้อมูล",
                'SubjectMaterial.required'=>"กรุณาป้อนข้อมูล",
                'ActivityDetail.required'=>"กรุณาป้อนข้อมูล",
                'ActivityTime.required'=>"กรุณาป้อนข้อมูล",
                'ActivityMaterial.required'=>"กรุณาป้อนข้อมูล",
                'AssessmentDetail.required'=>"กรุณาป้อนข้อมูล",
                'AssessmentTime.required'=>"กรุณาป้อนข้อมูล",
                'AssessmentMaterial.required'=>"กรุณาป้อนข้อมูล",
                '009Testing.required'=>"กรุณาป้อนข้อมูล",
                'file.required'=>"กรุณาป้อนข้อมูล",
                // 'Doc_Name.max' => "กรุณาป้อนชื่อเอกสาร 10 ตัวอักษร",
                // 'Doc_Name.unique' => "ชื่อเอกสารนี้ถูกใช้ไปแล้ว",
                // 'objective.required' => "กรุณาเลือกจุดประสงค์",
                // 'info.required' => "กรุณาป้อนรายละเอียด",
                // // 'usedate.required' => "กรุณาป้อนรายละเอียด",
                // // 'Year.required' => "กรุณาป้อนรายละเอียด",
                // 'file.required' => "กรุณาเลือกไฟล์",
                // 'file.mimes' => "กรุณาเลือกไฟล์ PDF เท่านั้น",
                // 'file.size' => "กรุณาเลือกไฟล์ PDF ขนาดไม่เกิน 10 MB",
                // 'file'=>'',

            ]
        );
        return view('traning.create');
}

}
