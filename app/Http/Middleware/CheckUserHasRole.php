<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;

class CheckUserHasRole
{
    public function handle(Request $request, Closure $next, ... $roles)
    {
        if (!auth()->user()->role)
            abort(403);

        if (empty($roles)) {
            return $next($request);
        }

        $role = new UserRole(auth()->user()->role->name);

        if (!$role->in($roles))
            abort(403);

        return $next($request);
    }
}
