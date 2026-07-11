<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsExecutive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('executive.login');
        }

        if (!Auth::user()->isExecutive()) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
