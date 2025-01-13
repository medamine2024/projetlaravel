<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Redirect unauthenticated users
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Redirect users without admin role
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'You do not have admin access.');
        }

        return $next($request);
    }
}