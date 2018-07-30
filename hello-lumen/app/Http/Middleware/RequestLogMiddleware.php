<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use Illuminate\Http\Request;

class RequestLogMiddleware
{
    public function handle($request, Closure $next)
    {
        Log::info("Request Logged\n" .
                sprintf("~~~~\n%s~~~~", (string) $request));
        return $next($request);
    }
}