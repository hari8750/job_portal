<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Use the 'admin' guard for the admins table
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->withErrors(['email' => 'You are not an admin.']);
        }

        return $next($request);
    }
}
