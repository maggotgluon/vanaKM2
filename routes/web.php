<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\TrainingRequestController;
use App\Http\Controllers\UserController;
use App\Models\DocumentRequest;
use App\Models\TrainingRequest;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // document
    Route::name('document.')->prefix('document')->group(function (){
        Route::get('/', [DocumentController::class,'index'] )
        ->name('index'); //all doc
        Route::name('request.')->prefix('request')->group(function (){
            Route::get('/create', [DocumentRequestController::class,'create'] )
                ->name('form'); //single doc
            Route::post('/create', [DocumentRequestController::class,'store'] )
                ->name('store'); //single doc

            Route::post('/updateStatus', [DocumentRequestController::class,'updateStatus'] )
                ->name('updateStatus'); //single doc

            Route::get('/download/{id}',[DocumentRequestController::class,'download'])
            ->name('download'); //single doc

            Route::get('/view/dar/{id}', [DocumentRequestController::class,'showDar'] )
            ->name('showDar'); //single doc

            Route::get('/view/{id}', [DocumentRequestController::class,'show'] )
            ->name('show'); //single doc


            Route::get('/{user?}', [DocumentRequestController::class,'index'] )
            ->name('all'); //all doc
        });
        Route::get('/download/{id}', [DocumentController::class,'download'] )
        ->name('download'); //single doc
        Route::get('/{id}', [DocumentController::class,'show'] )
        ->name('show'); //single doc

    });
    // training
    Route::name('training.')->prefix('training')->group(function (){
        Route::get('/', [TrainingRequestController::class,'published'] )
        ->name('index'); //all doc

        Route::name('request.')->prefix('request')->group(function (){
            Route::get('/create', [TrainingRequestController::class,'create'] )
                ->name('form'); //single doc
            Route::post('/create', [TrainingRequestController::class,'store'] )
                ->name('store'); //single doc

            Route::post('/updateStatus', [TrainingRequestController::class,'updateStatus'] )
                ->name('updateStatus'); //single doc

            Route::get('/download/{id}',[TrainingRequestController::class,'download'])
            ->name('download'); //single doc

            Route::get('/view/LDS008/{id}', [TrainingRequestController::class,'show_LDS008'] )
            ->name('show_008'); //single doc
            Route::get('/view/LDS009/{id}', [TrainingRequestController::class,'show_LDS009'] )
            ->name('show_009'); //single doc

            Route::get('/view/{id}', [TrainingRequestController::class,'show'] )
            ->name('show'); //single doc


            Route::get('/{user?}', [TrainingRequestController::class,'index'] )
            ->name('all'); //all doc
        });

        Route::get('/download/{id}', [TrainingRequestController::class,'download'] )
        ->name('download'); //single doc
        Route::get('/{id}', [TrainingRequestController::class,'showPublished'] )
        ->name('show'); //single doc

    });
    // post
    Route::name('post.')->prefix('post')->group(function (){

    });
    // user
    Route::name('user.')->prefix('user')->group(function (){
        Route::get('/', [UserController::class,'index'] )
        ->name('index'); //all doc
        Route::post('/', [UserController::class,'search'] )
        ->name('search'); //all doc

        Route::get('/create', [UserController::class,'create'] )
        ->name('create'); //all doc
        Route::post('/register', [UserController::class,'register'] )
        ->name('register'); //all doc
        Route::post('/permission/{id}', [UserController::class,'permission'] )
        ->name('permission'); //all doc

        Route::get('/{id}', [UserController::class,'show'] )
        ->name('show'); //all doc

        Route::post('/update/{id?}', [UserController::class,'store'] )
        ->name('update'); //all doc
    });
});

Route::get('/email/doc',function(){
    $moc = DocumentRequest::get()->random(1);
    $moc = DocumentRequestController::tranformData($moc[0]);
    return view('mail.notify',['data'=>$moc]);

});

Route::get('/email/train',function(){
    $moc = TrainingRequest::get()->random(1);
    $moc = TrainingRequestController::tranformData($moc[0]);
    return view('mail.notifyTraining',['data'=>$moc]);

});

// Route::fallback(function() {
//     return "You're message goes here!";
// });
