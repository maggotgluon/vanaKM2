<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentRequestController;
use App\Models\document as ModelsDocument;
use App\Models\document_request;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Node\Block\Document;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// //see all doc
Route::get('/document', function () {
    return view('document.index');
})->middleware(['auth'])->name('document');


// // view / download single doc
// Route::get('/document/{doc_id}', function (Document $doc_id) {
//     // return view('dashboard');
// })->middleware(['auth'])->name('documentCreate');


// regis
//upload new doc
Route::get('/regis_document', function () {
    return view('document.create');
})->middleware(['auth'])->name('regisDoc');
//post 
Route::post('/document/regis_document',  [DocumentRequestController::class,'create'] ) ->middleware(['auth']) -> name('createRegis');

//view my doc
Route::get('/regis_document/view/', function(){
    return view('document.regis',[
        'documents'=>document_request::all(),
    ]);
})->middleware(['auth'])->name('regisOwn');

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



require __DIR__.'/auth.php';


