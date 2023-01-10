<?php

namespace App\Http\Controllers;

use App\Models\TrainingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMailTraining;
use Illuminate\Support\Facades\Log;

class TrainingRequestController extends Controller
{
    //
    public function index($user=null){
        if (Gate::allows('review_trainDocument', Auth::user()) || Gate::allows('publish_trainDocument', Auth::user())) {
            if($user==null){
                //no user pass in
                $trainings = TrainingRequest::all();
            }else{
                $trainings = User::find($user)->DocumentRequest;
            }
            // dd($trainings);
        }else{
            $trainings = Auth::user()->TrainingRequest;
            // dd(Auth::user()->DocumentRequest);
        }

        if(request()->filter){
            $trainings = $trainings->where('training_status',request()->filter);
        }
        if($trainings->count()>0){
            $trainings = $trainings->toQuery()
                ->orderBy('updated_at', 'desc')->get();
        }


        foreach ($trainings as $key => $training) {
            $training = $this->tranformData($training);
        }

        return view('trainingRequest.index',['trainings'=>$trainings->paginate(10)]);

    }
    public function create(){
        return view('trainingRequest.create');
    }
    public function store(Request $request ){
        // dd($request);
        $LDS008 = array(
            'subject' => $request->subject,
            'train_dateStart' => $request->dateStart,
            'train_dateEnd' => $request->dateEnd,
            'train_timeStart' => $request->timeStart,
            'train_timeEnd' => $request->timeEnd,
            'train_objective' => $request->objective,
            'train_subjectDetails' => $request->subjectDetails_discription,
            'train_subjectDuration' => $request->subjectDetails_duration,
            // 'SubjectMaterial' => $request->SubjectMaterial,
            // 'SubjectRemark' => $request->SubjectRemark,
            'train_activityDetails' => $request->activity_discription,
            'train_activityDuration' => $request->activity_duration,
            // 'ActivityMaterial' => $request->ActivityMaterial,
            // 'ActivityRemark' => $request->ActivityRemark,
            'train_assessmentDetails' => $request->assessment_discription,
            'train_assessmentDuration' => $request->assessment_duration,
            // 'AssessmentMaterial' => $request->AssessmentMaterial,
            'train_remark' => $request->remark,

        );
        $LDS009 = array(
            'subject' => $request->subject,
            'assessment_process' => $request->assessmentProcess,
            'assessment_tools' => $request->assessmentTools,
            'assessment_pass' => $request->assessmentCriteriament_pass,
            'assessment_fail' => $request->assessmentCriteriament_fail,
        );

        $LDS008 = json_encode($LDS008);
        $LDS009 = json_encode($LDS009);

        $name = $request->doc_code.'-'.$request->doc_name;
        // $request->doc_ver = TrainingRequest::where('doc_name',$request->doc_name)->count();
        // $ver = Document::where('doc_name',$request->doc_name)->count();

        $req_code = $this->getNewRequestCode();

        $newTrainingRequest = new TrainingRequest();

        $newTrainingRequest->training_code = $req_code;
        $newTrainingRequest->insructor = $request->insructor;
        $newTrainingRequest->training_008 = $LDS008;
        $newTrainingRequest->training_009 = $LDS009;
        // $newTrainingRequest->training_dateApprove =
        // $newTrainingRequest->user_approve =
        // $newTrainingRequest->training_dateReview =
        // $newTrainingRequest->user_review =
        // $newTrainingRequest->access_lv =

        $newTrainingRequest->pdf_location = $request->file('pdf_file')?$this->storeFile($request->pdf_file,$request,$req_code):null;
        $newTrainingRequest->training_status = 0;
        $newTrainingRequest->user_id = Auth::user()->id;
        // $newTrainingRequest->remark = ;
        // dd($newTrainingRequest);
        $newTrainingRequest->save();


        return redirect()->route('training.request.all');

    }
    public static function getNewRequestCode(){

        $currentYear = date("Y");
        $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
        $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));

        $count = TrainingRequest::whereBetween('created_at',[$startYear,$endYear])->count();
        $TrainingCode = 'TRAIN'.date('Y').str_pad( $count+1 ,4,'0',STR_PAD_LEFT);

        return $TrainingCode;
    }

    private function storeFile(UploadedFile $file,$request,$training_code){
        $now = new Carbon();

        $ext = $file->getClientOriginalExtension();

        $filename = $training_code.'-'.$request->subject.'-'.$now->timestamp;

        $upload_location = '/TrainPDF/'.$request->subject.'/';
        $full_path = $upload_location.$filename.'.'.$ext;

        Storage::putFileAs($upload_location,$file,$filename.'.'.$ext);

        Storage::getVisibility($full_path);

        return $full_path;
    }

    public static function tranformData($data){
        $tranformData = $data;
        $tranformData->created_at_C = new Carbon($data->created_at);
        $tranformData->updated_at_C = new Carbon($data->created_at);
        // $tranformData->training_008->train_dateStart = $data->doc_startDate?new Carbon($data->training_008->train_dateStart):null;
        $tranformData->training_dateReview = $data->training_dateReview?new Carbon($data->training_dateReview):null;
        $tranformData->training_dateApprove = $data->training_dateApprove?new Carbon($data->training_dateApprove):null;
        $tranformData->training_review_obj = $data->user_review?User::find($data->user_review):null;
        $tranformData->user_approve_obj = $data->user_approve_obj?User::find($data->user_approve):null;
        $tranformData->user_id_obj = $data->user_id_obj?User::find($data->user_id):null;

        $tranformData->training_008 = json_decode($tranformData->training_008);
        $tranformData->training_008->train_dateStart = new Carbon($tranformData->training_008->train_dateStart);
        $tranformData->training_008->train_dateEnd= new Carbon($tranformData->training_008->train_dateEnd);
        $tranformData->training_009 = json_decode($tranformData->training_009);
        // dd($tranformData);

        switch ($data->training_status) {
            case '2':
                $tranformData->training_status_text = 'Approved';
                break;
            case '1':
                $tranformData->training_status_text = 'Reviewed';
                break;
            case '0':
                $tranformData->training_status_text = 'Pedding';
                break;
            case '-1':
                $tranformData->training_status_text = 'Rejected';
                break;
            default:
                $tranformData->training_status_text = 'Null';
                break;
        }
        return $tranformData;
    }
    public function updateStatus(Request $request){
        $trainingRequest = TrainingRequest::find($request->id);
        $trainingRequest->training_status = $request->status;
        // $trainingRequest->remark = $request->remark;
        $now = new Carbon();
        //dd($request->status);
        // dd($now->toDateTime());
        // dd(Auth::user()->id,$now->toDateTimestring());
        switch ($request->status) {
            case '1':
                $trainingRequest->training_dateReview = $now->toDateTimestring();
                $trainingRequest->user_review = Auth::user()->id;

                $TCC = User::where('user_level',5)->get();
                // Mail::to($TCC)
                //     ->send(new NotifyMailTraining($trainingRequest));
                // Log::channel('email')->info('email send to '.$TCC.' data '.$trainingRequest);

                // Log::channel('training')->info($trainingRequest->training_code.' update by '.Auth::user()->name .' status to review data : '.$request);
                break;
            case '2':
                Log::channel('training')->info($trainingRequest->training_code.' update by '.Auth::user()->name .' status to approved data : '.$request);
                $trainingRequest->training_dateApprove = $now->toDateTimestring();
                $trainingRequest->user_approve = Auth::user()->id;
                break;
            case '-1':
                Log::channel('training')->info($trainingRequest->training_code.' update by '.Auth::user()->name .' status to reject remark  '. $trainingRequest->remark .' data : '.$request);
                $trainingRequest->training_dateReview = $now->toDateTimestring();
                $trainingRequest->remark = $request->remark;
                break;
                default:
                dd(Auth::user());
                break;
            }
            // dd($trainingRequest);
        $trainingRequest->save();
        if($request->status == 2 || $request->status == -1){
            $TCC = User::find($trainingRequest->staff_id);
            $ACC = User::where('department',Auth::user()->department)
                    ->where(function($q){
                        $q->where('user_level',3)
                        ->orWhere('user_level',5);
                    }
                    )->get();
            Mail::to($TCC)
                ->cc($ACC)
                ->send(new NotifyMailTraining($trainingRequest));
            Log::channel('email')->info('email send to '.$TCC.' cc to '.$ACC.' data '.$trainingRequest);
        }
        return redirect()->route('training.request.all');

    }

    public function published(){
        $trainings = TrainingRequest::where('training_status',2)->get();

        foreach ($trainings as $key => $training) {
            $training = $this->tranformData($training);
        }
        return view('training.index',['trainings'=>$trainings->paginate(9)]);
    }

    public function show($id){
        $training = TrainingRequest::find($id);
        $training = $this->tranformData($training);
        Log::channel('training')->info($training->req_code.' view by '.Auth::user()->name);
        return view('trainingRequest.show',['training'=>$training]);
    }

    public function showPublished($id){
        $training = TrainingRequest::find($id);
        Log::channel('training')->info($training->req_code.' view by '.Auth::user()->name);
        $training = $this->tranformData($training);
        return view('training.show',['training'=>$training]);
    }

    public function show_LDS008($id){
        $training = TrainingRequest::find($id);

        // $data->training_008 = json_decode($data->training_008);
        // $data->training_009 = json_decode($data->training_009);

        $training = $this->tranformData($training);
        Log::channel('training')->info($training->req_code.' view LDS008 by '.Auth::user()->name);
        return view('trainingRequest.print_008',['training'=>$training]);
    }
    public function show_LDS009($id){
        $training = TrainingRequest::find($id);

        // $data->training_008 = json_decode($data->training_008);
        // $data->training_009 = json_decode($data->training_009);
        $training = $this->tranformData($training);
        Log::channel('training')->info($training->req_code.' view LDS009 by '.Auth::user()->name);
        return view('trainingRequest.print_009',['training'=>$training]);
    }

    public function download($id){
        $request = TrainingRequest::find($id);
        $requestFile = $request->pdf_location;
        Log::channel('training')->info($request->training_code.' download by '.Auth::user()->name .' file '.$requestFile);
        return Storage::download($requestFile );
    }
}
