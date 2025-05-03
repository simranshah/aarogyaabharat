<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('customer')->check()) {
            dd('customer login');
            // Redirect to the customer login page if not authenticated
            return redirect()->route('customer.login'); // Adjust based on your routes
        }

        return $next($request);
    }
}
