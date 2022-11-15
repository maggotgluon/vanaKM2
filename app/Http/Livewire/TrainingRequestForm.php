<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TrainingRequestController;
use App\Models\TrainingRequest;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use App\Mail\NotifyMailTraining;
use App\Models\User;

class TrainingRequestForm extends Component
{
    use WithFileUploads;
    use Actions;

    public $training_code;
    public $subject_code;
    public $training_008;

    public $instructor;

    public $subject;
    public $train_dateStart;
    public $train_dateEnd;
    public $train_timeStart;
    public $train_timeEnd;
    public $train_objective;
    public $train_subjectDetails;
    public $train_subjectDuration;

    public $train_activityDetails;
    public $train_activityDuration;
    public $train_assessmentDetails;
    public $train_assessmentDuration;
    public $train_remark;

    // public $training_009;
    public $assessment_process=[];
    public $assessment_tools;
    public $assessment_pass;
    public $assessment_fail;

    public $pdf_location;

    public $training_dateApprove;
    public $user_approve;
    public $training_dateReview;
    public $user_review;
    public $access_lv;

    public $training_status;

    public $user_id;
    public $remark;

    protected $rules = [
        'instructor'=>'required',

        'subject'=>'required',
        'train_dateStart'=>'required',
        'train_dateEnd'=>'required',
        'train_timeStart'=>'required',
        'train_timeEnd'=>'required',
        'train_objective'=>'required',
        'train_subjectDetails'=>'required',
        'train_subjectDuration'=>'required',

        'train_activityDetails'=>'required',
        'train_activityDuration'=>'required',
        'train_assessmentDetails'=>'required',
        'train_assessmentDuration'=>'required',
        // 'train_remark'=>'required',

        'assessment_process'=>'required',
        'assessment_tools'=>'required',
        'assessment_pass'=>'required',
        'assessment_fail'=>'required',

        'pdf_location'=>'required',
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.training-request-form');
    }

    public function store()
    {
        $validatedData = $this->validate($this->rules);

        // storefile
        $filename = $this->subject;
        $path = '/TrainPDF/doc/' . $this->subject;
        $pdf_file_path = $this->pdf_location->storeAs($path, $filename . '.' . $this->pdf_location->getClientOriginalExtension());

        $name = $this->subject;
        // $doc_ver = TrainingRequest::where('doc_name',$this->doc_code)->count();


        $req_code = TrainingRequestController::getNewRequestCode();

        $LDS008 = array(
            'subject' => $this->subject,
            'train_dateStart' => $this->train_dateStart,
            'train_dateEnd' => $this->train_dateEnd,
            'train_timeStart' => $this->train_timeStart,
            'train_timeEnd' => $this->train_timeEnd,
            'train_objective' => $this->train_objective,
            'train_subjectDetails' => $this->train_subjectDetails,
            'train_subjectDuration' => $this->train_subjectDuration,
            // 'SubjectMaterial' => $this->SubjectMaterial,
            // 'SubjectRemark' => $this->SubjectRemark,
            'train_activityDetails' => $this->train_activityDetails,
            'train_activityDuration' => $this->train_activityDuration,
            // 'ActivityMaterial' => $this->ActivityMaterial,
            // 'ActivityRemark' => $this->ActivityRemark,
            'train_assessmentDetails' => $this->train_assessmentDetails,
            'train_assessmentDuration' => $this->train_assessmentDuration,
            // 'AssessmentMaterial' => $this->AssessmentMaterial,
            'train_remark' => $this->train_remark,

        );
        $LDS009 = array(
            'subject' => $this->subject,
            'assessment_process' => $this->assessment_process,
            'assessment_tools' => $this->assessment_tools,
            'assessment_pass' => $this->assessment_pass,
            'assessment_fail' => $this->assessment_fail,
        );

        $LDS008 = json_encode($LDS008);
        $LDS009 = json_encode($LDS009);

        $newTrainingRequest = new TrainingRequest();

        // dd($this);
        $newTrainingRequest->training_code = $req_code;
        $newTrainingRequest->instructor = $this->instructor;
        $newTrainingRequest->training_008 = $LDS008;
        $newTrainingRequest->training_009 = $LDS009;
        // $newTrainingRequest->training_dateApprove =
        // $newTrainingRequest->user_approve =
        // $newTrainingRequest->training_dateReview =
        // $newTrainingRequest->user_review =
        // $newTrainingRequest->access_lv =

        $newTrainingRequest->pdf_location = $pdf_file_path;
        $newTrainingRequest->training_status = 0;
        $newTrainingRequest->user_id = Auth::user()->id;
        // $newTrainingRequest->remark = ;
        $save = $newTrainingRequest->save();

        if ($save) {
            $TCC = User::where('user_level',4)->get();
            // $ACC = User::where('user_level',3)->where('department',Auth::user()->department)->get();
            // dd($TCC,$ACC);
            Mail::to($TCC)
                // ->cc($ACC)
                ->send(new NotifyMailTraining($newTrainingRequest));
            $this->notification()->send([
                'title'       => $req_code . ' ' . $name . ' has beem request.',
                'description' => 'Please wait for response',
                'icon'        => 'success',

            ]);
            $this->clear();
        } else {
            $this->notification()->send([
                'title'       => 'Error !!!',
                'description' => 'Document request unsucessfull,please try again',
                'icon'        => 'error',
            ]);
        }
    }
    private function clear()
    {

        $this->training_code = "";
        $this->instructor = "";
        $this->subject_code = "";
        $this->training_008 = "";

        $this->subject = "";
        $this->train_dateStart = "";
        $this->train_dateEnd = "";
        $this->train_timeStart = "";
        $this->train_timeEnd = "";
        $this->train_objective = "";
        $this->train_subjectDetails = "";
        $this->train_subjectDuration = "";

        $this->train_activityDetails = "";
        $this->train_activityDuration = "";
        $this->train_assessmentDetails = "";
        $this->train_assessmentDuration = "";
        $this->train_remark = "";

        $this->training_009 = "";
        $this->assessment_process = "";
        $this->assessment_tools = "";
        $this->assessment_pass = "";
        $this->assessment_fail = "";

        $this->training_dateApprove = "";
        $this->user_approve = "";
        $this->training_dateReview = "";
        $this->user_review = "";
        $this->access_lv = "";

        $this->pdf_location = "";
        $this->training_status = "";

        $this->user_id = "";
        $this->remark = "";
    }
}
