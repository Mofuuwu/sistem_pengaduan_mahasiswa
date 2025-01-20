<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminHandler
{
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request);
        } 
        return redirect('/');

    }
}
