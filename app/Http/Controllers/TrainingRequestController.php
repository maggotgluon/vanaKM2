<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingRequest;
use App\Models\training;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use DragonCode\Support\Facades\Helpers\Arr;

class TrainingRequestController extends Controller
{
    private function InputToDate($Input)
    {
        if($Input!=null) {
            $Date = new Carbon($Input);
            $Date = date_format($Date,"d F Y");
            }
            else
             $Date = "";
            return  $Date;
    }
    //
    public function all(){
        // dd(Training::all());
        return view('training.index', [
            'documents' => TrainingRequest::where('Doc_Status',2)->get(),
        ]);
    }
    public function view($id){
        // dd($id);
        return view('training.show', [
            'documents' => TrainingRequest::where('Doc_Code',$id)->firstOrFail(),
        ]);
    }

      //
    public function allReg($filter=null){

        if($filter!=null){
            $regDoc = TrainingRequest::where('Doc_Status',$filter)->paginate(5);
        }else{
            $regDoc = TrainingRequest::all()->paginate(5);
        }

        return view('training.reg.index', ['documents' => $regDoc,'filter'=>$filter]);
    }
    public function allRegUser($filter=null){

        if($filter!=null){
            $regDoc = Auth::user()->TrainingRequest->where('Doc_Status',$filter);
        }else{
            $regDoc = Auth::user()->TrainingRequest;
        }
        return view('training.reg.indexMy', ['documents' => $regDoc,'filter'=>$filter]);

    }
    public function viewReg($id){
        return view('training.reg.show', [
            'documents' => TrainingRequest::where('Doc_Code',$id)->firstOrFail(),
        ]);
    }


    public function form008($Doc_Code){
        $d008 =TrainingRequest::where('Doc_Code',$Doc_Code)->firstOrFail() ;
        $sub_d008 = json_decode($d008->Doc_008, TRUE);
        $Doc_DateApprove =  $this->InputToDate($d008->Doc_DateApprove);
        $Doc_DateReview =  $this->InputToDate($d008->Doc_DateReview);
        $created_at =  $this->InputToDate($d008->created_at);
// dd( $Doc_DateReview );
    
     
            $user=User::find($d008->user_id);
            $Position_Approve=User::where('name',$d008->User_Approve)->firstOrFail();
            $Position_Review=User::where('name',$d008->User_Review)->firstOrFail();
            

        $positions = array (
            'user_position'=>$user->position,
            'Approve_position'=>$Position_Approve->position,
            'Review_position'=> $Position_Review->position
        );
        // dd($Position_Approve);
        return view('training.reg.f-008', ['f008'=>$sub_d008],['created_at'=>$created_at,'Doc_DateReview'=>$Doc_DateReview,'Doc_DateApprove'=>$Doc_DateApprove,'D008'=>$d008,'user'=>$user,'positions'=>$positions]);

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
            // 'SubjectMaterial' => $request->SubjectMaterial,
            // 'SubjectRemark' => $request->SubjectRemark,
            'ActivityDetails' => $request->ActivityDetails,
            'ActivityTime' => $request->ActivityTime,
            // 'ActivityMaterial' => $request->ActivityMaterial,
            // 'ActivityRemark' => $request->ActivityRemark,
            'AssessmentDetails' => $request->AssessmentDetails,
            'AssessmentTime' => $request->AssessmentTime,
            // 'AssessmentMaterial' => $request->AssessmentMaterial,
            'Remark008' => $request->Remark008,
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

        $currentYear = date("Y");
        $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
        $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));

        $countID = TrainingRequest::whereBetween('created_at',[$startYear,$endYear])->count();
        // $docID = 'TRAIN'. date('Y').str_pad($countID+1,4,'0',STR_PAD_LEFT);
        // dd($docID,$request->DocCode);
        //Version File
        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();

        $docver = TrainingRequest::where('Doc_Code', $request->DocCode)->count();

        $timestamp = Carbon::now()->getTimestamp();
        $docname = 'TRAIN'. date('Y').str_pad($countID+1,4,'0',STR_PAD_LEFT);
        $NameFile = $docname . '-' . $docver.'-'.$timestamp.'.'.$extension;
        // dd($file);
        //Location File
        $upload_location = '/TrainPDF/'.$docname.'/';
        $full_path = $upload_location . $NameFile;

        //  dd( $full_path);
        // dd(json_encode($d008));

          //ตรวจสอบข้อมูล
        $request->validate(
            [
                'SUBJECT'=>'required',
                'starttraindate'=>'required',
                'endtraindate'=>'required',
                'starttraintime'=>'required',
                'endtraintime'=>'required',
                'Objective'=>'required',
                'SubjectDetails'=>'required',
                'SubjectTime'=>'required',
                // 'SubjectMaterial'=>'required',
                'ActivityDetails'=>'required',
                'ActivityTime'=>'required',
                // 'ActivityMaterial'=>'required',
               'AssessmentDetails'=>'required',
               'AssessmentTime'=>'required',
                // 'AssessmentMaterial'=>'required',
                'checkbox'=> 'required',
                'Testing009'=>'required',
                'pass'=>'required',
                'nopass'=>'required',
                'file'=>'required'

                // 'info'=>'required',
                // // 'usedate'=>'required',
                // // 'Year'=>'required',
                // 'file'=>'required|mimes:pdf|size:10mb',

            ],
            [

                'SUBJECT.required' => "กรุณาป้อนชื่อเอกสาร",
                'starttraindate.required' => "กรุณาป้อนข้อมูล",
                'endtraindate.required' => "กรุณาป้อนข้อมูล",
                'starttraintime.required' => "กรุณาป้อนข้อมูล",
                'endtraintime.required' => "กรุณาป้อนข้อมูล",
                'Objective.required' => "กรุณาป้อนข้อมูล",
                'SubjectDetails.required' => "กรุณาป้อนข้อมูล",
                'SubjectTime.required'=>"กรุณาป้อนข้อมูล",
                // 'SubjectMaterial.required'=>"กรุณาป้อนข้อมูล",
                'ActivityDetails.required'=>"กรุณาป้อนข้อมูล",
                'ActivityTime.required'=>"กรุณาป้อนข้อมูล",
                // 'ActivityMaterial.required'=>"กรุณาป้อนข้อมูล",
                'AssessmentDetails.required'=>"กรุณาป้อนข้อมูล",
                'AssessmentTime.required'=>"กรุณาป้อนข้อมูล",
                // 'AssessmentMaterial.required'=>"กรุณาป้อนข้อมูล",
                'Testing009.required'=>"กรุณาป้อนข้อมูล",
                'pass.required'=>"กรุณาป้อนข้อมูล",
                'nopass.required'=>"กรุณาป้อนข้อมูล",
                // 'file.required'=>"กรุณาป้อนข้อมูล",
                // 'file.mimes' => "กรุณาเลือกไฟล์ PDF เท่านั้น",
                // 'file.size' => "กรุณาเลือกไฟล์ PDF ขนาดไม่เกิน 10 MB",
                'checkbox.required'=>"กรุณาเลือกอย่างน้อยหนึ่งข้อ",

            ]
        );

        // // loc / upload file / rename to
        // dd($upload_location,$file,$docname,$docver);
        Storage::putFileAs($upload_location, $file, $NameFile);
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



        $doc_train->save();
        Log::channel('training')->info( $doc_train->Doc_Code . 'requested by user '. User::find($doc_train->user_id)->name);

        return redirect()->route('regTraining.create')->with('success', 'Document added!');

    }


    public function approve(request $request){
        // dd($request);
        $id = $request->regID;
        $approve = $request->manage;
        $reg_doc = TrainingRequest::find($id);

        $toastType = 'success';
        $toastMsg = 'Training Approved!';
        if($approve === 'approved'){
            $reg_doc->Doc_Status = 2;
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

            $reg_doc->Doc_DateApprove = now();
            $reg_doc->User_Approve = Auth::user()->id;
            echo 'approved';
        }else if($approve === 'review'){
            $toastMsg = 'Training Review!';

            $reg_doc->Doc_DateReview = now();
            $reg_doc->User_Review = Auth::user()->id;
            $reg_doc->Doc_Status = 1;
        }else{
            $reg_doc->Doc_DateReview = now();
            $reg_doc->User_Review = Auth::user()->id;

            $reg_doc->Doc_Status = -1;
            $reg_doc->Remark = $request->remark;

            $toastMsg = 'Training rejected!';
            echo 'rejected';
        }

        $reg_doc->save();
        // dd($reg_doc->Doc_Name);
        $message = $request->manage;
        // echo $add->manage;
        // dd($add->id);

        // dd(document_request::find($add->id));

        Log::channel('training')->info($reg_doc->Doc_Code.' '.$approve . ' by '. Auth::user()->name);

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
        return redirect()->route('regTraining.all')->with($toastType, $toastMsg);
    }
}
