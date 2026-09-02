<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if 'admin' is in session
        if (!session()->has('admin')) {
            // Redirect to admin login if not logged in
            return redirect()->route('admin.login');
        }

        // Allow request to proceed if admin is logged in
        return $next($request);
    }
}
