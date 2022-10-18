<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\TrainingRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Document;
use App\Models\TrainingRequest;
use App\Models\User;

use Illuminate\Support\Carbon;


// use Livewire\Component;
// use Usernotnull\Toast\Concerns\WireToast;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', function () {

        $user = User::all();
        // $documents = Document::all();
        $now = new Carbon();
        $documents = Document::where('Doc_StartDate','<=',$now)->get();
        foreach ($documents as $index => $document) {
            # code...
            $created_at=new Carbon($document->created_at);
            $document->created_atC=$created_at;
            $document->created_atT=$created_at->diffForHumans();
            $updated_at=new Carbon($document->updated_at);
            $document->updated_atC=$updated_at;
            $document->updated_atT=$updated_at->diffForHumans();
            $Doc_StartDate=new Carbon($document->Doc_StartDate);
            $document->Doc_StartDateC=$Doc_StartDate;
            $document->Doc_StartDateT=$Doc_StartDate->diffForHumans();
            $Doc_DateApprove=new Carbon($document->Doc_DateApprove);
            $document->Doc_DateApproveC=$Doc_DateApprove;
            $document->Doc_DateApproveT=$Doc_DateApprove->diffForHumans();
        }
        $trainings = TrainingRequest::where('Doc_Status',2)->get();

        foreach ($trainings as $index => $training) {
            $training->Doc_008 = json_decode($training->Doc_008);
            $training->Doc_009 = json_decode($training->Doc_009);
            // $training->Doc_DateApprove
            $Doc_DateApprove=new Carbon($training->Doc_DateApprove);
            $training->Doc_DateApproveC=$Doc_DateApprove;
            $training->Doc_DateApproveT=$Doc_DateApprove->diffForHumans();

            // $training->Doc_DateReview
            $Doc_DateReview=new Carbon($training->Doc_DateReview);
            $training->Doc_DateReviewC=$Doc_DateReview;
            $training->Doc_DateReviewT=$Doc_DateReview->diffForHumans();

            $training->User_Approve = $training->User_Approve==null?null:User::find($training->User_Approve);

            $training->User_Review = $training->User_Review == null?null:User::find($training->User_Review);

            $training->user_id = $training->user_id == null?null:User::find($training->user_id);

            $created_at=new Carbon($training->created_at);
            $training->created_atC=$created_at;
            $training->created_atT=$created_at->diffForHumans();
            $updated_at=new Carbon($training->updated_at);
            $training->updated_atC=$updated_at;
            $training->updated_atT=$updated_at->diffForHumans();

        }
        // dd($trainings[0]);
        return view('dashboard',['user'=>$user,'documents'=>$documents,'trainings'=>$trainings]);

    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::prefix('view')->group(function (){
        Route::get('level', function(){
            return view('static.userLevel');
        })->name('userLV'); //all doc
    });
    Route::prefix('document')->group(function (){

        Route::name('document.')->group(function (){
            Route::get('/', [DocumentController::class,'all'] )
            ->name('all'); //all doc
            Route::get('/{id}', [DocumentController::class,'view'] )
            ->name('view'); //single doc
        });

        Route::name('regDoc.')->group(function (){
            // regDoc.all
            Route::get('/reg/all/{filter?}', [DocumentRequestController::class,'all'] )
            ->name('all'); //all reg doc
            // regDoc.all
            Route::get('/reg/user/{filter?}/', [DocumentRequestController::class,'allUser'] )
            ->name('allUser'); //all reg doc
            Route::get('/reg/MR/{filter?}', [DocumentRequestController::class,'allMR'] )
            ->name('allMR'); //all reg doc
            // regDoc.createView
            Route::get('/reg/create', [DocumentRequestController::class,'createView'] )
            ->name('create'); //all reg doc
            // regDoc.create
            Route::post('/reg/create', [DocumentRequestController::class,'create'] )
            ->name('create'); //all reg doc

            Route::post('/management/{id}',  [DocumentRequestController::class,'approve','$id'] )
            -> name('approve');

            Route::get('/management/reject/{id}',  [DocumentRequestController::class,'approve','$id'] )
            -> name('reject');
            Route::post('/management/reject/{id}',  [DocumentRequestController::class,'approve','$id'] )
            -> name('reject');

            // regDoc.view
            Route::get('/reg/dar/{id}', [DocumentRequestController::class,'view'] )
            ->name('view'); //single reg doc

            // regDoc.Dar
            Route::get('/f-dar/{id}', [DocumentRequestController::class,'DarForm',] )
            ->name('DarForm');
        });
    });

    Route::prefix('training')->group(function (){

        Route::name('training.')->group(function (){
            Route::get('/', [TrainingRequestController::class,'all'] )
            ->name('all'); //all doc
            Route::get('/view/{id}', [TrainingRequestController::class,'view'] )
            ->name('view'); //single doc
        });

        Route::name('regTraining.')->group(function (){
            Route::get('/reg/all/{filter?}', [TrainingRequestController::class,'allReg'] )
            ->name('all'); //all reg doc
            Route::get('/reg/user/{filter?}', [TrainingRequestController::class,'allRegUser'] )
            ->name('allUser'); //all reg doc

            // regDoc.createView
            Route::get('/reg/create', [TrainingRequestController::class,'createView'] )
            ->name('create'); //all reg doc
            // regDoc.create
            Route::post('/reg/create', [TrainingRequestController::class,'create'] )
            ->name('create'); //all reg doc

            Route::post('/management/{id}',  [TrainingRequestController::class,'approve','$id'] )
            -> name('approve');
            //view regis training 008

            Route::get('/f008/{id}', [TrainingRequestController::class,'form008',] )
            ->name('form008');
            //view regis training 009
            Route::get('/f009/{id}', [TrainingRequestController::class,'form009',] )
            ->name('form009');

            Route::get('/reg/view/{id}', [TrainingRequestController::class,'viewReg'] )
            ->name('view'); //single reg doc
        });
    });

    Route::name('user.')->prefix('user')->group(function (){

        Route::get('/', [UserController::class,'all'] )
        ->name('manage'); //userManage
        Route::post('/', [UserController::class,'allFiltter'] )
        ->name('allFilter'); //userManage

        Route::get('/{id}', [UserController::class,'profile'] )
        ->name('profile'); //userProfile

        Route::post('/update/{id}', [UserController::class,'update'] )
        ->name('update'); //userProfile

        Route::post('/permission/{id}', [UserController::class,'permission'] )
        ->name('permission'); //userProfile

        Route::post('/changePassword/{id}', [UserController::class,'changePassword'] )
        ->name('changePassword'); //userProfile


    });
});

require __DIR__.'/auth.php';
