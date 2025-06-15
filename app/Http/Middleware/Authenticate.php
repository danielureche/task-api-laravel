<?php

namespace App\Http\Middleware;

use App\Constants\AuthMessages;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            abort(response()->json(['message' => AuthMessages::UNAUTHORIZED], 401));
        }

        return null;
    }
}
