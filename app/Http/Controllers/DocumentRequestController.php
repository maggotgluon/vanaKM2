<?php

namespace App\Http\Controllers;

use App\Models\document_request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;

use Illuminate\Support\Facades\Storage;


class DocumentRequestController extends Controller
{
    //
    public function index(){
        return view('documents.index',[
            'documents'=>document_request::all(),
        ]);
    }

    public function show(){
        dd('show');
        return view('welcome');
        // dd ($documents);
        // dd(document_request::where('User_Code',$documents));
        
        // return view('documents.show',[
        //     'document' => document_request::find($documents['id'])
        // ]);
    }
    
    public function create(request $add){
        // dd($add);
        //ตรวจสอบข้อมูล
        $add->validate(
            [
                'file'=>'required'
            ],
            [
                'file'=>'กรุณาเลือกไฟล์ PDF'
            ]
        );

        //อัพโหลดไฟล์
        // $name = $add->file('file');
        // $path = $add->file('file')->create('public/files');
        
        // $save = new File;
        // $save->name = $name;
        // $save->path = $path;


        $NameFile = $add->file('file')->getClientOriginalName();
        // dd($NameFile);

        $upload_location = '/image/FilePDF/';
        $full_path = $upload_location.$NameFile;
        // dd($full_path);

        
        // //บันทึกข้อมูล 
        $documents = new document_request;
        $documents->Doc_Code = $add->DocCode;
        $documents->Doc_Name = $add->Doc_Name;
        $documents->User_Code = Auth::user()->id;
        $documents->Doc_Type = $add->type;
        $documents->Doc_Obj = $add->objective;
        $documents->Doc_Description = $add->info;
        $documents->Doc_Life = $add->Year;
        // dd($add->Doc_Name);
        $documents->Doc_ver = document_request::where('Doc_Name',$add->Doc_Name)->count();
        // document_request::count(Doc_Name);
        // $documents->Doc_Timestamp = $add->date;
        $documents->Doc_StartDate = $add->usedate;
        $documents->Doc_Location = $full_path;
        $documents->Doc_Status ='1';
        // //upload PDF
        // dd($documents);
        // dd( $add->file('file') );
        $file = $add->file('file');
        // dd($file->getClientOriginalName());
        // Storage:: move( $upload_location, $file);


                            // loc / upload file / rename to
        Storage::putFileAs($upload_location,$file,$file->getClientOriginalName());
        // Storage::putFileAs($upload_location,$file,doc_name.'-'.ver);

        $visibility = Storage::getVisibility($upload_location);
        // dd($visibility);


        // gettype($add);
        
        // dd( Storage::disk('local') );
        // $add->file($NameFile)->store($upload_location);

        //  dd($documents);
        $documents->save();
       
    }
}
