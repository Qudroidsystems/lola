<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DebugAuth
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Request Path: ' . $request->path() . ', Authenticated: ' . (auth()->check() ? 'User ID = ' . auth()->id() . ', Email = ' . auth()->user()->email : 'Not authenticated'));
        return $next($request);
    }
}