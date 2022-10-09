<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentRequest;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentRequestController extends Controller
{
    //
    public function all($user=null){
        
        $docPending = DocumentRequest::where('Doc_Status',0)->paginate(15);
        $docAccepted = DocumentRequest::where('Doc_Status',1)->paginate(15);
        $docReject = DocumentRequest::where('Doc_Status',-1)->paginate(15);

        if($user==null){
            $regDoc = DocumentRequest::paginate(15);
        }else{
            $regDoc = Auth::user()->DocumentRequest;
        }
        return view('document.reg.index',['documents'=>$regDoc,'docPending'=>$docPending,'docAccepted'=>$docAccepted,'docReject'=>$docReject]);
    }
    public function view($Doc_Code){
        // dd('reg view');
        $regDoc = DocumentRequest::where('Doc_Code',$Doc_Code)->firstOrFail();   
        return view('document.reg.show',['documents'=>$regDoc]);
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
        // dd('create');
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
        $currentYear = date("Y");
        $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
        $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));
        
        $count = DocumentRequest::whereBetween('created_at',[$startYear,$endYear])->count();

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
        $documents->Doc_Code = $count;
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
        if($approve === 'approved'){
            $reg_doc->Doc_Status = '1';
            // dd($reg_doc);
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

            // DB::table('users')
            // ->updateOrInsert(
            //     ['email' => 'john@example.com', 'name' => 'John'],
            //     ['votes' => '2']
            // );
            
            // dd($documents);
            $documents->save();
            echo 'approved';
        }else{
            $toastType = 'warning';
            $toastMsg = 'Document '.$reg_doc->Doc_Name.' Rejected!';
            $reg_doc->Doc_Status = '-1';
            // echo 'rejected';
        }
        
        $reg_doc->Doc_DateApprove = now();
        $reg_doc->User_Approve = Auth::user()->id;
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
        return redirect()->route('regDoc.all')->with($toastType, $toastMsg);
    }
}
