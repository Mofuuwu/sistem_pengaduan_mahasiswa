<?php

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

Route::get('/profile', function () {
    return view('home.profile');
});

Route::get('/detail-aduan', function () {
    return view('home.complaint-detail');
});

Route::get('/login', function () {
    return view('home.auth.login');
});

Route::get('/register', function () {
    return view('home.auth.register');
});
