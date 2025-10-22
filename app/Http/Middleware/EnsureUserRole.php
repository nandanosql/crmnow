<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('user.login');
        }

        if (auth()->user()->role !== 'user') {
            abort(403, 'Access denied. This area is for regular users only.');
        }

        if (!auth()->user()->isActive()) {
            auth()->logout();
            return redirect()->route('user.login')->withErrors([
                'email' => 'Your account has been disabled. Please contact system administrator.'
            ]);
        }

        return $next($request);
    }
}