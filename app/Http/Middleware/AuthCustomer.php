<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AuthCustomer
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
        // Check if the user is authenticated
        if (!Auth::check()) {
            \Log::info(['unauthenticated customer']);
            // return redirect()->route('login')->with('error', 'You need to log in first.');
            return redirect()->route('home')->with('error', 'You need to log in first.');
        }

        // Check if the user has the 'Customer' role
        if (!Auth::user()->hasRole('Customer')) {
            \Log::info(['unauthorized customer access']);
            return redirect()->route('home')->with('error', 'You do not have access to this resource.');
        }

        return $next($request);
    }
}
