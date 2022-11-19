<?php

namespace App\Http\Controllers;

use App\Mail\NotifyMail;
use App\Models\DocumentRequest;
use App\Models\Document;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DocumentRequestController extends Controller
{
    //
    public function index($user=null){
        // dd($documentRequests,User::find($user),User::find($user)->DocumentRequest);
        if (Gate::allows('review_document', Auth::user()) || Gate::allows('publish_document', Auth::user())) {
            // dd(Auth::user()->DocumentRequest);
            if($user==null){
                //no user pass in
                $documentRequests = DocumentRequest::all();
            }else{
                $documentRequests = User::find($user)->DocumentRequest;
            }
        }else{
            $documentRequests = Auth::user()->DocumentRequest;
        }
        // dd($user,$documentRequests,User::find($user)->DocumentRequest);
        // dd(User::find($user)->DocumentRequest->where('req_status',request()->filter));
        if(request()->filter){
            $documentRequests = $documentRequests->where('req_status',request()->filter);
        }
        if($documentRequests->count()>0){
            $documentRequests = $documentRequests->toQuery()
                ->orderBy('updated_at', 'desc')->get();
        }

        foreach ($documentRequests as $key => $documentRequest) {
            $documentRequest = $this->tranformData($documentRequest);
        }

        // req_code
        // dd($documentRequests);
        // dd(request()->filter,$documentRequests,$documentRequests->where('req_status',request()->filter));
        return view('documentRequest.index',['user'=>$user,'documentRequests'=>$documentRequests->paginate(10)]);
    }

    public function search(Request $key){
        // dd($key->search);
        // dd($key->fullUrlWithQuery(['department'=>'department']));

        $users = DocumentRequest::where('name','like','%'.$key->search.'%')
                ->orWhere('staff_id', 'like','%'.$key->search.'%')
                ->orWhere('email', 'like','%'.$key->search.'%')
                ->orWhere('position', 'like','%'.$key->search.'%')
                ->orWhere('department', 'like','%'.$key->search.'%')
                    ->get();

        return view('user.index',['users'=>$users->paginate(15)]);
    }
    public function show($id){
        $documentRequests = DocumentRequest::find($id);

        // $this->tranformData($documentRequests);

        return view('documentRequest.show',[
            'documentRequest'=> $this->tranformData($documentRequests)
        ]);

    }
    public function showDar($id){
        $documentRequests = DocumentRequest::find($id);

        // $this->tranformData($documentRequests);

        return view('documentRequest.print_dar',[
            'documentRequest'=> $this->tranformData($documentRequests)
        ]);

    }

    public function create(){
        return view('documentRequest.create');
    }

    public static function getNewRequestCode(){

        $currentYear = date("Y");
        $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
        $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));

        $count = DocumentRequest::whereBetween('created_at',[$startYear,$endYear])->count();
        $DocCode = 'DAR'.date('Y').str_pad( $count+1 ,4,'0',STR_PAD_LEFT);

        return $DocCode;
    }

    private static function storeFile(UploadedFile $file,$request,$req_code){
        $now = new Carbon();
        dd($file->getClientOriginalExtension());
        $ext = $file->getClientOriginalExtension();

        $filename = $req_code.'-'.$request->doc_code.'-'.$request->doc_name.'-'.$request->doc_ver.'-'.$now->timestamp;

        $upload_location = '/FilePDF/'.$request->doc_type.'/'.$request->doc_code.'/';
        $full_path = $upload_location.$filename.'.'.$ext;

        Storage::putFileAs($upload_location,$file,$filename.'.'.$ext);

        Storage::getVisibility($full_path);

        return $full_path;
    }

    private function isNull($var,$fallback){
        return $var?$fallback:null;
    }
    public static function tranformData($data){
        $tranformData = $data;
        $tranformData->created_at_C = new Carbon($data->created_at);
        $tranformData->updated_at_C = new Carbon($data->created_at);
        $tranformData->doc_startDate = $data->doc_startDate?new Carbon($data->doc_startDate):null;
        $tranformData->req_dateReview = $data->req_dateReview?new Carbon($data->req_dateReview):null;
        $tranformData->req_dateApprove = $data->req_dateApprove?new Carbon($data->req_dateApprove):null;
        $tranformData->user_review_obj = $data->user_review?User::find($data->user_review):null;
        $tranformData->user_approve_obj = $data->user_approve_obj?User::find($data->user_approve):null;
        $tranformData->user_id_obj = $data->user_id_obj?User::find($data->user_id):null;
        switch ($data->req_status) {
            case '2':
                $tranformData->req_status_text = __('Approved');
                break;
            case '1':
                $tranformData->req_status_text = __('Reviewed');
                break;
            case '0':
                $tranformData->req_status_text = __('Pending');
                break;
            case '-1':
                $tranformData->req_status_text = __('Rejected');
                break;
            default:
                $tranformData->req_status_text = __('Null');
                break;
        }

        // dd($tranformData);
        return $tranformData;
    }

    public static function storeWire($request){
        // $request=$request->all();
        // dd($request['doc_code'],DocumentRequestController::getNewRequestCode());

        $name = $request['doc_code'].'-'.$request['doc_name'];
        $request['doc_ver'] = Document::where('doc_name',$request['doc_code'])->count();
        // $ver = Document::where('doc_name',$request->doc_name)->count();

        $req_code = DocumentRequestController::getNewRequestCode();

        $newDocumentRequest = new DocumentRequest();
        $newDocumentRequest->user_id = Auth::user()->id;
        $newDocumentRequest->req_code = $req_code;
        $newDocumentRequest->req_obj = $request['req_obj'];
        $newDocumentRequest->req_description = $request['req_description'];
        $newDocumentRequest->req_status ='0';
        $newDocumentRequest->doc_code = $request['doc_code'];
        $newDocumentRequest->doc_name = $request['doc_name'];
        $newDocumentRequest->doc_type = $request['doc_type'];
        $newDocumentRequest->doc_startDate = new Carbon($request['doc_startDate']);
        $newDocumentRequest->doc_life = $request['doc_life'];
        $newDocumentRequest->doc_ver = $request['doc_ver'];
        $newDocumentRequest->pdf_location = $request['pdf_file'];
        $newDocumentRequest->doc_location = $request['doc_file'];
        // $newDocumentRequest->pdf_location = $request['pdf_file']?DocumentRequestController::storeFile($request['pdf_file'],$request,$req_code):null;
        // $newDocumentRequest->doc_location = $request['doc_file']?DocumentRequestController::storeFile($request['doc_file'],$request,$req_code):null;
        // dd($newDocumentRequest);
        $newDocumentRequest->save();

        // return redirect()->route('document.request.all');
    }
    public function store(Request $request){
        // dd($request);
        dd($request['doc_code'],$this->getNewRequestCode());
        $request->validate([
            'doc_code'=> 'required',
            'doc_name'=> 'required',
            'doc_type'=> 'required',
            'req_obj'=> 'required',
            'req_description'=> 'required',
            'doc_startDate'=> 'required',
            'doc_life'=> 'required',
            // 'pdf_file'=> 'required',
            // 'doc_file'=> 'required'
        ],[
            'doc_code'=> 'required',
            'doc_name'=> 'required',
            'doc_type'=> 'required',
            'req_obj'=> 'required',
            'req_description'=> 'required',
            'doc_startDate'=> 'required',
            'doc_life'=> 'required',
            // 'pdf_file'=> 'required',
            // 'doc_file'=> 'required'
        ]);
        $name = $request->doc_code.'-'.$request->doc_name;
        $request->doc_ver = Document::where('doc_name',$request->doc_name)->count();
        // $ver = Document::where('doc_name',$request->doc_name)->count();

        $req_code = $this->getNewRequestCode();

        $newDocumentRequest = new DocumentRequest();
        $newDocumentRequest->user_id = Auth::user()->id;
        $newDocumentRequest->req_code = $req_code;
        $newDocumentRequest->req_obj = $request->req_obj;
        $newDocumentRequest->req_description = $request->req_description;
        $newDocumentRequest->req_status ='0';
        $newDocumentRequest->doc_code = $request->doc_code;
        $newDocumentRequest->doc_name = $request->doc_name;
        $newDocumentRequest->doc_type = $request->doc_type;
        $newDocumentRequest->doc_startDate = new Carbon($request->doc_startDate);
        $newDocumentRequest->doc_life = $request->doc_life;
        $newDocumentRequest->doc_ver = $request->doc_ver;
        $newDocumentRequest->pdf_location = $request->file('pdf_file')?$this->storeFile($request->pdf_file,$request,$req_code):null;
        $newDocumentRequest->doc_location = $request->file('doc_file')?$this->storeFile($request->doc_file,$request,$req_code):null;
        $newDocumentRequest->save();
        // dd($newDocumentRequest);

        Mail::to('ruttaphong.w@vananava.com')->send(new NotifyMail($newDocumentRequest));

        return redirect()->route('document.request.all');
    }
    public function updateStatus(Request $request){
        // dd($request);
        $documentRequest = DocumentRequest::find($request->id);
        $documentRequest->req_status = $request->status;
        $documentRequest->req_remark = $request->remark;
        $now = new Carbon();
        switch ($request->status) {
            case '1':
                $documentRequest->req_dateReview = $now;
                $documentRequest->user_review = Auth::user()->id;
                break;
            case '2':
                $documentRequest->req_dateApprove = $now;
                $documentRequest->user_approve = Auth::user()->id;

                $newDocument = new Document();

                $newDocument->req_code=$documentRequest->req_code;
                $newDocument->req_id=$documentRequest->id;
                $newDocument->doc_code=$documentRequest->doc_code;
                $newDocument->doc_name=$documentRequest->doc_name;
                $newDocument->doc_type=$documentRequest->doc_type;
                $newDocument->doc_startDate=$documentRequest->doc_startDate;
                $newDocument->doc_life=$documentRequest->doc_life;
                $newDocument->doc_ver=Document::where('doc_code',$documentRequest->doc_code)->count(); // find new ver
                $newDocument->doc_dateApprove=$now->toDateTimeString();

                // dd($newDocument);
                $location= '/FilePDF/master/'.$documentRequest->doc_type.'/'.$documentRequest->doc_code.'/';
                $filename = $documentRequest->req_code.'-'.$documentRequest->doc_code.'-'.$documentRequest->doc_name.'-'.$newDocument->doc_ver.'.pdf';
                $newPath = $location.$filename;

                // dd(Storage::allFiles($location));
                foreach (Storage::allFiles($location) as $key => $file) {
                    // $oldFiles = collect();
                    // // $oldFiles->oldLocation = $file;
                    // $oldFiles->newLocation = $location.'achived/'.Str::afterLast($file,'/');

                    Document::where('pdf_location','/'.$file)
                        ->update(['pdf_location' => $location.'achived/'.Str::afterLast($file,'/')]);

                    // $record->pdf_location = $location.'achived/'.Str::afterLast($file,'/');
                    Storage::move($file, $location.'achived/'.Str::afterLast($file,'/'));
                    // $record->save();
                    // dd($file,$location,$filename);
                }
                // dd($documentRequest->pdf_location);
                Storage::copy($documentRequest->pdf_location,$newPath);
                // dd($old,$oldFiles);
                // dd(Storage::allFiles($location),$documentRequest->pdf_location);


                $newDocument->pdf_location=$newPath;
                $newDocument->save();


                $TCC = User::find($documentRequest->staff_id);
                $ACC = User::where('user_level',3)->where('department',Auth::user()->department)->get();
                // dd($TCC,$ACC);
                Mail::to($TCC)
                    ->cc($ACC)
                    ->send(new NotifyMail($documentRequest));
                break;
            case '-1':
                // dd($request->remark);
                $TCC = User::find($documentRequest->staff_id);
                $ACC = User::where('user_level',3)->where('department',Auth::user()->department)->get();
                // dd($TCC,$ACC);
                Mail::to($TCC)
                    ->cc($ACC)
                    ->send(new NotifyMail($documentRequest));
                $documentRequest->req_dateReview = $now;
                $documentRequest->req_remark = $request->remark;
                break;
            default:
                dd(Auth::user());
                break;
        }

        $documentRequest->save();
        return redirect()->route('document.request.all');
    }
    public function update(){}
    public function download($id){
        $request = DocumentRequest::find($id);
        if(Str::afterLast(request()->file,'.')!=='pdf'){
            $requestFile = $request->doc_location;
        }else{
            $requestFile = $request->pdf_location;
        }
        // dd($id,$request,$requestFile,Storage::download($requestFile ));
        return Storage::download($requestFile );
    }
    public function dar(){}
}
