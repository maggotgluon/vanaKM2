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
    Route::get('/document', [DocumentRequestController::class,'show',] )->name('document');
    // show single document
    // uri/document/{id}

    // group document regis

    // single_regis document (my/manage)
    // uri/reg_document/{id}
    
    // gorup document admin
    // manage document (my/manage/mr)
    // uri/manage_document/

    // group training
    // show all training
    // uri/train
    // show single training
    // uri/train/{id}

    // group training regis
    // single_regis training (my/manage)
    // uri/reg_train/{id}

    // manage document (my/manage/mr)
    // uri/manage_document/


    // group user
    // show all user
    // uri/users/
    // show id
    // uri/users/{id}

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

// regis
//upload new doc
Route::get('/regis_document', function () {
    // dd(document_request::all());
    $currentYear = date("Y");
    $startYear = date("Y-m-d",mktime(0,0,0,1,1,$currentYear));
    $endYear = date("Y-m-d",mktime(0,0,0,12,31,$currentYear));

    $count = document_request::whereBetween('created_at',[$startYear,$endYear])->count();
    // dd($count);
    return view('document.create',[
        'count_doc_code'=>$count,
    ]);
})->middleware(['auth'])->name('regisDoc');
//post 
Route::post('/regis_document',  [DocumentRequestController::class,'create'] ) ->middleware(['auth']) -> name('createRegis');

//view my doc
Route::get('/regis_document/view/', [DocumentRequestController::class,'showReg',] ) ->middleware(['auth'])->name('regisOwn');

Route::get('/regis_document/manage/', [DocumentRequestController::class,'manage',] ) ->middleware(['auth'])->name('regisManage');

Route::post('/regis_document/manage/{id}',  [DocumentRequestController::class,'approve','$id'] ) ->middleware(['auth']) -> name('regisApprove');

// Route::get('/regis_document/view/', function(){
//     // Auth::user()->document_request
    
//     return view('document.regis',[
//         'documents'=>Auth::user()->document_request,
//     ]);
// })->middleware(['auth'])->name('regisOwn');

Route::get('/regis_document/view/{Doc_Code}', function($Doc_Code){
    return view('document.regisShow',[
        'documents'=>document_request::where('Doc_Code',$Doc_Code)->firstOrFail(),
    ]);
})->middleware(['auth'])->name('regisView');




Route::get('/document/{Doc_Code}', function ($Doc_Code) {
    return view('document.Show',[
        'documents'=>ModelsDocument::where('id',$Doc_Code)->firstOrFail(),
    ]);
})->middleware(['auth'])->name('documentView');
//manage all doc <- admin onlydesde
//approved doc by md <- md only



// //see all doc
Route::get('/training', [TrainRequesrController::class,'show',] ) ->middleware(['auth'])->name('training');

// // view / download single doc
// Route::get('/document/{doc_id}', function (Document $doc_id) {
//     // return view('dashboard');
// })->middleware(['auth'])->name('documentCreate');

// regis
//upload new doc
Route::get('/regis_training', function () {
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



//post 
Route::post('/regis_training',  [TrainRequesrController::class,'create'] ) ->middleware(['auth']) -> name('createTrain');

//view my doc
Route::get('/regis_training/view/', [TrainRequesrController::class,'showReg',] ) ->middleware(['auth'])->name('regisTrainOwn');

Route::get('/regis_training/manage/', [TrainRequesrController::class,'manage',] ) ->middleware(['auth'])->name('regisTrainManage');

Route::post('/regis_training/manage/{id}',  [TrainRequesrController::class,'approve','$id'] ) ->middleware(['auth']) -> name('regisTrainApprove');



require __DIR__.'/auth.php';


