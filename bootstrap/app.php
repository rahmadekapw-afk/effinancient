<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
        'admin_auth' => \App\Http\Middleware\AdminAuth::class,
        'anggota_auth' => \App\Http\Middleware\AnggotaAuth::class,
        'superadmin.auth' => \App\Http\Middleware\SuperAdminAuth::class,
        'admin.or.super'    => \App\Http\Middleware\AdminOrSuperAdmin::class,
        
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
