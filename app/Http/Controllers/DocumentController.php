<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\DocumentRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    //
    public function all(){
        $doc = Document::all();
        $now = new Carbon();
        $date2 = Carbon::create(2018, 1, 4, 4, 0, 0);
        // dd($now->diffForHumans());
        $now = $now::now()->toDateString();
        $doc = Document::where('Doc_StartDate','<=',$now)->get();
        return view('document.index',['documents'=>$doc]);
    }
    public function view($Doc_Code){
        $doc = Document::where('Doc_Code',$Doc_Code)->firstOrFail();
        $dar = DocumentRequest::where('Doc_Code',$Doc_Code)->firstOrFail();
        // $dar = $doc->Document()->where('Doc_Code',$Doc_Code)->get();
        $file = Storage::get($doc->Doc_Location);
        $visibility = Storage::getVisibility($doc->Doc_Location);
        $lastModified = Storage::lastModified($doc->Doc_Location);
        // dd($doc->Doc_Location,$visibility, $lastModified);

        return view('document.show',['documents'=>$doc,'dar'=>$dar,'file'=>$file ]);
    }
    public function create(){
        // dd('doc create');
        return view('document.reg.create',['users'=>Auth::user()]);
    }
}
