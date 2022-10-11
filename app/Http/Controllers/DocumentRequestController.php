<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentRequest;
 
use App\Models\Document;
use App\Models\User;


use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DocumentRequestController extends Controller
{
    
    private function InputToDate($Input)
    {
        $Date = new Carbon($Input);
        return date_format($Date,"d F Y");
    }

    public function all($filter=null){
        // dd($user,$filter);
        // Gate::authorize('manage_document');
        if($filter!=null){
            $documents = DocumentRequest::where('Doc_Status',$filter)->paginate(5);
        }else{
            $documents = DocumentRequest::all()->paginate(5);
        }
        return view('document.reg.index',['documents'=>$documents,'filter'=>$filter]);
    }
    public function allUser($filter=null){
        
        if($filter!=null){
            $documents = Auth::user()->DocumentRequest->where('Doc_Status',$filter);
        }else{
            $documents = Auth::user()->DocumentRequest;
        }
        return view('document.reg.indexMy',['documents'=>$documents]);
    }
    public function allMR($filter=null){
        $documents = DocumentRequest::where('Doc_Status',1)->get();
        return view('document.reg.indexMR',['documents'=>$documents]);
    }
    public function allFilter($filter ,$user=null){
        
    }
    public function view($Doc_Code){
        // dd('reg view');
        $regDoc = DocumentRequest::where('Doc_Code',$Doc_Code)->firstOrFail();   
        return view('document.reg.show',['documents'=>$regDoc]);
    }
    public function DarForm($Doc_Code){
        // dd('reg DarForm');
        $DarForm = DocumentRequest::where('Doc_Code',$Doc_Code)->firstOrFail();
        // dd(User::find(id)->DocumentRequest->where('Doc_Name','ITD-001'));



        $created_at =  $this->InputToDate($DarForm->created_at);
        $updated_at =  $this->InputToDate($DarForm->updated_at);
        $Date_Approve =  $this->InputToDate($DarForm->Doc_DateApprove);
        $DarForm->Doc_StartDate =  $this->InputToDate($DarForm->Doc_StartDate);
        $date = array(
            'Date_Approve'=>$Date_Approve,
            'created_at'=>$created_at,
            'updated_at'=>$updated_at

        );
        // dd($date);
        // $DarReq = $this->hasone(User::class,'id',$id);

        return view('document.reg.f-dar',['DarForm'=>$DarForm],['date'=>$date]
        // ,['DarReq'=>$DarReq]
        );
    }

    public function createView(){
        // dd('create');
        $currentYear = date("Y");
        $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
        $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));
        
        $count = DocumentRequest::whereBetween('created_at',[$startYear,$endYear])->count();

        return view('document.reg.create',['count_doc_code'=>$count,]);
    }
    public function create(request $request){
        //dd($request);
        //ตรวจสอบข้อมูล
        $request->validate(
            [   
                // 'Doc_Name'=>'required|max:10|unique:document_requests',
                'objective'=>'required',
                'info'=>'required',
                'usedate'=>'required',
                'Year'=>'required',
                // 'file'=>'required|mimes:pdf', //|size:10mb',
                
            ],
            [
                'Doc_Name.required' => "กรุณาป้อนชื่อเอกสาร",
                'Doc_Name.max' => "กรุณาป้อนชื่อเอกสาร 10 ตัวอักษร",
                'Doc_Name.unique' => "ชื่อเอกสารนี้ถูกใช้ไปแล้ว",
                'objective.required' => "กรุณาเลือกจุดประสงค์",
                'info.required' => "กรุณาป้อนรายละเอียด",
                // 'usedate.required' => "กรุณาป้อนรายละเอียด",
                // 'Year.required' => "กรุณาป้อนรายละเอียด",
                'file.required' => "กรุณาเลือกไฟล์",
                'file.mimes' => "กรุณาเลือกไฟล์ PDF เท่านั้น",
                'file.size' => "กรุณาเลือกไฟล์ PDF ขนาดไม่เกิน 10 MB",
                // 'file'=>'',
            ]
        );
        // generate new doccode
        
        $currentYear = date("Y");
        $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
        $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));
        
        $count = DocumentRequest::whereBetween('created_at',[$startYear,$endYear])->count();
        $DocCode = 'DAR'.date('Y').str_pad( $count+1 ,4,'0',STR_PAD_LEFT);
        // dd($code,$request->DocCode);
        //Version File
        $file = $request->file('file');
        $docver = DocumentRequest::where('Doc_Name',$request->Doc_Name)->count();
        $docname = $request->Doc_Name;
        $NameFile = $docname.'-'.$docver;

        // dd($NameFile);

        $upload_location = '/FilePDF/';
        $full_path = $upload_location.$NameFile;
        // dd($full_path);

        
        // //บันทึกข้อมูล 
        $documents = new DocumentRequest;
        $documents->Doc_Code = $DocCode;
        $documents->Doc_Name = $request->Doc_Name;
        $documents->User_id = Auth::user()->id;
        $documents->Doc_Type = $request->type;
        $documents->Doc_Obj = $request->objective;
        $documents->Doc_Description = $request->info;
        $documents->Doc_Life = $request->Year;
        // dd($request->Doc_Name);
        $documents->Doc_ver = $docver;
        $documents->Doc_StartDate = $request->usedate;
        $documents->Doc_Location = $full_path;

        $documents->Doc_Status ='0';

        // loc / upload file / rename to
        Storage::putFileAs($upload_location,$file,$docname.'-'.$docver);
        // Storage::putFileAs($upload_location,$file,doc_name.'-'.ver);

        $visibility = Storage::getVisibility($upload_location);
        // dd($visibility);


        // gettype($request);
        
        // dd( Storage::disk('local') );
        // $request->file($NameFile)->store($upload_location);

        // dd($documents);
        $documents->save();
        Log::info('user '.$documents->User_id.' Request '.$documents->Doc_Code);
        
        return redirect()->route('regDoc.create')->with('success', 'Document added!');
        // return view('document.reg.create',['users'=>Auth::user()]);
    }

    public function approve(request $request){
        // dd($request);
        $id = $request->regID;
        $approve = $request->manage;
        $reg_doc = DocumentRequest::find($id);

        $toastType = 'success';
        $toastMsg = 'Document '.$reg_doc->Doc_Name.' Approved!';
        if($approve === 'mrapproved'){
            $reg_doc->Doc_Status = '2';
            $documents = Document::updateOrCreate(
                [
                    'Doc_Name' => $reg_doc->Doc_Name
                ],
                [
                    'Doc_Name' => $reg_doc->Doc_Name,
                    'Doc_Code' => $reg_doc->Doc_Code,
                    'Doc_Type' => $reg_doc->Doc_Type,
                    'Doc_Life' => $reg_doc->Doc_Life,
                    'Doc_ver' => $reg_doc->Doc_ver,
                    'Doc_DateApprove' => now()
                ]
            );
            $documents->save();
            $toastMsg = 'MR Approved!';
        }else if($approve === 'approved'){
            $reg_doc->Doc_Status = '1';
        }else{
            $toastType = 'warning';
            // dd($request);
            $reg_doc->Remark = $request->remark;
            $toastMsg = 'Document '.$reg_doc->Doc_Name.' Reject!';
            $reg_doc->Doc_Status = '-1';
            // echo 'rejected';
        }
        $reg_doc->Doc_DateApprove = now();
        $reg_doc->User_Approve = Auth::user()->id;
        // dd($reg_doc);
        $reg_doc->save();
        // dd($reg_doc->Doc_Name);
        $message = $request->manage;
        // echo $add->manage;
        // dd($add->id);

        // dd(document_request::find($add->id));
        


        Log::info('user '.$reg_doc->User_Approve.$approve.' Request '.$reg_doc->Doc_Code);
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
        return back()->with($toastType, $toastMsg);
        return redirect()->route('regDoc.all')->with($toastType, $toastMsg);



    }

}