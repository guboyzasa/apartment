<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {


           if (Auth::guard($guard)->check() && Auth::user()->is_super_admin == 0 ){
                return redirect()->route('dashboard');
           }

            if (Auth::guard($guard)->check() && Auth::user()->is_super_admin == 1) {
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}
