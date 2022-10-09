<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\TrainingRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::prefix('document')->group(function (){

        Route::name('document.')->group(function (){
            Route::get('/', [DocumentController::class,'all'] )
            ->name('all'); //all doc
            Route::get('/{id}', [DocumentController::class,'view'] )
            ->name('view'); //single doc
        });

        Route::name('regDoc.')->group(function (){
            // regDoc.all
            Route::get('/reg/all', [DocumentRequestController::class,'all'] )
            ->name('all'); //all reg doc
            // regDoc.all
            Route::get('/reg/all/{user}', [DocumentRequestController::class,'all'] )
            ->name('allUser'); //all reg doc
            // regDoc.createView
            Route::get('/reg/create', [DocumentRequestController::class,'createView'] )
            ->name('create'); //all reg doc
            // regDoc.create
            Route::post('/reg/create', [DocumentRequestController::class,'create'] )
            ->name('create'); //all reg doc
            
            Route::post('/management/{id}',  [DocumentRequestController::class,'approve','$id'] ) 
            -> name('approve');

            // regDoc.view
            Route::get('/reg/dar/{id}', [DocumentRequestController::class,'view'] )
            ->name('view'); //single reg doc
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
            Route::get('/reg/all', [TrainingRequestController::class,'allReg'] )
            ->name('all'); //all reg doc
            Route::get('/reg/all/{user}', [TrainingRequestController::class,'allReg'] )
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

            Route::get('/f008/{id}', [TrainingRequestController::class,'form008',] ) ->middleware(['auth'])
            ->name('form008');
            //view regis training 009
            Route::get('/f009/{id}', [TrainingRequestController::class,'form009',] ) ->middleware(['auth'])
            ->name('form009');

            Route::get('/reg/view/{id}', [TrainingRequestController::class,'viewReg'] )
            ->name('view'); //single reg doc
        });
    });

    Route::name('user.')->prefix('user')->group(function (){

        Route::get('/', [UserController::class,'all'] )
        ->name('manage'); //userManage

        Route::get('/{id}', [UserController::class,'profile'] )
        ->name('profile'); //userProfile

        Route::post('/update/{id}', [UserController::class,'update'] )
        ->name('update'); //userProfile

        Route::post('/permission/{id}', [UserController::class,'permission'] )
        ->name('permission'); //userProfile

        
    });
});

require __DIR__.'/auth.php';
