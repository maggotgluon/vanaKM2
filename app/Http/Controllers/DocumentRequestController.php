<?php

namespace App\Http\Controllers;

use App\Models\document as ModelsDocument;
use App\Models\document_request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use League\CommonMark\Node\Block\Document;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentRequestController extends Controller
{
    //
    public function index(){
        return view('documents.index',[
            'documents'=>document_request::all(),
        ]);
    }

    public function showReg(Request $request){
        // dd (Auth::user()->document_request);
        return view('document.regis',[
            'documents'=>Auth::user()->document_request,'message'=>$request->query
        ]);
    }

    public function show(){
        // dd(ModelsDocument::all());
        // ddd (document_request::where('Doc_Status','1')->get());
        return view('document.index',[
            'documents'=>ModelsDocument::all(),
        ]);
        return view('document.index',[
            'documents'=>document_request::where('Doc_Status','1')->get(),
        ]);
    }
    public function manage(Request $request ){
        // dd (Auth::user()->document_request);
        // $message = $request;
        // dd($request->query);
        return view('document.regis',[
            'documents'=>document_request::all(),'message'=>$request ,
        ]);
    }
    
    public function create(request $add){
        // dd($add);
        //ตรวจสอบข้อมูล
        $add->validate(
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

        //อัพโหลดไฟล์
   
        
        //Version File
        $file = $add->file('file');
        $docver = document_request::where('Doc_Name',$add->Doc_Name)->count();
        $docname = $add->Doc_Name;
        $NameFile = $docname.'-'.$docver;



        // dd($NameFile);

        $upload_location = '/FilePDF/';
        $full_path = $upload_location.$NameFile;
        // dd($full_path);


        
        // //บันทึกข้อมูล 
        $documents = new document_request;
        $documents->Doc_Code = $add->DocCode;
        $documents->Doc_Name = $add->Doc_Name;
        $documents->User_id = Auth::user()->id;
        $documents->Doc_Type = $add->type;
        $documents->Doc_Obj = $add->objective;
        $documents->Doc_Description = $add->info;
        $documents->Doc_Life = $add->Year;
        // dd($add->Doc_Name);
        $documents->Doc_ver = $docver;
        $documents->Doc_StartDate = $add->usedate;
        $documents->Doc_Location = $full_path;

        $documents->Doc_Status ='0';

        // $documents->Doc_Status ='1';

        // $documents->Doc_Timestamp = $add->date;
        // document_request::count(Doc_Name);
        //upload PDF
        // dd($documents);
        // dd( $add->file('file') );
        // dd($file->getClientOriginalName());
        // Storage:: move( $upload_location, $file);


                            // loc / upload file / rename to
        Storage::putFileAs($upload_location,$file,$docname.'-'.$docver);
        // Storage::putFileAs($upload_location,$file,doc_name.'-'.ver);

        $visibility = Storage::getVisibility($upload_location);
        // dd($visibility);


        // gettype($add);
        
        // dd( Storage::disk('local') );
        // $add->file($NameFile)->store($upload_location);

         dd($documents);
        $documents->save();
        return view('document.create',['count_doc_code'=>0]);
       
    }

    public function approve(request $add){
        $id = $add->regID;
        $approve = $add->manage;
        $reg_doc = document_request::find($id);
        if($approve === 'approved'){
            $reg_doc->Doc_Status = '1';
            // dd($reg_doc);
            $documents = ModelsDocument::updateOrCreate(
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
            $reg_doc->Doc_Status = '-1';
            echo 'rejected';
        }
        
        $reg_doc->Doc_DateApprove = now();
        $reg_doc->User_Approve = Auth::user()->id;
        $reg_doc->save();
        // dd($reg_doc->Doc_Name);
        $message = $add->manage;
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
        return redirect()->route('regisManage',['id'=>$id,'result'=>$message,'name'=>$reg_doc->Doc_Name,'code'=>$reg_doc->Doc_Code] );
    }
}
