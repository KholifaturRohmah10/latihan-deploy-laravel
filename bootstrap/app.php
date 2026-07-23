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
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// FOR VERCEL: Force storage to /tmp to prevent all read-only crashes
$storage = '/tmp/storage';
@mkdir($storage . '/framework/views', 0777, true);
@mkdir($storage . '/framework/cache/data', 0777, true);
@mkdir($storage . '/framework/sessions', 0777, true);
@mkdir($storage . '/logs', 0777, true);
$app->useStoragePath($storage);

// FOR VERCEL: Force APP_KEY if missing
if (empty($_ENV['APP_KEY'])) {
    $_ENV['APP_KEY'] = 'base64:evD3cGyTjib97WJlmt9CL1KVffS2/MvtExMX7zrJn2I=';
    putenv('APP_KEY=base64:evD3cGyTjib97WJlmt9CL1KVffS2/MvtExMX7zrJn2I=');
}

return $app;
