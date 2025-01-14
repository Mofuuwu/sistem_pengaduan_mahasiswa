<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/buat-aduan', function () {
    return view('home.make-complaint');
});

Route::get('/aduanku', function () {
    return view('home.my-complaint');
});

Route::get('/jelajahi-aduan', function () {
    return view('home.search-complaint');
});

Route::get('/detail-aduan', function () {
    return view('home.complaint-detail');
});


//--------- AUTH --------------------

Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'doRegister']);

Route::get('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/login', [AuthController::class, 'doLogin']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth');