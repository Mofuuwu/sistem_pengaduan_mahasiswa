<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home.index');
});

Route::get('/buat-aduan', function () {
    return view('home.make-complaint');
});

Route::get('/detail-aduan', function () {
    return view('home.complaint-detail');
});

Route::get('/aduan-berhasil', function () {
    return view('home.complaint-success');
});


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

Route::get('/jelajahi-aduan', [ComplaintController::class, 'search_complaint']);
Route::get('jelajahi-aduan/{id}', [ComplaintController::class, 'detail']);

Route::get('/aduanku', [ComplaintController::class, 'my_complaint']);
Route::get('aduanku/{id}', [ComplaintController::class, 'detail']);

Route::post('jelajahi-aduan/{complaint}/add-support', [ComplaintController::class, 'add_support'])->middleware('auth');
Route::post('aduanku/{complaint}/add-support', [ComplaintController::class, 'add_support'])->middleware('auth');
Route::post('jelajahi-aduan/{complaint}/del-support', [ComplaintController::class, 'del_support'])->middleware('auth');
Route::post('aduanku/{complaint}/del-support', [ComplaintController::class, 'del_support'])->middleware('auth');