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

use Illuminate\Support\Facades\Mail;
// use Mail;
use App\Mail\NotifyMail;

class DocumentRequestController extends Controller
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

    public function processDocumensRequest($documents){
        foreach ($documents as $index => $document) {
            # code...
            // dd($document);
            if($document->Doc_DateApprove!=null){
                $Doc_DateApprove = new Carbon($document->Doc_DateApprove);
                $document->Doc_DateApproveT = $Doc_DateApprove->diffForHumans();
            }
            if($document->Doc_DateMRApprove!=null){
                $Doc_DateMRApprove = new Carbon($document->Doc_DateMRApprove);
                $document->Doc_DateMRApproveT = $Doc_DateMRApprove->diffForHumans();
            }


            $Doc_StartDate = new Carbon($document->Doc_StartDate);
            $document->Doc_StartDateT = $Doc_StartDate->diffForHumans();
            $created_at = new Carbon($document->created_at);
            $document->created_atT = $created_at->diffForHumans();
            $updated_at = new Carbon($document->updated_at);
            $document->updated_atT = $updated_at->diffForHumans();

            $document->User_Approve = $document->User_Approve==null?null:User::find($document->User_Approve);
            $document->User_MRApprove = $document->User_MRApprove==null?null:User::find($document->User_MRApprove);
        }
        return $documents;

    }
    public function processDocumen($document){
            # code...
        // dd($document);
        if($document->Doc_DateApprove!=null){
            $Doc_DateApprove = new Carbon($document->Doc_DateApprove);
            $document->Doc_DateApproveT = $Doc_DateApprove->diffForHumans();
        }
        if($document->Doc_DateMRApprove!=null){
            $Doc_DateMRApprove = new Carbon($document->Doc_DateMRApprove);
            $document->Doc_DateMRApproveT = $Doc_DateMRApprove->diffForHumans();
        }


        $Doc_StartDate = new Carbon($document->Doc_StartDate);
        $document->Doc_StartDateT = $Doc_StartDate->diffForHumans();
        $created_at = new Carbon($document->created_at);
        $document->created_atT = $created_at->diffForHumans();
        $updated_at = new Carbon($document->updated_at);
        $document->updated_atT = $updated_at->diffForHumans();

        $document->user_id = $document->user_id==null?null:User::find($document->user_id);
        $document->User_Approve = $document->User_Approve==null?null:User::find($document->User_Approve);
        $document->User_MRApprove = $document->User_MRApprove==null?null:User::find($document->User_MRApprove);

        return $document;

    }

    public function all($filter=0){
        // dd($filter);
        // Gate::authorize('manage_document');
        if($filter!=null){
            $documents = DocumentRequest::where('Doc_Status',$filter)->get();
            // dd($documents->count());
        }else{
            $documents = DocumentRequest::all();
        }
        $pdocuments = $this->processDocumensRequest($documents);
        // dd($pdocuments);
        return view('document.reg.index',['documents'=>$pdocuments,'filter'=>$filter]);
    }
    public function allUser($filter=null){

        if($filter!=null){
            $documents = Auth::user()->DocumentRequest->where('Doc_Status',$filter);
        }else{
            $documents = Auth::user()->DocumentRequest;
        }
        $pdocuments = $this->processDocumensRequest($documents);
        return view('document.reg.indexMy',['documents'=>$pdocuments]);
    }
    public function allMR($filter=null){
        $documents = DocumentRequest::where('Doc_Status',1)->get();
        $pdocuments = $this->processDocumensRequest($documents);
        return view('document.reg.indexMR',['documents'=>$pdocuments]);
    }
    public function allFilter($filter ,$user=null){

    }
    public function view($Doc_Code){
        // dd('reg view');
        $regDoc = DocumentRequest::where('Doc_Code',$Doc_Code)->firstOrFail();

        // $regDoc->user_id= User::find($regDoc->user_id);
        // dd($regDoc);
        $pdocuments = $this->processDocumen($regDoc);

        return view('document.reg.show',['documents'=>$pdocuments]);
    }
    public function DarForm($Doc_Code){
        // dd('reg DarForm');
        $DarForm = DocumentRequest::where('Doc_Code',$Doc_Code)->firstOrFail();
        // dd(User::find(id)->DocumentRequest->where('Doc_Name','ITD-001'));



        $created_at =  $this->InputToDate($DarForm->created_at);
        $updated_at =  $this->InputToDate($DarForm->updated_at);
        $Doc_DateApprove =  $this->InputToDate($DarForm->Doc_DateApprove);
        $Doc_DateMRApprove =  $this->InputToDate($DarForm->Doc_DateMRApprove);
        // dd($Doc_DateMRApprove);
        $DarForm->Doc_StartDate =  $this->InputToDate($DarForm->Doc_StartDate);
        $date = array(

            'created_at'=>$created_at,
            'updated_at'=>$updated_at,
            'Doc_DateMRApprove'=>$Doc_DateMRApprove,
            'Doc_DateApprove'=>$Doc_DateApprove

        );
        // dd($date);
        $user=User::find($DarForm->user_id);
        // dd($user);
        // dd($date);
        // $DarReq = $this->hasone(User::class,'id',$id);

        return view('document.reg.p-dar',['DarForm'=>$DarForm],['date'=>$date,'user'=>$user]
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
        $extension = $file->getClientOriginalExtension();


        $docver = Document::where('Doc_Name',$request->Doc_Name)->count();
        $docname = $request->Doc_Name;
        $timestamp = Carbon::now()->getTimestamp();
        $NameFile = $DocCode.'-'.$docname.'-'.$docver.'.'.$extension;

        $fileRAW = $request->file('fileRAW');
        $extensionRAW = $file->getClientOriginalExtension();
        $NameFileRAW = $DocCode.'-'.$docname.'-'.$docver.'.'.$extensionRAW;
        // dd(Carbon::now()->locale('th_TH')->toDateString());
        // dd($NameFile);

        $upload_location = '/FilePDF/'.$docname.'/';
        $full_path = $upload_location.$NameFile;
        // dd($full_path);


        // //บันทึกข้อมูล
        $documents = new DocumentRequest;
        $documents->Doc_Code = $DocCode;
        $documents->Doc_Name = $request->Doc_Name;
        $documents->Doc_FullName = $request->Doc_FullName;
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
        Storage::putFileAs($upload_location,$file,$NameFile);
        Storage::putFileAs($upload_location,$fileRAW,$NameFileRAW);
        // Storage::putFileAs($upload_location,$file,doc_name.'-'.ver);

        $visibility = Storage::getVisibility($upload_location);
        // dd($visibility);


        // gettype($request);

        // dd( Storage::disk('local') );
        // $request->file($NameFile)->store($upload_location);

        // dd($documents);
        $documents->save();

        $details = [
            'title'=>$DocCode.'has been request',
            'body'=>'please visit KM system form more infomation'
        ];
        // Mail::to('ruttaphong.w@vananava.com')->send(new NotifyMail($details));

        Log::channel('document')->info($documents->Doc_Code .' Create Request by '. User::find($documents->User_id)->name);

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

            // $files = Storage::get($reg_doc->Doc_Location);
            $ver = Document::where('Doc_Name',$reg_doc->Doc_Name)->count()!=0?Document::where('Doc_Name',$reg_doc->Doc_Name)->firstOrFail()->Doc_ver+1:0;
            $newPath = '/FilePDF/master/'.$reg_doc->Doc_Name.'-rev-'.$ver.'.pdf';

            // dd($ver);
            // dd($reg_doc->Doc_StartDate);

            $documents = Document::updateOrCreate(
                [
                    'Doc_Name' => $reg_doc->Doc_Name
                ],
                [
                    'Doc_Name' => $reg_doc->Doc_Name,
                    'Doc_Code' => $reg_doc->Doc_Code,
                    'Doc_Type' => $reg_doc->Doc_Type,
                    'Doc_Life' => $reg_doc->Doc_Life,
                    'Doc_StartDate' => $reg_doc->Doc_StartDate,
                    'Doc_ver' => $ver,
                    'Doc_Location' => $newPath,
                    'Doc_DateApprove' => now()
                ]
            );
            // $documents->Doc_Location = 'public/'.$reg_doc->Doc_Name.'.pdf';
            Storage::copy($reg_doc->Doc_Location, $newPath);
            $size = Storage::size($newPath);
            // dd($size);
            $documents->save();
            $reg_doc->Doc_DateMRApprove = now();
            $reg_doc->User_MRApprove = Auth::user()->id;
            $toastMsg = 'MR Approved!';
        }else if($approve === 'approved'){
            $reg_doc->Doc_Status = '1';
            $reg_doc->Doc_DateApprove = now();
            $reg_doc->User_Approve = Auth::user()->id;
        }else{
            $toastType = 'warning';
            $reg_doc->User_Approve = Auth::user()->id;
            // dd($request);
            $reg_doc->Remark = $request->remark;
            $toastMsg = 'Document '.$reg_doc->Doc_Name.' Reject!';
            $reg_doc->Doc_Status = '-1';
            // echo 'rejected';
        }
        // dd($reg_doc);
        $reg_doc->save();
        // dd($reg_doc->Doc_Name);
        $message = $request->manage;
        // echo $add->manage;
        // dd($add->id);
        $details = [
            'title'=>'test email',
            'body'=>'infomation'
        ];
        // Mail::to('ruttaphong.w@vananava.com')->send(new NotifyMail($details));

        // dd($details);



        Log::channel('document')->info($reg_doc->Doc_Code.' update '.$approve.' by '.User::find($reg_doc->User_Approve)->name.' '.$reg_doc->Remark);
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
