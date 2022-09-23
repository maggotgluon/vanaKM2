<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\train_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Ramsey\Uuid\v1;

class TrainRequesrController extends Controller
{
    public function create(request $add){
        //  dd($add);
        // INPUT DATA IN OBJECT

        $d008=array(
            'SUBJECT'=>$add->SUBJECT,
            'traindate'=>$add->traindate,
            'traintime'=>$add->traintime,
            'Objective'=>$add->Objective,
            'SubjectDetails'=>$add->SubjectDetails,
            'SubjectTime'=>$add->SubjectTime,
            'SubjectMaterial'=>$add->SubjectMaterial,
            'SubjectRemark'=>$add->SubjectRemark,
            'ActivityDetail'=>$add->ActivityDetail,
            'ActivityTime'=>$add->ActivityTime,
            'ActivityMaterial'=>$add->ActivityMaterial,
            'ActivityRemark'=>$add->ActivityRemark,
            'AssessmentDetail'=>$add->AssessmentDetail,
            'AssessmentTime'=>$add->AssessmentTime,
            'AssessmentMaterial'=>$add->AssessmentMaterial,
            'AssessmentRemark'=>$add->AssessmentRemark,
        );

        $d009=array(
            'SUBJECT'=>$add->SUBJECT,
            'checkbox'=>$add->checkbox,
            '009Testing'=>$add->Testing009
        );
       
       //json_encode
       $d008=json_encode($d008);
       $d009=json_encode($d009);




//Version File
        $file = $add->file('file');
        $docver = train_request::where('Doc_Code',$add->Doc_Code)->count();
        $docname = $add->Doc_Code;
        $NameFile = $docname.'-'.$docver;

//Location File
        $upload_location = '/TrainPDF/';
        $full_path = $upload_location.$NameFile;

    //  dd( $NameFile);
        // dd(json_encode($d008));

        //   //ตรวจสอบข้อมูล
        // $add->validate(
        //     [   
        //          'SUBJECT'=>'required',
        //          'traindate'=>'required',
        //          'traintime'=>'required',
        //         'Objective'=>'required',
        //         'SubjectDetails'=>'required',
        //         'SubjectTime'=>'required',
        //         'SubjectMaterial'=>'required',
        //         'ActivityDetail'=>'required',
        //         'ActivityTime'=>'required',
        //         'ActivityMaterial'=>'required',
        //         'AssessmentDetail'=>'required',
        //         'AssessmentTime'=>'required',
        //         'AssessmentMaterial'=>'required',
        //         'Testing009'=>'required',
        //         'checkbox'=> 'required',
        //         'file'=>'required|mimes:pdf|size:10mb',
                
        //         // 'info'=>'required',
        //         // // 'usedate'=>'required',
        //         // // 'Year'=>'required',
        //         // 'file'=>'required|mimes:pdf|size:10mb',
                
        //     ],
        //     [

        //         'SUBJECT.required' => "กรุณาป้อนชื่อเอกสาร",
        //         'traindate.required' => "กรุณาป้อนข้อมูล",
        //         'traintime.required' => "กรุณาป้อนข้อมูล",
        //         'Objective.required' => "กรุณาป้อนข้อมูล",
        //         'SubjectDetails.required' => "กรุณาป้อนข้อมูล",
        //         'SubjectTime.required'=>"กรุณาป้อนข้อมูล",
        //         'SubjectMaterial.required'=>"กรุณาป้อนข้อมูล",
        //         'ActivityDetail.required'=>"กรุณาป้อนข้อมูล",
        //         'ActivityTime.required'=>"กรุณาป้อนข้อมูล",
        //         'ActivityMaterial.required'=>"กรุณาป้อนข้อมูล",
        //         'AssessmentDetail.required'=>"กรุณาป้อนข้อมูล",
        //         'AssessmentTime.required'=>"กรุณาป้อนข้อมูล",
        //         'AssessmentMaterial.required'=>"กรุณาป้อนข้อมูล",
        //         'Testing009.required'=>"กรุณาป้อนข้อมูล",
        //         'file.required'=>"กรุณาป้อนข้อมูล",
        //         'file.mimes' => "กรุณาเลือกไฟล์ PDF เท่านั้น",
        //         'file.size' => "กรุณาเลือกไฟล์ PDF ขนาดไม่เกิน 10 MB",
        //         'checkbox.required'=>"กรุณาเลือกอย่างน้อยหนึ่งข้อ",
        //         // 'Doc_Name.max' => "กรุณาป้อนชื่อเอกสาร 10 ตัวอักษร",
        //         // 'Doc_Name.unique' => "ชื่อเอกสารนี้ถูกใช้ไปแล้ว",
        //         // 'objective.required' => "กรุณาเลือกจุดประสงค์",
        //         // 'info.required' => "กรุณาป้อนรายละเอียด",
        //         // // 'usedate.required' => "กรุณาป้อนรายละเอียด",
                // // 'Year.required' => "กรุณาป้อนรายละเอียด",
                // 'file.required' => "กรุณาเลือกไฟล์",
                // 'file.mimes' => "กรุณาเลือกไฟล์ PDF เท่านั้น",
                // 'file.size' => "กรุณาเลือกไฟล์ PDF ขนาดไม่เกิน 10 MB",
                // 'file'=>'',

        //     ]
        // );

   // // loc / upload file / rename to
        // Storage::putFileAs($upload_location,$file,$docname.'-'.$docver);
        // // Storage::putFileAs($upload_location,$file,doc_name.'-'.ver);
        // $visibility = Storage::getVisibility($upload_location);


    

        // //บันทึกข้อมูล 
        $doc_train = new train_request;
        $doc_train->Doc_Code = $add->DocCode;
        $doc_train->Doc_008 =  $d008;
        $doc_train->Doc_009 =  $d009;
        $doc_train-> user_id = Auth::user()->id;
        $doc_train->Doc_Location = '0';
        // $doc_train->Doc_Location = '$add->full_path';
        $doc_train->Doc_Status = '0';

// dd( $doc_train);
     


        // $doc_train->save();
        return view('traning.create');
}

}
