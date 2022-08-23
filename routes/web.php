<?php

use App\Http\Controllers\ClassRoom\ClassRoomController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Section\SectionsController;
use App\Http\Controllers\Students\PromoitonController;
use App\Http\Controllers\Students\StudentsController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(['middleware'=>['guest']],function (){
    Route::get('/',function (){
    return view('auth.login');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('Grades',GradeController::class);
    Route::resource('Classrooms',ClassRoomController::class);
    Route::post('delete_all',[ClassRoomController::class,'delete_all'])->name('delete_all');
    Route::post('Filter',[ClassRoomController::class,'Filter'])->name('Filter');
    Route::resource('Sections',SectionsController::class);
    Route::get('classes/{id}',[SectionsController::class,'getclasses']);
    Route::view('add_parent','livewire.show_form');
    Route::resource('Teachers',TeacherController::class);
    Route::resource('Students',StudentsController::class);
    Route::get('classes_room/{id}',[StudentsController::class,'classes_room'])->name('classes_room');
    Route::get('Get_Sections/{id}',[StudentsController::class,'Get_Sections'])->name('Get_Sections');
    Route::post('Upload_attachment',[StudentsController::class,'Upload_attachment'])->name('Upload_attachment');
    Route::get('Download_attachment/{studentsname}/{filename}',[StudentsController::class,'Download_attachment'])->name('Download_attachment');
    Route::post('Delete_attachment', [StudentsController::class,'Delete_attachment'])->name('Delete_attachment');
    Route::resource('promotion',PromoitonController::class);



});


Auth::routes();

