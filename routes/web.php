<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\TrainRequesrController;
use App\Http\Controllers\UserController;
use App\Models\document as ModelsDocument;
use App\Models\document_request;
use App\Models\train_request;
use App\Models\User;
use App\Models\users_permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Node\Block\Document;
use Illuminate\Foundation\Auth\User as AuthUser;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
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

// route group auth
Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard',['documents'=>document_request::where('Doc_Status','1')->get()]);
    })->name('dashboard');

    // group document
    // show all document
    // uri/document
    // Route::get('/document', [DocumentRequestController::class,'show',] )->name('document');
    // show single document
    // uri/document/{id}

    // group document regis
    Route::prefix('document')->group(function (){
        Route::get('', [DocumentRequestController::class,'show',] )->name('document');
        Route::get('/view/{Doc_Code}', function ($Doc_Code) {
            // dd($Doc_Code,ModelsDocument::all(),ModelsDocument::where('Doc_Code',$Doc_Code)->firstOrFail());
            // dd(ModelsDocument::where('id',$Doc_Code)->firstOrFail());
            return view('document.show',[
                'documents'=>ModelsDocument::where('Doc_Code',$Doc_Code)->firstOrFail(),
            ]);
        })->name('documentView');
        
        Route::prefix('request')->group(function (){
            Route::get('', function () {
                // dd(document_request::all());
                $currentYear = date("Y");
                $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
                $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));
        
                $count = document_request::whereBetween('created_at',[$startYear,$endYear])->count();
                // dd($count);
                return view('document.create',[
                    'count_doc_code'=>$count,
                ]);
            })->name('regisDoc');
    
            Route::post('',  [DocumentRequestController::class,'create'] ) 
            -> name('createRegis');
            
            Route::get('/management', [DocumentRequestController::class,'manage',] ) 
            ->name('regisManage');
    
            Route::post('/management/{id}',  [DocumentRequestController::class,'approve','$id'] ) 
            -> name('regisApprove');
    
            Route::get('/{Doc_Code}', function($Doc_Code){
                return view('document.regisShow',[
                    'documents'=>document_request::where('Doc_Code',$Doc_Code)->firstOrFail(),
                ]);
            })->name('regisView');
        });
    });


    // single_regis document (my/manage)
    // uri/reg_document/{id}
    
    // gorup document admin
    // manage document (my/manage/mr)
    // uri/manage_document/

    // regis
    
    //upload new doc
   
        //post 
        // Route::post('/regis_document',  [DocumentRequestController::class,'create'] ) -> name('createRegis');

        //view my doc
        // Route::get('/regis_document/view/', [DocumentRequestController::class,'showReg',] ) ->name('regisOwn');

        // Route::get('/regis_document/manage/', [DocumentRequestController::class,'manage',] ) ->name('regisManage');


        Route::get('/regis_document/view/', function(){
            // Auth::user()->document_request
            
            return view('document.regis',[
                'documents'=>Auth::user()->document_request,
            ]);
        })->name('regisOwn');





        //manage all doc <- admin onlydesde
        //approved doc by md <- md only



    // group training
    // show all training
    // uri/train
    // show single training
    // uri/train/{id}

    // group training regis
    // single_regis training (my/manage)
    // uri/reg_train/{id}

    Route::prefix('training')->group(function (){
        Route::get('', [TrainRequesrController::class,'show',] ) ->middleware(['auth'])->name('training');
        //view single  training
        // Route::get('/view/{id}', [TrainRequesrController::class,'show',] ) ->middleware(['auth'])->name('training');

        Route::get('/view/{id}', [TrainRequesrController::class,'showReg',] ) ->middleware(['auth'])->name('regisTrainOwn');
        Route::prefix('regis')->group(function (){
            Route::get('', function () {
                // dd(document_request::all());
                
                $currentYear = date("Y");
                $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
                $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));
        
                $count = train_request::whereBetween('created_at',[$startYear,$endYear])->count();
        
                // dd(train_request::all()->count());
                //  ddd($startYear, $endYear, $count);
                return view('traning.create',[
                    'count_train_code'=>$count,
                ]);
            })->middleware(['auth'])->name('regisTrain');

            //view regis training
            Route::get('/view', [TrainRequesrController::class,'showReg',] ) ->middleware(['auth'])->name('regisTrainOwn');
            //view regis training 008
            Route::get('/f008/{id}', [TrainRequesrController::class,'form008',] ) ->middleware(['auth'])->name('regForm008');
            //view regis training 009
            Route::get('/f009/{id}', [TrainRequesrController::class,'form009',] ) ->middleware(['auth'])->name('regForm009');
            //view regis training
            Route::get('/manage', [TrainRequesrController::class,'manage',] ) ->middleware(['auth'])->name('regisTrainManage');
            //view single regis training
            Route::post('/manage/{id}',  [TrainRequesrController::class,'approve','$id'] ) ->middleware(['auth']) -> name('regisTrainApprove');
            //update single regis training
            Route::post('/regis_training',  [TrainRequesrController::class,'create'] ) ->middleware(['auth']) -> name('createTrain');
        });
    });

    Route::name('user.')->group(function () {
        // all route assign user. as prefix
        Route::get('/user/{id}', [UserController::class,'profile'] )
        ->name('profile'); //userProfile

        Route::get('/user', [UserController::class,'all'] )
        ->name('manage'); //userManage

        Route::get('/user/{id}/add/{permission}', function ($user,$permission) {
            DB::table('users_permissions')->updateOrInsert([
                'user_id' =>$user,
                'permissions_type' => 'permission',
                'parmission_name'=>$permission,
            ],['allowance'=>true]);
            return redirect(route('user.profile',$user));
        })->name('addPri'); //addPermission

        Route::get('/user/{id}/remove/{permission}', function ($user,$permission) {
            DB::table('users_permissions')->updateOrInsert([
                'user_id' =>$user,
                'permissions_type' => 'permission',
                'parmission_name'=>$permission,
            ],['allowance'=>false]);
            return redirect(route('user.profile',$user));
        })->name('remPri'); //removePermission
        
        Route::post('/user/update/{user}', function (request $data,User $user) {
            // dd($user->id);
            $newDP = user::where('staff_id',$data->suser)->first();
            // dd($newDP->name);
            $user->department_head = $newDP->name;
            $user->save();
            return redirect(route('user.profile',$user->id));
        })->name('update'); //updateUser
    });

});


// //see all doc
// Route::get('/document', [DocumentRequestController::class,'show',] ) ->middleware(['auth'])->name('document');



// // view / download single doc
// Route::get('/document/{doc_id}', function (Document $doc_id) {
//     // return view('dashboard');
// })->middleware(['auth'])->name('documentCreate');




require __DIR__.'/auth.php';


