<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PharmacistController;
use Spatie\GoogleCalendar\Event;

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



Route::get('/',[HomeController::class,'index']);
Route::get('/home',[HomeController::class,'redirect']);

Route::get('/auth.login', function () {
    return view('auth.login');
    });

    Route::get('/auth.regis', function () {
        return view('auth.register');
        });
    
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/add_doctor_view',[AdminController::class,'addview']);
Route::post('/upload_doctor',[AdminController::class,'upload']);

Route::post('/appointment',[HomeController::class,'appointment']);
Route::get('/myappointment',[HomeController::class,'myappointment']);
Route::get('/cancel_appoint/{id}',[HomeController::class,'cancel_appoint']);

Route::get('/showappointment',[AdminController::class,'showappointment']);
Route::get('/approved/{id}',[AdminController::class,'approved']);
Route::get('/canceled/{id}',[AdminController::class,'canceled']);

// Route::get('/calendar', function(){
//     $event = new Event;

//     $event->name = "test";
//     $event->startDateTime = Carbon\Carbon\now();
//     $event->endDateTime = Carbon\Carbon\now()->addHour();

//     $event->save();
    
//     $e = Event::get();
//     dd($e);
// });

Route::get('/medicine',[PharmacistController::class,'addview']);
Route::get('/add',[PharmacistController::class,'add']);
Route::post('/create',[PharmacistController::class,'create']);
Route::get('/edit/{id}',[PharmacistController::class,'edit'])->name('edit');
Route::put('/update/{id}', [PharmacistController::class, 'update'])->name('update');
Route::delete('/destroy/{id}', [PharmacistController::class, 'destroy'])->name('destroy');