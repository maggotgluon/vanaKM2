<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\DocumentRequest;

class DocumentController extends Controller
{
    // 
    public function all(){
        // dd('doc all');
        
        return view('document.index',['documents'=>Document::all()]);
    }
    public function view($Doc_Code){
        $doc = Document::where('Doc_Code',$Doc_Code)->firstOrFail();  
        $dar = DocumentRequest::where('Doc_Code',$Doc_Code)->firstOrFail();   
        // $dar = $doc->Document()->where('Doc_Code',$Doc_Code)->get();
        // dd($Doc_Code,$doc,$dar);

        return view('document.show',['documents'=>$doc,'dar'=>$dar]);
    }
    public function create(){
        // dd('doc create');
        return view('document.reg.create',['users'=>Auth::user()]);
    }
}
