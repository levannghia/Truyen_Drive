<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterTruyenTranhController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\TruyenTranhController;
use App\Http\Controllers\UserController;

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

Route::get('lang/{locale}',function($locale){
    if(!in_array($locale,['en','vi'])){
        abort(404);
    }
    session()->put('locale',$locale);
    return redirect()->back();
});

Route::get('/', function () {
    return view('layout');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [IndexController::class, 'home']);
Route::get('/doc-truyen/{slug}', [IndexController::class, 'docTruyen'])->name('doc.truyen');
Route::get('/doc-truyen-tranh/{slug}', [IndexController::class, 'docTruyenTranh'])->name('doc.truyen.tranh');
Route::get('/xem-chapter/{slug}', [IndexController::class, 'chapter'])->name('xem.chapter');
Route::get('/xem-chapter-truyen-tranh/{slug}', [IndexController::class, 'chapterTruyenTranh'])->name('xem.chapter.truyen.tranh');
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhMuc'])->name('danh.muc');
Route::get('/tag/{slug}', [IndexController::class, 'tag'])->name('tag');
Route::post('/search-ajax', [IndexController::class, 'searchAjax'])->name('search.ajax');
Route::post('/view-ajax', [IndexController::class, 'viewAjax'])->name('view.ajax');
Route::get('/search', [IndexController::class, 'search'])->name('search');
Route::group(['middleware' => ['auth']],function(){
    Route::resource('/category',CategoryController::class);
    Route::resource('/truyen',TruyenController::class);
    Route::resource('/chapter',ChapterController::class);
    Route::resource('/truyen-tranh',TruyenTranhController::class);
    Route::resource('/chapter-truyen-tranh',ChapterTruyenTranhController::class);
    //role
    Route::resource('/user',UserController::class);
    Route::get('/phan-quyen/{id}',[UserController::class,'phanQuyen'])->name('phan.quyen');
    //google drive 
    Route::get('/new-folder',[GoogleDriveController::class,'newTruyenTranh'])->name('gg.new.folder');
});