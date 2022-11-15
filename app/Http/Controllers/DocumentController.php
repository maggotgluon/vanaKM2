<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Document;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Carbon;
class DocumentController extends Controller
{
    //
    public function index($user=null){
        $now = new Carbon();

        $documentRequests = Document::where('doc_startDate','<=',$now->toDateString())->get();
        $documentRequests = Document::all();
        if($documentRequests->count()>0){

            $documentRequests = $documentRequests->toQuery()
                                    ->orderBy('updated_at', 'desc')->get()
                                ->unique('doc_code');
            if(request()->filter){
                $documentRequests = $documentRequests->where('req_status',request()->filter);
            }
        }
        return view('document.index',['user'=>$user,'documents'=>$documentRequests->paginate(9)]);
    }

    private function tranformData($data){
        $tranformData = $data;
        $tranformData->created_at = new Carbon($data->created_at);
        $tranformData->doc_startDate = $data->doc_startDate?new Carbon($data->doc_startDate):null;
        $tranformData->req_dateReview = $data->req_dateReview?new Carbon($data->req_dateReview):null;
        $tranformData->req_dateApprove = $data->req_dateApprove?new Carbon($data->req_dateApprove):null;
        $tranformData->user_review = $data->user_review?User::find($data->user_review):null;
        $tranformData->user_approve =  $data->user_approve?User::find($data->user_approve):null;
        $tranformData->user_id =  $data->user_id?User::find($data->user_id):null;
        switch ($data->req_status) {
            case '2':
                $tranformData->req_status_text = 'Approved';
                break;
            case '1':
                $tranformData->req_status_text = 'Reviewed';
                break;
            case '0':
                $tranformData->req_status_text = 'Pedding';
                break;
            case '-1':
                $tranformData->req_status_text = 'Rejected';
                break;
            default:
                $tranformData->req_status_text = 'Null';
                break;
        }

        // dd($tranformData);
        return $tranformData;
    }
    public function show($id){
        $documentRequests = Document::find($id);

        // $this->tranformData($documentRequests);

        return view('document.show',[
            'documentRequest'=> $this->tranformData($documentRequests)
        ]);

    }


    public function download($id){
        $request = Document::find($id);
        $requestFile = $request->pdf_location;
        return Storage::download($requestFile );
    }
}
