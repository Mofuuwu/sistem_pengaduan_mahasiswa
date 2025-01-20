<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\UserHandler;
use Illuminate\Support\Facades\Route;


Route::get('/aduan-berhasil', function () {
    return view('home.complaint-success');
});

//---------- HOME -------------------

Route::get('/', [HomeController::class, 'index'])->middleware('userHandler');


//--------- AUTH --------------------

Route::get('/register', [AuthController::class, 'register'])->middleware('guest')->name('user-register');
Route::post('/register', [AuthController::class, 'doRegister']);

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('user-login');
Route::post('/login', [AuthController::class, 'doLogin']);

Route::get('/login-admin', [AuthController::class, 'login_admin'])->middleware('guest')->name('admin-login');
Route::post('/login-admin', [AuthController::class, 'doLoginAdmin']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/profile', [AuthController::class, 'profile'])->middleware(['auth', 'userHandler'])->name('profile');
Route::post('/profile', [AuthController::class, 'editProfile'])->middleware('auth');

//Seputar Aduan
Route::post('/buat-aduan', [ComplaintController::class, 'handle_complaint']);
Route::get('/buat-aduan', [ComplaintController::class, 'make_complaint'])->middleware('userHandler');

Route::get('/jelajahi-aduan', [ComplaintController::class, 'search_complaint'])->name('jelajahi-aduan')->middleware('userHandler');
Route::get('jelajahi-aduan/{id}', [ComplaintController::class, 'detail'])->middleware('userHandler');

Route::get('/aduanku', [ComplaintController::class, 'my_complaint'])->middleware('userHandler');
Route::get('/aduan-didukung', [ComplaintController::class, 'supported_complaint'])->middleware('userHandler');

Route::get('aduanku/{id}', [ComplaintController::class, 'detail'])->middleware('userHandler');
Route::get('aduan-didukung/{id}', [ComplaintController::class, 'detail'])->middleware('userHandler');

Route::get('detail/{id}', [ComplaintController::class, 'detail'])->name('complaint_detail')->middleware('userHandler');

Route::post('jelajahi-aduan/{complaint}/add-support', [ComplaintController::class, 'add_support'])->middleware('auth');
Route::post('aduanku/{complaint}/add-support', [ComplaintController::class, 'add_support'])->middleware('auth');
Route::post('detail/{complaint}/add-support', [ComplaintController::class, 'add_support'])->middleware('auth');

Route::post('jelajahi-aduan/{complaint}/del-support', [ComplaintController::class, 'del_support'])->middleware('auth');
Route::post('aduanku/{complaint}/del-support', [ComplaintController::class, 'del_support'])->middleware('auth');
Route::post('detail/{complaint}/del-support', [ComplaintController::class, 'del_support'])->middleware('auth');

Route::post('search', [HelperController::class, 'search_complaint_by_id'])->name('search_complaint_by_id');


// =========== Download ===================
Route::get('/attachments/{id}/download', [HelperController::class, 'downloadAttachment'])->name('attachments.download')->middleware('userHandler');