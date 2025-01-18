<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/aduan-berhasil', function () {
    return view('home.complaint-success');
});

//---------- HOME -------------------

Route::get('/', [HomeController::class, 'index']);


//--------- AUTH --------------------

Route::get('/register', [AuthController::class, 'register'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'doRegister']);

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth')->name('profile');
Route::post('/profile', [AuthController::class, 'editProfile'])->middleware('auth');

//Seputar Aduan
Route::post('/buat-aduan', [ComplaintController::class, 'handle_complaint']);
Route::get('/buat-aduan', [ComplaintController::class, 'make_complaint']);

Route::get('/jelajahi-aduan', [ComplaintController::class, 'search_complaint'])->name('jelajahi-aduan');
Route::get('jelajahi-aduan/{id}', [ComplaintController::class, 'detail']);

Route::get('/aduanku', [ComplaintController::class, 'my_complaint']);
Route::get('/aduan-didukung', [ComplaintController::class, 'supported_complaint']);

Route::get('aduanku/{id}', [ComplaintController::class, 'detail']);
Route::get('aduan-didukung/{id}', [ComplaintController::class, 'detail']);

Route::get('detail/{id}', [ComplaintController::class, 'detail'])->name('complaint_detail');

Route::post('jelajahi-aduan/{complaint}/add-support', [ComplaintController::class, 'add_support'])->middleware('auth');
Route::post('aduanku/{complaint}/add-support', [ComplaintController::class, 'add_support'])->middleware('auth');
Route::post('detail/{complaint}/add-support', [ComplaintController::class, 'add_support'])->middleware('auth');

Route::post('jelajahi-aduan/{complaint}/del-support', [ComplaintController::class, 'del_support'])->middleware('auth');
Route::post('aduanku/{complaint}/del-support', [ComplaintController::class, 'del_support'])->middleware('auth');
Route::post('detail/{complaint}/del-support', [ComplaintController::class, 'del_support'])->middleware('auth');

Route::post('search', [HelperController::class, 'search_complaint_by_id'])->name('search_complaint_by_id');


// =========== Download ===================
Route::get('/attachments/{id}/download', [HelperController::class, 'downloadAttachment'])->name('attachments.download');