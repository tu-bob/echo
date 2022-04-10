<?php

namespace App\Http\Middleware\Roles;

use Closure;
use Illuminate\Http\Request;

class AllowRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles): mixed
    {
        $user = auth()->user();

        if ($user->hasAnyRole($roles))
            return $next($request);

        abort(403, 'Access denied');
    }
}
