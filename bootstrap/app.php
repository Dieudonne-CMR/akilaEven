<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckHotlSelect;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
         // Ajouter les 01/04/2025
        $middleware->alias([
            'aliasMiddleware' => CheckHotlSelect::class,
            'check.hotel.owner' => \App\Http\Middleware\CheckHotelOwner::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();
    // Ajouter le middleware de vérification de l'hôtel

    // $app->routeMiddleware([
    //     'check.hotel.owner' => \App\Http\Middleware\CheckHotelOwner::class,
    // ]);
    
