<?php

namespace App\Http\Middleware\Roles;

use Closure;
use Illuminate\Http\Request;

class DenyRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param $roles array of names
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles): mixed
    {
        $user = auth()->user();
        if (count($user->roles) === 0)
            abort(403, 'You do not have any role');

        foreach ($user->roles as $role) {
            if (!in_array($role->name, $roles))
                return $next($request);
        }

        abort(403, 'Access denied');
    }
}
