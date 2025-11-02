<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (! $request->user()) {
            abort(401);
        }

        $allowed = array_map('trim', explode('|', $roles));

        if (! in_array($request->user()->role, $allowed, true)) {
            abort(403, 'This action is unauthorized.');
        }

        return $next($request);
    }
}
