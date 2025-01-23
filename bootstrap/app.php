<?php

use App\Http\Middleware\AdminHandler;
use App\Http\Middleware\EmployeeHandler;
use App\Http\Middleware\UserHandler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'adminHandler' => AdminHandler::class,
            'employeeHandler' => EmployeeHandler::class,
            'userHandler' => UserHandler::class
        ]);
        $middleware->append([
            UserHandler::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
