<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UATLoginMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('app.require_uat_login')) {
            return $next($request); // Skip if not UAT
        }

        $username = env('UAT_USERNAME');
        $password = env('UAT_PASSWORD');

        if ($request->session()->get('uat_logged_in')) {
            return $next($request);
        }

        if ($request->isMethod('post') &&
            $request->input('username') === $username &&
            $request->input('password') === $password) {

            $request->session()->put('uat_logged_in', true);
            return redirect($request->url()); // Refresh to hide login form
        }

        return response()->view('uat-login');
    }
}
