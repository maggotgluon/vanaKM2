<?php

namespace App\Http\Livewire;

use App\Http\Controllers\DocumentRequestController;
use App\Mail\NotifyMail;
use App\Models\DocumentRequest;
use App\Models\Document;
use Livewire\Component;
use Livewire\Request;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

use Illuminate\Support\Facades\Log;

class DocumentRequestForm extends Component
{
    use WithFileUploads;
    use Actions;

    public $doc_code;
    public $doc_name;
    public $doc_type;
    public $req_obj;
    public $req_description;
    public $doc_startDate;
    public $doc_life;
    public $pdf_file;
    public $doc_file;


    protected $rules = [
        'doc_code' => 'required',
        'doc_name' => 'required',
        'doc_type' => 'required',
        'req_obj' => 'required',
        'req_description' => 'required',
        'doc_startDate' => 'required|date|after:tomorrow',
        'doc_life' => 'required',
        'pdf_file' => 'required|mimes:pdf',
        'doc_file' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.document-request-form');
    }
    public function link($req_code){

        $documentRequests = DocumentRequest::where('req_code',$req_code);
        dd($documentRequests);
        return view('documentRequest.show',[
            'documentRequest'=> $this->tranformData($documentRequests)
        ]);
    }
    public function store(){
        // validate
        $this->doc_life = $this->doc_type=='DS'?-1:$this->doc_life;
        $validatedData = $this->validate($this->rules,[
            'doc_code' => __('required'),
            'doc_name' => __('required'),
            'doc_type' => __('required'),
            'req_obj' => __('required'),
            'req_description' => __('required'),
            'doc_startDate' => __('required'),
            'doc_life' => __('required'),
            'pdf_file' => __('required'),
            'doc_file' => __('required'),
        ]);
        // storefile
        // dd($this->doc_life);
        $filename = $this->doc_code;
        $path = '/FilePDF/doc/'.$this->doc_code;
        $pdf_file_path=$this->pdf_file->storeAs($path,$filename.'.'.$this->pdf_file->getClientOriginalExtension());

        Log::channel('document')->info($pdf_file_path.' added to store by '.auth()->user()->name);

        $doc_file_path=$this->doc_file->storeAs($path,$filename.'.'.$this->doc_file->getClientOriginalExtension());

        Log::channel('document')->info($doc_file_path.' added to store by '.auth()->user()->name);

        $name = $this->doc_code.'-'. $this->doc_name;
        $doc_ver = Document::where('doc_name',$this->doc_code)->count();
        // $ver = Document::where('doc_name',$request->doc_name)->count();

        $req_code = DocumentRequestController::getNewRequestCode();


        $newDocumentRequest = new DocumentRequest();
        $newDocumentRequest->user_id = auth()->user()->id;
        $newDocumentRequest->req_code = $req_code;
        $newDocumentRequest->req_obj = $this->req_obj;
        $newDocumentRequest->req_description = $this->req_description;
        $newDocumentRequest->req_status ='0';
        $newDocumentRequest->doc_code = $this->doc_code;
        $newDocumentRequest->doc_name = $this->doc_name;
        $newDocumentRequest->doc_type = $this->doc_type;
        $newDocumentRequest->doc_startDate = new Carbon($this->doc_startDate);
        $newDocumentRequest->doc_life = $this->doc_life;
        $newDocumentRequest->doc_ver = $doc_ver;
        $newDocumentRequest->pdf_location = $pdf_file_path;
        $newDocumentRequest->doc_location = $doc_file_path;

        $save = $newDocumentRequest->save();

        if($save){
            Log::channel('document')->info($newDocumentRequest->req_code.' added by '.auth()->user()->name .' data : '.$newDocumentRequest);
            $TCC = User::where('user_level',6)->get();
            // $ACC = User::where('user_level',3)->where('department',Auth::user()->department)->get();
            // dd($TCC,$ACC);
            Mail::to($TCC)
                // ->cc($ACC)
                ->send(new NotifyMail($newDocumentRequest));
            Log::channel('email')->info('email send to '.$TCC.' data '.$newDocumentRequest);

            $this->notification()->send([
                'title'       => $req_code.' '.$name.' has been request.',
                'description' => 'Please wait for response',
                'icon'        => 'success',

            ]);
            $this->clear();
        }else{

            Log::channel('document')->error($newDocumentRequest->req_code.' added by '.auth()->user()->name .' data : '.$newDocumentRequest);
            $this->notification()->send([
                'title'       => 'Error !!!',
                'description' => 'Document request unsucessfull,please try again',
                'icon'        => 'error',
            ]);
        }

    }
    private function clear(){
        $this->doc_code="";
        $this->doc_name="";
        $this->doc_type="";
        $this->req_obj="";
        $this->req_description="";
        $this->doc_startDate="";
        $this->doc_life="";
        $this->pdf_file="";
        $this->doc_file="";
    }
}
