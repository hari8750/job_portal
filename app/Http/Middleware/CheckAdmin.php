<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Example: Only allow admin users
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/'); // redirect to home if not admin
        }

        return $next($request);
    }
}
