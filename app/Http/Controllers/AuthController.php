<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirecResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register () {
        return view('home.auth.register');
    }

    public function login () {
        return view('home.auth.login');
    }
    public function doRegister () {
        
    }
    public function doLogin () {
        
    }
    
    public function logout (Request $request)    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    
    }
}
