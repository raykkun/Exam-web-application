<?php
namespace App\Http\Middleware;

class RoleMiddleware extends Middleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (! in_array(auth()->user()->role, $roles)) {
            abort(403);
        }

        return $next($request);
}
}
