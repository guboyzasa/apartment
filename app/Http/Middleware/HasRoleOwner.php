<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
class HasRoleOwner 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->role_id == 1)  
        {
            return redirect()->back()->withErrors('คุณไม่มีสิทธิ์เข้าถึง!!');
        }

        return $next($request);
    }
}
