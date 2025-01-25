<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ComplaintController;

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
//--------- COMPLAINT --------------------
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
//--------- HELPER --------------------
Route::get('/attachments/{id}/download', [HelperController::class, 'downloadAttachment'])->name('attachments.download');
//--------- ANOTHER --------------------
Route::get('/aduan-berhasil', function () {
    return view('home.complaint-success');
});

Route::post('employee/complaints/add_logs', [AdminController::class, 'add_logs'])->name('employee_add_logs')->middleware('employeeHandler');
Route::post('employee/complaints/del-log/{id}', [AdminController::class, 'del_logs'])->name('employee_del_logs')->middleware('employeeHandler');