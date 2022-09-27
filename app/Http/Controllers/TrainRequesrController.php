<?php

namespace App\Http\Controllers;

use App\Models\train_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

class TrainRequesrController extends Controller{

    private function InputToDate($Input)
    {
        $Date = new Carbon($Input);
        return date_format($Date,"d F Y");

    }


    public function create(request $add){
        //  dd($add);

        //  Cover Dte formate
        // $dd =$this->InputToDate($add->starttraindate);
        // dd($dd);



        // INPUT DATA IN OBJECT
        $d008 = array(
            'SUBJECT' => $add->SUBJECT,
            'starttraindate' => $this->InputToDate($add->starttraindate),
            'endtraindate' => $this->InputToDate($add->endtraindate),
            'starttraintime' => $add->starttraintime,
            'endtraintime' => $add->endtraintime,
            'Objective' => $add->Objective,
            'SubjectDetails' => $add->SubjectDetails,
            'SubjectTime' => $add->SubjectTime,
            'SubjectMaterial' => $add->SubjectMaterial,
            'SubjectRemark' => $add->SubjectRemark,
            'ActivityDetail' => $add->ActivityDetail,
            'ActivityTime' => $add->ActivityTime,
            'ActivityMaterial' => $add->ActivityMaterial,
            'ActivityRemark' => $add->ActivityRemark,
            'AssessmentDetail' => $add->AssessmentDetail,
            'AssessmentTime' => $add->AssessmentTime,
            'AssessmentMaterial' => $add->AssessmentMaterial,
            'AssessmentRemark' => $add->AssessmentRemark,
        );

        $d009 = array(
            'SUBJECT' => $add->SUBJECT,
            'checkbox' => $add->checkbox,
            '009Testing' => $add->Testing009,
            'pass' => $add->pass,
            'nopass' => $add->nopass,
        );

        //json_encode
        $d008 = json_encode($d008);
        $d009 = json_encode($d009);

        //Version File
        $file = $add->file('file');
        $docver = train_request::where('Doc_Code', $add->DocCode)->count();
        $docname = $add->DocCode;
        $NameFile = $docname . '-' . $docver;
        // dd($file);
        //Location File
        $upload_location = '/TrainPDF/';
        $full_path = $upload_location . $NameFile;

        //  dd( $full_path);
        // dd(json_encode($d008));

        //   //ตรวจสอบข้อมูล
        // $add->validate(
        //     [
        //         'SUBJECT'=>'required',
        //         'starttraindate'=>'required',
        //         'endtraindate'=>'required',
        //         'starttraintime'=>'required',
        //         'endtraintime'=>'required',
        //         'Objective'=>'required',
        //   *     'SubjectDetails'=>'required',
        //   *     'SubjectTime'=>'required',
        //         'SubjectMaterial'=>'required',
        //         'ActivityDetail'=>'required',
        //         'ActivityTime'=>'required',
        //         'ActivityMaterial'=>'required',
        //   *     'AssessmentDetail'=>'required',
        //   *     'AssessmentTime'=>'required',
        //         'AssessmentMaterial'=>'required',
        //         'checkbox'=> 'required',
        //         'Testing009'=>'required',
        //         'pass'=>'required',
        //         'nopass'=>'required',
        //         'file'=>'required',

        //         // 'info'=>'required',
        //         // // 'usedate'=>'required',
        //         // // 'Year'=>'required',
        //         // 'file'=>'required|mimes:pdf|size:10mb',

        //     ],
        //     [

        //         'SUBJECT.required' => "กรุณาป้อนชื่อเอกสาร",
        //         'starttraindate.required' => "กรุณาป้อนข้อมูล",
        //         'endtraindate.required' => "กรุณาป้อนข้อมูล",
        //         'starttraintime.required' => "กรุณาป้อนข้อมูล",
        //         'endtraintime.required' => "กรุณาป้อนข้อมูล",
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
        //         'pass.required'=>"กรุณาป้อนข้อมูล",
        //         'nopass.required'=>"กรุณาป้อนข้อมูล",
        //         'file.required'=>"กรุณาป้อนข้อมูล",
        //         // 'file.mimes' => "กรุณาเลือกไฟล์ PDF เท่านั้น",
        //         // 'file.size' => "กรุณาเลือกไฟล์ PDF ขนาดไม่เกิน 10 MB",
        //         'checkbox.required'=>"กรุณาเลือกอย่างน้อยหนึ่งข้อ",

        //     ]
        // );

        // // loc / upload file / rename to
        // dd($upload_location,$file,$docname,$docver);
        Storage::putFileAs($upload_location, $file, $docname . '-' . $docver);
        // Storage::putFileAs($upload_location,$file,doc_name.'-'.ver);
        $visibility = Storage::getVisibility($upload_location);
        // dd($visibility);

        // dd($add->DocCode);
        // dd($d008,$d009,Auth::user()->id);

        // //บันทึกข้อมูล
        $doc_train = new train_request;
        $doc_train->Doc_Code = $add->DocCode;
        $doc_train->Doc_008 = $d008;
        $doc_train->Doc_009 = $d009;
        $doc_train->user_id = Auth::user()->id;
        // $doc_train->Doc_Location = '0';
        $doc_train->Doc_Location = $full_path;
        $doc_train->Doc_Status = '0';

        // dd( $doc_train);

        $doc_train->save();

        return view('traning.create', ['count_train_code' => 0]);

        return view('traning.create', ['count_train_code' => '1']);
    }

    public function show(){
        return view('traning.index', [
            'documents' => train_request::all(),
        ]);
    }

    public function form008($Doc_Code){
        $d008 =train_request::where('Doc_Code',$Doc_Code)->firstOrFail() ;
        $sub_d008 = json_decode($d008->Doc_008, TRUE);
        // dd($sub_d008);
        return view('traning.form008', ['f008'=>$sub_d008],['D008'=>$d008]);

    }
    public function form009($Doc_Code){ 
        $d009 =train_request::where('Doc_Code',$Doc_Code)->firstOrFail() ;
        $d009 = json_decode($d009->Doc_009, TRUE);
    //  dd($d009);
        return view('traning.form009', ['f009'=>$d009]);
    }

}
