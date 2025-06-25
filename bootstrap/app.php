<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\AuthenticateAdmin;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin_auth' => AuthenticateAdmin::class
        ]);

        $middleware->redirectUsersTo(function (Request $request) {
                            if($request->user()->isUserAdmin()){
                                return route('admin.dashboard');
                            } else {
                                return route('dashboard');
                            }
                        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
