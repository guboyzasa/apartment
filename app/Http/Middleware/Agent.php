<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Agent
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
        if( Auth::check() && Auth::user()->is_active == 1 && Auth::user()->is_super_admin == 0 && Auth::user()->company->is_active == 1){
            return $next($request);
        }else{
            Session::flush();
            Auth::logout();
            return redirect('login')->withErrors('ร้านของคุณถูกระงับ กรุณาติดต่อผู้พัฒนา');
        }
    }
}
