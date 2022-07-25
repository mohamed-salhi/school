<?php

use App\Http\Controllers\ClassRoom\ClassRoomController;
use App\Http\Controllers\Grade\GradeController;
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



});


Auth::routes();

