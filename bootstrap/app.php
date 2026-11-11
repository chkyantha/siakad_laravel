<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserHasRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Tamu yang membuka halaman terlindungi dialihkan ke sini
        $middleware->redirectGuestsTo(fn () => route('login'));

        // Pengguna login yang membuka halaman khusus tamu dialihkan ke sini
        $middleware->redirectUsersTo(fn () => route('dashboard'));

        $middleware->alias([
            'role' => \App\Http\Middleware\EnsureUserHasRole::class,
            'no-back' => \App\Http\Middleware\PreventBackHistory::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
    })->create();
