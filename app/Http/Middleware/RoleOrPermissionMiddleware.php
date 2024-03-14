<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleOrPermissionMiddleware
{
    public function handle(Request $request, Closure $next, ...$rolesOrPermissions)
    {
        foreach ($rolesOrPermissions as $roleOrPermission) {
            if ($request->user()->hasRole($roleOrPermission) || $request->user()->hasPermissionTo($roleOrPermission)) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
