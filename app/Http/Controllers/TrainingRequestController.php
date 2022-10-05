<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingRequest;
use App\Models\training;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
class TrainingRequestController extends Controller
{
    private function InputToDate($Input)
    {
        $Date = new Carbon($Input);
        return date_format($Date,"d F Y");
    }
    //
    public function all(){
        // dd(Training::all());
        return view('training.index', [
            'documents' => TrainingRequest::where('Doc_Status',1)->get(),
        ]);
    }
    public function view($id){
        // dd($id);
        return view('training.show', [
            'documents' => TrainingRequest::where('Doc_Code',$id)->firstOrFail(),
        ]);
    }

      //
    public function allReg($user=null){
        if($user==null){
            $regDoc = TrainingRequest::all();
        }else{
            $regDoc = Auth::user()->TrainingRequest;
        }
        return view('training.reg.index', [
            'documents' => $regDoc,
        ]);
    }
    public function viewReg($id){
        return view('training.reg.show', [
            'documents' => TrainingRequest::where('Doc_Code',$id)->firstOrFail(),
        ]);
    }
    

    public function form008($Doc_Code){
        $d008 =TrainingRequest::where('Doc_Code',$Doc_Code)->firstOrFail() ;
        $sub_d008 = json_decode($d008->Doc_008, TRUE);
        // dd($sub_d008);
        return view('training.reg.f-008', ['f008'=>$sub_d008],['D008'=>$d008]);

    }
    public function form009($Doc_Code){ 
        $d009 =TrainingRequest::where('Doc_Code',$Doc_Code)->firstOrFail() ;
        $d009 = json_decode($d009->Doc_009, TRUE);
        //  dd($d009);
        return view('training.reg.f-009', ['f009'=>$d009]);
    }

    public function createView(){
        // dd('create');
        $currentYear = date("Y");
        $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
        $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));
        
        $count = TrainingRequest::whereBetween('created_at',[$startYear,$endYear])->count();

        return view('training.reg.create',['count_train_code'=>$count,]);
    }

    public function create(request $request){
        //  dd($request);

        //  Cover Dte formate
        // $dd =$this->InputToDate($request->starttraindate);
        // dd($dd);



        // INPUT DATA IN OBJECT
        $d008 = array(
            'SUBJECT' => $request->SUBJECT,
            'starttraindate' => $this->InputToDate($request->starttraindate),
            'endtraindate' => $this->InputToDate($request->endtraindate),
            'starttraintime' => $request->starttraintime,
            'endtraintime' => $request->endtraintime,
            'Objective' => $request->Objective,
            'SubjectDetails' => $request->SubjectDetails,
            'SubjectTime' => $request->SubjectTime,
            'SubjectMaterial' => $request->SubjectMaterial,
            'SubjectRemark' => $request->SubjectRemark,
            'ActivityDetail' => $request->ActivityDetail,
            'ActivityTime' => $request->ActivityTime,
            'ActivityMaterial' => $request->ActivityMaterial,
            'ActivityRemark' => $request->ActivityRemark,
            'AssessmentDetail' => $request->AssessmentDetail,
            'AssessmentTime' => $request->AssessmentTime,
            'AssessmentMaterial' => $request->AssessmentMaterial,
            'AssessmentRemark' => $request->AssessmentRemark,
        );

        $d009 = array(
            'SUBJECT' => $request->SUBJECT,
            'checkbox' => $request->checkbox,
            '009Testing' => $request->Testing009,
            'pass' => $request->pass,
            'nopass' => $request->nopass,
        );

        //json_encode
        $d008 = json_encode($d008);
        $d009 = json_encode($d009);

        //Version File
        $file = $request->file('file');
        $docver = TrainingRequest::where('Doc_Code', $request->DocCode)->count();
        $docname = $request->DocCode;
        $NameFile = $docname . '-' . $docver;
        // dd($file);
        //Location File
        $upload_location = '/TrainPDF/';
        $full_path = $upload_location . $NameFile;

        //  dd( $full_path);
        // dd(json_encode($d008));

        //   //ตรวจสอบข้อมูล
        // $request->validate(
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

        // dd($request->DocCode);
        // dd($d008,$d009,Auth::user()->id);

        // //บันทึกข้อมูล
        $doc_train = new TrainingRequest;
        $doc_train->Doc_Code = $docname;
        $doc_train->Doc_008 = $d008;
        $doc_train->Doc_009 = $d009;
        $doc_train->user_id = Auth::user()->id;
        // $doc_train->Doc_Location = '0';
        $doc_train->Doc_Location = $full_path;
        $doc_train->Doc_Status = '0';

        // dd($request, $doc_train);

        $doc_train->save();

        return redirect()->route('regTraining.create')->with('success', 'Document added!');
        
    }


    public function approve(request $request){
        // dd($request);
        $id = $request->regID;
        $approve = $request->manage;
        $reg_doc = TrainingRequest::find($id);

        $toastType = 'success';
        $toastMsg = 'Document Approved!';
        if($approve === 'approved'){
            $reg_doc->Doc_Status = 1;
            // dd($reg_doc);
            // $documents = Training::updateOrCreate(
            //     [
            //         'Doc_Name' => $reg_doc->Doc_Name
            //     ],
            //     [
            //         'Doc_Name' => $reg_doc->Doc_Name,
            //         'Doc_Code' => $reg_doc->Doc_Code,
            //         'Doc_Type' => $reg_doc->Doc_Type,
            //         'Doc_Life' => $reg_doc->Doc_Life,
            //         'Doc_ver' => $reg_doc->Doc_ver,
            //         'Doc_DateApprove' => now()
            //     ]
            // );

            // DB::table('users')
            // ->updateOrInsert(
            //     ['email' => 'john@example.com', 'name' => 'John'],
            //     ['votes' => '2']
            // );
            
            // dd($documents);
            // $documents->save();
            echo 'approved';
        }else{
            $reg_doc->Doc_Status = -1;
            echo 'rejected';
        }
        
        $reg_doc->Doc_DateApprove = now();
        $reg_doc->User_Approve = Auth::user()->id;
        $reg_doc->save();
        // dd($reg_doc->Doc_Name);
        $message = $request->manage;
        // echo $add->manage;
        // dd($add->id);

        // dd(document_request::find($add->id));
        


        //disible mail service during test

        // Mail::send(['text'=>'mail'], array('name'=>"Virat Gandhi"), function($message) {
        //     $message->to('maggotgluon@gmail.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail');
        //     $message->from('ruttaphong.w@vananava.com','KM Service');
        //     // $message->body('test');
        //     // dd($message);
        //  });
        
        // dd(route::class,'regisManage');
        // return view('document.regis',[
        //     'documents'=>document_request::all(),
        // ]);
        // dd($message);
        return redirect()->route('training.all')->with($toastType, $toastMsg);
    }
}
