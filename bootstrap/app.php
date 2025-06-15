<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Responses\ErrorResponse;
use App\Constants\ErrorMessages;
use App\Exceptions\InvalidCredentialsException;
use App\Constants\AuthMessages;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (AuthorizationException $e, $request) {
            return ErrorResponse::make(ErrorMessages::FORBIDDEN, 403);
        });

        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            return ErrorResponse::make(ErrorMessages::NOT_FOUND, 404);
        });

        $exceptions->renderable(function (ValidationException $e, $request) {
            return ErrorResponse::make(ErrorMessages::VALIDATION_FAILED, 422);
        });

        $exceptions->renderable(function (HttpException $e, $request) {
            return ErrorResponse::make($e->getMessage(), $e->getStatusCode());
        });

        $exceptions->renderable(function (InvalidCredentialsException $e, $request) {
            return ErrorResponse::make(AuthMessages::INVALID_CREDENTIALS, 401);
        });

        $exceptions->renderable(function (AuthenticationException $e, $request) {
            return ErrorResponse::make(ErrorMessages::UNAUTHORIZED, 401);
        });

        // Para cualquier otra excepción
        $exceptions->renderable(function (Throwable $e, $request) {
            return ErrorResponse::make(ErrorMessages::SERVER_ERROR, 500);
        });
    })->create();
