<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if (! in_array($request->user()->role, $roles)) {
            return redirect($this->dashboardFor($request->user()->role));
        }

        return $next($request);
    }

    private function dashboardFor(string $role): string
    {
        return match ($role) {
            'super_admin' => '/superadmin',
            'teacher' => '/teacher',
            'student' => '/student',
            'parent' => '/parent',
            default => '/dashboard',
        };
    }
}